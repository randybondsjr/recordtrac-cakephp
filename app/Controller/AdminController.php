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
  
  public function addUser() {
      if ($this->request->is('post')) {
          $this->User->create();
          if ($this->User->save($this->request->data)) {
              $this->Session->setFlash(__('The user has been saved'));
              return $this->redirect(array('action' => 'index'));
          }
          $this->Session->setFlash(
              __('The user could not be saved. Please, try again.')
          );
      }
  }
}