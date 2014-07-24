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
}
