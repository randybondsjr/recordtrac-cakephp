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
    'Creator' => array(
      'className' => 'User',
      'foreignKey' => 'creator_id'
    ),
    'Requester' => array(
      'className' => 'User',
      'foreignKey' => 'requester_id'
    ),
    'Status' => array(
      'className' => 'Status',
      'foreignKey' => 'status_id'
    )
  );
  
  public $hasMany = array (
    'Owner' => array(
          'className' => 'Owner',
          'foreignKey' => 'request_id'
    ),
    'Subscriber' => array(
          'className' => 'Subscriber',
          'foreignKey' => 'request_id'
    ),
    'Record' => array(
          'className' => 'Record',
          'foreignKey' => 'request_id'
    ),
    'Note' => array(
          'className' => 'Note',
          'foreignKey' => 'request_id'
    )
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