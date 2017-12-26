<?php

App::uses('MasterCleanerAppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'facebook', array('file' => 'facebook'. DS . 'graph-sdk' . DS . 'src' . DS . 'Facebook' . DS . 'autoload.php'));

class MasterCleanersController extends MasterCleanerAppController {

	public $components = array('RequestHandler', 'Security','OptionCommon');
	public $uses = array('Cleaner', 'TransactionManager');
	
	public function beforeFilter() {
		parent::beforeFilter();

		$this->Security->blackHoleCallback = 'blackhole';

		$this->Security->validatePost = false;
		$this->Security->csrfCheck = false;
 
		$this->Auth->allow('login','index','add','facebookLogin', 'fbcallback', 'logout', 'activate');
	}


	public function add () {
		$townships = $this->OptionCommon->townships;
		$job_type = $this->OptionCommon->job_type;
		$skill = $this->OptionCommon->skill;

		$lastCleanerID = $this->Cleaner->find('first',array('order' => array('id' => 'DESC'),'fields' => 'cleaner_id'));

		if (!empty($lastCleanerID['Cleaner']['cleaner_id'])) {
			$temp = substr($lastCleanerID['Cleaner']['cleaner_id'], 3);
			$num = $temp+1;
			$spId = str_pad($num, 6, '0', STR_PAD_LEFT);
		} else {
			$num = 1;
			$spId = str_pad($num, 6, '0', STR_PAD_LEFT);
		}
		$prefix = 'SP-';
		$UserCode = $prefix.$spId;
		
		$error = false;

		$this->set(compact('UserCode','townships','job_type','skill'));

		if ($this->request->is(array('post', 'put'))) {

			try {
				$transaction = $this->TransactionManager->begin();

				$this->request->data['Cleaner']['cleaner_id'] = $UserCode;
				$this->request->data['Cleaner']['deactivate'] = 0;
	

				// save to the database
				if (!$this->Cleaner->save($this->request->data)) {
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
			$this->redirect(array('controller' => 'master_cleaners', 'action' => 'index'));
		}
		if ($this->request->is('post')) {
			$auth = $this->Cleaner->find('first', array(
				'conditions' => array(
					'name' => $this->request->data['Cleaner']['name'],
					'deleted' => 0)
			));
			if(!empty($auth)){
				if ($auth['Cleaner']['deactivate'] != 1) {
					if ($this->Auth->login()) {
						if ($this->request->data['Cleaner']['remember_me'] == 1) {
							unset($this->request->data['Cleaner']['remember_me']);
							$this->request->data['Cleaner']['name'] = $this->request->data['Cleaner']['name'];
							$this->request->data['Cleaner']['password'] = $this->request->data['Cleaner']['password'];
							$this->Cookie->write('rememberMe', $this->request->data['Cleaner'], true, '2 weeks');
						}
						$type=AuthComponent::user('type');
						if($type==true){
							$this->redirect(array('controller' => 'master_cleaners', 'action' => 'index'));
						}else{
							$this->redirect(array('controller' => 'master_cleaners', 'action' => 'index'));
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