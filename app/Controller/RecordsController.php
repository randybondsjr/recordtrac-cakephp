<?php
class RecordsController extends AppController {

  public function add() {
    App::uses('CakeEmail', 'Network/Email');
    
    if (!empty($this->request->data)) {
      if ($this->Record->validates()) {
        // it validated logic
        if($this->Record->save($this->request->data)){
          $requestID = filter_var($this->request->data["Record"]["request_id"], FILTER_VALIDATE_INT);
  
          //determine type of record
          $recordType = '';
          $url = '';
          if($this->request->data["Record"]["url"] != ''){
            $recordType = "url";
            $url = $this->request->data["Record"]["url"];
          }elseif($this->request->data["Record"]["access"] != ''){
            $recordType = "offline";
            $url = filter_var($this->request->data["Record"]["access"], FILTER_SANITIZE_STRING);
          }else{
            $recordType = "file";
            $url = Router::fullbaseUrl()."/files/record/filename/".$this->Record->id."/".rawurlencode($this->request->data["Record"]["filename"]["name"]);
          }
          
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
                      'description' => $this->request->data["Record"]["description"],
                      'fileupload' => $recordType,
                      'url' => $url
                  ))
                  ->send();
            }
          }
          $this->Session->setFlash("<h4>Success</h4><p>Your record has been added and subscribers have been notified by email.</p>", 'success');
        }else{
          $this->Session->setFlash("<h4>ERROR</h4><p>Could not save record at this time</p>", 'danger');
        }
      } else {
        // didn't validate logic
        $errors = $this->Record->validationErrors;
        foreach ($errors["filename"] as $error){
          $this->Session->setFlash("<h4>ERROR</h4><p>".$error."</p>", 'danger');
        }
        
      }
      $this->redirect(array('action' => 'view', 'controller' => 'requests', $requestID));
    }
	}
}