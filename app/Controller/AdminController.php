<?php
class AdminController extends AppController {
  //define allowed action for logged in users (staff)
  var $permissions = array('index',
                           'requestsbymonth',
                           'requestsbymonthdept',
                           'requestsbyyear',
                           'requestsbyyeardept',
                           'allrequestsbystaff',
                           'openrequestsbystaff',
                           'openrequests',
                           'allrequestsbyrequester'); 
  public $components = array('HighCharts.HighCharts');
	public $uses = array();

  public function index() {
    $thirtyDaysAgo = date("Y-m-d",strtotime("now -30 days") );
    $todayDaysAgo  = date('Y-m-d');
    $this->loadModel('Calendar');
    $dailyRequests = $this->Calendar->find('all', array(
       'fields' => 'datefield, COUNT(requests.date_received) as total',
       'joins' => array(
                    array('table' => 'requests',
                        'alias' => 'requests',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'date(requests.date_received) >= datefield',
                            'date(requests.date_received) <  datefield + 1'
                        )
                    )
                  ),
       'conditions' => "datefield >= '". $thirtyDaysAgo ."' AND datefield <= '".  $todayDaysAgo ."'",
       'group' => 'datefield'
       ));
    $requestDays = array();
    $requestCount = array();
    foreach($dailyRequests as $request){
      $requestDays[] = substr($request["Calendar"]["datefield"],5);
      $requestCount[] = intval($request[0]["total"]);
    }
    
    //chart
    $chartName = 'Line Chart';

    $mychart = $this->HighCharts->create( $chartName, 'line' );

    $this->HighCharts->setChartParams(
                $chartName,
                array(
                        'renderTo'				=> 'linewrapper',  // div to display chart inside
                        //'chartWidth'			=> 800,
                        //'chartHeight'			=> 400,
                        'chartMarginTop' 			=> 60,
                        'chartMarginLeft'			=> 90,
                        'chartMarginRight'			=> 30,
                        'chartMarginBottom'			=> 110,
                        'chartSpacingRight'			=> 10,
                        'chartSpacingBottom'		=> 15,
                        'chartSpacingLeft'			=> 0,
                        'chartAlignTicks'			=> TRUE,
                        'chartBackgroundColor' => 'rgba(255, 255, 255, 1)',
                        //'chartBackgroundColorStops'		=> array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),

                        'title'				=> 'Requests',
                        'titleAlign'			=> 'left',
                        'titleFloating'			=> TRUE,
                        'titleStyleFont'			=> '18px Metrophobic, Arial, sans-serif',
                        'titleStyleColor'			=> '#2c3e50',
                        'titleX'				=> 20,
                        'titleY'				=> 20,

                        'legendEnabled' 			=> TRUE,
                        'legendLayout'			=> 'horizontal',
                        'legendAlign'			=> 'center',
                        'legendVerticalAlign '		=> 'bottom',
                        'legendItemStyle'			=> array('color' => '#222'),
                        'legendBackgroundColorLinearGradient' 	=> array(0,0,0,25),
                        'legendBackgroundColorStops' 		=> array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),

                        'tooltipEnabled' 			=> FALSE,
                        'xAxisLabelsEnabled' 			=> TRUE,
                        'xAxisLabelsAlign' 			=> 'right',
                        'xAxisLabelsStep' 			=> 0,
                        'xAxisLabelsRotation' 		=> -90,
                        'xAxislabelsX' 			=> 5,
                        'xAxisLabelsY' 			=> 10,
                        'xAxisCategories'           	=> $requestDays,

                        'yAxisTitleText' 			=> 'Units',
                        'enableAutoStep' 			=> FALSE
                )
        );

    $series = $this->HighCharts->addChartSeries();

    $series->addName('Requests')
        ->addData($requestCount);

    $mychart->addSeries($series);
    
    
    //pie chart
    $this->loadModel('Requests');
    $totalStatuses = $this->Requests->find('all', array(
       'fields' => 'status_id, COUNT(*) total',
       'group' => 'Requests.status_id'
       ));

    $pieData = array();
    foreach($totalStatuses as $totalStatus){
      if    ($totalStatus["Requests"]["status_id"] == 1){ $status = "Open";}
      elseif($totalStatus["Requests"]["status_id"] == 2){ $status = "Closed";}
      elseif($totalStatus["Requests"]["status_id"] == 3){ $status = "Due Soon";}
      else                                              { $status = "Over Due";}
      $pieData[] = array($status,intval($totalStatus[0]["total"]));
    }
    //pr($pieData);

    $chartName = 'Pie Chart';

    $pieChart = $this->HighCharts->create( $chartName, 'pie' );


    $this->HighCharts->setChartParams(
                $chartName,
                array(
                        'renderTo'				=> 'piewrapper',  // div to display chart inside
                        'chartMarginTop' 			=> 60,
                        'chartMarginLeft'			=> 90,
                        'chartMarginRight'			=> 30,
                        'chartMarginBottom'			=> 110,
                        'chartSpacingRight'			=> 10,
                        'chartSpacingBottom'		=> 15,
                        'chartSpacingLeft'			=> 0,
                        'chartAlignTicks'			=> FALSE,
                        'chartBackgroundColor' => 'rgba(255, 255, 255, 1)',

                        'title'				=> 'Request Status',
                        'titleAlign'			=> 'left',
                        'titleFloating'			=> TRUE,
                        'titleStyleFont'			=> '18px Metrophobic, Arial, sans-serif',
                        'titleStyleColor'			=> '#2c3e50',
                        'titleX'				=> 20,
                        'titleY'				=> 20,

                        'legendEnabled' 			=> TRUE,
                        'legendLayout'			=> 'horizontal',
                        'legendAlign'			=> 'center',
                        'legendVerticalAlign '		=> 'bottom',
                        'legendItemStyle'			=> array('color' => '#222'),
                        'legendBackgroundColorLinearGradient' 	=> array(0,0,0,25),
                        'legendBackgroundColorStops' 		=> array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),

                        'tooltipEnabled' 			=> TRUE,
                        'tooltipBackgroundColorLinearGradient' => array(0,0,0,50),   // triggers js error
                        'tooltipBackgroundColorStops' => array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),

                )
        );

    $series = $this->HighCharts->addChartSeries();

    $series->addName('Requests')
        ->addData($pieData);

    $pieChart->addSeries($series);
  }
  
  public function requestsbymonth(){
    $this->set("title_for_layout","Request by Month Report - RecordTrac - " . $this->getAgencyName());

    $params = array(
      'recursive' => -1,
      'fields' => array("COUNT(id) as 'total'", "DATE_FORMAT(created, '%Y') as 'year'","DATE_FORMAT(created, '%M') as 'month'"),
      'group' => array("DATE_FORMAT(created, '%Y%M')"),
      'order' => array('created' => 'DESC')
    );
    
    $this->loadModel('Request');
    $numberOfPosts = $this->Request->find('all', $params);
    $this->set('months',$numberOfPosts);
  }
  
  public function requestsbymonthdept(){
    $this->set("title_for_layout","Request by Month Per Department Report - RecordTrac - " . $this->getAgencyName());

    $params = array(
      'fields' => array("COUNT(Request.id) as 'total'", "DATE_FORMAT(Request.created, '%Y') as 'year'","DATE_FORMAT(Request.created, '%M') as 'month', Request.department_id, Department.name"),
      'group' => array("Request.department_id, DATE_FORMAT(Request.created, '%Y%M')"),
      'order' => array('Request.created' => 'DESC')
    );
    
    $this->loadModel('Request');
    $numberOfPosts = $this->Request->find('all', $params);
    $this->set('months',$numberOfPosts);
  }
  
  public function requestsbyyear(){
    $this->set("title_for_layout","Request by Year Report - RecordTrac - " . $this->getAgencyName());

    $params = array(
      'recursive' => -1,
      'fields' => array("COUNT(id) as 'total'", "DATE_FORMAT(created, '%Y') as 'year'"),
      'group' => array("DATE_FORMAT(created, '%Y')"),
      'order' => array('created' => 'DESC')
    );
    
    $this->loadModel('Request');
    $numberOfPosts = $this->Request->find('all', $params);
    $this->set('months',$numberOfPosts);
  }
  
  public function requestsbyyeardept(){
    $this->set("title_for_layout","Request by Year Report - RecordTrac - " . $this->getAgencyName());

    $params = array(
      'fields' => array("COUNT(Request.id) as 'total'", "DATE_FORMAT(Request.created, '%Y') as 'year', Department.name"),
      'group' => array("Request.department_id, DATE_FORMAT(Request.created, '%Y')"),
      'order' => array('Request.created' => 'DESC')
    );
    
    $this->loadModel('Request');
    $numberOfPosts = $this->Request->find('all', $params);
    $this->set('months',$numberOfPosts);
  }
  
  public function allrequestsbyrequester(){
    
    if(!empty($this->request->data)){

      $term = filter_var($this->request->data["Admin"]["term"], FILTER_SANITIZE_STRING);
      $this->loadModel('Request');
      //lookup by name
      $this->Request->Behaviors->attach('Containable');
      $this->Request->contain(array(
                              'Owner', 
                              'Requester' => array(
                                                
                                                  'conditions'=>array(
                                                                  'Requester.alias LIKE \'%'.$term.'%\''), 
                                                  ), 
                              'Department'));
      $requestsUnfiltered = $this->Request->find('all', array('order' => array('Request.created' => 'DESC')));
      $this->Request->Behaviors->detach('Containable');

      $requests = array();
      foreach($requestsUnfiltered as $request){
        if(!empty($request["Requester"]["id"])){
          $requests[] = $request;
        }
      }
      //look up by email
      $this->Request->Behaviors->attach('Containable');
      $this->Request->contain(array(
                              'Owner', 
                              'Requester' => array(
                                                
                                                  'conditions'=>array(
                                                                  'Requester.email LIKE \'%'.$term.'%\''), 
                                                  ), 
                              'Department'));
      $requestsEmails = $this->Request->find('all', array('order' => array('Request.created' => 'DESC')));
      $this->Request->Behaviors->detach('Containable');
      //cleanup
      foreach($requestsEmails as $request){
        if(!empty($request["Requester"]["id"])){
          $recordExists = false; //check for duplicates
          foreach($requests as $checkRequest){
            if($request["Request"]["id"] == $checkRequest["Request"]["id"]){
              $recordExists = true;
            }
          }
          if($recordExists == false){

          $requests[] = $request;
          }
        }
      }

      if(count($requests) > 0){
        $this->response->type('application/pdf');
        $this->set(compact('requests'));
        $this->set('term',$term);
        $this->layout = '/pdf/default';
        $this->render('/Pdf/all_requests_by_requester_report');
      }else{
        $this->Session->setFlash('No requests found. Please try searching by another name or email.', 'danger');
      }
    }
  }
  
  public function allrequestsbystaff(){

    $this->loadModel('User');
    $this->set('users',$this->User->find('list', array('conditions' => 'User.department_id IS NOT NULL', 'fields' => array('id','alias'))));
    
    if(!empty($this->request->data)){
      
      
      $staffID = filter_var($this->request->data["Admin"]["users"], FILTER_VALIDATE_INT);
      $this->loadModel('Request');
      $this->Request->Behaviors->attach('Containable');
      $this->Request->contain(array(
                              'Owner' => array(
                                                  'User', 
                                                  'conditions'=>array(
                                                                  'Owner.user_id' => $staffID), 
                                                  ), 'Requester', 'Department'));
      $requestsUnfiltered = $this->Request->find('all', array('order' => array('Request.created' => 'DESC')));
      $this->Request->Behaviors->detach('Containable');
      //pr($requestsUnfiltered);
      $requests = array();
      foreach($requestsUnfiltered as $request){
        if(!empty($request["Owner"])){
          //pr($request); 
          $requests[] = $request;
        }
      }
      //echo count($requests);
      if(count($requests) >0){
        $this->response->type('application/pdf');
        $this->set(compact('requests'));
        $this->layout = '/pdf/default';
        $this->render('/Pdf/all_requests_by_staff_report');
      }else{
        $this->Session->setFlash('No requests found. Please choose another staff member.', 'danger');
      }
    }
  }
  
  public function openrequestsbystaff(){

    $this->loadModel('User');
    $this->set('users',$this->User->find('list', array('conditions' => 'User.department_id IS NOT NULL', 'fields' => array('id','alias'))));
    
    if(!empty($this->request->data)){
      
      
      $staffID = filter_var($this->request->data["Admin"]["users"], FILTER_VALIDATE_INT);
      $this->loadModel('Request');
      $this->Request->Behaviors->attach('Containable');
      $this->Request->contain(array(
                              'Owner' => array(
                                                  'User', 
                                                  'conditions'=>array(
                                                                  'Owner.active' => 1,
                                                                  'Owner.user_id' => $staffID), 
                                                  ), 'Requester', 'Department'));
      $requestsUnfiltered = $this->Request->find('all', array('conditions' => array('Request.Status_id != 2'), 'order' => array('Request.due_date' => 'desc')));
      $this->Request->Behaviors->detach('Containable');
      //pr($requestsUnfiltered);
      $requests = array();
      foreach($requestsUnfiltered as $request){
        if(!empty($request["Owner"])){
          //pr($request); 
          $requests[] = $request;
        }
      }
      //echo count($requests);
      if(count($requests) >0){
        $this->response->type('application/pdf');
        $this->set(compact('requests'));
        $this->layout = '/pdf/default';
        $this->render('/Pdf/open_requests_by_staff_report');
      }else{
        $this->Session->setFlash('No requests found. Please choose another staff member.', 'danger');
      }
    }
  }
  
  public function openrequests(){
    $this->response->type('application/pdf');

    $this->loadModel("Request");
    $requests = $this->Request->find('all', array('conditions' => array('Request.Status_id != 2'), 'order' => array('Request.id' => 'desc')));
    $this->set(compact('requests'));
    $this->layout = '/pdf/default';
    $this->render('/Pdf/open_requests_report');
  }
}