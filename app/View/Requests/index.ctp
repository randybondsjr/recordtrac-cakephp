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
	<div class="col-sm-3">
	  <div class="well">
      Filter Form Here
	  </div>
	</div>
	<!-- @todo ADD STATUS TO TABLE -->
	<div class="col-sm-9">
	  <table class="table table-striped">
      <thead>
          <tr>
            <th style="width: 15px;"></th>
            <th class="col-sm-1"><?php echo $this->Paginator->sort('id', '#');?></th>
            <th class="col-sm-2"><?php echo $this->Paginator->sort('date_received', 'Received');?></th>
            <th class="col-sm-4"><?php echo $this->Paginator->sort('text', 'Request');?></th>
            <th><?php echo $this->Paginator->sort('Department.name', 'Department');?></th>
            <th><?php echo $this->Paginator->sort('', 'Point of Contact');?></th>
          </tr>
      </thead>
      <tbody>
        <?php 
          foreach ($results as $result){
            echo "<tr>\n";
            if ($this->Session->read('Auth.User') && $result["Request"]["status_id"] == 4){
              $statusClass = "warning"; 
            }elseif($this->Session->read('Auth.User') && $result["Request"]["status_id"] == 3){
              $statusClass = "danger"; 
            }elseif($result["Request"]["status_id"] == 2){
              $statusClass = "danger"; 
            }else{
              $statusClass = "success"; 
            }
            printf("<td class=\"status status-%s\"></td>\n",$statusClass);
            printf("<td>%d</td>\n",$result["Request"]["id"]);
            printf("<td>%s</td>\n",$this->Time->format('M jS, Y',$result["Request"]["date_received"]));
            printf("<td>%s</td>\n",$this->Html->link($this->Text->truncate($result["Request"]["text"],100,
                                                        array(
                                                            'ellipsis' => '...',
                                                            'exact' => false
                                                        )), array('action' => 'view', $result["Request"]["id"])));
            printf("<td>%s</td>\n",$result["Department"]["name"]);
            printf("<td>POC</td>\n");
            echo "</tr>\n";
          }
        ?>
      </tbody>
	  </table>
	  <ul class="pagination pull-right">
	    <li>
	      <?php echo $this->Paginator->prev(
            __('Previous'),
            array(),
            null,
            array('style' => 'display: none')
          );
        ?>
      </li>
      <li>
        <?php echo $this->Paginator->next(
            __('Next'),
            array(),
            null,
            array('style' => 'display: none')
          );
        ?>
      </li>
    </ul>
    

	  <p><?php echo $this->Paginator->counter('Page {:page} of {:pages}, showing {:current} records out of {:count} total');?></p>
	</div>
</div>