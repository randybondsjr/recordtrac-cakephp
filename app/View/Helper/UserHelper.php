<?php
class UserHelper extends AppHelper {
  public function getUserDetails($id=null){
    App::import('Model','User'); //load model..
    $this->{'User'} = new User(); //and create an instance of it
    $user = $this->User->find('all', array(
      'conditions' => array('User.id = '. $id)
    ));
    return $user[0];
  }
}