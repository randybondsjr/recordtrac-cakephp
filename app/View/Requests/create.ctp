<?php
  $this->Html->script('bootstrap-combobox', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
  $this->Html->script('create-request', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
  $this->Html->css('bootstrap-combobox', array('inline' => false));
?>
<div class="row">
	<div class="col-sm-7">
	  <h1>Request a new record</h1>
	  <p>Use RecordTrac to request copies of specific documents, photos, emails, texts, audio recordings, electronic information and data in the <?php echo $agencyName; ?>'s databases.</p>
	  
    <?php
      echo $this->Form->create('Request');
      echo $this->Form->input('text',
                              array('type' => 'textarea', 
                                    'placeholder' => 'Describe your request. Be as specific as possible.',
                                    'before' => '<p class="lead">What are you trying to find?</p>', 
                                    'label' => '<span class="glyphicon glyphicon-exclamation-sign"></span> Everything in this request box will be displayed publicly. <a href="/about#why">Why?</a>', 
                                    'class' => 'form-control'));
    ?>
    
    <?php
      echo $this->Form->input('doctype',
                              array(
                                    'between' => '<p class="lead">Select a department or document type <small class="department_optional">(optional)</small></p>',
                                    'empty' => '(choose one)', 
                                    'label' => '', 
                                    'class' => 'form-control combobox'));
      echo $this->Form->submit(
          'Submit My Request', 
          array('class' => 'btn btn-primary', 'title' => 'Custom Title')
      );
    ?>
	</div>
	<div class="col-sm-4 col-sm-offset-1">
	  <div class="well">
	    <h4>Example</h4>
	    <p class="lead">I need a copy of all of Mayor Jean Deux’s emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.</p>
	    <p class="lead">The emails should contain the words "Art+Soul festival" or "Art + Soul <?php echo $agencyName; ?>."</p>
	  </div>
	</div>
</div>