<?php

App::uses('UserAppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'facebook', array('file' => 'facebook'. DS . 'graph-sdk' . DS . 'src' . DS . 'Facebook' . DS . 'autoload.php'));

class UsersController extends UserAppController {
	public $components = array('RequestHandler', 'Security');
	public $uses = array('Customer','ServiceRequest','SubService','ServiceProvider','Question','TransactionManager');
	
	// private $key = "Qb2KFqy7Amf5VMu4Jt8Cg0Dce1OGsj9HSah6Lir3";

	public function beforeFilter() {
		parent::beforeFilter();

		$this->Security->blackHoleCallback = 'blackhole';

		$this->Security->validatePost = false;
		$this->Security->csrfCheck = false;    

		$this->Auth->allow('login','index','add','facebookLogin', 'fbcallback', 'logout', 'activate');
	}

	public function add(){
		$this->layout = 'user';

		if ($this->request->is(array('post', 'put'))) {

			$lastcustomerID = $this->Customer->find('first',array('order' => array('id' => 'DESC'),'fields' => 'customer_id'));

			if (!empty($lastcustomerID['Customer']['customer_id'])) {
				$temp = substr($lastcustomerID['Customer']['customer_id'], 2);
				$num = $temp+1;
				$CompanyID = str_pad($num, 6, '0', STR_PAD_LEFT);
			} else {
				$num = 1;
				$CompanyID = str_pad($num, 6, '0', STR_PAD_LEFT);
			}
			$prefix = 'C-';
			$UserCode = $prefix.$CompanyID;

			$data = $this->request->data;


			try {
				$transaction = $this->TransactionManager->begin();
				
				$data['Customer']['customer_id'] = $UserCode;
				$data['Customer']['deactivate'] = 0;

				// save to the database
				$this->Customer->create();

				if(!$this->Customer->save($data, array('deep' => true))) {
					throw new Exception("ERROR OCCUR DURING REGISTER OF USER INFORMATION");
				}

				$this->login();

				$this->TransactionManager->commit($transaction);

				$this->redirect(array('controller'=>'users','action' => 'login'));

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
			}

		}
	}

	public function login() {
		$this->layout = 'user';
		if ($this->Session->check('Auth.users')) {
			$this->redirect(array('controller' => 'users', 'action' => 'index'));
		}
		if ($this->request->is('post')) {
			// debug($this->request->data);
			$auth = $this->Customer->find('first', array(
				'conditions' => array(
					'Customer.name' => $this->request->data['Customer']['name'],
					'Customer.deleted' => 0)
				));
			if(!empty($auth)){
				if ($auth['Customer']['deactivate'] != 1) {

					if ($this->Auth->login()) {
						// if ($this->request->data['Customer']['remember_me'] == 1) {
						// 	unset($this->request->data['Customer']['remember_me']);
						// 	$this->Cookie->write('user_rememberMe', $this->request->data['Customer'], true, '2 weeks');
						// }
						$this->redirect(array('controller' => 'users', 'action' => 'index'));

					} else {
						$this->Session->setFlash('Please refill name and password');
					}
				} else {
					$this->Session->setFlash('Your account is deactivated .Please try again.');
				}
			} else {
				$this->Session->setFlash('Your name is not registered');
			}
		}
		$cookies = $this->Cookie->read('user_rememberMe');
		$name = $cookies['name'] ;
		$password = $cookies['password'] ;
		$this->set(compact('name', 'password'));
	}

	public function logout() {
		$this->Session->destroy();
		$this->Auth->logout();
		$this->redirect(array('controller'=>'users','action' => 'add'));
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
		$profile_image = $userNode['picture'] ;

		$this->Session->write('profile_image', $profile_image);

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

			$loginInfo = $this->Customer->findByFbid($userNode['id']);
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
		$this->layout = 'home';
	}

	public function profile() {
		$this->layout = 'user';
		// debug($this->Auth->user());
		if (!empty($this->Auth->user('id'))) {
			$customer_id = $this->Auth->user('id') ;
			$request = $this->ServiceRequest->find('all',array(
					'conditions' => array(
						'ServiceRequest.customer_id' => $customer_id
					),
					'order' => array('ServiceRequest.modified' => 'DESC')
					));
			// debug($request);

		}
		$this->set(Compact('request','customer_id'));
	}

	public function detail($id = null) {
		$this->layout = 'user';
		if (!empty($this->Auth->user('id'))) {
			$customer_id = $this->Auth->user('id') ;
			$request = $this->ServiceRequest->findById($id);

			$sub_service = $this->SubService->find('list',array(
				'fields' => array(
					'id' ,'name')));

			$question = $this->Question->find('list',array(
				'fields' => array(
					'id' ,'Ename')));


			// $this->log($request);
		}
		$this->set(Compact('request','customer_id','sub_service','question'));
	}

}
