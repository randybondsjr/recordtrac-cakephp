<?php 
class InternalNote extends AppModel {
  public $belongsTo = array(
    'Creator' => array(
      'className' => 'User',
      'foreignKey' => 'created_by'
    )
  );
  public $validate = array(
    'text' => array(
      'rule' => 'notEmpty'
    )
  );
}