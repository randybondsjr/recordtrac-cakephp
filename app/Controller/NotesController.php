<?php
class NotesController extends AppController {
  public $components = array("BusinessDays");
  public function add() {
    if (empty($this->request->data)) {
      $this->redirect(array('action' => 'index','controller'=> 'recordtrac'));
    }
    App::uses('CakeEmail', 'Network/Email');
    if (!empty($this->request->data)) {
      if($this->Note->save($this->request->data)){
        $requestID = filter_var($this->request->data["Note"]["request_id"], FILTER_VALIDATE_INT);
        
        //get the subscribers
        $this->loadModel('Subscriber');
        $subscribers = $this->Subscriber->find('all', array(
          'conditions' => array('Subscriber.request_id' => $requestID)
        ));
        
        //get the point of contact
        $this->loadModel('Owner');
        $owner = $this->Owner->find('first', array(
          'conditions' => array('Owner.request_id' => $requestID)
        ));

        foreach ($subscribers as $subscriber){
          //make sure they are set to receive notifications, and have a valid email
          if($subscriber["Subscriber"]["should_notify"] == 1 && $subscriber["User"]["email"] != ''){
            //email subscriber
            $Email = new CakeEmail();
            $Email->template('requestupdated')
                ->emailFormat('html')
                ->to($subscriber["User"]["email"])
                ->from($this->getfromEmail())
                ->subject($this->getAgencyName().' Public Disclosure Request #' .$requestID ." - Updated")
                ->viewVars( array(
                    'agencyName' => $this->getAgencyName(),
                    'page' => '/requests/view/' . $requestID,
                    'ownerEmail' => $owner["User"]["email"],
                    'requestID' => $requestID,
                    'unsubscribe' =>'/requests/unsubscribe/'.$subscriber["Subscriber"]["id"],
                    'note' => $this->request->data["Note"]["text"]
                ))
                ->send();
          }
        }
        
        $this->Session->setFlash('<h4>Success!</h4><p class="lead">Note added to this request, subscribers have been emailed.</p>', 'success');
      }else{
        $this->Session->setFlash('<h4>ERROR</h4><p class="lead">Note could not be added at this time</p>', 'danger');
      }
      $this->redirect(array('action' => 'view', 'controller' => 'requests', $requestID));
    }else{
      $this->redirect(array('action' => 'view', 'controller' => 'requests', $requestID));
    }
	}
	public function extend() {
	  if (empty($this->request->data)) {
      $this->redirect(array('action' => 'index','controller'=> 'recordtrac'));
    }
    App::uses('CakeEmail', 'Network/Email');
    if (!empty($this->request->data)) {
      $this->request->data["Note"] = $this->request->data["Extend"];
      if($this->Note->save($this->request->data)){
        $requestID = filter_var($this->request->data["Extend"]["request_id"], FILTER_VALIDATE_INT);
        
        //get the subscribers
        $this->loadModel('Subscriber');
        $subscribers = $this->Subscriber->find('all', array(
          'conditions' => array('Subscriber.request_id' => $requestID)
        ));
        
        //get the point of contact
        $this->loadModel('Owner');
        $owner = $this->Owner->find('first', array(
          'conditions' => array('Owner.request_id' => $requestID)
        ));
        
        //get the request due date
        $this->loadModel('Request');
        $request = $this->Request->find('first', array(
          'conditions' => array('Request.id' => $requestID), 
          'fields' => array('due_date')
        ));
       
        
        
        $extendDate = $this->BusinessDays->add_business_days($days=10, $date=$request["Request"]["due_date"], $format="Y-m-d H:i:s");
        $this->Request->id = $requestID;
        $todayDT = date("Y-m-d H:i:s");
        $this->Request->saveField('extended', '1'); 
        $this->Request->saveField('due_date', $extendDate); 
        $this->Request->saveField('status_updated', $todayDT);
        $this->Request->saveField('status_id', '1');

        foreach ($subscribers as $subscriber){
          //make sure they are set to receive notifications, and have a valid email
          if($subscriber["Subscriber"]["should_notify"] == 1 && $subscriber["User"]["email"] != ''){
            //email subscriber
            $Email = new CakeEmail();
            $Email->template('requestupdated')
                ->emailFormat('html')
                ->to($subscriber["User"]["email"])
                ->from($this->getfromEmail())
                ->subject($this->getAgencyName().' Public Disclosure Request #' .$requestID ." - Updated")
                ->viewVars( array(
                    'agencyName' => $this->getAgencyName(),
                    'page' => '/requests/view/' . $requestID,
                    'ownerEmail' => $owner["User"]["email"],
                    'requestID' => $requestID,
                    'unsubscribe' =>'/requests/unsubscribe/'.$subscriber["Subscriber"]["id"],
                    'extend' => $this->request->data["Extend"]["text"]
                ))
                ->send();
          }
        }
        
        $this->Session->setFlash('<h4>Success!</h4><p class="lead">Request Extended, subscribers have been emailed.</p>', 'success');
      }else{
        $this->Session->setFlash('<h4>ERROR</h4><p class="lead">Request could not extended be added at this time</p>', 'danger');
      }
      $this->redirect(array('action' => 'view', 'controller' => 'requests', $requestID));
    }else{
      $this->redirect(array('action' => 'view', 'controller' => 'requests', $requestID));
    }
	}
	public function closeRequest(){
	  if (empty($this->request->data)) {
      $this->redirect(array('action' => 'index','controller'=> 'recordtrac'));
    }
    App::uses('CakeEmail', 'Network/Email');
    if (!empty($this->request->data)) {
      $this->request->data["Note"] = $this->request->data["Close"];
      if($this->Note->save($this->request->data)){
        $requestID = filter_var($this->request->data["Close"]["request_id"], FILTER_VALIDATE_INT);
        $this->loadModel('Request');
        $this->Request->id = $requestID;
        $todayDT = date("Y-m-d H:i:s");
        $this->Request->saveField('status_id', '2'); 
        $this->Request->saveField('status_updated', $todayDT);
        
        //get the subscribers
        $this->loadModel('Subscriber');
        $subscribers = $this->Subscriber->find('all', array(
          'conditions' => array('Subscriber.request_id' => $requestID)
        ));
        
        //get the point of contact
        $this->loadModel('Owner');
        $owner = $this->Owner->find('first', array(
          'conditions' => array('Owner.request_id' => $requestID)
        ));
        
        foreach ($subscribers as $subscriber){
          //make sure they are set to receive notifications, and have a valid email
          if($subscriber["Subscriber"]["should_notify"] == 1 && $subscriber["User"]["email"] != ''){
            //email subscriber
            $Email = new CakeEmail();
            $Email->template('requestclosed')
                ->emailFormat('html')
                ->to($subscriber["User"]["email"])
                ->from($this->getfromEmail())
                ->subject($this->getAgencyName().' Public Disclosure Request #' .$requestID ." - Closed")
                ->viewVars( array(
                    'agencyName' => $this->getAgencyName(),
                    'page' => '/requests/view/' . $requestID,
                    'ownerEmail' => $owner["User"]["email"],
                    'requestID' => $requestID,
                    'unsubscribe' =>'/requests/unsubscribe/'.$subscriber["Subscriber"]["id"],
                    'closed' => $this->request->data["Close"]["text"]
                ))
                ->send();
          }
        }
        
        $this->Session->setFlash('<h4>Success!</h4><p class="lead">Request Closed, subscribers have been emailed.</p>', 'success');
      }else{
        $this->Session->setFlash('<h4>ERROR</h4><p class="lead">Request could not closed be added at this time</p>', 'danger');
      }
      $this->redirect(array('action' => 'view', 'controller' => 'requests', $requestID));
    }else{
      $this->redirect(array('action' => 'view', 'controller' => 'requests', $requestID));
    }
	} 
}