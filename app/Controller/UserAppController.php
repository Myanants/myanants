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

	public function isAuthorized($user) {
		if ($this->Auth->loggedIn() && $this->Session->check('Auth.users')) {
			return true;
		}
		return false;
	}


	function beforeFilter() {
        $this->_setLanguage();
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