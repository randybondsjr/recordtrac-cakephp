<?php
class RecordTracController extends AppController {
	public $uses = array();//no model used!
	public $components = array('HighCharts.HighCharts');
  public function index() {
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
                  //'chartBackgroundColorLinearGradient' 	=> array(0,0,0,300),
                  //'chartBackgroundColorStops'		=> array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),
  
                  'title'					=> 'Requests (Top 5 Departments)',
                  'titleAlign'				=> 'left',
                  'titleFloating'				=> TRUE,
                  'titleX'				=> 20,
                  'titleY'				=> 20,
  
                  'legendEnabled' 			=> FALSE,
  
                  'tooltipEnabled' 			=> FALSE,
                  // 'tooltipBackgroundColorLinearGradient' => array(0,0,0,50),   // triggers js error
                  // 'tooltipBackgroundColorStops' => array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),
  
                  //'plotOptionsLinePointStart' 		=> strtotime('-30 day') * 1000,
                  //'plotOptionsLinePointInterval' 	=> 24 * 3600 * 1000,
  
                  //'xAxisType' 				=> 'datetime',
                  //'xAxisTickInterval' 			=> 10,
                  //'xAxisStartOnTick' 			=> TRUE,
                  //'xAxisTickmarkPlacement' 		=> 'on',
                  //'xAxisTickLength' 			=> 10,
                  //'xAxisMinorTickLength' 		=> 5,
  
                  'xAxisLabelsEnabled' 			=> TRUE,
                  'xAxisLabelsAlign' 			=> 'center',
                  'xAxisLabelsStep' 			=> 0,
                  //'xAxisLabelsRotation' 		=> -35,
                  'xAxislabelsX' 				=> 5,
                  'xAxisLabelsY' 				=> 20,
                  'xAxisCategories'          		=> $depts,
  
                  //'yAxisMin' 				=> 0,
                  //'yAxisMaxPadding'			=> 0.2,
                  //'yAxisEndOnTick'			=> FALSE,
                  //'yAxisMinorGridLineWidth' 		=> 0,
                  //'yAxisMinorTickInterval' 		=> 'auto',
                  //'yAxisMinorTickLength' 		=> 1,
                  //'yAxisTickLength'			=> 2,
                  //'yAxisMinorTickWidth'			=> 1,
  
                  'yAxisTitleText' 			=> 'Requests',
                  //'yAxisTitleAlign' 			=> 'high',
                  //'yAxisTitleStyleFont' 		=> '14px Metrophobic, Arial, sans-serif',
                  //'yAxisTitleRotation' 			=> 0,
                  //'yAxisTitleX' 			=> 0,
                  //'yAxisTitleY' 			=> -10,
                  //'yAxisPlotLines' 			=> array( array('color' => '#808080', 'width' => 1, 'value' => 0 )),
  
                  // autostep options
                  'enableAutoStep' 			=> FALSE
            )
    );
    
    $series = $this->HighCharts->addChartSeries();
    
    $series->addData($requests);
    
    $mychart->addSeries($series);
    
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
                  // 'tooltipBackgroundColorLinearGradient' => array(0,0,0,50),   // triggers js error
                  // 'tooltipBackgroundColorStops' => array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),
                  
                  //'plotOptionsLinePointStart' 		=> strtotime('-30 day') * 1000,
                  //'plotOptionsLinePointInterval' 	=> 24 * 3600 * 1000,
                  
                  //'xAxisType' 				=> 'datetime',
                  //'xAxisTickInterval' 			=> 1,
                  //'xAxisStartOnTick' 			=> TRUE,
                  //'xAxisTickmarkPlacement' 		=> 'on',
                  'xAxisTickLength' 			=> 0,
                  //'xAxisMinorTickLength' 		=> 5,
                  
                  'xAxisLabelsEnabled' 			=> TRUE,
                  'xAxisLabelsAlign' 			=> 'left',
                  'xAxisLabelsStep' 			=> 0,
                  //'xAxisLabelsRotation' 		=> -35,
                  'xAxislabelsX' 				=> 5,
                  'xAxisLabelsY' 				=> 5,
                  'xAxisCategories'     => $depts,
                  
                  //'yAxisMin' 				=> 0,
                  //'yAxisMaxPadding'			=> 0.2,
                  //'yAxisEndOnTick'			=> FALSE,
                  //'yAxisMinorGridLineWidth' 		=> 0,
                  //'yAxisMinorTickInterval' 		=> 'auto',
                  //'yAxisMinorTickLength' 		=> 1,
                  //'yAxisTickLength'			=> 2,
                  //'yAxisMinorTickWidth'			=> 1,
                  
                  
                  'yAxisTitleText' 		=> 'Days',
                  //'yAxisTitleAlign' 		=> 'high',
                  //'yAxisTitleStyleFont' 	=> '14px Metrophobic, Arial, sans-serif',
                  //'yAxisTitleRotation' 		=> 0,
                  //'yAxisTitleX' 		=> 0,
                  //'yAxisTitleY' 		=> -10,
                  //'yAxisPlotLines' 		=> array( array('color' => '#808080', 'width' => 1, 'value' => 0 )),
                  
                  // autostep options
                  'enableAutoStep' 		=> FALSE
          )
    );

    $series = $this->HighCharts->addChartSeries();

    $series->addData($requests);

    $mychart->addSeries($series);


  }
}