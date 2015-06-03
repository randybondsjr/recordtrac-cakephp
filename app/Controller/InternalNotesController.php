<?php
class InternalNotesController extends AppController {
  
  var $permissions = array('add','remove'); //define allowed action for logged in users (staff)
  
  public function add() {
    if (empty($this->request->data)) {
      $this->redirect(array('action' => 'index','controller'=> 'recordtrac'));
    }
    if (!empty($this->request->data)) {
      if($this->InternalNote->save($this->request->data)){
        $requestID = filter_var($this->request->data["InternalNote"]["request_id"], FILTER_VALIDATE_INT);
        
        $this->Session->setFlash('<h4>Success!</h4><p class="lead">Internal Note added to this request.</p>', 'success');
      }else{
        $this->Session->setFlash('<h4>ERROR</h4><p class="lead">Internal Note could not be added at this time</p>', 'danger');
      }
      $this->redirect(array('action' => 'view', 'controller' => 'requests', $requestID));
    }else{
      $this->redirect(array('action' => 'view', 'controller' => 'requests', $requestID));
    }
	}
	
	public function remove($id=null,$requestID){
    //clean variables
    $id = filter_var($id, FILTER_VALIDATE_INT);
    $requestID = filter_var($requestID, FILTER_VALIDATE_INT);
     
    //if you don't belong, go 
    if($id == null || $requestID == null){
      $this->redirect(array('action' => 'index','controller'=> 'recordtrac'));
    }
    
    if($this->InternalNote->delete($id)){
      $this->Session->setFlash("<h4>Success</h4><p>Your Internal Note has been removed.</p>", 'success');
      $this->redirect(array('action' => 'view', 'controller' => 'requests', $requestID));
    }else{
      $this->Session->setFlash("<h4>Failure</h4><p>Your Internal Note could not be removed due to an error</p>", 'danger');
      $this->redirect(array('action' => 'view', 'controller' => 'requests', $requestID));
    }
	}
	
}