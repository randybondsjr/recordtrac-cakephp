<div class="row">
	<div class="col-sm-7">
	  <h1>Edit Request <span class="muted">#<?php  echo $requestId; ?></span></h1>
	  <p>You are editing a request that has been submitted to RecordTrac. This should only be done for the protection of any person's right to privacy.</p>
	  
    <?php
      echo $this->Form->create('Request');
      echo $this->Form->input('modified_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
      echo $this->Form->input('text',
                              array('type' => 'textarea',
                                    'before' => '<p class="lead">Request Details</p>',
                                    'label' => false,
                                    'class' => 'form-control'));
      echo "<div id=\"not_public_record\"></div>";

      echo $this->Form->submit(
          'Update Request', 
          array('class' => 'btn btn-primary', 'title' => 'Update Request')
      );
      echo $this->Form->end();
    ?>
	</div>
	<div class="col-sm-4 col-sm-offset-1">
	  <div class="well">
	    <h4>Instructions</h4>
	    <p class="lead">Edit the request, only removing text that will reveal sensitive information concerning the parties involved.</p>
	    <p class="lead">Once updated, a note will be added to the request and emailed to the subscribers with the following text:</p>
	    <blockquote>This request was edited pursuant to RCW 42.56.240(1) for the protection of any person's right to privacy.</blockquote>
	  </div>
	</div>
</div>