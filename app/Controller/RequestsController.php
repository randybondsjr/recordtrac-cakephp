<?php
class RequestsController extends AppController {
  public function index($query = null) {
    pr($this->data);
        if (!$query && $this->data) {
            $this->redirect(array('action' => 'view', $this->data['Track']['request_id']));
        }
    
  }
  public function track(){
    $this->set("title_for_layout","Track a Request - City of Yakima");
  }
  public function view($id = null){
    pr($this->data);
    echo $id;
  }
}