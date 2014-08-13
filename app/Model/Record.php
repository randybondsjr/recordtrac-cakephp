<?php 
class Record extends AppModel {
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