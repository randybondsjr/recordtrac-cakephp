<?php
class RequestsController extends AppController {
  
  public $components = array('BusinessDays');
  public function index($query = null) {
    //variables
    $conditions = '';
    $status = '';
    $dateQuery = '';
    $dept = '';
    
    //if there is a filter submitted (GET), adjust query
    if(!empty($this->request->query)){
      //sanitize variables
      $term = filter_var($this->request->query["term"], FILTER_SANITIZE_STRING);
      $dept = filter_var($this->request->query["department_id"], FILTER_VALIDATE_INT);
      
      //@todo ADD My Requests filtering
      
      
      //iterate through statuses
      if(!empty($this->request->query["status"])){
        foreach($this->request->query["status"] as $statusID){
          $status[] =  filter_var($statusID, FILTER_VALIDATE_INT);
        }
        $status = implode(",", $status);
        $status = "AND Request.Status_id IN ($status)";
      }
      //change dates so that we can use em
      if(isset($this->request->query["min_date"]) && $this->request->query["min_date"] != ''){
        $minDate = filter_var($this->request->query["min_date"], FILTER_SANITIZE_STRING);
        $cleanMinDate = explode("/",$minDate);
        $cleanMinDate = $cleanMinDate[2]."-".$cleanMinDate[0]."-".$cleanMinDate[1]." 00:00:00";
        $dateQuery = "AND Request.date_received > '$cleanMinDate'";
      }
      if(isset($this->request->query["max_date"]) && $this->request->query["max_date"] != ''){
        $maxDate = filter_var($this->request->query["max_date"], FILTER_SANITIZE_STRING);
        $cleanMaxDate = explode("/",$maxDate);
        $cleanMaxDate = $cleanMaxDate[2]."-".$cleanMaxDate[0]."-".$cleanMaxDate[1]." 00:00:00";
        $dateQuery = "AND Request.date_received < '$cleanMaxDate'";
      }
      if(isset($cleanMaxDate) && isset($cleanMinDate)){
        $dateQuery = "AND (Request.date_received BETWEEN '$cleanMinDate' AND '$cleanMaxDate')";
      }
      
      if(isset($dept) && $dept != ''){
        $dept = "AND Request.Department_id = $dept";
      }
      
      $conditions = array("Request.Text LIKE '%$term%' $status $dateQuery $dept");
    }
    //if there is POST data, that's a direct link to a request
    if (!$query && $this->data) {
      $this->redirect(array('action' => 'view', $this->data['Track']['request_id']));
    }
    
    //auto-populates form based on query
    $this->params->data = array('Request' => $this->params->query);
    
    //for form advanced filter department dropdown
    $this->loadModel('Department');
    $this->set('departments',$this->Department->find('list'));
    
    //statuses for form
    $this->loadModel('Status');
    if ($this->Session->read('Auth.User')){
      $this->set('statuses',$this->Status->find('list'));
    }else{
      $this->set('statuses',$this->Status->find('list', array(
        'conditions' => array('Status.type' => 'public')
      )));
    }

    //total results for title
    $this->set('total',$total = $this->Request->find('count'));
    
    //paginate results
    $this->paginate = array(
				'limit' => 15,
				'conditions' => $conditions,
        'order' => array('Request.id' => 'desc')
		);
		$records = $this->paginate('Request');
		
		//error handling in case there are no requests found
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