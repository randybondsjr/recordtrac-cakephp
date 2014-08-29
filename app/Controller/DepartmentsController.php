<?php
class DepartmentsController extends AppController {
  public function index(){
      $this->paginate = array(
				'limit' => 25,
        'order' => array('User.alias' => 'asc')
      );
      $this->Department->recursive = 0;
      $this->set('depts', $this->paginate());
  }
  public function add(){
    
  }
  public function edit($id = null){
    
  }
}