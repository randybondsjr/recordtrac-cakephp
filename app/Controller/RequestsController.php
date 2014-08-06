<?php
class RequestsController extends AppController {

  public $components = array('BusinessDays');
  public function index($query = null) {
    //variables
    $conditions = '';
    $status = '';
    $dateQuery = '';
    $dept = '';
    $requester = '';
    
    //if there is a filter submitted (GET), adjust query
    if(!empty($this->request->query)){
      //sanitize variables
      $term = filter_var($this->request->query["term"], FILTER_SANITIZE_STRING);
      $dept = filter_var($this->request->query["department_id"], FILTER_VALIDATE_INT);
      
      if(isset($this->request->query["requester"]) && $this->request->query["requester"]!=''){
        $requester = filter_var($this->request->query["requester"], FILTER_SANITIZE_STRING);
        $requester = "AND Requester.Alias LIKE '%$requester%'";
      }
      
      //@todo ADD My Requests filtering
      
      
      //iterate through statuses
      if(!empty($this->request->query["status"])){
        foreach($this->request->query["status"] as $statusID){
          if (!$this->Session->read('Auth.User')){ //if not a logged in user, overdue and due soon are just "open"
            if($statusID == 1){
              $status[] = 3;
              $status[] = 4;
            }
          }
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
      
      $conditions = array("Request.Text LIKE '%$term%' $status $dateQuery $dept $requester");
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
		
		//update statuses in DB on each page load
		$requests = $this->Request->find('all');
		//for figuring out if request is overdue for staff
		$today = date("Y-m-d");
		$todayDT = date("Y-m-d h:i:s");
    $today2 = $this->BusinessDays->add_business_days($days=2, $date=$today, $format="Y-m-d");
    foreach($requests AS $request){
      $due_date = $request["Request"]["due_date"];
      $overdue = false;
      $dueSoon = false;
      if($request["Request"]["status_id"] != 2){ //only update if its not closed
        if($today > $due_date){
          $this->Request->id = $request["Request"]["id"];
          $this->Request->saveField('status_id', '4'); // set status overdue
          $this->Request->saveField('status_updated', $todayDT); //set status updated datetime
        }else if($today2 >= $due_date){
          $this->Request->id = $request["Request"]["id"];
          $this->Request->saveField('status_id', '3'); // set status overdue
          $this->Request->saveField('status_updated', $todayDT); //set status updated datetime
        }
      }
    }
  }
  
  public function track(){
    $this->set("title_for_layout","Track a Request - " . $this->getAgencyName());
  }
  
  public function view($id = null){
    $this->Request->id = $id;
    $this->set("title_for_layout","Request " . $id . " - View a Request - " . $this->getAgencyName());
    $request = $this->Request->read();
    $this->set('request', $request);
    
    //the active staff Point of Contact for the Request
    $this->loadModel('Owner');
    $this->set('poc',$this->Owner->find('first', array(
      'conditions' => array('(Owner.active = 1 AND Owner.is_point_person = 1) AND Owner.request_id = '.$id)
    )));
    
    //the active staff Helpers for the Request
    $this->set('helpers',$this->Owner->find('all', array(
      'conditions' => array('(Owner.active = 1 AND Owner.is_point_person != 1) AND Owner.request_id = '. $id)
    )));
    
    $this->loadModel('User');
    $this->set('users',$this->User->find('list', array(
      'joins' => array(
        array(
            'table' => 'departments',
            'alias' => 'DeptJoin',
            'type' => 'LEFT',
            'conditions' => array(
                'User.department_id = DeptJoin.id'
            )
        )
      ),
      'fields' => array('User.id','User.alias','DeptJoin.name'),
      'conditions' => array('department_id IS NOT NULL')
    )));
  }

  public function create(){
    App::uses('CakeEmail', 'Network/Email');
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
    
    //save data
    if (!empty($this->request->data)) {
      //clean up the date if this is a manual entry
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
      $this->request->data["Subscriber"][0]["should_notify"] = 1;

      //get owners for request
      $this->loadModel('Department');
      $dept = $this->Department->find('first', array(
        'conditions' => array('Department.id' => $this->request->data["Request"]["department_id"])
      ));
      //set variables for Point Person
      $this->request->data["Owner"][0]["user_id"] = $dept["Contact"]["id"];
      $this->request->data["Owner"][0]["reason"] = "Point of Contact for ". $dept["Department"]["name"];
      $this->request->data["Owner"][0]["is_point_person"] = 1;
      
      //Set variable for Initial Helper (backup)
      $this->request->data["Owner"][1]["user_id"] = $dept["Backup"]["id"];      
      $this->request->data["Owner"][1]["reason"] = "Backup for ". $dept["Department"]["name"];
      $this->request->data["Owner"][1]["is_point_person"] = 0;

      if($this->Request->saveAll($this->request->data)){ 
        $requestID = $this->Request->getLastInsertId();
        $this->loadModel('User');
        $user = $this->User->find('first', array(
          'order' => array('User.id' => 'desc')
        ));
        $owner = $this->User->find('first', array(
          'conditions' => array('User.id' => $dept["Contact"]["id"])
        ));
        $helper = $this->User->find('first', array(
          'conditions' => array('User.id' => $dept["Backup"]["id"])
        ));

        $this->loadModel('Subscriber');
        $subscriber = $this->Subscriber->find('first', array(
          'order' => array('Subscriber.id' => 'desc')
        ));
        $this->Subscriber->id = $subscriber["Subscriber"]["id"];
        
        if($this->Subscriber->saveField('user_id', $user["User"]["id"])){
          //email requester
          $Email = new CakeEmail();
          $Email->template('requester')
              ->emailFormat('html')
              ->to($this->request->data["Requester"]["email"])
              ->from($this->getfromEmail())
              ->subject($this->getAgencyName().' Public Disclosure Request')
              ->viewVars( array(
                  'agencyName' => $this->getAgencyName(),
                  'page' => '/requests/view/' . $requestID,
                  'ownerEmail' => $owner["User"]["email"],
                  'responseDays' => $this->getResponseDays()
              ))
              ->send();
          //email owner
          $Email = new CakeEmail();
          $Email->template('owners')
              ->emailFormat('html')
              ->to($owner["User"]["email"])
              ->from($this->getfromEmail())
              ->subject('New Public Disclosure Request')
              ->viewVars( array(
                  'agencyName' => $this->getAgencyName(),
                  'page' => '/requests/view/' . $requestID,
                  'ownerEmail' => $owner["User"]["email"],
                  'responseDays' => $this->getResponseDays()
              ))
              ->send();
          //email helper    
          $Email = new CakeEmail();
          $Email->template('owners')
              ->emailFormat('html')
              ->to($helper["User"]["email"])
              ->from($this->getfromEmail())
              ->subject('New Public Disclosure Request')
              ->viewVars( array(
                  'agencyName' => $this->getAgencyName(),
                  'page' => '/requests/view/' . $requestID,
                  'ownerEmail' => $owner["User"]["email"],
                  'responseDays' => $this->getResponseDays()
              ))
              ->send();
          
          //@todo add an email to requester, POC, etc. 
          if ($this->Session->read('Auth.User')){
            $this->Session->setFlash('<h4>The request has been submitted!</h4><p class="lead">The requester has been notified via email that they can expect to hear a response from the '. $this->getAgencyName() .' in the next 5 days. Requester will be automatically contacted with any updates.</p>');
          }else{
            $this->Session->setFlash('<h4>Your request has been submitted!</h4><p class="lead">You can expect a response from the  '. $this->getAgencyName() .'  in the next ' . $this->getResponseDays() . ' days. You will be contacted via email with any updates.</p> <p class="lead">All messages from the   '. $this->getAgencyName() .' and/or the information and documents you requested will be posted to this page. You can access <a href="/requests/view/' . $requestID . '">this page</a> at any time.</p>');
          }
          $this->redirect(array('action' => 'view', $this->Request->id));
        }
      }
    }
  }
}