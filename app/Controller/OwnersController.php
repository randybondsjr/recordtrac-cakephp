<?php
class OwnersController extends AppController {
  
  var $permissions = array('reassignPoc','addHelper','removeHelper'); //define allowed action for logged in users (staff)
  
  public function reassignPoc() {
    App::uses('CakeEmail', 'Network/Email');
    //no empty requests to this page
    if (empty($this->request->data)) {
      $this->redirect(array('action' => 'index', 'controller' => 'recordtrac'));
    }
    
    //make sure it's actually a change
    if($this->request->data["Owner"]["prev_id"] != $this->request->data["Owner"]["user_id"]){ 
      //get the email for the users being adjusted
      $this->loadModel("User");
      $prevOwner = $this->User->find('first', array(
        'conditions' => array('User.id = '. $this->request->data["Owner"]["prev_id"]),
        'fields' => array('User.email')
      ));
      $newOwner = $this->User->find('first', array(
        'conditions' => array('User.id = '. $this->request->data["Owner"]["user_id"]),
        'fields' => array('User.email')
      ));
      // if this is set, it will update rather than insert, but need to set later
      $ownerID = $this->request->data["Owner"]["owner_id"];
      unset($this->request->data["Owner"]["owner_id"]); 

      //save the new helper
      if ($this->Owner->save($this->request->data)) {
        //email new POC
        $Email = new CakeEmail();
        $Email->template('owners')
            ->emailFormat('html')
            ->to($newOwner["User"]["email"])
            ->from($this->getfromEmail())
            ->subject($this->getAgencyName().' PDR Assigned to You')
            ->viewVars( array(
                'agencyName' => $this->getAgencyName(),
                'page' => '/requests/view/' . $this->request->data["Owner"]["request_id"],
                'responseDays' => $this->getResponseDays()
            ))
            ->send();
        
        //Update prev owner to not active and save reason
        $this->request->data["Owner"]["owner_id"] = $ownerID;
        $this->request->data["Owner"]["reason_unassigned"] = $this->request->data["Owner"]["reason"]; 
        unset($this->request->data["Owner"]["reason"]);
        unset($this->request->data["Owner"]["user_id"]);
        $this->request->data["Owner"]["active"] = 0;
        $this->Owner->id = $this->request->data["Owner"]["owner_id"];
        //update the prev owner and redirect back to request
        if($this->Owner->save($this->request->data)){
          $Email = new CakeEmail();
          $Email->template('staffremoved')
              ->emailFormat('html')
              ->to($prevOwner["User"]["email"])
              ->from($this->getfromEmail())
              ->subject($this->getAgencyName().' PDR Assigned to You')
              ->viewVars( array(
                  'agencyName' => $this->getAgencyName(),
                  'page' => '/requests/view/' . $this->request->data["Owner"]["request_id"]
              ))
              ->send();
          $this->Session->setFlash('<h4>Success!</h4><p class="lead">The Point of Contact for this request has been updated.</p>', 'success');
          $this->redirect(array('controller' => 'requests', 'action' => 'view', $this->request->data["Owner"]["request_id"]));
          
        }
      }
    }
  }
  
  public function addHelper() {
    App::uses('CakeEmail', 'Network/Email');
    //no empty requests to this page
    if (empty($this->request->data)) {
      $this->redirect(array('action' => 'index', 'controller' => 'recordtrac'));
    }
    //check if this person is already a helper
    $currentHelpers = $this->Owner->find('all', array(
      'conditions' => array('Owner.request_id = '. $this->request->data["Owner"]["request_id"] .' AND Owner.is_point_person = 0 AND Owner.active = 1'),
      'fields' => array('Owner.user_id')
    ));
    $currentHelperIDs = array();
    foreach ($currentHelpers as $currentHelper){
      $currentHelperIDs[] = $currentHelper["Owner"]["user_id"];
    }
    // if this person is already a helper, throw error
    if(in_array($this->request->data["Owner"]["user_id"], $currentHelperIDs)){
      //@todo ADD FLASH ERROR Template
      $this->Session->setFlash('<h4>ERROR!</h4><p class="lead">This staff member is already a helper for this request! No Helper Added.</p>', 'danger');
      $this->redirect(array('controller' => 'requests', 'action' => 'view', $this->request->data["Owner"]["request_id"]));
    }
    //save the new helper and email them
    if($this->Owner->save($this->request->data)){
      $this->loadModel("User");
      $helper = $this->User->find('first', array(
        'conditions' => array('User.id = '. $this->request->data["Owner"]["user_id"]),
        'fields' => array('User.email')
      ));
      $Email = new CakeEmail();
      $Email->template('owners')
          ->emailFormat('html')
          ->to($helper["User"]["email"])
          ->from($this->getfromEmail())
          ->subject($this->getAgencyName().' PDR Assigned to You')
          ->viewVars( array(
              'agencyName' => $this->getAgencyName(),
              'page' => '/requests/view/' . $this->request->data["Owner"]["request_id"],
              'responseDays' => $this->getResponseDays()
          ))
          ->send();
      $this->Session->setFlash('<h4>Success!</h4><p class="lead">Helper for this request has been added.</p>', 'success');
      $this->redirect(array('controller' => 'requests', 'action' => 'view', $this->request->data["Owner"]["request_id"]));
    }
	}
	
	public function removeHelper(){
  	App::uses('CakeEmail', 'Network/Email');
    //no empty requests to this page
    if (empty($this->request->data)) {
      $this->redirect(array('action' => 'index', 'controller' => 'recordtrac'));
    }
    $this->Owner->id = $this->request->data["Owner"]["owner_id"];
    $this->Owner->saveField('active',0);
    unset($this->Owner->id);
    unset($this->request->data["Owner"]["owner_id"]);
    if($this->Owner->save($this->request->data)){
      $this->loadModel("User");
      $helper = $this->User->find('first', array(
        'conditions' => array('User.id = '. $this->request->data["Owner"]["user_id"]),
        'fields' => array('User.email')
      ));
      $Email = new CakeEmail();
      $Email->template('staffremoved')
          ->emailFormat('html')
          ->to($helper["User"]["email"])
          ->from($this->getfromEmail())
          ->subject($this->getAgencyName().' PDR Assigned to You')
          ->viewVars( array(
              'agencyName' => $this->getAgencyName(),
              'page' => '/requests/view/' . $this->request->data["Owner"]["request_id"],
              'responseDays' => $this->getResponseDays()
          ))
          ->send();
      $this->Session->setFlash('<h4>Success!</h4><p class="lead">Helper for this request has been removed.</p>', 'success');
      $this->redirect(array('controller' => 'requests', 'action' => 'view', $this->request->data["Owner"]["request_id"]));
    }
	}
	
}