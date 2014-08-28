<?php 
App::uses('CakeEmail', 'Network/Email');
class RecordtracShell extends AppShell {
  public $uses = array('Request', 'User');
  public $tasks = array("BusinessDays");
  public function main() {
    $requests = $this->Request->find('all');
    $this->out('Updating request statuses...');
    $today = date("Y-m-d");
		$todayDT = date("Y-m-d H:i:s");
    $today2 = $this->BusinessDays->execute($days=2, $date=$today, $format="Y-m-d");
    $countOverDue = 0;
    $countDueSoon = 0;
    $notifyIDs = array();
    $requests = $this->Request->find('all');
    $i = 0;
    $staff = array();
    $agencyName = Configure::read('Agency.name');
    $fromEmail = Configure::read('Agency.fromEmail');
    
    foreach($requests AS $request){
      $due_date = $request["Request"]["due_date"];
      $statusDate = date("Y-m-d", strtotime($request["Request"]["status_updated"]));
      $overdue = false;
      $dueSoon = false;
     
 
      if($request["Request"]["status_id"] != 2){ //only update if its not closed
        if($today > $due_date){ //overdue
          if($statusDate != $today){ // check if it's been updated today, if so, let's leave it alone
            $this->Request->id = $request["Request"]["id"];
            $notifyIDs[$i]["request_id"] = $request["Request"]["id"];
            $notifyIDs[$i]["owners"] = $request["Owner"];
            $notifyIDs[$i]["status"] = '4';
            $i++;
            $this->Request->saveField('status_id', '4'); // set status overdue
            $this->Request->saveField('status_updated', $todayDT); //set status updated datetime
            $countOverDue = $countOverDue + 1;
          }
        }else if($today2 >= $due_date){ //due soon
          if($statusDate != $today){ // check if it's been updated today, if so, let's leave it alone
            $this->Request->id = $request["Request"]["id"];
            $notifyIDs[$i]["request_id"] = $request["Request"]["id"];
            $notifyIDs[$i]["owners"] = $request["Owner"];
            $notifyIDs[$i]["status"] = '3';
            $this->Request->saveField('status_id', '3'); // set status due soon
            $this->Request->saveField('status_updated', $todayDT); //set status updated datetime
            $countDueSoon =  $countDueSoon + 1;
            $i++;
          }
        }
      }
      
    }
    sort($notifyIDs);
    $this->out($countOverDue . ' requests marked overdue.');
    $this->out($countDueSoon . ' requests marked due soon.');
    $this->out('Start sending emails...');
    //get list of request_ids for each staff member
    $i = 0;
    foreach ($notifyIDs as $notify){
      foreach($notify["owners"] as $owner){
        if($owner["active"] != ''){
          $staff[$owner["user_id"]]["requests"][$i]["id"] = $owner["request_id"];
          $staff[$owner["user_id"]]["requests"][$i]["status"] =  $notify["status"];
        }
      }
      $i++;
    }

    //email each staff member
    foreach($staff as $key=>$requests){
      $requests = array_values($requests["requests"]);
      $user = $this->User->find('first', array('conditions' => array('User.id' => $key), 'fields' => 'email'));
      $Email = new CakeEmail();
      $Email->template('staffnotify')
              ->emailFormat('html')
              ->to($user["User"]["email"])
              ->from($fromEmail)
              ->subject('Public Records Requests Status Update')
              ->viewVars( array(
                  'agencyName' => $agencyName,
                  'requests' => $requests
              ))
              ->send(); 
      $this->out('Email sent to ' . $user["User"]["email"]);
    }
    
    $this->out('All done!');
  }
}