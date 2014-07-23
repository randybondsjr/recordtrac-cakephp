<div class="row">
	<div class="col-sm-6">
    <h1>Track a Request</h1>
    <p>Use the tracking tool to find a specific request. If you would prefer to browse all existing requests, you can <?php echo $this->Html->link('explore here', array('action' => 'index', 'controller' => 'requests')); ?>.</p>
    <h3>Enter Your Tracking Number</h3>
    <?php
      echo $this->Form->create('Track', array('url'=>array('controller'=>'requests', 'action'=>'index')));
      echo $this->Form->input('request_id',array('type' => 'text', 'placeholder' => 'Enter Your Tracking Number', 'label' => '', 'class' => 'form-control'));
    	echo $this->Form->end('Find My Request');
    ?>
  </div>
</div>