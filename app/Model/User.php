<?php 
// app/Model/User.php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
    public $validate = array(
        /*'email' => array(
          'rule1' => array(
            'rule'    => 'email',
            'message' => 'This should be an email address',
            'last'    => false
           )
        ),*/
        'password' => array(
            'required' => array(
                'rule' => array('minLength', 8),
                'message' => 'Password must be at least 8 characters'
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