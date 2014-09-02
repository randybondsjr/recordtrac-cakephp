<?php
class RecordTracController extends AppController {
	public $uses = array();//no model used!
	public $components = array('HighCharts.HighCharts');
	private function get_avg_response_time($deptID = null){
  	$response_time = 0;
  	$num_closed = 0;
  	$this->loadModel('Request');
    $requests = $this->Request->find('all', array('conditions' => array('Request.department_id' => $deptID)));

    foreach($requests as $request){
      if($request["Request"]["status_id"] == 2){ //only do this if it's closed
        $response_time = $response_time + strtotime($request["Request"]["status_updated"]) - strtotime($request["Request"]["created"]);
        $num_closed = $num_closed + 1;
      }
    }
    if($num_closed > 0){
       $avg = $response_time / $num_closed;
       return $avg;
    }else {
      return 0;
    }
	}
  
  private function responseSort($a,$b){
    return $a['avg_response_time'] - $b['avg_response_time'];
  }
  
  private function secondsToDays($seconds){
    $ret = "";

    /*** get the days ***/
    $days = intval(intval($seconds) / (3600*24));
    if($days> 0)
    {
        $ret .= $days;
    }

    return $ret;
  }
  
  public function index() {
    $this->set("title_for_layout","RecordTrac - " . $this->getAgencyName());
    //top requests
    $this->loadModel('Requests');
    $this->set('totalRequests', $this->Requests->find('count'));
    $top5depts = $this->Requests->query('
                                        SELECT count(*) as totalRequest, d.name 
                                        FROM `requests` r
                                        LEFT JOIN `departments` d ON d.id= r.department_id
                                        GROUP BY department_id 
                                        ORDER BY count(*) DESC
                                        LIMIT 0,5
                                        ');

    $requests = array();
    $depts = array();
    foreach($top5depts AS $dept){
      $requests[] = intval($dept[0]["totalRequest"]);
      $depts[] = $dept["d"]["name"];
    }
    
        
    //AVG RESPONSE TIME
    $this->loadModel('Departments');
    $departments = $this->Departments->find('all');
    $avgResponseTime = array();
    $i = 0;
    foreach($departments as $department){
      $avgResponseTime[$i]["name"] = $department["Departments"]["name"];
      $avgResponseTime[$i]["avg_response_time"] = $this->get_avg_response_time($department["Departments"]["id"]);
      $i++;
    }
    usort($avgResponseTime, array($this,'responseSort'));

    $avgNames = array();
    $avgTimes = array();
    $i = 0;
    foreach ($avgResponseTime as $avg){
      if($avg["avg_response_time"] != 0){
        if($i != 5){
          $avgNames[$i] = $avg["name"];
          $avgTimes[$i] = intval($this->secondsToDays($avg["avg_response_time"]));
          $i++;
        }
      }
    }
    
    //top requests chart
    $chartName = 'Top Requests';
    $mychart = $this->HighCharts->create( $chartName, 'column' );
    $this->HighCharts->setChartParams(
            $chartName,
            array(
                  'renderTo'				=> 'toprequests',  // div to display chart inside
                  'chartMarginTop' 			=> 60,
                  'chartMarginLeft'			=> 70,
                  'chartMarginRight'			=> 30,
                  'chartMarginBottom'			=> 110,
                  'chartSpacingRight'			=> 10,
                  'chartSpacingBottom'			=> 15,
                  'chartSpacingLeft'			=> 0,
                  'chartAlignTicks'			=> FALSE,
                  'chartTheme'                => 'skies',
                  'chartBackgroundColor' => 'rgba(255, 255, 255, 0.1)',
                  'title'					=> 'Requests (Top 5 Departments)',
                  'titleAlign'				=> 'left',
                  'titleFloating'				=> TRUE,
                  'titleX'				=> 20,
                  'titleY'				=> 20,
                  'legendEnabled' 			=> FALSE,
                  'tooltipEnabled' 			=> FALSE,
                  'xAxisLabelsEnabled' 			=> TRUE,
                  'xAxisLabelsAlign' 			=> 'center',
                  'xAxisLabelsStep' 			=> 0,
                  'xAxislabelsX' 				=> 5,
                  'xAxisLabelsY' 				=> 20,
                  'xAxisCategories'          		=> $depts,
                  'yAxisTitleText' 			=> 'Requests',
                  'enableAutoStep' 			=> FALSE
            )
    );
    
    $series = $this->HighCharts->addChartSeries();
    $series->addName('Requests')
           ->addData($requests);
    $mychart->addSeries($series);
    
    //avg response time chart
    $chartName = 'Avg Response Time';
    $mychart = $this->HighCharts->create( $chartName, 'bar' );
    $this->HighCharts->setChartParams(
            $chartName,
            array(
                  'renderTo'				=> 'daystorespond',  // div to display chart inside
                  'chartMarginTop' 			=> 60,
                  'chartMarginLeft'			=> 20,
                  'chartMarginRight'			=> 30,
                  'chartMarginBottom'			=> 110,
                  'chartSpacingRight'			=> 10,
                  'chartSpacingBottom'			=> 15,
                  'chartSpacingLeft'			=> 0,
                  'chartAlignTicks'			=> FALSE,
                  'chartTheme'                => 'skies',
                  'chartBackgroundColor' => 'rgba(255, 255, 255, 0.1)',
                  'title'					=> 'Average # Days to Respond (quickest 5 departments)',
                  'titleAlign'				=> 'left',
                  'titleFloating'				=> TRUE,
                  'titleX'				=> 20,
                  'titleY'				=> 20,
                  'legendEnabled' 			=> FALSE,
                  'tooltipEnabled' 			=> FALSE,
                  'xAxisTickLength' 			=> 0,
                  'xAxisLabelsEnabled' 			=> TRUE,
                  'xAxisLabelsAlign' 			=> 'left',
                  'xAxisLabelsStep' 			=> 0,
                  'xAxislabelsX' 				=> 5,
                  'xAxisLabelsY' 				=> 5,
                  'xAxisCategories'     => $avgNames,
                  'yAxisTitleText' 		=> 'Days',
                  'enableAutoStep' 		=> FALSE
          )
    );

    $series = $this->HighCharts->addChartSeries();
    $series->addName('Days')
           ->addData($avgTimes);
    $mychart->addSeries($series);


  }
}