<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
  public $components = array(
    'Session',
    'Auth' => array(
      'authenticate' => array(
        'Form' => array(
          'fields' => array('username' => 'email')
        )
      ),
      'loginAction' => array(
        'controller' => 'recordtrac',
        'action' => 'index'
      ),
      'loginRedirect' => array(
        'controller' => 'recordtrac',
        'action' => 'index'
      ),
      'logoutRedirect' => array(
        'controller' => 'recordtrac',
        'action' => 'index'
      ),
      'authorize' => array('Controller')
    )
  );
  public function beforeFilter(){
    $this->layout = 'bootstrap';
    $this->set('agencyName', Configure::read('Agency.name'));
    $this->set('agencyTag', Configure::read('Agency.tagline'));
    $this->set('agencyUrl', Configure::read('Agency.url'));
    $this->set('appUrl', Configure::read('App.url'));
    $this->Auth->allow();
  }
  public function isAuthorized($user) {
    // Admin can access every action
    if (isset($user['is_admin']) && $user['is_admin'] == 1) {
      return true;
    }

    // Default deny
    return false;
  }
  private $agencyName = ""; 
  public function getAgencyName() { 
    $this->agencyName = Configure::read('Agency.name');;
    return $this->agencyName; 
  }
  private $responseDays = ""; 
  public function getResponseDays() { 
    $this->responseDays = Configure::read('Agency.responseDays');;
    return $this->responseDays; 
  }
  private $fromEmail = ""; 
  public function getfromEmail() { 
    $this->fromEmail = Configure::read('Agency.fromEmail');;
    return $this->fromEmail; 
  }
  
}
