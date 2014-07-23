<?php
class RequestsController extends AppController {
  public function index($query = null) {
    if (!$query && $this->data) {
        $this->redirect(array('action' => 'view', $this->data['Track']['request_id']));
    }
    
  }
  public function track(){
    $this->set("title_for_layout","Track a Request - City of Yakima");
  }
  public function view($id = null){
    $this->Request->id = $id;
    $this->set('request', $this->Request->read());
  }
  public function create(){
    
  }
}