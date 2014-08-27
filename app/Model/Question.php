<?php 
class Question extends AppModel {
   	public $validate = array(
      'question' => array(
        'rule' => 'notEmpty'
      ),
      'answer' => array(
        'rule' => 'notEmpty'
      )
    );
}