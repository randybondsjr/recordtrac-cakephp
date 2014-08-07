<?php
class SubscribersController extends AppController {
  public function subscribe() {
   
    $this->loadModel('User');
    $emailExists = $this->User->find('first',array(
      'conditions' => array('User.email' => $this->request->data["User"]["email"])
    ));
    //if the user doesn't exist, we need to create it
    if(empty($emailExists)){
      $this->User->save($this->request->data);
      $userID = $this->User->getLastInsertId();
      $this->request->data["Subscriber"]["user_id"] = $userID;
    }else{
      $this->request->data["Subscriber"]["user_id"] = $emailExists["User"]["id"];
    }

    //check if the subscriber exists, we don't need multiple records... 
    $subscriberExists = $this->Subscriber->find('first',array(
      'conditions' => array('Subscriber.user_id = '.$this->request->data["Subscriber"]["user_id"].' AND Subscriber.request_id = '.$this->request->data["Subscriber"]["request_id"])
    ));
    //throw error in flash if subscriber exists, otherwise add a record
    if(!empty($subscriberExists)){
      $this->Session->setFlash('<h4>ERROR</h4><p class="lead">You\'re already subscribed to receive updates for this request.</p>');
    }else{
      if($this->Subscriber->save($this->request->data)){
        $this->Session->setFlash('<h4>Success!</h4><p class="lead">You will be contacted via email at with any updates to this request.</p>');
      }
    }
    $this->redirect(array('action' => 'view', 'controller' => 'requests', $this->request->data["Subscriber"]["request_id"]));
	}
}