<?php
  $this->Html->script('admin', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
  echo $this->Element('admin-navigation'); 
?>
		<div class="row">
			<div class="col-sm-8">
				<h3>Dashboard</h3>
			</div>
		</div>

		<div class="row">
		  <div class="col-sm-4">
		    <h2>Users</h2>
        <?php echo $this->Html->link("<li><span class=\"glyphicon glyphicon-plus\"></span> Add User</li>","/users/add",array('escape' => false));?>
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