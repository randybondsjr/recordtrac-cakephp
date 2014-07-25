 <div class="row">
			<div class="col-sm-8">
				<h1 id="landing_brand">RecordTrac - Administration</h1>
			</div>
		</div>
    <div class="row">
      <div class="col-sm-7">
        <?php echo $this->Form->create('User'); ?>
        <fieldset>
            <legend><?php echo __('Add User'); ?></legend>
            <?php echo $this->Form->input('email',
                                  array('type' => 'email', 
                                        'placeholder' => 'yourname@example.com',
                                        'label' => 'Your email', 
                                        'class' => 'form-control'));
            echo $this->Form->input('password');
        ?>
        </fieldset>
        <?php echo $this->Form->end(__('Submit')); ?>
      </div>
      <div class="col-sm-3 col-sm-offset-1 well">
        <h3>Instructions</h3>
      </div>
    </div>