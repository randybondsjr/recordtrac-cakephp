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
        <?php echo $this->Form->create('Extendreason'); ?>
        <fieldset>
          <legend><?php echo __('Add Extend Reason'); ?></legend>
            
          <?php 
            
            echo $this->Form->input('name',array(
                                              'label'=>'Label', 
                                              'class' => 'form-control', 
                                              'placeholder' => 'Label'));
            echo $this->Form->input('reason',array(
                                              'label'=>'Reason', 
                                              'class' => 'form-control', 
                                              'placeholder' => 'Reason'));
          ?>
        </fieldset>
        <?php 
          echo $this->Form->submit(
            'Add Extend Reason', 
            array('class' => 'btn btn-primary', 'title' => 'Add Extend Reason')
          );
        ?>
      </div>
      <div class="col-sm-3 col-sm-offset-1 well">
        <h3>Instructions</h3>
        <p class="lead">Remember the name of the reason is for internal use, while the reason itself is the text that will be emailed to the requester.</p>
      </div>
    </div>
	</div><!--END FROM ADMIN NAV -->
</div>
<div class="clearfix"></div>