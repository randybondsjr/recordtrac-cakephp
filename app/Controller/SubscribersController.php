<?php
class SubscribersController extends AppController {
  public function subscribe() {
    App::uses('CakeEmail', 'Network/Email');
    if (empty($this->request->data)) {
      $this->redirect(array('action' => 'index','controller'=> 'recordtrac'));
    }
    if (!empty($this->request->data)) {
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
        $this->Session->setFlash('<h4>ERROR</h4><p class="lead">You\'re already subscribed to receive updates for this request.</p>', 'danger');
      }else{
        if($this->Subscriber->save($this->request->data)){
          $requestID = $this->request->data["Subscriber"]["request_id"];
          $subscriber = $this->Subscriber->getLastInsertID();
          if(isset($this->request->data["User"]["email"]) && $this->request->data["User"]["email"] != ''){
            //email requester
            $Email = new CakeEmail();
            $Email->template('subscribe')
                ->emailFormat('html')
                ->to($this->request->data["User"]["email"])
                ->from($this->getfromEmail())
                ->bcc($this->getBccEmail())
                ->subject($this->getAgencyName().' Public Disclosure Request #' .$requestID)
                ->viewVars( array(
                    'agencyName' => $this->getAgencyName(),
                    'page' => '/requests/view/' . $requestID,
                    'ownerEmail' => $this->getBccEmail(),
                    'unsubscribe' =>'/requests/unsubscribe/'.$subscriber
                ))
                ->send();
          }
          $this->Session->setFlash('<h4>Success!</h4><p class="lead">You will be contacted via email at with any updates to this request.</p>', 'success');
        }
      }
      $this->redirect(array('action' => 'view', 'controller' => 'requests', $this->request->data["Subscriber"]["request_id"]));
    }
	}
}