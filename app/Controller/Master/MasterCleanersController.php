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
		$this->layout = 'mastercleaner' ;
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

				// validate the upload file.
				if (!empty($this->request->data['Cleaner']['photo']['name'])) {
					$tmpName = $this->request->data['Cleaner']['photo']['tmp_name'];
					$name = $this->request->data['Cleaner']['photo']['name'];
					unset($this->request->data['Cleaner']['photo']);

					move_uploaded_file($tmpName, WWW_ROOT . '/img/' . $name);
					$this->request->data['Cleaner']['photo'] = $name;

				} else {
					unset($this->request->data['Cleaner']['photo']);
				}

				/****** Calculation age from birthday
				***** object oriented
				*********************************/
				$birth_date = $this->request->data['Cleaner']['date_of_birth'] ;
				unset($this->request->data['Cleaner']['date_of_birth']);
				$tmp = $birth_date['year'].'-'.$birth_date['month'].'-'.$birth_date['day'] ;
				$cal_age = date_diff(date_create($tmp), date_create('today'))->y ;
				
				$this->request->data['Cleaner']['date_of_birth'] = $tmp ;
				$this->request->data['Cleaner']['age'] = $cal_age ;
				$tmp = '' ;
				foreach ($job_type as $cleaning_key => $cleaning_value) {
					if (!empty($this->request->data['Cleaner'][$cleaning_value])) {
						$tmp .= $cleaning_value.'-'.$this->request->data['Cleaner'][$cleaning_value.'skill'].'@@';
					}		
				}
				$job_type = rtrim($tmp,"@@");
				$this->request->data['Cleaner']['job_type'] = $job_type;

				// save to the database
				if (!$this->Cleaner->save($this->request->data)) {
					throw new Exception('ERROR COULD NOT ADD Tag');
				}

				$this->TransactionManager->commit($transaction);
				$this->redirect(array('action' => 'login'));

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
			}
		}

	}

	public function tmpadd () {
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

	public function facebookLogin() {

		// disable auto render view
		$this->autoRender = false;

		// config of facebook
		// app_id => app id from facebook app, app_secret => app secret from facebook app, default_graph_version
		$fb = new Facebook\Facebook([
			'app_id' => '1038913562917167',
			'app_secret' => 'c0df3e628a09c24f972985ad47dee466',
			'default_graph_version' => 'v2.10',
		]);

		$helper = $fb->getRedirectLoginHelper();

		$permissions = ['email']; // Optional permissions
		$loginUrl = $helper->getLoginUrl('http://myanants.com/staging/user/fbcallback', $permissions);
		$this->redirect($loginUrl);

	}

	public function fbcallback() {
		// disable auto render view
		$this->autoRender = false;


		$fb = new Facebook\Facebook([
			'app_id' => '1038913562917167',
			'app_secret' => 'c0df3e628a09c24f972985ad47dee466',
			'default_graph_version' => 'v2.10',
		]);

		$helper = $fb->getRedirectLoginHelper();
		
		try {
			$accessToken = $helper->getAccessToken();
			
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;

		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		if (! isset($accessToken)) {
			if ($helper->getError()) {
				header('HTTP/1.0 401 Unauthorized');
				echo "Error: " . $helper->getError() . "\n";
				echo "Error Code: " . $helper->getErrorCode() . "\n";
				echo "Error Reason: " . $helper->getErrorReason() . "\n";
				echo "Error Description: " . $helper->getErrorDescription() . "\n";
				var_dump($helper->getError());
			} else {
				header('HTTP/1.0 400 Bad Request');
				echo 'Bad request';
			}
			exit;
		}

		// The OAuth 2.0 client handler helps us manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();

		// Get the access token metadata from /debug_token
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);
		
		// Get user’s Facebook ID
		$userId = $tokenMetadata->getField('customer_id');
		$response = $fb->get('/me?fields=id,name,email,picture', $accessToken);
		$userNode = $response->getGraphUser()->AsArray();

		$userInfo = $this->Customer->findByFbid($userNode['id']);

		if (empty($userInfo) && !empty($userNode)) {
			$randomID = mt_rand(0000001,9999999);//generate random number of given between range
			$customerID='C-' .$randomID;
			$data = array(
				'Customer' => array(
					'fbid' => $userNode['id'],
					'name' => $userNode['name'],
					'email' => $userNode['email'],
					'password' => mt_rand(),
					'customer_id' => $customerID
				)
			);

			$check_email_duplicate = $this->Customer->findByEmail($userNode['email']);
			if (!empty($check_email_duplicate)) {
				$this->Session->setFlash("Email is already taken.", 'error');
				$this->redirect(array('controller'=>'users','action' => 'login'));
			}

			if (!$this->Customer->save($data, array('validate' => false))) {
				throw new Exception("ERROR SAVING DATA OF FACEBOOK LOGIN");
			}

			$loginInfo = $this->Customer->findByFacebookId($userNode['id']);
			if (!empty($loginInfo)) {
				if ($this->Auth->login($loginInfo['Customer'])) {
					if ($this->Auth->user('deactivate') == 0) {
						$this->redirect(array('controller'=>'users','action' => 'index'));
					} else {
						$this->redirect(array('controller'=>'users','action' => 'login'));
					}
				}
			}
		} else {
			if ($this->Auth->login($userInfo['Customer'])) {
				if ($this->Auth->user('deactivate') == 0) {
					$this->redirect(array('controller'=>'users','action' => 'index'));
				} else {
					$this->redirect(array('controller'=>'users','action' => 'login'));
				}
			}
		}

	}

	public function index() {

	}
}