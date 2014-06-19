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
    <div class="collapse navbar-collapse pull-left">
      <ul class="nav navbar-nav">
        <li><a href="/new">New request</a></li>
        <li><a href="/requests">Explore requests</a></li>
        <li><a href="/about">About</a></li>
      </ul>
      
    </div><!--/.nav-collapse -->
    <ul class="nav pull-right">
      <li class="dropdown">
        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><?php echo $agencyName; ?> Login <strong class="caret"></strong></a>
        <div class="dropdown-menu">
          <?php
            echo $this->Form->create('User', array('action'=>'search_results','class'=>'nav-login'));
            echo $this->Form->input('email',array('type' => 'email', 'label' => 'Email','placeholder'=>'you@email.com'));
            echo $this->Form->input('password',array('type' => 'password', 'label' => 'Password','placeholder'=>'password'));
            echo $this->Form->submit(__('Login',true), array('class'=>'btn'));
            echo $this->Form->end();
          ?>
        </div>
      </li>
    </ul>
  </div>
</div>