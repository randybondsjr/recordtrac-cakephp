<?php
class AdminController extends AppController {
  /**
  * This controller does not use a model
  *
  * @var array
  */
	public $uses = array();
	public function beforeFilter(){
	  parent::beforeFilter();
    $this->Auth->deny();
	}
  public function index() {

  }
}