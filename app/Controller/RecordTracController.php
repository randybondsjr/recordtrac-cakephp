<?php
class RecordTracController extends AppController {
	public $uses = array();//no model used!
  public function index() {
    $this->loadModel('Requests');
    $this->set('totalRequests', $this->Requests->find('count'));
  }
}