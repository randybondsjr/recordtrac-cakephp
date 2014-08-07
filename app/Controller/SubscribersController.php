<?php
class SubscribersController extends AppController {
  public function subscribe() {
    pr($this->request->data);
    $this->loadModel('User');
    $this->User->save($this->request->data);
    //$this->Subscriber->save($this->request->data);
	}
}