<?php
class RequestsController extends AppController {
  public function index($query = null) {
    if (!$query && $this->data) {
        $this->redirect(array('action' => 'view', $this->data['Track']['request_id']));
    }
    $this->paginate = array(
				'limit' => 25,
        'order' => array('Request.id' => 'desc')
		);
		$records = $this->paginate('Request');
		$this->set('total',$total = $this->Request->find('count'));
		
		if( ! empty($records)){
			$this->set('results', $records);
		}else{
			$this->Session->setFlash('No requests found.');
			$this->set('results', $records);
		}
  }
  
  public function track(){
    $this->set("title_for_layout","Track a Request - City of Yakima");
  }
  
  public function view($id = null){
    $this->Request->id = $id;
    $this->set("title_for_layout","Request " . $id . " - View a Request - City of Yakima");
    $this->set('request', $this->Request->read());
  }
  
  public function create(){
    //query doctypes for dropdowm
    $this->loadModel('DocType');
    $doctypes = $this->DocType->find('all');
    $doctypeList = array();
    foreach ($doctypes AS $doctype){
      $doctypeList[] = array('value' => $doctype["DocType"]["department_id"], 'name' => $doctype["DocType"]["prettyDocName"]);
    }
    $this->set('doctypes',$doctypeList);
  }
}