<?php

App::uses('UserAppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'facebook', array('file' => 'facebook'. DS . 'graph-sdk' . DS . 'src' . DS . 'Facebook' . DS . 'autoload.php'));

class UsersController extends UserAppController {
	public $components = array('RequestHandler', 'Security');
	public $uses = array('Customer','TransactionManager');
	// private $key = "Qb2KFqy7Amf5VMu4Jt8Cg0Dce1OGsj9HSah6Lir3";

	public function beforeFilter() {
		parent::beforeFilter();
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
			debug($this->request->data);
			$auth = $this->Customer->find('first', array(
				'conditions' => array(
					'Customer.name' => $this->request->data['Customer']['name'])
				));
			if(!empty($auth)){
				if ($this->Auth->login()) {
					if ($this->request->data['Customer']['remember_me'] == 1) {
						unset($this->request->data['Customer']['remember_me']);
						$this->Cookie->write('user_rememberMe', $this->request->data['Customer'], true, '2 weeks');
					}
					$this->redirect(array('controller' => 'users', 'action' => 'index'));

				} else {
					$this->Session->setFlash('Please refill name and password');
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
		$loginUrl = $helper->getLoginUrl('http://myanant.com/user/fbcallback', $permissions);
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
		$accessToken = $helper->getAccessToken();

		debug($accessToken);

		if (isset($_GET['state'])) {
			debug($_GET['state']);
		}

		try {
			$accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
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

		// Logged in
		echo '<h3>Access Token</h3>';
		var_dump($accessToken->getValue());

		// The OAuth 2.0 client handler helps us manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();

		// Get the access token metadata from /debug_token
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);
		echo '<h3>Metadata</h3>';
		var_dump($tokenMetadata);

		// Validation (these will throw FacebookSDKException's when they fail)
		$tokenMetadata->validateAppId('1038913562917167'); // Replace {app-id} with your app id
		
		// If you know the user ID this access token belongs to, you can validate it here
		//$tokenMetadata->validateUserId('123');
		$tokenMetadata->validateExpiration();

		if (! $accessToken->isLongLived()) {
			// Exchanges a short-lived access token for a long-lived one
			try {
				$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
			} catch (Facebook\Exceptions\FacebookSDKException $e) {
				echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
				exit;
			}

			var_dump($accessToken->getValue());
		}

		$_SESSION['fb_access_token'] = (string) $accessToken;
		debug($_SESSION['fb_access_token'] );
		$this->log($_SESSION['fb_access_token'] );

		// User is logged in with a long-lived access token.
		// You can redirect them to a members-only page.
		//header('Location: https://example.com/members.php');
	}


	public function index() {
		$this->layout = 'home';
	}

}
