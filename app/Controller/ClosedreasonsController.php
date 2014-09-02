<?php
class ClosedreasonsController extends AppController {
  public function beforeFilter(){
	  parent::beforeFilter();
    $this->Auth->deny();
  }
  public function index(){
    $this->set("title_for_layout","Closed Reasons");
    $this->paginate = array(
			'limit' => 25,
      'order' => array('Closedreason.label' => 'asc')
    );
    $this->Closedreason->recursive = 0;
    $this->set('reasons', $this->paginate());
  }
  public function add(){
    $this->set("title_for_layout","Add Closed Reason");
    
    if ($this->request->is('post')) {
        $this->Closedreason->create();
        if ($this->Closedreason->save($this->request->data)) {
            $this->Session->setFlash(__('The closed reason has been added!'), 'success');
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(
            __('The closed reason could not be saved. Please, try again.'), 'danger'
        );
    }
  }
  public function edit($id = null){
    $this->set("title_for_layout","Edit Closed Reason");
    $this->Closedreason->id = $id;

    if (!$this->Closedreason->exists()) {
        throw new NotFoundException(__('Invalid document id'));
    }
    if ($this->request->is('post') || $this->request->is('put')) {
        if ($this->Extendreason->save($this->request->data)) {
            $this->Session->setFlash(__('The closed reason has been updated'), 'success');
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(
            __('The closed reason could not be saved. Please, try again.'), 'danger'
        );
    } else {
        $this->request->data = $this->Extendreason->read(null, $id);
    }
  }
}