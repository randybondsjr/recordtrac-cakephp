<?php
  $this->Html->script('admin', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
  echo $this->Element('admin-navigation'); 
?>
		<div class="row">
			<div class="col-sm-8">
				<h3>All Requests by Requester</h3>
			</div>
		</div>

		<div class="row">
		  <div class="col-sm-12">
  		  <?php 
          echo $this->Form->create('Admin');
          echo $this->Form->input('term',
                                  array('type' => 'text',
                                        'before' => '<p class="lead">Please search by requester email or name:</p>', 
                                        'label' => '',
                                        'class' => 'form-control'));
          echo $this->Form->submit(
              'Create Report', 
              array('class' => 'btn btn-primary', 'title' => 'Create Report')
          );
          echo $this->Form->end();
        ?>
		  </div>
		</div>
	</div><!--END FROM ADMIN NAV -->
</div>
<div class="clearfix"></div>
