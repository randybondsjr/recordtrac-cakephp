<div class="row">
	<div class="col-sm-8">
	  <div class="well">
	    <h1>Request <span class="muted">#<?php  echo $request["Request"]["id"]; ?></span></h1>
	    <p class="lead"><?php echo $request["Request"]["request"]; ?></p>
	    <?php pr($request); ?>
	  </div>
	</div>
	<div class="col-sm-4">
	  <div class="well">
	    <span class="glyphicon glyphicon-folder-close"></span> Closed
	  </div>
	</div>
</div>