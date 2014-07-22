<?php
class RecordTracController extends AppController {
  /**
  * This controller does not use a model
  *
  * @var array
  */
	public $uses = array();
	
  public function index() {
    $this->loadModel('Requests');
    $this->set('totalRequests', $this->Requests->find('count'));
  }
}