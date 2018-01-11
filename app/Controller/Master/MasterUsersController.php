<?php

App::uses('MasterAppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'facebook', array('file' => 'facebook'. DS . 'graph-sdk' . DS . 'src' . DS . 'Facebook' . DS . 'autoload.php'));

class MasterUsersController extends MasterAppController {

	public $components = array('RequestHandler', 'Security','OptionCommon');
	public $uses = array('ServiceProvider', 'TransactionManager');
	
	public function beforeFilter() {
		parent::beforeFilter();
		
		$this->Security->blackHoleCallback = 'blackhole';

		$this->Security->validatePost = false;
		$this->Security->csrfCheck = false;
 
		$this->Auth->allow('login','index','add','facebookLogin', 'fbcallback', 'logout', 'activate');
	}


	public function add () {
		$experience = $this->OptionCommon->experience;
		$townships = $this->OptionCommon->townships;

		$lastServiceProviderID = $this->ServiceProvider->find('first',array('order' => array('id' => 'DESC'),'fields' => 'service_provider_id'));

		if (!empty($lastServiceProviderID['ServiceProvider']['service_provider_id'])) {
			$temp = substr($lastServiceProviderID['ServiceProvider']['service_provider_id'], 3);
			$num = $temp+1;
			$spId = str_pad($num, 6, '0', STR_PAD_LEFT);
		} else {
			$num = 1;
			$spId = str_pad($num, 6, '0', STR_PAD_LEFT);
		}
		$prefix = 'SP-';
		$UserCode = $prefix.$spId;
		
		$error = false;

		$this->set(compact('UserCode','experience','townships'));

		if ($this->request->is(array('post', 'put'))) {

			try {
				$transaction = $this->TransactionManager->begin();

				$this->request->data['ServiceProvider']['service_provider_id'] = $UserCode;
				$this->request->data['ServiceProvider']['deactivate'] = 0;
				
				// validate the upload file.
				if (!empty($this->request->data['ServiceProvider']['image']['name'])) {
					$tmpName = $this->request->data['ServiceProvider']['image']['tmp_name'];
					$name = $this->request->data['ServiceProvider']['image']['name'];
					unset($this->request->data['ServiceProvider']['image']);

					move_uploaded_file($tmpName, WWW_ROOT . '/img/' . $name);
					$this->request->data['ServiceProvider']['image'] = $name;

				} else {
					unset($this->request->data['ServiceProvider']['image']);
				}


				// TOWNSHIPS 
				$this->request->data['ServiceProvider']['experience'] = $experience[$this->request->data['ServiceProvider']['experience']] ;
				$this->request->data['ServiceProvider']['townships'] = $townships[$this->request->data['ServiceProvider']['townships']] ;

// debug($this->request->data);
				// save to the database
				if (!$this->ServiceProvider->save($this->request->data)) {
					throw new Exception('ERROR COULD NOT ADD Tag');
				} else {
					$this->log("saved in DB -----------------");
					if ($this->Auth->login()) {
						$this->log("logined ---------------------");
						// $this->redirect(array('controller' => 'users', 'action' => 'index'));
					}
				}

				$this->TransactionManager->commit($transaction);
				$this->redirect(array('controller' => 'master_users', 'action' => 'index'));

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
			}
		}

	}


	public function login() {
		$this->Cookie->name = 'rememberMe'; //Remember name and password
		$this->Cookie->secure = false; // i.e. only sent if using secure HTTP
		$this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
		$this->Cookie->httpOnly = true;
		$this->Cookie->type('rijndael');

		if ($this->Session->check('Auth.masters')) {
			$this->redirect(array('controller' => 'master_users', 'action' => 'index'));
		}
		if ($this->request->is('post')) {
			$auth = $this->ServiceProvider->find('first', array(
				'conditions' => array(
					'name' => $this->request->data['ServiceProvider']['name'],
					'deleted' => 0)
			));

			if(!empty($auth)){
				if ($auth['ServiceProvider']['deactivate'] != 1) {
					if ($this->Auth->login()) {
						if ($this->request->data['ServiceProvider']['remember_me'] == 1) {
							unset($this->request->data['ServiceProvider']['remember_me']);
							$this->request->data['ServiceProvider']['name'] = $this->request->data['ServiceProvider']['name'];
							$this->request->data['ServiceProvider']['password'] = $this->request->data['ServiceProvider']['password'];
							$this->Cookie->write('rememberMe', $this->request->data['ServiceProvider'], true, '2 weeks');
						}
						$type=AuthComponent::user('type');
						if($type==true){
							$this->redirect(array('controller' => 'master_users', 'action' => 'index'));
						}else{
							$this->redirect(array('controller' => 'master_users', 'action' => 'index'));
						}

					} else {
						$this->Session->setFlash('Your name or password is invalid.Please refill name and password.');
					}
				} else {
					$this->Session->setFlash('Your account is deactivated .you can not log in!');
				}
			} else {
				$this->Session->setFlash('Your name is not registered');
			}
		}
		$cookies = $this->Cookie->read('rememberMe');
		$name = $cookies['name'] ;
		$password = $cookies['password'] ;
		$this->set(compact('name', 'password'));
	}


	public function logout() {
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());
	}

	public function index() {

	}

	// Main function for password reset
	public function remind($token = null, $user = null) {
		$this->layout = 'mastercleaner' ;
		// Check token
		if (empty($token)) {
			$admin = false;
			if ($user) {
				$this->request->data = $user;
				$admin = true;
			}
			$this->_sendPasswordReset($admin);
		} else {
			$this->_resetPassword($token);
		}
	}

	// Send Password Reset
	protected function _sendPasswordReset($admin = null, $options = array()) {
		$defaults = array(
			'from' => 'passwordreset@myanants.net',
			'subject' => "[MyanAnts] Password reset procedure of login account",
			'template' => 'masteruser_password_reset_request',
			'emailFormat' => CakeEmail::MESSAGE_TEXT,
			'layout' => 'default'
		);
		$options = array_merge($defaults, $options);
		if (!empty($this->request->data)) {
			$user = $this->{$this->modelClass}->passwordReset($this->request->data);
			if (!empty($user)) {
				$Email = $this->_getMailInstance();
				$Email->to($user["ServiceProvider"]['email']);
				$Email->from($options['from']);
				$Email->emailFormat($options['emailFormat']);
				$Email->subject($options['subject']);
				$Email->template($options['template'], $options['layout']);
				$Email->viewVars(array(
					'model' => $this->modelClass,
					'user' => $this->ServiceProvider->data,
					'token' => $this->ServiceProvider->data["ServiceProvider"]['password_token']));
				$Email->send();
				if ($admin) {
					$this->Session->setFlash(sprintf(
							__d('ServiceProviders', '%s has been sent an email with instruction to reset their password.'),
							$user["ServiceProvider"]['email']));
					$this->redirect(array('action' => 'login'));
				} else {
					$this->Session->setFlash("MyanAnts sent an email to change your password.
						Please change your password within 1 hour according to the message.");
					$this->redirect(array('action' => 'login'));
				}
			} else {
				$this->Session->setFlash("This email address is not currently in use");
				$this->redirect($this->referer('/'));
			}
		}
		$this->render('request_password_change');
	}

	// Reset Password
	protected function _resetPassword($token) {
		$user = $this->{$this->modelClass}->checkPasswordToken($token);
		if (empty($user)) {
			$this->Session->setFlash("The URL is incorrect or expired.");
			$this->redirect(array('action' => 'remind'));
		}

		if (!empty($this->request->data) && $this->{$this->modelClass}->resetPassword(Set::merge($user, $this->request->data))) {
			$this->Session->setFlash("Password is changed");
			$this->redirect($this->Auth->loginAction);
		}
		$this->set('token', $token);
	}

	// Mail Instance
	protected function _getMailInstance() {
		$emailConfig = Configure::read('ServiceProviders.emailConfig');
		if ($emailConfig) {
			return new CakeEmail($emailConfig);
		} else {
			return new CakeEmail('default');
		}
	}

}