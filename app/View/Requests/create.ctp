<?php
  $this->Html->script('bootstrap-combobox', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
  $this->Html->script('create-request', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
  $this->Html->script('datepicker', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
  $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js', array('inline' => false));
  $this->Html->css('//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css', array('inline' => false));
  $this->Html->css('bootstrap-combobox', array('inline' => false));
?>
<div class="row">
	<div class="col-sm-7">
	  <h1>Request a new record</h1>
	  <p>Use RecordTrac to request copies of specific documents, photos, emails, texts, audio recordings, electronic information and data in the <?php echo $agencyName; ?>'s databases.</p>
	  
    <?php
      $labelPerson = "Your";
      echo $this->Form->create('Request');
      echo $this->Form->input('text',
                              array('type' => 'textarea', 
                                    'placeholder' => 'Describe your request. Be as specific as possible.',
                                    'before' => '<p class="lead">What are you trying to find?</p>', 
                                    'label' => '<div class="alert alert-info"><span class="glyphicon glyphicon-exclamation-sign glyphicon-info"></span> Everything in this request box will be displayed publicly. <a href="/about#why">Why?</a></div>',
                                    'class' => 'form-control'));
      echo "<div id=\"not_public_record\"></div>";
      echo "<p class=\"lead\">Select a Date Range for the Request <small class=\"department_optional\">(optional)</small></p>";
      echo $this->Form->input('request_start',
                            array('type' => 'text',
                                  'label' => 'Start', 
                                  'class' => 'form-control'));
      echo $this->Form->input('request_end',
                            array('type' => 'text',
                                  'label' => 'End', 
                                  'class' => 'form-control'));
      echo $this->Form->input('department_id',
                              array(
                                    'between' => '<p class="lead">Select a department or document type <small class="department_optional">(optional)</small></p>',
                                    'empty' => '(choose one)', 
                                    'label' => '', 
                                    'class' => 'form-control combobox'));
      if ($this->Session->read('Auth.User')){
        echo $this->Form->input('creator_id',
                              array('type' => 'hidden',
                                    'value' => $this->Session->read('Auth.User.id')));
        echo $this->Form->input('offline_submission_id',
                              array('between' => '<p class="lead">Format Received</p>',
                                    'empty' => '(choose one)',
                                    'label' => '', 
                                    'class' => 'form-control'));
        //default date is today
        $defaultDate = date('m/d/Y');
        echo $this->Form->input('date_received',
                              array('between' => '<p class="lead">Date Received</p>',
                                    'type' => 'text',
                                    'label' => '', 
                                    'class' => 'form-control date-picker',
                                    'value' => $defaultDate));
        $labelPerson = "Requester's";
      }
      
      echo "<p class=\"lead\">Contact Information</p>";
      echo $this->Form->input('Requester.email',
                              array('type' => 'email', 
                                    'placeholder' => 'name@example.com',
                                    'label' => $labelPerson. ' email', 
                                    'class' => 'form-control'));
      echo $this->Form->input('Requester.alias',
                              array('type' => 'text', 
                                    'placeholder' => $labelPerson. ' Name',
                                    'label' => $labelPerson. ' Name <small>(optional)</small>', 
                                    'class' => 'form-control'));
      echo $this->Form->input('Requester.phone',
                              array('type' => 'text', 
                                    'placeholder' => '(509) 555-1234',
                                    'label' => $labelPerson. ' Phone Number <small>(optional)</small>', 
                                    'class' => 'form-control'));
      echo $this->Form->submit(
          'Submit My Request', 
          array('class' => 'btn btn-primary', 'title' => 'Submit My Request')
      );
      echo $this->Form->end();
    ?>
	</div>
	<div class="col-sm-4 col-sm-offset-1">
	  <div class="well">
	    <h4>Example</h4>
	    <p class="lead">I need a copy of all of Mayor Jean Deux’s emails sent to City Manager Kenobi between July 30, 2013-August 8, 2013.</p>
	    <p class="lead">The emails should contain the words "Art+Soul festival" or "Art + Soul <?php echo $agencyName; ?>."</p>
	    <h4>Tips</h4>
	    <ul>
        <li>Don't reveal personal information, like your social security number or home address.</li>
        <li>Limit your request by a date range.</li>
        <li>Provide the name of the record or take a guess.</li>
        <li>If you don't know the name of the record, describe the information you believe is contained in it.</li>
      </ul>
	  </div>
	</div>
</div>