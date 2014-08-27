<?php
class QuestionsController extends AppController {
  public function ask() {
    if (empty($this->request->data)) {
      $this->redirect(array('action' => 'index','controller'=> 'recordtrac'));
    }
    if (!empty($this->request->data)) {
      $requestID = filter_var($this->request->data["Question"]["request_id"], FILTER_VALIDATE_INT);
      if($this->Question->save($this->request->data)){
        $this->Session->setFlash('<h4>Success!</h4><p class="lead">Question posted to request</p>', 'success');
      }else{
        $this->Session->setFlash('<h4>ERROR</h4><p class="lead">Question could not posted be added at this time</p>', 'danger');
      }
      $this->redirect(array('action' => 'view', 'controller' => 'requests', $requestID));
    }
  }
  public function answer(){
    if (empty($this->request->data)) {
      $this->redirect(array('action' => 'index','controller'=> 'recordtrac'));
    }
    if (!empty($this->request->data)) {
      $requestID = filter_var($this->request->data["Question"]["request_id"], FILTER_VALIDATE_INT);
      if($this->Question->save($this->request->data)){
        $this->Session->setFlash('<h4>Success!</h4><p class="lead">Answer posted to request</p>', 'success');
      }else{
        $this->Session->setFlash('<h4>ERROR</h4><p class="lead">Answer could not posted be added at this time</p>', 'danger');
      }
      $this->redirect(array('action' => 'view', 'controller' => 'requests', $requestID));
    }
  }
}