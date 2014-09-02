<?php
class DepartmentsController extends AppController {
  public function beforeFilter(){
	  parent::beforeFilter();
    $this->Auth->deny();
  }
  public function index(){
      $this->paginate = array(
				'limit' => 25,
        'order' => array('Department.name' => 'asc')
      );
      $this->Department->recursive = 0;
      $this->set('depts', $this->paginate());
  }
  public function add(){
    $this->loadModel('User');
    $this->set('contacts', $this->User->find('list', array('fields' => 'id, alias', 'conditions' => 'department_id IS NOT NULL', 'order' => 'User.alias')));
    $this->set('backups', $this->User->find('list', array('fields' => 'id, alias', 'conditions' => 'department_id IS NOT NULL', 'order' => 'User.alias')));
    if ($this->request->is('post')) {
        $this->Department->create();
        if ($this->Department->save($this->request->data)) {
            $this->Session->setFlash(__('The department has been saved'), 'success');
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(
            __('The department could not be saved. Please, try again.'), 'danger'
        );
    }
  }
  public function edit($id = null){
    $this->Department->id = $id;
    $this->loadModel('User');
    $this->set('contacts', $this->User->find('list', array('fields' => 'id, alias', 'conditions' => 'department_id IS NOT NULL', 'order' => 'User.alias')));
    $this->set('backups', $this->User->find('list', array('fields' => 'id, alias', 'conditions' => 'department_id IS NOT NULL', 'order' => 'User.alias')));
    if (!$this->Department->exists()) {
        throw new NotFoundException(__('Invalid user'));
    }
    if ($this->request->is('post') || $this->request->is('put')) {
        if ($this->Department->save($this->request->data)) {
            $this->Session->setFlash(__('The department has been updated'), 'success');
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(
            __('The department could not be saved. Please, try again.'), 'danger'
        );
    } else {
        $this->request->data = $this->Department->read(null, $id);
    }
  }
}