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
  
  /*
 	public $validate = array(
 	 'pc_name_dp_tag' => array(
            'rule' => 'notEmpty'
        )
  );
	*/
}