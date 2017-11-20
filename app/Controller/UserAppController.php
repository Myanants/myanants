<?php
session_start();
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class UserAppController extends AppController {
	protected $_mergeParent = 'UserAppController';
	public $is_mobile = false;
	public $layouts = array('desktop', 'mobile');
	public $components = array(
		'Session',
		'DebugKit.Toolbar',
		'Auth' => array(
			'loginAction' => array(
				'controller' => 'users',
				'action' => 'login'
			),
			'loginRedirect' => array(
				'controller' => 'users',
				'action' => 'index'
			),
			'logoutRedirect' => array(
				'controller' => 'users',
				'action' => 'login'
			),
			'authenticate' => array(
				'Form' => array(
					'fields' => array(
						'username' => 'email',
						'password' => 'password',
					),
					'userModel' => 'User',
					'passwordHasher' => 'Blowfish',
				)
			),
			'authorize' => array(
				'Controller',
			)
		),
		'Cookie'
	);

	// public function beforeFilter() {
	// 	// $this->layout = 'users';
	// 	AuthComponent::$sessionKey = 'Auth.users';
	// 	if(in_array($this->params['controller'],array('users'))){
	// 		$this->Auth->allow('remind');
	// 	}
	// 	$this->Cookie->name = 'rememberMe';
	// 	$this->Cookie->secure = false; // i.e. only sent if using secure HTTP
	// 	$this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
	// 	$this->Cookie->httpOnly = true;
	// 	$this->Cookie->type('rijndael');
	// 	$this->set('LoginedUser', $this->Auth->user());
	// 	$this->Auth->allow('privacy_policy','term_condition','add','registration_success','employer_success','remind','index','contactus','job_search','employer_add','help','receipt','detail','request_password_change', 'top_com_info');

	// }
	public function isAuthorized($user) {
		if ($this->Auth->loggedIn() && $this->Session->check('Auth.users')) {
			return true;
		}
		return false;
	}

}