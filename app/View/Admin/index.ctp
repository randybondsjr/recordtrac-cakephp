</div><!-- end container so we can go full width --->
  <nav class="navbar navbar-default" role="navigation">
    <div class="container">
      ...
    </div>
  </nav>
  <div class="row">
  	<div class="col-sm-10 col-sm-offset-1">
  		
  		<div class="row">
  			<div class="col-sm-8">
  				<h1 id="landing_brand">RecordTrac - Administration</h1>
  			</div>
  		</div>
  
  		<div class="row">
  		  <div class="col-sm-4">
  		    <h2>Users</h2>
          <?php echo $this->Html->link(
                  "<span class=\"glyphicon glyphicon-plus\"></span> Add User",
          	      "/users/add",
                  array('escape' => false, 'class' => 'btn btn-success')
            )
          ?>
          <?php echo $this->Html->link(
                  "<span class=\"glyphicon glyphicon-search\"></span> Manage Users",
          	      "/users",
                  array('escape' => false, 'class' => 'btn btn-warning')
            )
          ?>
        </div>
  		  <div class="col-sm-4">
          <h2>Departments</h2>
  		  </div>
  		  <div class="col-sm-4">
          <h2>Requests</h2>
  		  </div>
  		</div>
  		
  
  	
  	</div>
  </div>
