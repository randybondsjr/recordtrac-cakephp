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
	      }
	     // pr($request);
	    ?>
    </div>
    <?php 
	    if ($this->Session->read('Auth.User')){
	      $requesterEmail = "<span class=\"badge\">Not Provided</span>";
	      $requesterAlias = "<span class=\"badge\">Not Provided</span>";
	      $requesterPhone = "<span class=\"badge\">Not Provided</span>";
	      if($request["Requester"]["email"] != ""){ $requesterEmail = "<a href=\"mailto:".$request["Requester"]["email"]."\">".$request["Requester"]["email"]."</a>"; }
	      if($request["Requester"]["alias"] != ""){ $requesterAlias = "<strong>".$request["Requester"]["alias"]."</strong>"; }
	      if($request["Requester"]["phone"] != ""){ $requesterPhone = "<strong>".$request["Requester"]["phone"]."</strong>"; }
        printf("<p><small> Requester's e-mail: %s<br/> Requester's name: %s and phone number: %s</small></p>\n", $requesterEmail, $requesterAlias, $requesterPhone);
      }
    ?>
	  <h3>Response</h3>
	  <?php 
	    
	  ?>
	</div>
	<div class="col-sm-4">
    <?php
      if ($this->Session->read('Auth.User') && $request["Request"]["status_id"] == 4){
        $statusText =  "Due Soon";
        $statusClass = "warning"; 
        $statusGlyph = "glyphicon-exclamation-sign";
      }elseif($this->Session->read('Auth.User') && $request["Request"]["status_id"] == 3){
        $statusText =  "Overdue";
        $statusClass = "danger"; 
        $statusGlyph = "glyphicon-exclamation-sign";
      }elseif($request["Request"]["status_id"] == 2){
        $statusText =  "Closed";
        $statusClass = "danger"; 
        $statusGlyph = "glyphicon-folder-close";
      }else{
        $statusText =  "Open";
        $statusClass = "success"; 
        $statusGlyph = "glyphicon-folder-open";
      }
    ?>
	  <div class="well status status-<?php echo $statusClass; ?> ">
	    <span class="glyphicon <?php echo $statusGlyph; ?>"></span>&nbsp; <?php echo $statusText; ?>
	  </div>
	  <h4>Point of Contact</h4>
	  <h4>Helpers</h4>
	  <p class="text-center muted">Received: <?php printf("<td>%s</td>\n",$this->Time->format('F jS, Y',  $request["Request"]["date_received"])); ?></p> 
	  <?php 
	    if ($this->Session->read('Auth.User')){
        printf("<p class=\"text-center\">Due: <span class=\"badge\">%s</span></p>\n", $this->Time->format('F jS, Y', $request["Request"]["due_date"]));
      }
    ?>
	</div>
</div>