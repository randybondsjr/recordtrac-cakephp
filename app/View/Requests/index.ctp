<div class="row">
  <div class="col-sm-8">
    <h1>Explore <span id="request-count" class="badge badge-info badge-lg"><?php echo $total; ?></span> requests and counting</h1>
  </div>
  <div class="col-sm-4">
    <p><?php echo $this->Html->link('Request New Record', array('action' => 'create'),array('class' => 'btn btn-lg btn-primary')); ?> </p>
  </div>
</div>
<div class="row">
	<div class="col-sm-4">
	  <div class="well">
      Filter Form Here
	  </div>
	</div>
	<div class="col-sm-8">
	  <table class="table table-striped">
      <thead>
          <tr>
              <th><?php echo $this->Paginator->sort('id', '#');?></th>
              <th><?php echo $this->Paginator->sort('date_received', 'Received');?></th>
              <th><?php echo $this->Paginator->sort('text', 'Request');?></th>
              <th><?php echo $this->Paginator->sort('department_id', 'Department');?></th>
              <th><?php echo $this->Paginator->sort('', 'Point of Contact');?></th>
          </tr>
      </thead>
      <tbody>
      </tbody>
	  </table>
	  <p><?php echo $this->Paginator->counter('Page {:page} of {:pages}, showing {:current} records out of {:count} total');?></p>
	</div>
</div>