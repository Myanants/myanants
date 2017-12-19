<?php
session_start();
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class MasterAppController extends AppController {
	protected $_mergeParent = 'MasterAppController';
	public $layouts = array('desktop', 'mobile');
	public $components = array(
		'Session',
		'DebugKit.Toolbar',
		'Auth' => array(
			'loginAction' => array(
				'controller' => 'master_users',
				'action' => 'login'
			),
			'loginRedirect' => array(
				'controller' => 'master_jobs',
				'action' => 'index'
			),
			'logoutRedirect' => array(
				'controller' => 'master_users',
				'action' => 'login'
			),
			'authenticate' => array(
				'Form' => array(
					'fields' => array(
						'username' => 'name',
						'password' => 'password',
					),
					'userModel' => 'ServiceProvider',
					'passwordHasher' => 'Blowfish',
				)
			),
			'authorize' => array(
				'Controller',
			)
		),
		'Cookie'
	);
	

	function beforeFilter() {
		$this->layout = 'login_master';
        // $this->_setLanguage();
		AuthComponent::$sessionKey = 'Auth.masters';
		if(in_array($this->params['controller'],array('master_users'))){
			$this->Auth->allow('remind');
		}
		$this->Cookie->name = 'rememberMe';
		$this->Cookie->secure = false; // i.e. only sent if using secure HTTP
		$this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
		$this->Cookie->httpOnly = true;
		$this->Cookie->type('rijndael');
		$this->set('LoginedUser', $this->Auth->user());
		$this->Auth->allow('add','registration_success','employer_success','remind','index','fbcallback','facebookLogin');

    }

    public function isAuthorized($user) {
		if ($this->Auth->loggedIn() && $this->Session->check('Auth.masters')) {
			return true;
		}
		return false;
	}


    function _setLanguage() {

        if ($this->Cookie->read('lang') && !$this->Session->check('Config.language')) {
            $this->Session->write('Config.language', $this->Cookie->read('lang'));
            $this->log("if");
        } else if (isset($this->params['language']) && ($this->params['language'] !=  $this->Session->read('Config.language'))) {

            $this->Session->write('Config.language', $this->params['language']);
            $this->Cookie->write('lang', $this->params['language'], false, '20 days');
            $this->log("else");

        }
    }

}