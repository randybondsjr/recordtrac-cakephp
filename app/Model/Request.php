<?php 
class Request extends AppModel {
  public $belongsTo = array(

        'Department' => array(
          'className' => 'Department',
          'foreignKey' => 'department_id'
        ),
        'OfflineSubmission' => array(
          'className' => 'OfflineSubmission',
          'foreignKey' => 'offline_submission_id'
        ),
        'User' => array(
          'className' => 'User',
          'foreignKey' => 'creator_id'
        ),
        'Status' => array(
          'className' => 'Status',
          'foreignKey' => 'status_id'
        )/*,
        'OsVersion' => array(
          'className' => 'OsVersion',
          'foreignKey' => 'os_installed_id'
        ),
        'OsSticker' => array(
          'className' => 'OsVersion',
          'foreignKey' => 'os_sticker_id'
        )*/
        
  );
  /*
 	public $validate = array(
 	 'pc_name_dp_tag' => array(
            'rule' => 'notEmpty'
        )
  );
	*/
}