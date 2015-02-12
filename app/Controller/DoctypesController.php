<?php
class DoctypesController extends AppController {

  public function index(){
    $this->set("title_for_layout","Document Types");
    $this->paginate = array(
			'limit' => 25,
      'order' => array('Doctype.name' => 'asc')
    );
    $this->Doctype->recursive = 0;
    $this->set('types', $this->paginate());
  }
  
  public function add(){
    $this->set("title_for_layout","Add Document Type");
    $this->loadModel('Department');
    $this->set('departments', $this->Department->find('list', array('fields' => 'id, name', 'order' => 'Department.name')));
    
    if ($this->request->is('post')) {
        $this->Doctype->create();
        if ($this->Doctype->save($this->request->data)) {
            $this->Session->setFlash(__('The document type has been added!'), 'success');
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(
            __('The document type could not be saved. Please, try again.'), 'danger'
        );
    }
  }
  
  public function edit($id = null){
    $this->set("title_for_layout","Edit Document Type");
    $this->Doctype->id = $id;
    $this->loadModel('Department');
    $this->set('departments', $this->Department->find('list', array('fields' => 'id, name', 'order' => 'Department.name')));
    if (!$this->Doctype->exists()) {
        throw new NotFoundException(__('Invalid document id'));
    }
    if ($this->request->is('post') || $this->request->is('put')) {
        if ($this->Doctype->save($this->request->data)) {
            $this->Session->setFlash(__('The document type has been updated'), 'success');
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(
            __('The document type could not be saved. Please, try again.'), 'danger'
        );
    } else {
        $this->request->data = $this->Doctype->read(null, $id);
    }
  }
  
}