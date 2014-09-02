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
        <?php echo $this->Form->create('Doctype'); ?>
        <fieldset>
          <legend><?php echo __('Add Document Type'); ?></legend>
            
          <?php 
            
            echo $this->Form->input('name',array(
                                              'label'=>'Name', 
                                              'class' => 'form-control', 
                                              'placeholder' => 'Document Type'));
            echo $this->Form->input('department_id',array( 
                                              'empty' => '(chose one)',
                                              'class' => 'form-control'));
          ?>
        </fieldset>
        <?php 
          echo $this->Form->submit(
            'Add Document Type', 
            array('class' => 'btn btn-primary', 'title' => 'Add Document Type')
          );
        ?>
      </div>
      <div class="col-sm-3 col-sm-offset-1 well">
        <h3>Instructions</h3>
        <p class="lead">Please be kind, rewind.</p>
      </div>
    </div>
	</div><!--END FROM ADMIN NAV -->
</div>
<div class="clearfix"></div>