<?php 
  $this->Html->script('readmore.min.js', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
  $this->Html->script('view-request', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
?>
<div class="row">
	<div class="col-sm-8">
	  <div class="well">
	    <h1>Request <span class="muted">#<?php  echo $request["Request"]["id"]; ?></span></h1>
	    <p class="lead"><?php echo nl2br($request["Request"]["text"]); ?></p>
	    <?php 
	      if(isset($request["Request"]["offline_submission_id"]) && $request["Request"]["offline_submission_id"] != ''){
  	      printf("<p><small>This request was submitted on behalf of the requester by %s</small></p>", $request["Creator"]["alias"] );
	      }else{
  	      printf("<p><small>This request was submitted by %s</small></p>", $request["Requester"]["alias"] );
	      }
	    ?>
    </div>
    <?php 
	    if ($this->Session->read('Auth.User')){
	      $requesterEmail = "<span class=\"badge\">Not Provided</span>";
	      $requesterAlias = "<span class=\"badge\">Not Provided</span>";
	      $requesterPhone = "<span class=\"badge\">Not Provided</span>";
	      if($request["Requester"]["email"] != ""){ $requesterEmail = $this->Text->autoLinkEmails($request["Requester"]["email"]); }
	      if($request["Requester"]["alias"] != ""){ $requesterAlias = "<strong>".$request["Requester"]["alias"]."</strong>"; }
	      if($request["Requester"]["phone"] != ""){ $requesterPhone = "<strong>".$request["Requester"]["phone"]."</strong>"; }
        printf("<p><small> Requester's e-mail: %s<br/> Requester's name: %s and phone number: %s</small></p>\n", $requesterEmail, $requesterAlias, $requesterPhone);
      }
    ?>
	  <h3>Response</h3>
	  
	  <?php 
	    if ($this->Session->read('Auth.User')):
	  ?>
	  <div class="rw-container">

      <div class="rw-controller-container">
        <div class="rw-controller-btns-container">
    
          <div class="rw-btn-wrap" data-target="1">
            <div class="rw-btn"><i class="icon-file-text-alt"></i></div><div class="rw-btn-expand">Add Record</div>
          </div>
    
          <div class="rw-btn-wrap" data-target="2">
            <div class="rw-btn"><i class="icon-edit"></i></div><div class="rw-btn-expand">Add Note</div>
          </div>
    
    
          <div class="rw-btn-wrap" data-target="3">
            <div class="rw-btn"><i class="icon-calendar"></i></div><div class="rw-btn-expand">Extend Request</div>
          </div>
    
    
          <div class="rw-btn-wrap" data-target="4">
            <div class="rw-btn"><i class="icon-archive"></i></div><div class="rw-btn-expand">Close Request</div>
          </div>
    
        </div>
    
      </div>
    
      <!-- here reside the data-target-for="X"  -->
      <div class="rw-actions-container">
    
        <div class="target-for" data-target-for="1">
          <form name="input_doc" class="form-horizontal" id="submitRecord" method="post" action="/add_a_record" autocomplete="on" enctype="multipart/form-data" novalidate="novalidate">
            <input type="hidden" name="request_id" value="20">
            <fieldset>
              <div class="row-fluid">
                <!-- <h4>Add a record</h4> -->
                <div class="control-group">
                  <label class="control-label" for="recordSummary">Name of record</label>
                  <div class="controls">
                    <textarea class="input-xxlarge" rows="1" name="record_description" type="text" id="recordSummary" placeholder="Add a short explanation of the record" required=""></textarea>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Upload a record <span id="recordTooltip" rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Upload a record stored on your computer. The record will be sent to Scribd.com and the public will be able to read and download it here. We’ll notify the requester via email of the document."><small><i class="icon-info-sign"></i></small></span></label>
                  <div class="row-fluid">
                    <div class="controls">
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="input-append">
                          <div class="uneditable-input span3">
                            <i class="icon-file fileupload-exists"></i>
                            <span class="fileupload-preview">
                          </span></div>
                          <span class="btn btn-file">
                            <span class="fileupload-new">Select file</span>
                            <span class="fileupload-exists">Change</span>
                            <input type="file" name="record">
                          </span>
                          <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Or provide a link to a record <span rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Provide the web address of where a requester can find the information or documents. The link will be posted online for the public to view. We'll notify the requester via email."><small><i class="icon-info-sign"></i></small></span></label>
                  <div class="row-fluid">
                    <div class="controls">
                      <input type="text" name="link_url" id="inputUrl" class="input-xxlarge">
                      <!-- need to clean this up with jquery: needs to switch from being disabled when no file exists to being enabled when a file exists -->
                    </div>
                  </div>
                </div>
                <div class="control-group button-margin">
                  <label class="control-label">Or indicate how the record can be accessed offline <span id="offlinedocTooltip" rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Name the record you are about to upload. We’ll post your title online and it can be viewed by the public. "><small><i class="icon-info-sign"></i></small></span></label>
                  <div class="row-fluid">
                    <div class="controls">
                      <textarea class="input-xxlarge" id="offlineDoc_textarea" name="record_access" rows="3" placeholder="How can the requester get this record?  Ex. 'Sent via mail on a CD', 'Print out awaiting requester at City Clerk desk'"></textarea>
                    </div>
                  </div>
                </div>
                <div class="control-group">
                  <div class="controls">
                    <button type="submit" class="btn btn-primary">Add record</button>
                  </div>
                </div>
              </div>
    
            </fieldset>
          </form>
        </div>
    
    
        <!-- Add a note form -->
        <div class="target-for" data-target-for="2">
          <form name="note" class="form-horizontal" id="note" method="post" action="/add_a_note" novalidate="novalidate">
            <input type="hidden" name="request_id" value="20">
            <fieldset>
              <div class="row-fluid">
                <!-- <h4>Add a note</h4> -->
                <div class="control-group button-margin">
                  <label class="control-label">Note <span rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Use this space to provide an update about the request. We'll post your question online to be viewed by the public. The requester will be notified via email."><small><i class="icon-info-sign"></i></small></span></label>
                  <div class="controls">
                    <textarea type="text" class="input-xxlarge" id="noteTextarea" name="note_text" rows="2" placeholder="Anything else the requester should know." required=""></textarea>
                  </div>
                </div>
                <div class="control-group">
                  <div class="controls">
                    <button type="submit" class="btn btn-primary">Add note</button>
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
    
    
        <!-- Request an extension form -->
        <div class="target-for" data-target-for="3">
          
          <form name="extend_request" class="form-horizontal" id="extension" method="post" action="/add_a_extension" novalidate="novalidate">
            <input type="hidden" name="request_id" value="20">
            <input type="hidden" name="extend_reason">
            <fieldset>
              <div class="row-fluid">
                <!-- <h4>Request an extension</h4> -->
                <div class="control-group button-margin">
                  <label class="control-label">Reason <span rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Use this feature to indicate you need more time to respond to this request. Your message will be posted online for the public to view. We'll notify the requester via email."><small><i class="icon-info-sign"></i></small></span></label>
                  <div class="controls">
                    <select id="extend_reasons" name="extend_reasons" class="selectpicker" multiple="" required="" data-selected-text-format="count" style="display: none;">
                      <option value="Additional time is required to answer your public records request. We need to search for, collect, or examine a large number of records (Government Code Section 6253(c)(2)).">Large amount</option>
                      <option value="Additional time is required to answer your public records request. We need to search for and collect the requested records from a separate facility or set of facilities (Government Code Section 6253(c)(1)).">Separate facility</option>
                      <option value="Additional time is required to answer your public records request. We need to consult with another agency before we are able to deliver your record (Government Code Section 6253(c)(3)).">Another agency</option>
                      <option value="Additional time is required to answer your public records request. We need to compile data or create a computer report to extract data (Government Code Section 6253(c)(4)).">Data extraction</option>
                    </select><div class="btn-group bootstrap-select show-tick"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-id="extend_reasons"><div class="filter-option pull-left">Nothing selected</div>&nbsp;<div class="caret"></div></button><div class="dropdown-menu open"><ul class="dropdown-menu inner" role="menu"><li rel="0"><a tabindex="0" class="" style=""><span class="text">Large amount</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="1"><a tabindex="0" class="" style=""><span class="text">Separate facility</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="2"><a tabindex="0" class="" style=""><span class="text">Another agency</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="3"><a tabindex="0" class="" style=""><span class="text">Data extraction</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li></ul></div></div>
                  </div>
                </div>
                <div class="control-group">
                  <div class="controls">
                    <!-- <button id="extendRequest" class="btn btn-primary" type="submit">Request an extension</button> -->
                    <!-- Button to trigger modal -->
                    <a id="extendRequest_button" href="#extendModal" role="button" class="btn btn-primary" data-toggle="modal">Extend request...</a>
    
                    <!-- Modal -->
                    <div id="extendModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="extendModalLabel" aria-hidden="true">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="extendModalLabel">Reason for extension</h3>
                      </div>
                      <div class="modal-body">
                        <!-- NOTE: need to remove the line breaks in the CODE in textarea in order to remove the funky indentation -->
                        <textarea id="extendTextarea" class="input-block-level" rows="10"></textarea>
                      </div>
                      <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                        <button id="extendButton" type="submit" class="btn btn-primary">Extend this request</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
          
        </div>
    
    
        <!-- Close request form -->
        <div class="target-for" data-target-for="4">
          <form name="close" class="form-horizontal" id="closeRequest" method="post" action="/close">
            <input type="hidden" name="request_id" value="20">
            <input type="hidden" name="close_reason">
            <fieldset>
              <div class="row-fluid">
                <!-- <h4>Close this request </h4> -->
                <div class="control-group button-margin">
    
                  <label class="control-label">Reason <span rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Use this feature to close out this request. Your message will be posted online for the public to view. We'll notify the requester via email."><small><i class="icon-info-sign"></i></small></span></label>
                  <div class="controls">
                    <select id="close_reasons" name="close_reasons" class="selectpicker" multiple="" data-selected-text-format="count" style="display: none;">
                      <option value="We released all of the requested documents.">Fulfilled</option>
                      <option value="We cannot upload your document online. The records contains sensitive information only you can view.">Fulfilled - Private Documents Not Uploaded</option>
                      <option value="We released all of the requested documents. Personal information, such as home addresses, telephone numbers, and credit card numbers, were removed from the documents to protect the privacy or identity of another individual (Government Code Section 6254(c)).">Fulfilled - Information Redacted</option>
                      <option value="We released all of the requested documents. We removed information identifying private citizens who made complaints to government (City of San Jose v. Superior Court (1999) 74 Cal.App.4th 1008, 1020.)).">Fulfilled - Identity of Citizens Making Complaints Removed</option>
                      <option value="This is not a public records request.">Not a public records request</option>
                      <option value="The record you asked for does not exist.">Do not have this record</option>
                      <option value="We cannot upload the documents you requested. The California Public Records Act prohibits the City from releasing an individual’s employment, medical, or similar files to protect their privacy (Government Code Section 6254(c)).">Can Not Release - Personal Records</option>
                      <option value="We cannot upload the documents you requested. The California Public Records Act prohibits the City from releasing records related to an on-going litigation (Government Code Section 6254(b)).">Can Not Release - Ongoing Litigation</option>
                      <option value="We cannot upload the documents you requested. The California Public Records Act prohibits the City from releasing investigative records for crimes committed or police incident reports, rap sheets, and arrest records (Government Code Section 6254(f)).">Can Not Release - Investigative Records</option>
                      <option value="We cannot upload the documents you requested. The California Public Records Act prohibits the City from releasing communications between an attorney and his or her clients (Government Code Section 6254(k).">Can Not Release - Attorney-Client Privilege</option>
                      <option value="We closed this request after we were unable to contact the requester to determine what they needed.">Unable to contact the requester</option>
                      <option value="We don't have the records you requested. We suggest you submit a public records request to Alameda County or the state of California.">Contact Another Government Agency</option>
                      <option value="The person who submitted this request determined they no longer need the record.">Requester Not Interested</option>
                    </select><div class="btn-group bootstrap-select show-tick"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-id="close_reasons"><div class="filter-option pull-left">Nothing selected</div>&nbsp;<div class="caret"></div></button><div class="dropdown-menu open"><ul class="dropdown-menu inner" role="menu"><li rel="0"><a tabindex="0" class="" style=""><span class="text">Fulfilled</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="1"><a tabindex="0" class="" style=""><span class="text">Fulfilled - Private Documents Not Uploaded</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="2"><a tabindex="0" class="" style=""><span class="text">Fulfilled - Information Redacted</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="3"><a tabindex="0" class="" style=""><span class="text">Fulfilled - Identity of Citizens Making Complaints Removed</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="4"><a tabindex="0" class="" style=""><span class="text">Not a public records request</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="5"><a tabindex="0" class="" style=""><span class="text">Do not have this record</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="6"><a tabindex="0" class="" style=""><span class="text">Can Not Release - Personal Records</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="7"><a tabindex="0" class="" style=""><span class="text">Can Not Release - Ongoing Litigation</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="8"><a tabindex="0" class="" style=""><span class="text">Can Not Release - Investigative Records</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="9"><a tabindex="0" class="" style=""><span class="text">Can Not Release - Attorney-Client Privilege</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="10"><a tabindex="0" class="" style=""><span class="text">Unable to contact the requester</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="11"><a tabindex="0" class="" style=""><span class="text">Contact Another Government Agency</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="12"><a tabindex="0" class="" style=""><span class="text">Requester Not Interested</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li></ul></div></div>
                  </div>
                </div>
                <div class="control-group">
                  <div class="controls">
                    <!-- Button to trigger modal -->
                    <a id="closeRequest_button" href="#closeModal" role="button" class="btn btn-inverse" data-toggle="modal">Close request...</a>
    
                    <!-- Modal -->
                    <div id="closeModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="closeModalLabel" aria-hidden="true">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="closeModalLabel">Reason for closing</h3>
                      </div>
                      <div class="modal-body">
                        <!-- NOTE: need to remove the line breaks in the CODE in textarea in order to remove the funky indentation -->
                        <textarea id="closeTextarea" class="input-block-level" rows="10"></textarea>
                      </div>
                      <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                        <button id="closeButton" type="submit" class="btn btn-inverse">Close this request</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
    
      </div>
    
    </div>
    <?php endif; ?>
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
	  
	  <h4>
	    <?php 
	      if ($this->Session->read('Auth.User')){
    	    echo $this->Html->tag('a',
            'Point of Contact <span class="pull-right"><span class="glyphicon glyphicon-user"></span><span class="glyphicon glyphicon-arrow-right muted"></span>',
            array('id' => 'reassign', 'escape' => false)
          ); 
        }else{
	        echo "Point of Contact";
	      }
      ?>
	  </h4>
	  <div id="popover-head" class="hide">Reassign To: <button type="button" class="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>
      <div id="popover-content" class="hide">
        <form>
          <input type="text" class="form-control">
        </form>
      </div>
	  <?php 
	    echo $this->Html->link(
        $poc["User"]["alias"],
        array('controller'=>'Users','action' => 'view',$poc["User"]["id"])
      ); 
    ?>
	  <h4>Helpers</h4>
	  <ul class="list-unstyled">
  	  <?php
  	    foreach($helpers as $helper){
  	      printf("<li>%s</li>", $helper["User"]["alias"]);
  	    }
      ?>
	  </ul>
	  <p class="text-center muted">Received: <?php printf("<td>%s</td>\n",$this->Time->format('F jS, Y',  $request["Request"]["date_received"])); ?></p> 
	  <?php 
	    if ($this->Session->read('Auth.User')){
        printf("<p class=\"text-center\">Due: <span class=\"badge\">%s</span></p>\n", $this->Time->format('F jS, Y', $request["Request"]["due_date"]));
      }
    ?>
	</div>
</div>
<script>
  $(document).ready(function(){
    $('#reassign').popover({ 
        html : true,
        title: function() {
          return $("#popover-head").html();
        },
        content: function() {
          return $("#popover-content").html();
        },
        placement: 'left'
    });
  
  });
  $('#reassign').on('shown.bs.popover', function () {
    $('.close').on('click',function(){
      $('#reassign').popover('hide');
    });
  })
</script>