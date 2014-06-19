
<div class="row-fluid">
	<div class="col-sm-10 col-sm-offset-1">
		<div class="row-fluid">
			<div class="col-sm-8">
				<h1 id="landing_brand">RecordTrac</h1>
				<h3>A better way to find public records.</h3>
			</div>
			<div class="col-sm-4">
				<img src="{{ url_for('static', filename = 'images/logo.png')}}" alt="{{config['AGENCY_NAME']}} logo" width="130" height="130"/>
			</div>

		</div>
		<div class="row-fluid">
			<p class="lead">Use RecordTrac to tell the <?php echo $agencyName; ?> the type of documents you need. We display every message or record uploaded. You may find what you're looking for without having to submit a new request.  <a href="/about">Find out more…</a></p>
		</div>
		<div class="row-fluid">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="row-fluid">
					<div class="col-sm-4">
						<div class="row-fluid">
							<a href="/requests" class="btn btn-link round_link">
								<img src="{{ url_for('static', filename='images/explore.png') }}" width="75px" class="center-image" alt="explore">
								<h4 class="text-center text-title">EXPLORE</h4>
								<p class="col-sm-10 col-sm-offset-1 text-center text-body">View <span id="request-count" class="badge badge-info">
									{% set all_record_requests = "Request" | get_objs %}
									{{ all_record_requests | count }}</span> past requests and counting.
								</p>
							</a>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="row-fluid">
							<a href="/new" class="btn btn-link round_link">
								<img src="{{ url_for('static', filename='images/create.png') }}" width="100px" class="center-image" alt="create">
								<h4 class="text-center text-title">REQUEST</h4>
								<p class="span10 offset1 text-center text-body">Create a new public records request.</p>
							</a>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="row-fluid">
							<a href="/track" class="btn btn-link round_link">
								<img src="{{ url_for('static', filename='images/track.png') }}" width="150px" class="center-image" alt="track">
								<h4 class="text-center text-title">TRACK</h4>
								<p class="span10 offset1 text-center text-body">Get real-time updates as we process your request.</p>
							</a>
						</div>
					</div>
					
				</div>
			</div>
		</div>

		<div class="row-fluid">
			<div class="col-sm-4 offset4">
				<a href="#recent-requests" id="seedata" class="btn btn-large btn-block btn-primary">See how {{config['AGENCY_NAME']}}'s doing <i class="icon-arrow-down"> </i></a>
			</div>
		</div>
	</div>
</div>
</div><!-- end container div -->

<div class="row-fluid">
	<div class="well">
		<h3 id="recent-requests" class="text-center">{{config['AGENCY_NAME']}} Request Statistics</h3>
    <div class="span5 offset1">
      <div id="responses-freq-viz">
      </div>
    </div>
    <div class="span5">
      <div id="responses-time-viz">
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
					<div class="col-sm-4 offset4">
						<a href="/requests" id="startmeup" class="btn btn-large btn-block btn-primary"><i class="icon-search"> </i>Start exploring now </a>
					</div>
				</div>
			</div>
		</div>
  </div>
