<div class="row">
	<div class="col-sm-8">
	  <div class="well">
	    <h1>Request <span class="muted">#<?php  echo $request["Request"]["id"]; ?></span></h1>
	    <p class="lead"><?php echo $request["Request"]["text"]; ?></p>
	    <?php pr($request); ?>
	  </div>
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
	  <div class="well <?php echo $statusClass; ?>">
	    <span class="glyphicon <?php echo $statusGlyph; ?>"></span>&nbsp; <?php echo $statusText; ?>
	  </div>
	</div>
</div>