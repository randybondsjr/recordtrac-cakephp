<div class="row">
  <div class="col-sm-8">
    <h1>RecordTrac - Administration - Users</h1>
  </div>
  <div class="col-sm-4">
    <p><?php echo $this->Html->link('Add User', array('action' => 'add'),array('class' => 'btn btn-lg btn-primary')); ?> </p>
  </div>
</div>

<div class="row">
	<div class="col-sm-12">
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
	  <p><?php echo $this->Paginator->counter('Page {:page} of {:pages}, showing {:current} records out of {:count} total');?></p>
	</div>
</div>