<?php
  $this->Html->script('admin', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
  echo $this->Element('admin-navigation'); 
?>
 <div class="row">
			<div class="col-sm-8">
				<h1>RecordTrac - Administration</h1>
			</div>
		</div>
    <div class="row">
      <div class="col-sm-7">
        <?php echo $this->Form->create('User'); ?>
        <fieldset>
          <legend><?php echo __('Add User'); ?></legend>
            
          <?php
            echo $this->Form->input('alias',array(
                                              'label'=>'Name', 
                                              'class' => 'form-control', 
                                              'placeholder' => 'Full Name'));
            echo $this->Form->input('email',array(
                                              'type' => 'email', 
                                              'placeholder' => 'yourname@example.com',
                                              'label' => 'Email', 
                                              'class' => 'form-control'));
            echo $this->Form->input('phone',array(
                                              'placeholder' => '509.555.1234',
                                              'class' => 'form-control'));
            echo $this->Form->input('password',array( 
                                              'placeholder' => 'Password',
                                              'class' => 'form-control'));
            echo $this->Form->input('department_id',array( 
                                              'empty' => '(chose one)',
                                              'class' => 'form-control'));
            echo $this->Form->input('is_admin',array('label' => 'Super Admin?'));
          ?>
        </fieldset>
        <?php 
          echo $this->Form->submit(
            'Add User', 
            array('class' => 'btn btn-primary', 'title' => 'Custom Title')
          );
        ?>
      </div>
      <div class="col-sm-3 col-sm-offset-1 well">
        <h3>Instructions</h3>
        <p class="lead">Fill out all form field for a user, if the user is a staff member, they must be assigned a department.</p>
      </div>
    </div>
	</div><!--END FROM ADMIN NAV -->
</div>
<div class="clearfix"></div>