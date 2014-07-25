<?php
// app/Controller/UsersController.php
class UsersController extends AppController {
    public function beforeFilter(){
  	  parent::beforeFilter();
      $this->Auth->deny();
      $this->Auth->allow('login','logout');
  	}

    public function login() {
      if ($this->request->is('post')) {
          if ($this->Auth->login()) {
              return $this->redirect($this->Auth->redirect());
          }
          $this->Session->setFlash(__('Invalid username or password, try again'));
      }
    }
    
    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function index() {
      $this->paginate = array(
				'limit' => 25,
        'order' => array('User.alias' => 'asc')
      );
      $this->User->recursive = 0;
      $this->set('users', $this->paginate());
    }

    public function add() {
      $this->loadModel('Department');
      $this->set('departments', $this->Department->find('list'));
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
    
    public function resetPassword($id=null){
      $this->User->id = $id;
      if (!$this->User->exists()) {
          throw new NotFoundException(__('Invalid user'));
      }
      if ($this->request->is('post') || $this->request->is('put')) {
          if ($this->User->save($this->request->data)) {
              $this->Session->setFlash(__('The user\'s password has been changed.'));
              return $this->redirect(array('action' => 'index'));
          }
          $this->Session->setFlash(
              __('The password could not be saved. Please, try again.')
          );
      } else {
          $this->request->data = $this->User->read(null, $id);
          unset($this->request->data['User']['password']);
      }

    }

    public function edit($id = null) {
      $this->loadModel('Department');
      $this->set('departments', $this->Department->find('list'));
      $this->User->id = $id;
      if (!$this->User->exists()) {
          throw new NotFoundException(__('Invalid user'));
      }
      if ($this->request->is('post') || $this->request->is('put')) {
          if ($this->User->save($this->request->data)) {
              $this->Session->setFlash(__('The user has been saved'));
              return $this->redirect(array('action' => 'index'));
          }
          $this->Session->setFlash(
              __('The user could not be saved. Please, try again.')
          );
      } else {
          $this->request->data = $this->User->read(null, $id);
          unset($this->request->data['User']['password']);
      }
    }

}