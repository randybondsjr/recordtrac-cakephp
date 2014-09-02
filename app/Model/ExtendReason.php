<?php
class ExtendReason extends AppModel {
  public $validate = array(
 	 'name' => array(
          'rule' => 'notEmpty'
        ),
   'reason' => array(
          'rule' => 'notEmpty'
        )
  );
}