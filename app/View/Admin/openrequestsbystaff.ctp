<?php
  $this->Html->script('admin', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
  echo $this->Element('admin-navigation'); 
?>
		<div class="row">
			<div class="col-sm-8">
				<h3>Open Requests by Staff Member</h3>
			</div>
		</div>

		<div class="row">
		  <div class="col-sm-12">
  		  <?php 
          echo $this->Form->create('Admin');
          echo $this->Form->input('users',
                                  array('empty' => '-- Please Choose One --',
                                        'before' => '<p class="lead">Please choose a staff member to create the report from:</p>', 
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
