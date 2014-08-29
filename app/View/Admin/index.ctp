<?php
  $this->Html->script('admin', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
  echo $this->Element('admin-navigation'); 
?>
		<div class="row">
			<div class="col-sm-8">
				<h3>Dashboard</h3>
			</div>
		</div>

		<div class="row">
		  <div class="col-sm-8">
		    <div id="linewrapper"></div>
        <div class="clear"></div>		
        <?php echo $this->HighCharts->render('Line Chart'); ?>
      </div>
      <div class="col-sm-4">
        <div id="piewrapper"></div>
        <div class="clear"></div>	
        <?php echo $this->HighCharts->render('Pie Chart'); ?>
      </div>
		</div>
	</div><!--END FROM ADMIN NAV -->
</div>