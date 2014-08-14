<?php
class OwnersController extends AppController {
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
          $this->Session->setFlash('<h4>Success!</h4><p class="lead">The Point of Contact for this request has been updated.</p>');
          $this->redirect(array('controller' => 'requests', 'action' => 'view', $this->request->data["Owner"]["request_id"]));
          
        }
      }
    }
  }
}