<?php
  $this->Html->script('admin', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
  echo $this->Element('admin-navigation'); 
?>
  <div class="row">
			<div class="col-sm-8">
				<h1>Administration</h1>
			</div>
		</div>
    <div class="row">
      <div class="col-sm-7">
        <?php echo $this->Form->create('Department'); ?>
        <fieldset>
          <legend><?php echo __('Add Department'); ?></legend>
            
          <?php 
            
            echo $this->Form->input('name',array(
                                              'label'=>'Name', 
                                              'class' => 'form-control', 
                                              'placeholder' => 'Department Name'));
            echo $this->Form->input('contact_id',array( 
                                              'empty' => '(chose one)',
                                              'class' => 'form-control'));
            echo $this->Form->input('backup_id',array( 
                                              'empty' => '(chose one)',
                                              'class' => 'form-control'));
          ?>
        </fieldset>
        <?php 
          echo $this->Form->submit(
            'Add Department', 
            array('class' => 'btn btn-primary', 'title' => 'Add Department')
          );
        ?>
      </div>
      <div class="col-sm-3 col-sm-offset-1 well">
        <h3>Instructions</h3>
        <p class="lead">Enter a department name, and then add a staff member who will be emailed with requests related to this department.</p>
      </div>
    </div>
	</div><!--END FROM ADMIN NAV -->
</div>
<div class="clearfix"></div>