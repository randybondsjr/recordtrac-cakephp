<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<div class="row">
			<div id="about_image" class="col-sm-10">
				<?php echo $this->Html->image('/img/recordtrac/logo.png', array('alt' => $agencyName));?>
				<span class="glyphicon glyphicon-plus glyphicon-lg glyphicon-muted glyphicon-margin-lg"></span>
				<?php echo $this->Html->image('/img/recordtrac/CfA_logo.png', array('alt' => 'Code for America','width'=>'20%'));?>
			</div>
		</div>
		<div class="row">
			<div class="bottombreathe">
			<h2 id="about">About RecordTrac</h2>
			<ul style="list-style: none;">
			<li><a href="#what">What is RecordTrac?</a> </li>
			<li><a href="#why">Why was RecordTrac made?</a> </li>
			<li><a href="#all request table">Where can I find all the requests submitted through RecordTrac?</a></li>
			<li><a href="#show">Why can you show everyone my request?</a> </li>
			<li><a href="#documents">Why aren't all documents uploaded on RecordTrac?</a> </li> 
			<li><a href="#redeploy">What should I do if I want my agency to use RecordTrac?</a> </li>
			
			</ul>

			<br>

				<h4 id="what">What is RecordTrac?</h4>
				<p>RecordTrac is a quick, simple way for you to submit a public records request to <?php echo $agencyName; ?></p>  
				<p><strong>Every message or record uploaded on this site is completely public.</strong> This makes easier to understand what happens to every request.</p>
				<br>

				<h4 id="why">Why was RecordTrac made?</h4>

				<p>The 2013 Code for America fellows created RecordTrac with the City of Oakland. As public records requests became larger and more complex, city employees found coordinating a response to be difficult. The old software system no longer met their needs and many requests remained untracked.</p>
				<p>Members of the public complained they didn’t understand what happened after they submitted their requests and it took too long to get the records they needed.</p>
				<p>By making everything completely transparent, you can know your request is fulfilled.</p>
				<br>


				<h4 id="all request table">Where can I find all the requests submitted through RecordTrac?</h4>
				<p>RecordTrac displays all current and past records requests at <?php echo $this->Html->link($appUrl . '/requests', '/requests'); ?>. A description of what RecordTrac displays on this page can be found below:</p> 

				<div class="row">
					<div class="col-sm-1 col-sm-offset-1">
						<p class="table-legend">'#'</p>
					</div>
					<div class="col-sm-8">
						<p class="table-legend-explanation">Each request is assigned a unique number. You can easily track your request with this number by visiting <?php echo $this->Html->link($appUrl . '/track', '/track'); ?>.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-1 col-sm-offset-1">
						<p class="table-legend">'Received'</p>
					</div>
					<div class="col-sm-8">
						<p class="table-legend-explanation">This column displays the date when the request was entered in RecordTrac.</p>
						<p class="table-legend-explanation">You are allowed to submit a public records request any way, including by mail, fax, and over the phone. If a request wasn't originally submitted through RecordTrac, it may take agency employees a day or two to enter it into the system.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-1 col-sm-offset-1">
						<p class="table-legend">'Point of Contact'</p>
					</div>
					<div class="col-sm-8">
						<p class="table-legend-explanation">The 'Point of Contact' is a <?php echo $agencyName; ?> employee responsible for providing you with the information you need about your public records request.</p>
						<p class="table-legend-explanation">Sometimes <?php echo $agencyName; ?> employees from several departments will be needed to respond to one public records request. They will be added as Helpers.  In that case, if you have any questions about your request send a message to the Point of Contact through RecordTrac.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-1 col-sm-offset-1">
						<p class="table-legend">'Department'</p>
					</div>
					<div class="col-sm-8">
						<p class="table-legend-explanation">The agency department where the point of contact works. Multiple departments may be involved in one request, but the Point of Contact's department will only be displayed.</p>
					</div>
				</div>
				<br>


				<h4 id="show">Why can you show everyone my request?</h4>
				<p>The California Public Records Act and Oakland’s Sunshine Ordinance gives everyone access to documents, photos, emails, texts, audio recordings, and data about the <?php echo $agencyName; ?> and its business. This is why we can display your request and any responses from <?php echo $agencyName; ?> staff. To make you feel comfortable, we don't allow the public to view your name or contact information through this website. </p>

				<p>According to the Public Records Act, the <?php echo $agencyName; ?> must:</p>
				<ul>
				<li>Help you locate the record</li>
				<li>Allow you to view the records immediately during business hours</li>
				<li>Respond within 10 days</li> 
				</ul>
				<p>The <?php echo $agencyName; ?> may ask for a 14-day extension if they have to sort through a large number of documents, retrieve the document from a facility outside of City Hall, consult with another agency, or write a computer program to get data.</p> 
				<p>
					For more information on the Public Records Act, check out these resources:
				</p>
				<ul>
					<li><a href="http://apps.leg.wa.gov/rcw/default.aspx?cite=42.56">Washington State Public Records Act</a></li>
					<li><a href="<?php echo $agencyUrl; ?>"><?php echo $agencyName; ?> Homepage</a></li>
				</ul>
				<br>
				<h4 id="documents">Why aren't all documents uploaded on RecordTrac?</h4>
				<p>The <?php echo $agencyName; ?> will not publicly release records or information that violates your right to privacy. This also includes records that will compromise your safety or the completion of a law enforcement investigation.</p>

				<p>For example, many police reports contain sensitive information that can only be sent to the individuals directly involved in the crime or incident, and will not be released through RecordTrac. You will, however, better understand the number and types of records requests processed, even when the record itself cannot be uploaded due to sensitive data.</p>   
				<br>
				<h4 id="redeploy">What should I do if I want my agency to use RecordTrac?</h4>
				<p>RecordTrac is an open-source software project that can be redeployed by any municipality. If you want to reuse RecordTrac, we'd love to hear from you. Visit our sign-up page by <a href="http://www.recordtrac.com">clicking here</a>.</p>

			</div>
		</div>
	</div>
</div>
