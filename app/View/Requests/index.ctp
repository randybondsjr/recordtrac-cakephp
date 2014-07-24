<div class="row">
  <div class="col-sm-8">
    <h1>Explore <span id="request-count" class="badge badge-info badge-lg"><?php echo $total; ?></span> requests and counting</h1>
  </div>
  <div class="col-sm-4">
    <p><?php echo $this->Html->link('Request New Record', array('action' => 'create'),array('class' => 'btn btn-lg btn-primary')); ?> </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-10">
    <p class="intro-text">RecordTrac makes every public records request available to the public, including messages or documents uploaded by agency staff. Search through current and past requests. You may find what you need!</p>
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
              <th class="col-sm-1"><?php echo $this->Paginator->sort('id', '#');?></th>
              <th class="col-sm-2"><?php echo $this->Paginator->sort('date_received', 'Received');?></th>
              <th><?php echo $this->Paginator->sort('text', 'Request');?></th>
              <th><?php echo $this->Paginator->sort('Department.name', 'Department');?></th>
              <th><?php echo $this->Paginator->sort('', 'Point of Contact');?></th>
          </tr>
      </thead>
      <tbody>
        <?php 
          foreach ($results as $result){
            echo "<tr>";
            printf("<td>%d</td>",$result["Request"]["id"]);
            printf("<td>%s</td>",$this->Time->format('M jS, Y',$result["Request"]["date_received"]));
            printf("<td>%s</td>",$this->Text->truncate($result["Request"]["text"],100,
                                                        array(
                                                            'ellipsis' => '...',
                                                            'exact' => false
                                                        )));
            printf("<td>%s</td>",$result["Department"]["name"]);
            printf("<td>POC</td>");
            echo "</tr>";
          }
        ?>
      </tbody>
	  </table>
	  <p><?php echo $this->Paginator->counter('Page {:page} of {:pages}, showing {:current} records out of {:count} total');?></p>
	</div>
</div>