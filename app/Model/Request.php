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
        'OsSticker' => array(
          'className' => 'OsVersion',
          'foreignKey' => 'os_sticker_id'
        )*/
        
  );

 	public $validate = array(
    'department_id' => array(
      'rule' => 'notEmpty'
    ),
    'text' => array(
      'rule1' => array(
        'rule'    => 'notEmpty',
        'last'    => false
       ),
      'rule2' => array(
          'rule'    => array('minLength', 50),
          'message' => 'Please provide more details so that we may complete your request quickly.'
      )
    )

  );
	
}