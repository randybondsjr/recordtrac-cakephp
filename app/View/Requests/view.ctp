<?php 
  $this->Html->script('readmore.min.js', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
  $this->Html->script('bootstrap-select.min', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
  $this->Html->css('bootstrap-select.min', array('inline' => false));
  $this->Html->script('datepicker', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
  $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js', array('inline' => false));
  $this->Html->css('//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css', array('inline' => false));
  $this->Html->script('view-request', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
  
  $requesterEmail = "<span class=\"badge\">Not Provided</span>";
  $requesterAlias = "<span class=\"badge\">Name Not Provided</span>";
  $requesterPhone = "<span class=\"badge\">Not Provided</span>";
  if($request["Requester"]["email"] != ""){ $requesterEmail = $this->Text->autoLinkEmails($request["Requester"]["email"]); }
  if($request["Requester"]["alias"] != ""){ $requesterAlias = "<strong>".$request["Requester"]["alias"]."</strong>"; }
  if($request["Requester"]["phone"] != ""){ $requesterPhone = "<strong>".$request["Requester"]["phone"]."</strong>"; }
?>
<div class="row">
	<div class="col-sm-8">
	  <div class="well">
	    <h1 class="control-widget">Request <span class="muted">#<?php  echo $request["Request"]["id"]; ?></span></h1>
	    <?php if ($this->Session->read('Auth.User') && $request["Request"]["status_id"] != 2): ?>
      <?php 
        if($this->Session->read('Auth.User.is_admin')){
          echo $this->Html->link(
        		        "<span class=\"glyphicon glyphicon-pencil\"></span> Edit Request",
          		      "edit/".$request["Request"]["id"]."/",
                    array('escape' => false, 'class' => 'btn btn-primary pull-right', 'id' => 'seedata')
          );
        }
      ?>
      <div class="rw-container">
        <div class="rw-controller-container">
          <div class="rw-controller-btns-container">
            <div class="rw-btn-wrap" data-target="askform">
              <div class="rw-btn">
                <span class="glyphicon glyphicon-question-sign"></span>
              </div>
              <div class="rw-btn-expand"> 
                Ask a Question
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="rw-actions-container"> 
        <!--Add Record -->
        <div class="target-for" data-target-for="askform">
          <?php
            echo $this->Form->create('Question', array('action' => 'ask', 'controller' => 'question', 'class' => 'form-horizontal'));
            echo $this->Form->input('creator_id',array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
            echo $this->Form->input('request_id',array('type' => 'hidden', 'value' => $request["Request"]["id"]));
            echo $this->Form->input('question',
                array('type' => 'textarea', 
                      'div' => 'form-group',
                      'placeholder' => 'Add the requester a question',
                      'label' => array('class' =>'control-label col-sm-3', 'text' => 'Question <span id="offlinedocTooltip" rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Use this space to ask a question about the request. The question will be posted online to be viewed by the public."><span class="glyphicon glyphicon-exclamation-sign"></span>'), 
                      'class' => 'form-control',
                      'between' => '<div class="col-sm-9">',
                      'after' => '</div>',
                      'rows' => 2));
            echo $this->Form->submit(
                'Ask Question', 
                array('class' => 'btn btn-primary', 
                      'title' => 'Ask Question',
                      'div' => 'form-group', 
                      'before' => '<div class="col-sm-9 col-sm-offset-3">',
                      'after' => '</div>'));
            echo $this->Form->end();
          ?>
        </div>
      </div>
	    <?php endif; ?>
	    <p class="lead"><?php echo nl2br($request["Request"]["text"]); ?></p>
	    <?php 
	      if(!empty($request["Question"])){
	        foreach($request["Question"] as $question){
	          $user = $this->User->getUserDetails($question["creator_id"]);
	          echo "<hr/>\n";
	          echo "<div class=\"row\">\n";
	          echo "<div class=\"col-sm-1\"><span class=\"glyphicon glyphicon-question-sign\"></span></div>\n";
	          printf("<div class=\"col-sm-8\">%s - %s</div>\n", $question["question"], $this->Text->autoLinkEmails($user["User"]["email"], array('class' => 'muted')));
	          printf("<div class=\"col-sm-3 text-right\"><span data-toggle=\"tooltip\" data-placement=\"right\" title=\"%s\" rel=\"tooltip\">%s</span></div>",$this->Time->format('M jS, Y g:ia', $question["created"]),$this->Date->time_elapsed_string($question["created"]));
	          echo "</div>\n";
	          
	          echo "<div class=\"row\">\n";
	          if($question["answer"] != ''){
	            printf("<div class=\"col-sm-8 col-sm-offset-1\">%s - Requester</div>\n", $question["answer"]);
	          }elseif($this->Session->read('Auth.User')){
  	          echo "<div class=\"col-sm-8 col-sm-offset-1\"><em>Requester hasn't answered yet.</em></div>\n";
	          }else{
	            echo "<div class=\"col-sm-8 col-sm-offset-1\">";
              echo $this->Form->create('Question', array('action' => 'answer', 'controller' => 'question', 'class' => 'form-horizontal'));
              echo $this->Form->input('id',array('type' => 'hidden', 'value' => $question["id"]));
              echo $this->Form->input('request_id',array('type' => 'hidden', 'value' => $request["Request"]["id"]));
              echo $this->Form->input('answer',
                  array('type' => 'textarea', 
                        'div' => 'form-group',
                        'placeholder' => 'Can you respond to the above question?',
                        'label' => array('class' =>'control-label col-sm-3', 'text' => 'Answer'), 
                        'class' => 'form-control',
                        'between' => '<div class="col-sm-9">',
                        'after' => '</div>',
                        'rows' => 2));
              echo $this->Form->submit(
                  'Answer Question', 
                  array('class' => 'btn btn-primary', 
                        'title' => 'Answer Question',
                        'div' => 'form-group', 
                        'before' => '<div class="col-sm-9 col-sm-offset-3">',
                        'after' => '</div>'));
              echo $this->Form->end();
              echo "</div>";
	          }
	          echo "</div>\n";
          }
        }
        echo "<hr/>\n";
	      if(isset($request["Request"]["offline_submission_id"]) && $request["Request"]["offline_submission_id"] != ''){
  	      printf("<p><small>This request was submitted on behalf of %s (%s) by %s</small></p>\n", $requesterAlias, $requesterEmail, $request["Creator"]["alias"]);
	      }else{
  	      printf("<p><small>This request was submitted by %s (%s)</small></p>\n", $requesterAlias, $requesterEmail );
	      }
	    ?>
	    
    </div>
    <?php 
	    if ($this->Session->read('Auth.User')){
  	    echo $this->Form->create('Request', array('action' => 'updateTags','class' => 'form-horizontal'));
        echo $this->Form->input('id',array('type' => 'hidden', 'value' => $request["Request"]["id"]));
        echo $this->Form->input('tags',
            array('type' => 'textarea', 
                  'div' => 'form-group',
                  'value' => $request["Request"]["tags"],
                  'label' => array('class' =>'control-label col-sm-3', 'text' => 'Tags <span id="tagsTooltip" rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Add tags as comma separated values to aide search. These are not visible to the users, they only help make the search more accurate."><span class="glyphicon glyphicon-exclamation-sign"></span>'), 
                  'class' => 'form-control',
                  'between' => '<div class="col-sm-9">',
                  'after' => '</div>',
                  'rows' => 2));
        echo $this->Form->submit(
            'Update Tags', 
            array('class' => 'btn btn-primary', 
                  'title' => 'Update Tags',
                  'div' => 'form-group', 
                  'before' => '<div class="col-sm-9 col-sm-offset-3">',
                  'after' => '</div>'));
        echo $this->Form->end();
        printf("<p><small> Requester's e-mail: %s<br/> Requester's name: %s and phone number: %s</small></p>\n", $requesterEmail, $requesterAlias, $requesterPhone);
      }
    ?>
	  <h3 class="control-widget">Response</h3>

	  <?php
	    if ($this->Session->read('Auth.User') && $request["Request"]["status_id"] != 2):
	  ?>
    <div class="rw-container">
      <div class="rw-controller-container">
        <div class="rw-controller-btns-container">
        
          <div class="rw-btn-wrap" data-target="1">
            <div class="rw-btn"><span class="glyphicon glyphicon-file"></span></div><div class="rw-btn-expand">Add Record</div>
          </div>
          
          <div class="rw-btn-wrap" data-target="2">
            <div class="rw-btn"><span class="glyphicon glyphicon-edit"></span></div><div class="rw-btn-expand">Add Note</div>
          </div>
          
          
          <div class="rw-btn-wrap" data-target="3">
            <div class="rw-btn"><span class="glyphicon glyphicon-calendar"></span></div><div class="rw-btn-expand">Extend Request</div>
          </div>          
          
          <div class="rw-btn-wrap" data-target="4">
           <div class="rw-btn"><span class="glyphicon glyphicon-folder-close"></span></div><div class="rw-btn-expand">Close Request</div>
          </div>
        </div>
      </div>
    
      <!-- here reside the data-target-for="X"  -->
      <div class="rw-actions-container"> 
        <!--Add Record -->
        <div class="target-for" data-target-for="1">
          <?php
            echo $this->Form->create('Record', array('type' => 'file', 'action' => 'add', 'controller' => 'record', 'class' => 'form-horizontal'));
            echo $this->Form->input('user_id',array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
            echo $this->Form->input('request_id',array('type' => 'hidden', 'value' => $request["Request"]["id"]));
            echo $this->Form->input('description',
                array('type' => 'textarea', 
                      'div' => 'form-group',
                      'placeholder' => 'Add a short explanation of the record',
                      'label' => array('class' =>'control-label col-sm-3', 'text' => 'Name of Record <span id="offlinedocTooltip" rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Name the record you are about to upload. We’ll post your title online and it can be viewed by the public. "><span class="glyphicon glyphicon-exclamation-sign"></span>'), 
                      'class' => 'form-control',
                      'between' => '<div class="col-sm-9">',
                      'after' => '</div>',
                      'rows' => 1));
            echo $this->Form->input('filename',
                array('type' => 'file', 
                      'div' => 'form-group',
                      'label' => array('class' =>'control-label col-sm-3', 'text' => 'Upload a File <span id="recordTooltip" rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Upload a record stored on your computer. The record will be uploaded and the public will be able to read and download it here."><span class="glyphicon glyphicon-exclamation-sign"></span></span>'), 
                      'class' => 'form-control',
                      'between' => '<div class="col-sm-9">',
                      'after' => '<p class="help-block">Maximum Upload File Size: '.$upload_mb.'MB</p></div>'));
            echo $this->Form->input('url',
                array('type' => 'text', 
                      'div' => 'form-group',
                      'label' => array('class' =>'control-label col-sm-3', 'text' => 'Or Provide a Link to the Record <span rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Provide the web address of where a requester can find the information or documents. The link will be posted online for the public to view."><span class="glyphicon glyphicon-exclamation-sign"></span></span>'), 
                      'class' => 'form-control',
                      'between' => '<div class="col-sm-9">',
                      'after' => '</div>'));
            echo $this->Form->input('access',
                array('type' => 'textarea', 
                      'div' => 'form-group',
                      'placeholder' => 'Add a short explanation of the record',
                      'label' => array('class' =>'control-label col-sm-3', 'text' => 'Or indicate how the record can be accessed offline <span id="offlinedocTooltip" rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="How can the requester get this record?  Ex. Sent via mail on a CD, Print out awaiting requester at City Clerk desk"><span class="glyphicon glyphicon-exclamation-sign"></span>'), 
                      'class' => 'form-control',
                      'placeholder' => 'How can the requester get this record?  Ex. "Sent via mail on a CD", "Print out awaiting requester at City Clerk desk"',
                      'between' => '<div class="col-sm-9">',
                      'after' => '</div>',
                      'rows' => 3));
            echo $this->Form->input('staff_mins',
                array('type' => 'text', 
                      'div' => 'form-group',
                      'label' => array('class' =>'control-label col-sm-3', 'text' => 'Minutes of Staff Time Spent <span id="offlinedocTooltip" rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Enter the minutes spent by staff on this part of the request"><span class="glyphicon glyphicon-exclamation-sign"></span>'), 
                      'class' => 'form-control',
                      'between' => '<div class="col-sm-9">',
                      'after' => '</div>'));
            echo $this->Form->submit(
                'Add Record', 
                array('class' => 'btn btn-primary', 
                      'title' => 'Add Record',
                      'div' => 'form-group', 
                      'before' => '<div class="col-sm-9 col-sm-offset-3">',
                      'after' => '</div>'));
            echo $this->Form->end();
          ?>
        </div>
        <!-- Add note -->
        <div class="target-for" data-target-for="2">
          <?php
            echo $this->Form->create('Note', array('action' => 'add', 'class' => 'form-horizontal'));
            echo $this->Form->input('user_id',array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
            echo $this->Form->input('request_id',array('type' => 'hidden', 'value' => $request["Request"]["id"]));
            echo $this->Form->input('type_id',array('type' => 'hidden', 'value' => 1));
            echo $this->Form->input('text',
                array('type' => 'textarea', 
                      'div' => 'form-group',
                      'placeholder' => 'Anything else the requester should know.',
                      'label' => array('class' =>'control-label col-sm-3', 'text' => 'Note <span rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Use this space to provide an update about the request. We\'ll post your question online to be viewed by the public. The requester will be notified via email."><small><span class="glyphicon glyphicon-exclamation-sign"></span></small></span>'), 
                      'class' => 'form-control',
                      'between' => '<div class="col-sm-9">',
                      'after' => '</div>',
                      'rows' => 3));
            echo $this->Form->input('staff_mins',
                array('type' => 'text', 
                      'div' => 'form-group',
                      'label' => array('class' =>'control-label col-sm-3', 'text' => 'Minutes of Staff Time Spent <span id="offlinedocTooltip" rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Enter the minutes spent by staff on this part of the request"><span class="glyphicon glyphicon-exclamation-sign"></span>'), 
                      'class' => 'form-control',
                      'between' => '<div class="col-sm-9">',
                      'after' => '</div>'));
            echo $this->Form->submit(
                'Add Note', 
                array('class' => 'btn btn-primary', 
                      'title' => 'Add Note',
                      'div' => 'form-group', 
                      'before' => '<div class="col-sm-9 col-sm-offset-3">',
                      'after' => '</div>'));
            echo $this->Form->end();
          ?>
        </div>
        <!-- Extend Request -->
        <div class="target-for" data-target-for="3">
          <?php
            echo $this->Form->create('Extend', array('url'=>$this->Html->url(array('controller'=>'notes', 'action'=>'extend')), 'class' => 'form-horizontal'));
            echo $this->Form->input('user_id',array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
            echo $this->Form->input('request_id',array('type' => 'hidden', 'value' => $request["Request"]["id"]));
            echo $this->Form->input('type_id',array('type' => 'hidden', 'value' => 2));
            echo $this->Form->input('extend_reasons',
                array('options' => $extend_reasons,
                      'multiple' => true,
                      'div' => 'form-group',
                      'label' => array('class' =>'control-label col-sm-3', 'text' => 'Reason <span rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Use this feature to indicate you need more time to respond to this request. Your message will be posted online for the public to view."><span class="glyphicon glyphicon-exclamation-sign"></span></span>'), 
                      'class' => 'form-control selectpicker',
                      'between' => '<div class="col-sm-9">',
                      'after' => '</div>'));
            echo "<div class=\"form-group\"><div class=\"col-sm-9 col-sm-offset-3\"><button id=\"extend-request\" class=\"btn btn-primary\">Extend Request</button></div></div>";
            ?>
            <!-- Modal -->
            <div class="modal fade" id="extendModal" tabindex="-1" role="dialog" aria-labelledby="extendModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Reason for extension</h4>
                  </div>
                  <div class="modal-body">
                  <?php
                    echo $this->Form->input('text',
                          array('type' => 'textarea', 
                                'div' => 'form-group',
                                'label' => false, 
                                'class' => 'form-control',
                                'between' => '<div class="col-sm-12">',
                                'after' => '</div>',
                                'rows' => 10));
                  ?>
                  <?php
                    echo $this->Form->input('days',
                          array('type' => 'text', 
                                'div' => 'form-group',
                                'label' => array('class' =>'control-label col-sm-3', 'text' => 'New Due Date'), 
                                'class' => 'form-control date-picker',
                                'between' => '<div class="col-sm-9">',
                                'after' => '<p class="help-block">Request will be extended to the date chosen at 5:00pm</p></div>'));
                  ?>
                  </div>
                  <div class="modal-footer">
                    <?php 
                      echo $this->Form->submit(
                                    'Extend Record', 
                                    array('class' => 'btn btn-primary', 
                                          'title' => 'Extend Record',
                                          'div' => 'form-group', 
                                          'before' => '<div class="col-sm-9 col-sm-offset-3">',
                                          'after' => '</div>'));
                    ?>
                  </div>
                </div>
              </div>
            </div>
          <?php
            echo $this->Form->end();
          ?>
        </div>
        <!-- Close Request -->
        <div class="target-for" data-target-for="4">
          <?php
            echo $this->Form->create('Close', array('url'=>$this->Html->url(array('controller'=>'notes', 'action'=>'closeRequest')), 'class' => 'form-horizontal'));
            echo $this->Form->input('user_id',array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
            echo $this->Form->input('request_id',array('type' => 'hidden', 'value' => $request["Request"]["id"]));
            echo $this->Form->input('type_id',array('type' => 'hidden', 'value' => 3));
            echo $this->Form->input('closed_reasons',
                array('options' => $closed_reasons,
                      'multiple' => true,
                      'div' => 'form-group',
                      'label' => array('class' =>'control-label col-sm-3', 'text' => 'Reason <span rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Use this feature to close out this request. Your message will be posted online for the public to view."><span class="glyphicon glyphicon-exclamation-sign"></span></span>'), 
                      'class' => 'form-control selectpicker',
                      'between' => '<div class="col-sm-9">',
                      'after' => '</div>'));
            echo "<div class=\"form-group\"><div class=\"col-sm-9 col-sm-offset-3\"><button id=\"close-request\" class=\"btn btn-primary\">Close Request</button></div></div>";
            ?>
            <!-- Modal -->
            <div class="modal fade" id="closedModal" tabindex="-1" role="dialog" aria-labelledby="closeModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Reason for closing</h4>
                  </div>
                  <div class="modal-body">
                  <?php
                    echo $this->Form->input('text',
                          array('type' => 'textarea', 
                                'div' => 'form-group',
                                'label' => false, 
                                'class' => 'form-control',
                                'between' => '<div class="col-sm-12">',
                                'after' => '</div>',
                                'rows' => 10));
                  ?>
                  </div>
                  <div class="modal-footer">
                    <?php 
                      echo $this->Form->submit(
                                    'Close Request', 
                                    array('class' => 'btn btn-primary', 
                                          'title' => 'Close Request',
                                          'div' => 'form-group', 
                                          'before' => '<div class="col-sm-9 col-sm-offset-3">',
                                          'after' => '</div>'));
                    ?>
                  </div>
                </div>
              </div>
            </div>
          <?php
            echo $this->Form->end();
          ?>
        </div>  
      </div>
    
    </div>
    <?php endif; ?>
    <?php
      if($countResponses != 0){
  	    foreach ($responses as $response){
  	      echo "<div class=\"row\">";
  	      echo "<div class=\"col-sm-1\">";
    	      if(isset($response["type_id"]) && $response["type_id"] == 1){ //regular note 
      	      echo "<span class=\"glyphicon glyphicon-edit\"></span>";
      	      $text = sprintf("<span class=\"longdescription\">%s</span>", nl2br($response["text"]));
    	      }elseif(isset($response["type_id"]) && $response["type_id"] == 2) { //extension
      	      echo "<span class=\"glyphicon glyphicon-plus\"></span>";
      	      $text = sprintf("<span class=\"longdescription\">%s</span>", nl2br($response["text"]));
    	      }elseif(isset($response["type_id"]) && $response["type_id"] == 3) { //closed
    	        echo "<span class=\"glyphicon glyphicon-folder-close\"></span>";
    	        $text = sprintf("<span class=\"longdescription\">%s</span>", nl2br($response["text"]));
    	      }elseif(isset($response["filename"]) && $response["filename"] != '') { 
    	        echo "<span class=\"glyphicon glyphicon-file\"></span>";
    	        $text = sprintf("<a href=\"/files/record/filename/%s/%s\" target=\"_blank\">%s <span class=\"glyphicon glyphicon-new-window\"></span></a>",$response["id"],$response["filename"],$response["description"]);
              if ($this->Session->read('Auth.User')){
                $text .= $this->Html->link(
                                      "<span class=\"glyphicon glyphicon-remove\"></span>",
                                      array(
                                        "controller" => "records",
                                        "action" => "remove/".$response["id"]."/".$request["Request"]["id"]."/"
                                      ),
                                      array('escape' => false, 'class' => 'btn btn-danger btn-xs add-margin-left'),
                                      "Are you sure you wish to remove this record?\nA note will be added to the request."
                                  );
              }
    	      }elseif(isset($response["url"]) && $response["url"] != '') { 
    	        echo "<span class=\"glyphicon glyphicon-link\"></span>";
    	        $text = sprintf("<a href=\"%s\" target=\"_blank\">%s <span class=\"glyphicon glyphicon-new-window\"></span></a>",$response["url"],$response["description"]);
              if ($this->Session->read('Auth.User')){
                $text .= $this->Html->link(
                                      "<span class=\"glyphicon glyphicon-remove\"></span>",
                                      array(
                                        "controller" => "records",
                                        "action" => "remove/".$response["id"]."/".$request["Request"]["id"]."/"
                                      ),
                                      array('escape' => false, 'class' => 'btn btn-danger btn-xs add-margin-left'),
                                      "Are you sure you wish to remove this record?\nA note will be added to the request."
                                  );
              }
    	      }elseif(isset($response["access"]) && $response["access"] != '') { 
              echo "<span class=\"glyphicon glyphicon-book\"></span>";
              $text = sprintf("<span class=\"longdescription\">%s</span>", nl2br($response["description"]));
    	      }
  	      echo "</div>";
  	      printf("<div class=\"col-sm-9\">%s</div>", $text);
  
          printf("<div class=\"col-sm-2 text-right\"><span data-toggle=\"tooltip\" data-placement=\"right\" title=\"%s\" rel=\"tooltip\">%s</span></div>\n",$this->Time->format('M jS, Y g:ia', $response["created"]),$this->Date->time_elapsed_string($response["created"]));

  	      echo "</div>\n<hr>";
  	    }
      }else{
        echo "<p><em>No records uploaded yet.</em></p>\n";
      }
	  ?>
	</div>
	<div class="col-sm-4">
    <?php
      if ($this->Session->read('Auth.User') && $request["Request"]["status_id"] == 4){
        $statusText =  "Overdue";
        $statusClass = "danger"; 
        $statusGlyph = "glyphicon-exclamation-sign";
      }elseif($this->Session->read('Auth.User') && $request["Request"]["status_id"] == 3){
        $statusText =  "Due Soon";
        $statusClass = "warning"; 
        $statusGlyph = "glyphicon-exclamation-sign";
      }elseif($request["Request"]["status_id"] == 2){
        $statusText =  "Closed";
        $statusClass = "closed"; 
        $statusGlyph = "glyphicon-folder-close";
      }else{
        $statusText =  "Open";
        $statusClass = "success"; 
        $statusGlyph = "glyphicon-folder-open";
      }
    ?>
	  <div class="well status status-<?php echo $statusClass; ?> text-center">
	    <span class="glyphicon <?php echo $statusGlyph; ?>"></span>&nbsp; <?php echo $statusText; ?>
	  </div>
	  <?php 
      if($this->Session->read('Auth.User.is_admin') && $request["Request"]["status_id"] == 2){
        echo $this->Html->link(
        	        "<span class=\"glyphicon glyphicon-arrow-down\"></span> Reopen Request",
        		      "reopen/".$request["Request"]["id"]."/",
                  array('escape' => false, 'class' => 'btn btn-block btn-primary'),"Are you sure you wish to reopen this request?"
        );
      }
		?>
	  <h4>
	    <?php 
	      if ($this->Session->read('Auth.User') && $request["Request"]["status_id"] != 2){
    	    echo $this->Html->tag('a',
            'Point of Contact <span class="pull-right"><span class="glyphicon glyphicon-arrow-right muted"></span><span class="glyphicon glyphicon-user"></span>',
            array('id' => 'reassign', 'escape' => false)
          ); 
        }else{
	        echo "Point of Contact";
	      }
      ?>
	  </h4>
	  <?php if ($this->Session->read('Auth.User') && $request["Request"]["status_id"] != 2): ?>
	  <div id="reassign-head" class="hide">
	    Reassign To: <button type="button" class="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	  </div>
    <div id="reassign-content" class="hide">
      <?php
        echo $this->Form->create('Owner', array('action'=>'reassignPoc'));
        echo $this->Form->input('request_id', array('type' => 'hidden', 'value' => $request["Request"]["id"]));
        echo $this->Form->input('owner_id', array('type' => 'hidden', 'value' => $poc["Owner"]["id"]));
        echo $this->Form->input('prev_id', array('type' => 'hidden', 'value' => $poc["User"]["id"]));
        echo $this->Form->input('active', array('type' => 'hidden', 'value' => '1'));
        echo $this->Form->input('is_point_person', array('type' => 'hidden', 'value' => '1'));
        echo $this->Form->input('user_id', array('label' => false, 'empty' => '(choose one)', 'class' => 'form-control'));
        echo $this->Form->input('reason', array('type' => 'text', 'label' => false, 'placeholder' => 'Say why', 'class' => 'form-control'));
        echo $this->Form->submit(
          'Reassign', 
          array('class' => 'btn btn-primary btn-sm', 'title' => 'Reassign')
        );
        echo $this->Form->end();
      ?>
    </div>
	  <?php 
	    endif;
	    if(!empty($poc)){
  	    echo $this->Html->link(
          $poc["User"]["alias"],
          array('controller'=>'Users','action' => 'view',$poc["User"]["id"]),
          array('class' => 'darklink')
        ); 
      }else {
        echo "No Point of Contact Found";
      }
    ?>
    
	  <h4>
	    <?php 
	      if ($this->Session->read('Auth.User') && $request["Request"]["status_id"] != 2){
    	    echo $this->Html->tag('a',
            'Helpers <span class="pull-right"><span class="glyphicon glyphicon-plus muted"></span><span class="glyphicon glyphicon-user"></span>',
            array('id' => 'addHelper', 'escape' => false)
          ); 
        }else{
	        echo "Helpers";
	      }
      ?>
	  </h4>
	  <?php if ($this->Session->read('Auth.User')): ?>
	  <div id="addhelper-head" class="hide">
	    Add Helper: <button type="button" class="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	  </div>
    <div id="addhelper-content" class="hide">
      <?php
        echo $this->Form->create('Owner', array('action'=>'addHelper'));
        echo $this->Form->input('request_id', array('type' => 'hidden', 'value' => $request["Request"]["id"]));
        echo $this->Form->input('active', array('type' => 'hidden', 'value' => '1'));
        echo $this->Form->input('is_point_person', array('type' => 'hidden', 'value' => '0'));
        echo $this->Form->input('user_id', array('label' => false, 'empty' => '(choose one)', 'class' => 'form-control'));
        echo $this->Form->input('reason', array('type' => 'text', 'label' => false, 'placeholder' => 'Say why', 'class' => 'form-control'));
        echo $this->Form->submit(
          'Add Helper', 
          array('class' => 'btn btn-primary btn-sm', 'title' => 'Add Helper')
        );
        echo $this->Form->end();
      ?>
    </div>
    <?php endif; ?>
	  <ul class="list-unstyled">
  	  <?php
  	    if(!empty($helpers)){
    	    if ($this->Session->read('Auth.User') && $request["Request"]["status_id"] != 2){
    	      foreach($helpers as $helper){
      	      echo "<li>". $this->Html->tag('a',
                $helper["User"]["alias"]. "<span class=\"pull-right white\">remove</span>",
                array('id' => 'removeHelper'.$helper["Owner"]["id"], 'escape' => false, 'class' => "darklink unassignPopover")
              );
              echo "<div id=\"removehelper-head" . $helper["Owner"]["id"] . "\" class=\"hide\">
                	    Remove Helper: <button type=\"button\" class=\"close\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Close</span></button>
                	  </div>
                    <div id=\"removehelper-content" . $helper["Owner"]["id"] . "\" class=\"hide\">";
              echo $this->Form->create('Owner', array('action'=>'removeHelper'));
              echo $this->Form->input('request_id', array('type' => 'hidden', 'value' => $request["Request"]["id"]));
              echo $this->Form->input('owner_id', array('type' => 'hidden', 'value' => $helper["Owner"]["id"]));
              echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $helper["Owner"]["user_id"]));
              echo $this->Form->input('active', array('type' => 'hidden', 'value' => '0'));
              echo $this->Form->input('reason_unassigned', array('type' => 'text', 'label' => false, 'placeholder' => 'Say why', 'class' => 'form-control', 'value' => 'Task completed'));
              echo $this->Form->submit(
                'Remove Helper', 
                array('class' => 'btn btn-primary btn-sm', 'title' => 'Remove Helper')
              );
              echo $this->Form->end();
              echo "</div></li>";
      	    }
    	    }else{
      	    foreach($helpers as $helper){
      	      printf("<li>%s</li>", $helper["User"]["alias"]);
      	    }
    	    }
        }else{
          echo "No Helpers for this request";
        }
      ?>
	  </ul>
	  <p>
	  <?php
	    echo $this->Html->tag('a',
              "<span class=\"glyphicon glyphicon-time\"></span> History",
              array('id' => 'historyPopover', 'escape' => false)
            );
	  ?>
	  </p>
	  <div id="history-head" class="hide">
	    Routing History <button type="button" class="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	  </div>
	  <div id="history-content" class="hide">
	    <table class="table table-condensed">
        <thead>
          <tr>
            <th>Name</th>
            <th></th>
            <th>Date</th>
            <th>Note</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($history as $record){
              $actionIcon = "plus-sign";
              $reason = $record["Owner"]["reason"];
              if($record["Owner"]["reason_unassigned"] != ''){
                $actionIcon = "minus-sign";
                $reason = $record["Owner"]["reason_unassigned"];
              }
              echo "<tr>";
              printf("<td>%s</td>",$record["User"]["alias"]);
              printf("<td><span class=\"glyphicon glyphicon-%s\"></span></td>",$actionIcon);
              printf("<td>%s</td>\n",$this->Time->format('M jS, Y',$record["Owner"]["created"]));
              printf("<td>%s</td>",$reason);
              echo "</tr>";
            } 
          ?>
        </tbody>
      </table>
	  </div>
	  <?php if ($this->Session->read('Auth.User')): ?>
	  <p class="muted"><?php printf("<strong>%d</strong> staff minutes spent on request.",$timeSpent); ?></p> 
	  <hr/>
	  <?php endif; ?>
	  <p class="text-center muted">Received: <?php printf("%s",$this->Time->format('F jS, Y \a\t g:ia',  $request["Request"]["date_received"])); ?></p> 
	  <?php 
	    if ($this->Session->read('Auth.User')){
        printf("<p class=\"text-center\">Due: <span class=\"badge\">%s</span></p>\n", $this->Time->format('F jS, Y', $request["Request"]["due_date"]));
      }else{
        echo $this->Form->create('Subscriber', array('action'=>'subscribe'));
        echo $this->Form->input('request_id', array('type' => 'hidden', 'value' => $request["Request"]["id"]));
        echo $this->Form->input('should_notify', array('type' => 'hidden', 'value' => '1'));
        echo "<div class=\"input-group col-xs-9 pull-left\">";
        echo $this->Form->input('User.email', array('type' => 'email', 'label' => false, 'placeholder' => 'yourname@email.com', 'class' => 'form-control', 'div' => false));
        echo "<span class=\"input-group-btn\">";
        echo $this->Form->submit(
          'Follow', 
          array('class' => 'btn btn-search', 'title' => 'Follow',  'div' => false)
        );
        echo "</span></div>";
        echo "<span class=\"glyphicon glyphicon-question-sign\" id=\"subscribeHelp\" data-toggle=\"popover\" data-content=\"Enter your email here and we will send you updates for this request.\"></span>";
        echo $this->Form->end();
      }
    ?>
    
	</div>
</div>