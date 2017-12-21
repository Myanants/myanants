<?php


App::uses('MasterAppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'facebook', array('file' => 'facebook'. DS . 'graph-sdk' . DS . 'src' . DS . 'Facebook' . DS . 'autoload.php'));

class MasterUsersController extends MasterAppController {

	public $components = array('RequestHandler', 'Security');
	public $uses = array('ServiceProvider', 'TransactionManager');
	
	public function beforeFilter() {
		parent::beforeFilter();

		$this->Security->blackHoleCallback = 'blackhole';

		$this->Security->validatePost = false;
		$this->Security->csrfCheck = false;
 
		$this->Auth->allow('login','index','add','facebookLogin', 'fbcallback', 'logout', 'activate');
	}


	public function add () {

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

		$this->set(compact('UserCode'));

		if ($this->request->is(array('post', 'put'))) {

			try {
				$transaction = $this->TransactionManager->begin();

				$this->request->data['ServiceProvider']['service_provider_id'] = $UserCode;
				$this->request->data['ServiceProvider']['deactivate'] = 0;
	

				// save to the database
				if (!$this->ServiceProvider->save($this->request->data)) {
					throw new Exception('ERROR COULD NOT ADD Tag');
				}

				$this->TransactionManager->commit($transaction);
				$this->redirect(array('action' => 'index'));

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
						$this->Session->setFlash('Please refill name and password');
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
}