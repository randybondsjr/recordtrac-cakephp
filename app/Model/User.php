<?php 
// app/Model/User.php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
  public $validate = array(
    'password' => array(
        'required' => array(
            'rule' => array('minLength', 8),
            'message' => 'Password must be at least 8 characters'
        )
    ),
    'email' => array(
      'rule1' => array(
        'rule'    => 'email',
        'message' => 'Please enter a valid email address'/*
,
        'allowEmpty' => true    // we'll also accept an empty string
*/
       )
    ),
    'alias' => array(
        'required' => array(
            'rule' => 'notEmpty',
            'message' => 'This field is required'
        )
    ),
    'phone' => array(
        'required' => array(
            'rule' => 'notEmpty',
            'message' => 'This field is required'
        )
    )
  );
  
  public $belongsTo = array(
    'Department' => array(
      'className' => 'Department',
      'foreignKey' => 'department_id'
    ) 
  );

  public function beforeSave($options = array()) {
    if (isset($this->data[$this->alias]['password'])) {
        $passwordHasher = new SimplePasswordHasher();
        $this->data[$this->alias]['password'] = $passwordHasher->hash(
            $this->data[$this->alias]['password']
        );
    }
    return true;
  }
}