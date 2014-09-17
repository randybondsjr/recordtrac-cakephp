</div><!-- end container so we can go full width --->
<div class="admin-head hidden-xs">
  <div class="col-sm-12">
    <h2><span class="glyphicon glyphicon-stats"></span> Administration</h2>
  </div>
</div>
<div class="full-height">
  <div class="col-sm-2 navbar-admin-bg">
    <div id="navbar" class="navbar  navbar-admin">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#adminnav">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <h2 class="visible-xs"><span class="glyphicon glyphicon-stats"></span> Administration</h2>
      
      </div>
      <div class="clearfix"></div>
      <div class="collapse navbar-collapse" id="adminnav">
        <ul class="nav nav-stacked" id="menu-bar">
          <li><?php echo $this->Html->link("<span class=\"glyphicon glyphicon-dashboard\"></span> Dashboard","/admin",array('escape' => false));?></li>
          <li class="panel dropdown">
            <a data-toggle="collapse" data-parent="#menu-bar" href="#requests">
                <span class="glyphicon glyphicon-folder-open"></span>&nbsp; Requests <span class="caret"></span>
              </a>
            <ul id="requests" class="panel-collapse collapse">
              <li>Document Types</li>
              <li><?php echo $this->Html->link("<span class=\"glyphicon glyphicon-plus\"></span> Add Document Type","/doctypes/add",array('escape' => false));?></li>
              <li><?php echo $this->Html->link("<span class=\"glyphicon glyphicon-search\"></span> Manage Document Types","/doctypes",array('escape' => false));?></li>
              <li class="divider"></li>
              <li>Extend Reasons</li>
              <li><?php echo $this->Html->link("<span class=\"glyphicon glyphicon-plus\"></span> Add Extend Reason","/extendreasons/add",array('escape' => false));?></li>
              <li><?php echo $this->Html->link("<span class=\"glyphicon glyphicon-search\"></span> Manage Extend Reasons","/extendreasons",array('escape' => false));?></li>
              <li class="divider"></li>
              <li>Closed Reasons</li>
              <li><?php echo $this->Html->link("<span class=\"glyphicon glyphicon-plus\"></span> Add Closed Reason","/closedreasons/add",array('escape' => false));?></li>
              <li><?php echo $this->Html->link("<span class=\"glyphicon glyphicon-search\"></span> Manage Closed Reasons","/closedreasons",array('escape' => false));?></li>
            </ul>
          </li>  
          <li class="panel dropdown">
            <a data-toggle="collapse" data-parent="#menu-bar" href="#departments">
                <span class="glyphicon glyphicon-list"></span> Departments <span class="caret"></span>
              </a>
            <ul id="departments" class="panel-collapse collapse">
              <li><?php echo $this->Html->link("<span class=\"glyphicon glyphicon-plus\"></span> Add Department","/departments/add",array('escape' => false));?></li>
              <li><?php echo $this->Html->link("<span class=\"glyphicon glyphicon-search\"></span> Manage Departments","/departments",array('escape' => false));?></li>
            </ul>
          </li>
          <li class="panel dropdown">
            <a data-toggle="collapse" data-parent="#menu-bar" href="#users">
                <span class="glyphicon glyphicon-user"></span> Users <span class="caret"></span>
              </a>
            <ul id="users" class="panel-collapse collapse">
              <li><?php echo $this->Html->link("<span class=\"glyphicon glyphicon-plus\"></span> Add User","/users/add",array('escape' => false));?></li>
              <li><?php echo $this->Html->link("<span class=\"glyphicon glyphicon-user\"></span> Manage Staff Users","/users/staff",array('escape' => false));?></li>
              <li><?php echo $this->Html->link("<span class=\"glyphicon glyphicon-search\"></span> Manage All Users","/users",array('escape' => false));?></li>
            </ul>
          </li>
          <li class="panel dropdown">
            <a data-toggle="collapse" data-parent="#menu-bar" href="#reports">
                <span class="glyphicon glyphicon-tasks"></span> Reports <span class="caret"></span>
              </a>
            <ul id="reports" class="panel-collapse collapse">
              <li><?php echo $this->Html->link("<span class=\"glyphicon glyphicon-file\"></span> Requests by Month","/admin/requestsbymonth",array('escape' => false));?></li>
              <li><?php echo $this->Html->link("<span class=\"glyphicon glyphicon-file\"></span> Requests by Year","/admin/requestsbyyear",array('escape' => false));?></li>
              <li><?php echo $this->Html->link("<span class=\"glyphicon glyphicon-file\"></span> Report 3","/users",array('escape' => false));?></li>
            </ul>
          </li> 
        </ul>
      </div>
    </div>
  </div>
  <div class="col-sm-10">
    