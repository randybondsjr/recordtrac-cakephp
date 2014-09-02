<?php 
class Department extends AppModel {
  public $belongsTo = array(

        'Contact' => array(
          'className' => 'User',
          'foreignKey' => 'contact_id'
        ),
        'Backup' => array (
          'className' => 'User',
          'foreignKey' => 'backup_id'
        )   
  );
  
  
 	public $validate = array(
 	 'name' => array(
          'rule' => 'notEmpty'
        ),
   'contact_id' => array(
          'rule' => 'notEmpty'
        ),
   'backup_id' => array(
          'rule' => 'notEmpty'
        )
  );
	
}