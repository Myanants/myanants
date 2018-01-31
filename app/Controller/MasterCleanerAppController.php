<?php
session_start();
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class MasterCleanerAppController extends AppController {
	protected $_mergeParent = 'MasterCleanerAppController';
	public $layouts = array('desktop', 'mobile');
	public $components = array(
		'Session',
		'DebugKit.Toolbar',
		'Auth' => array(
			'loginAction' => array(
				'controller' => 'master_cleaners',
				'action' => 'login'
			),
			'loginRedirect' => array(
				'controller' => 'master_cleaners',
				'action' => 'index'
			),
			'logoutRedirect' => array(
				'controller' => 'master_cleaners',
				'action' => 'login'
			),
			'authenticate' => array(
				'Form' => array(
					'fields' => array(
						'username' => 'name',
						'password' => 'password',
					),
					'userModel' => 'Cleaner',
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
        
		AuthComponent::$sessionKey = 'Auth.mastercleaners';
		if(in_array($this->params['controller'],array('master_cleaners'))){
			$this->Auth->allow('remind');
		}
		$this->Cookie->name = 'rememberMe';
		$this->Cookie->secure = false; // i.e. only sent if using secure HTTP
		$this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
		$this->Cookie->httpOnly = true;
		$this->Cookie->type('rijndael');
		$this->set('LoginedUser', $this->Auth->user());
		$this->Auth->allow('add','remind','index','fbcallback','facebookLogin');

    }

    public function isAuthorized($user) {
		if ($this->Auth->loggedIn() && $this->Session->check('Auth.mastercleaners')) {
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