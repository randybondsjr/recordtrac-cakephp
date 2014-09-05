 <div class="row">
			<div class="col-sm-8">
				<h1 id="landing_brand">RecordTrac - Administration</h1>
			</div>
		</div>
    <div class="row">
      <div class="col-sm-7">
        <?php echo $this->Form->create('User'); ?>
        <fieldset>
          <legend><?php echo __('Reset User Password for <strong>' . $this->data["User"]["alias"] . '</strong>'); ?></legend>
          <?php 
            echo $this->Form->input('password',array(
                      
                                              'label'=>'New Password', 
                                              'class' => 'form-control', 
                                              'placeholder' => 'New Password'));
          ?>
        </fieldset>
        <?php 
          echo $this->Form->submit(
            'Update Password', 
            array('class' => 'btn btn-primary', 'title' => 'Custom Title')
          );
        ?>
      </div>
      <div class="col-sm-3 col-sm-offset-1 well">
        <h3>Instructions</h3>
        <p class="lead">Please enter a new password for this user, it will reset the current password they have.</p>
      </div>
    </div>
    <div class="clearfix"></div>