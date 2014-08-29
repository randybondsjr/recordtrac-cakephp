<?php
  $this->Html->script('admin', array('inline' => false)); //this adds js to this page put these files in /app/webroot/js
  echo $this->Element('admin-navigation'); 
?>
<div class="row">
  <div class="col-sm-7">
    <h1>Administration <small>Users</small> <?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>', array('action' => 'add'),array('class' => 'btn btn-primary', 'escape' => false)); ?></h1>
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
	  <p class="pull-right"><?php echo $this->Paginator->counter('Page {:page} of {:pages}, showing {:current} user(s) of {:count} total');?></p>
	  <table class="table table-striped">
      <thead>
          <tr>
              <th><?php echo $this->Paginator->sort('alias', 'Name');?></th>
              <th><?php echo $this->Paginator->sort('email', 'Email');?></th>
              <th><?php echo $this->Paginator->sort('Department.name', 'Department');?></th>
              <th>Created</th>
              <th>Actions</th>
          </tr>
      </thead>
      <tbody>
        <?php 
          foreach ($users as $user){
            echo "<tr>";
            printf("<td>%s</td>",$user["User"]["alias"]);
            printf("<td>%s</td>",$user["User"]["email"]);
            printf("<td>%s</td>",$user["Department"]["name"]);
            printf("<td>%s</td>",$this->Time->format('M jS, Y',$user["User"]["created"]));
            echo "<td>";
            echo	$this->Html->link(
								'<span class="glyphicon glyphicon-pencil"></span>',
								array('action' => 'edit', $user['User']['id']),
								array('class' => 'btn btn-success btn-small', 'escape' => false, 'title' => 'Edit User')
                );
            echo " ";
            echo	$this->Html->link(
								'<span class="glyphicon glyphicon-refresh"></span>',
								array('action' => 'resetpassword', $user['User']['id']),
								array('class' => 'btn btn-warning btn-small', 'escape' => false, 'title' => 'Reset User Password')
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