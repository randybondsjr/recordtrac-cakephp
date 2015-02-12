<?php
class ExtendreasonsController extends AppController {
  
  public function index(){
    $this->set("title_for_layout","Extend Reasons");
    $this->paginate = array(
			'limit' => 25,
      'order' => array('Extendreason.label' => 'asc')
    );
    $this->Extendreason->recursive = 0;
    $this->set('reasons', $this->paginate());
  }
  
  public function add(){
    $this->set("title_for_layout","Add Extend Reason");

    
    if ($this->request->is('post')) {
        $this->Extendreason->create();
        if ($this->Extendreason->save($this->request->data)) {
            $this->Session->setFlash(__('The extend reason has been added!'), 'success');
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(
            __('The extend reason could not be saved. Please, try again.'), 'danger'
        );
    }
  }
  
  public function edit($id = null){
    $this->set("title_for_layout","Edit Extend Reason");
    $this->Extendreason->id = $id;

    if (!$this->Extendreason->exists()) {
        throw new NotFoundException(__('Invalid document id'));
    }
    if ($this->request->is('post') || $this->request->is('put')) {
        if ($this->Extendreason->save($this->request->data)) {
            $this->Session->setFlash(__('The extend reason has been updated'), 'success');
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(
            __('The extend reason could not be saved. Please, try again.'), 'danger'
        );
    } else {
        $this->request->data = $this->Extendreason->read(null, $id);
    }
  }

}