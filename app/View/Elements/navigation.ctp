<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><?php echo $this->Html->image('/img/recordtrac/logo.png', array('alt' => $agencyName, 'width' => '35px', 'height' => '35px'));?> RecordTrac</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="/new">New request</a></li>
        <li><a href="/requests">Explore requests</a></li>
        <li><a href="/about">About</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>