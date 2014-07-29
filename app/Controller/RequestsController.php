<?php
class RequestsController extends AppController {
  
  public $components = array('BusinessDays');
  public function index($query = null) {
    if (!$query && $this->data) {
        $this->redirect(array('action' => 'view', $this->data['Track']['request_id']));
    }
    $this->paginate = array(
				'limit' => 15,
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
    $agencyName = Configure::read('Agency.name');
    //query doctypes for dropdowm
    $this->loadModel('DocType');
    $doctypes = $this->DocType->find('all');
    $doctypeList = array();
    foreach ($doctypes AS $doctype){
      $doctypeList[] = array('value' => $doctype["DocType"]["department_id"], 'name' => $doctype["DocType"]["prettyDocName"]);
    }
    $this->set('departments',$doctypeList);
    
    //query for offline submission type
    $this->loadModel('OfflineSubmission');
    $submissions = $this->OfflineSubmission->find('list');
    $this->set('offlineSubmissions',$submissions);
    if (!empty($this->request->data)) {
      //clean up the date if this is a manual 
      if(isset($this->data["Request"]["date_received"])){
        $cleanDate = explode("/",$this->data["Request"]["date_received"]);
        $nowTime = date('h:i:s');
        $cleanDate = $cleanDate[2]."-".$cleanDate[0]."-".$cleanDate[1]." ".$nowTime;
        $this->request->data["Request"]["date_received"] = $cleanDate;
      }else{
        $today = date("Y-m-d h:i:s");
        $this->request->data["Request"]["date_received"] = $today;
      }
      //due date in 5 business days
      $this->request->data["Request"]["due_date"] = $this->BusinessDays->add_business_days($days=5, $date=$this->request->data["Request"]["date_received"], $format="Y-m-d h:i:s");
     // pr($this->request->data); exit;
      if($this->Request->saveAll($this->request->data)){
        //@todo add an email to requester, POC, etc. 
        //@todo write to ownders table
        $this->Session->setFlash('<h4>The request has been submitted!</h4><p class="lead">The requester has been notified via email that they can expect to hear a response from the '. $agencyName .' in the next 5 days. Requester will be automatically contacted with any updates.</p>');
        $this->redirect(array('action' => 'view', $this->Request->id));
      }
    }
  }
}