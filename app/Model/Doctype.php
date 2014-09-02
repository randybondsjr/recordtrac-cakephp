<?php 
class DocType extends AppModel {
  public $belongsTo = array(
    'Department' => array(
      'className' => 'Department',
      'foreignKey' => 'department_id'
    )
  );
  var $virtualFields = array(
    'prettyDocName' => 'CONCAT(DocType.name, " - ", Department.name)'
  ); 
  public $validate = array(
 	 'name' => array(
          'rule' => 'notEmpty'
        ),
   'department_id' => array(
          'rule' => 'notEmpty'
        )
  );
	
}
