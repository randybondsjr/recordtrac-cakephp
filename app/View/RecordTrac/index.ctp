<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		
		<div class="row">
			<div class="col-sm-8">
				<h1 id="landing_brand">RecordTrac</h1>
				<h3>A better way to find public records.</h3>
			</div>
			<div class="col-sm-4">
			  <?php echo $this->Html->image('/img/recordtrac/logo.png', array('alt' => $agencyName));?>
			</div>
		</div>
		
		<div class="row">
		  <div class="col-sm-12">
			  <p class="lead">Use RecordTrac to tell the <?php echo $agencyName; ?> the type of documents you need. We display every message or record uploaded. You may find what you're looking for without having to submit a new request.  <a href="/about">Find out more…</a></p>
      </div>
		</div>
		<div class="row">
		  <div class="col-sm-4">
		    <?php echo $this->Html->link(
        		        $this->Html->image('/img/recordtrac/explore.png', array('alt' => 'explore', 'class' => 'center-image', 'width' => '75px'))
          		      . "<h4 class=\"text-center text-title\">EXPLORE</h4>"
          		      . "<p class=\"text-center text-body\">View <span id=\"request-count\" class=\"badge badge-info\">$totalRequests</span> past requests and counting.</p>",
          		      "/requests",
                    array('escape' => false, 'class' => 'btn btn-link round_link')
		      )
		    ?>
      </div>
		  <div class="col-sm-4">
		    <?php echo $this->Html->link(
        		        $this->Html->image('/img/recordtrac/create.png', array('alt' => 'explore', 'class' => 'center-image', 'width' => '100px'))
          		      . "<h4 class=\"text-center text-title\">REQUEST</h4>"
          		      . "<p class=\"text-center text-body\">Create a new public records request.</p>",
          		      "/requests/create",
                    array('escape' => false, 'class' => 'btn btn-link round_link')
		      )
		    ?>
		  </div>
		  <div class="col-sm-4">
		    <?php echo $this->Html->link(
        		        $this->Html->image('/img/recordtrac/track.png', array('alt' => 'explore', 'class' => 'center-image', 'width' => '150px'))
          		      . "<h4 class=\"text-center text-title\">TRACK</h4>"
          		      . "<p class=\"text-center text-body\">Get real-time updates as we process your request.</p>",
          		      "/track",
                    array('escape' => false, 'class' => 'btn btn-link round_link')
		      )
		    ?>
		  </div>
		</div>
		
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
			  <?php echo $this->Html->link(
        		        "See how $agencyName's doing <span class=\"glyphicon glyphicon-arrow-down\"></span>",
          		      "#recent-requests",
                    array('escape' => false, 'class' => 'btn btn-lg btn-block btn-primary', 'id' => 'seedata')
		      )
		    ?>
			</div>
		</div>
	
	</div>
</div>
</div><!-- End Container -->

<div class="well">
  <div class="container">
  <div class="row">
    <h3 id="recent-requests" class="text-center"><?php echo $agencyName; ?> Request Statistics</h3>
    <div class="col-sm-5 col-sm-offset-1">
      <div id="responses-freq-viz">
        Total # of Requests (top 5 departments)
      </div>
    </div>
    <div class="col-sm-5">
      <div id="responses-time-viz">
        Average # Days to Respond (quickest 5 departments)
      </div>
    </div>
    <div class="row-fluid">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="row-fluid">
					<div id="disclaimer" class="col-sm-offset-2 col-sm-8 text-center">
						<p>NOTE: The resources within each department may be different.  Requests also vary in complexity, and may not be evenly spread among departments.</p>
					</div>
				</div>
				<div class="row-fluid">
					<div class="col-sm-4 col-sm-offset-4">
					  <?php echo $this->Html->link(
        		        "<span class=\"glyphicon glyphicon-search\"></span> Start exploring now",
          		      "/requests",
                    array('escape' => false, 'class' => 'btn btn-lg btn-block btn-primary', 'id' => 'startmeup')
    		      )
    		    ?>
					</div>
				</div>
			</div>
		</div>
  </div>
</div>