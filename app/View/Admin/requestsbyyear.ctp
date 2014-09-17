<?php
  $this->Html->script('admin', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
  echo $this->Element('admin-navigation'); 
?>
		<div class="row">
			<div class="col-sm-8">
				<h3>Requests by Year Report</h3>
			</div>
		</div>

		<div class="row">
		  <div class="col-sm-12">
		    <table class="table table-responsive table-striped">
		      <thead>
		        <tr>
  		        <th>Year</th>
              <th>Requests</th>
		        </tr>
		      </thead>
  		  <?php 
          foreach($months as $month){
            echo "<tr>";
            printf("<td>%s</td><td>%d</td>", $month[0]["year"],$month[0]["total"]);
            echo "</tr>";
          }
        ?>
		    </table>
		  </div>
		</div>
	</div><!--END FROM ADMIN NAV -->
</div>
<div class="clearfix"></div>
