<?php 
class Owner extends AppModel {
  public $belongsTo = array(
        'User' => array(
          'className' => 'User',
          'foreignKey' => 'user_id'
        ),
        'Request' => array(
          'className' => 'Request',
          'foreignKey' => 'request_id'
        )
  );
}