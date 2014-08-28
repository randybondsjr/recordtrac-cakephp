<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainnav">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php
        echo $this->Html->link(
          $this->Html->image("/img/recordtrac/logo.png", array('alt' => $agencyName, 'width' => '35px', 'height' => '35px')) . ' ' . __('RecordTrac'),
          Router::fullbaseUrl(),
          array('escape' => false, 'class' => 'navbar-brand')
        );
      ?>
      </div>
    <div class="collapse navbar-collapse pull-left" id="mainnav">
      <ul class="nav navbar-nav">
        <li><?php echo $this->Html->link('New Request', '/requests/create'); ?></li>
        <li><?php echo $this->Html->link('Explore Requests', '/requests'); ?></li>
        <li><?php echo $this->Html->link('About', '/about'); ?></li>
      </ul>
      
    </div><!--/.nav-collapse -->
    <ul class="nav pull-right">
      <li class="dropdown">
        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
        <?php 
          if ($this->Session->read('Auth.User')){
            $user = $this->Session->read('Auth.User');
            echo "Logged in as: ". $user["alias"];
          }else{
            echo $agencyName . " Login";
          }
        ?>
        <strong class="caret"></strong></a>
        <div class="dropdown-menu">
          <?php
            if ($this->Session->read('Auth.User')){
              echo $this->Html->link(
                                      'Logout <span class="glyphicon glyphicon-chevron-right"></span>',
                                      array(
                                          'controller' => 'Users',
                                          'action' => 'logout'
                                      ),
                                      array('class' => 'btn btn-danger pull-right logout', 'escape' => false)
                                    );
            }else{
              echo $this->Form->create('User', array('controller' => 'Users', 'action'=>'login','class'=>'nav-login'));
              echo $this->Form->input('email',array('type' => 'email', 'label' => 'Email','placeholder'=>'you@email.com'));
              echo $this->Form->input('password',array('type' => 'password', 'label' => 'Password','placeholder'=>'password'));
              echo $this->Form->submit(__('Login',true), array('class'=>'btn btn-primary'));
              echo $this->Form->end();
            }
          ?>
        </div>
      </li>
    </ul>
  </div>
</div>