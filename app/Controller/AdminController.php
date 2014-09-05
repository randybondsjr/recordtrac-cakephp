<?php
class AdminController extends AppController {
  /**
  * This controller does not use a model
  *
  * @var array
  */
  public $components = array('HighCharts.HighCharts');
	public $uses = array();
	public function beforeFilter(){
	  parent::beforeFilter();
    $this->Auth->deny();
	}

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
}