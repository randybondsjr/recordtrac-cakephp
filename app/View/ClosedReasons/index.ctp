<?php
  $this->Html->script('admin', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
  echo $this->Element('admin-navigation'); 
?>

<div class="row">
  <div class="col-sm-7">
    <h1>Administration <small>Closed Reasons</small> <?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>', array('action' => 'add'),array('class' => 'btn btn-primary', 'escape' => false)); ?></h1>
  </div>
  <div class="col-sm-5">
    <ul class="pagination pull-right">
      <li><?php echo $this->Paginator->first('< First '); ?> </li>
      <?php 	echo $this->Paginator->numbers(array(
        'before' => '',
        'separator' => '',
        'currentClass' => 'active',
        'currentTag' => 'a',
        'tag' => 'li',
        'after' => ''
        )); 
      ?> 
      <li><?php echo $this->Paginator->last(' Last >'); ?></li>
    </ul>
  </div>
</div>

<div class="row">
	<div class="col-sm-12">
	  <p class="pull-right"><?php echo $this->Paginator->counter('Page {:page} of {:pages}, showing {:current} reasons of {:count} total');?></p>
	  <table class="table table-striped">
      <thead>
          <tr>
              <th><?php echo $this->Paginator->sort('name', 'Name');?></th>
              <th><?php echo $this->Paginator->sort('reason', 'Reason');?></th>
              <th>Actions</th>
          </tr>
      </thead>
      <tbody>
        <?php 
          foreach ($reasons as $reason){
            echo "<tr>";
            printf("<td>%s</td>",$reason["Closedreason"]["name"]);
            printf("<td>%s</td>",$reason["Closedreason"]["reason"]);
            echo "<td>";
            echo	$this->Html->link(
								'<span class="glyphicon glyphicon-pencil"></span>',
								array('action' => 'edit', $reason['Closedreason']['id']),
								array('class' => 'btn btn-success btn-small', 'escape' => false, 'title' => 'Edit User')
                );
            echo "</td>";
            echo "</tr>";
          }
        ?>
      </tbody>
	  </table>
	  <ul class="pagination pull-right">
      <li><?php echo $this->Paginator->first('< First '); ?> </li>
      <?php 	echo $this->Paginator->numbers(array(
        'before' => '',
        'separator' => '',
        'currentClass' => 'active',
        'currentTag' => 'a',
        'tag' => 'li',
        'after' => ''
        )); 
      ?> 
      <li><?php echo $this->Paginator->last(' Last >'); ?></li>
    </ul>
	  
	</div>
</div>

	</div><!--END FROM ADMIN NAV -->
</div>
<div class="clearfix"></div>