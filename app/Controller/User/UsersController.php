<?php

App::uses('UserAppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'facebook', array('file' => 'facebook'. DS . 'graph-sdk' . DS . 'src' . DS . 'Facebook' . DS . 'autoload.php'));

class UsersController extends UserAppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'user_new';
		$this->Auth->allow('login','index','add','facebookLogin', 'fbcallback', 'logout', 'activate');
	}


	public function login() {
		$this->layout = 'user';
		if ($this->Session->check('Auth.users')) {
			$this->redirect(array('controller' => 'users', 'action' => 'index'));
		}
		if ($this->request->is('post')) {
			$auth = $this->User->find('first', array('conditions' => array(
				'email' => $this->request->data['Customer']['email'])));

				if(!empty($auth)){

					if ($auth['Customer']['withdraw'] != 1) {

						if ($auth['Customer']['activate'] != 1) {

							if ($this->Auth->login()) {

								// if user checked remember me checkbox, save to cookie
								if ($this->request->data['Customer']['remember_me'] == 1) {
									$this->request->data['Customer']['email'] = $this->request->data['Customer']['email'];
									$this->request->data['Customer']['password'] = $this->request->data['Customer']['password'];
									$this->Cookie->write('rememberMe', $this->request->data['Customer'], true, '2 weeks');
								}

								// if logged user is new go to personalInfo, old user go to mypage
								if ($this->Auth->user('new_arrival') == 0) {
									$this->redirect(array('controller'=>'mypages','action' => 'personalInfo'));
								} else {
									$this->redirect(array('controller'=>'mypages','action' => 'mypage'));
								}

							} else {
								$this->Session->setFlash('Please refill email and password', 'error');
							}
						} else {
							$this->Session->setFlash('You can\'t login because your account is not activated', 'error');
						}

					} else{
						$this->Session->setFlash('You can\'t login because you withdraw your account', 'error');
					}

				} else {
					$this->Session->setFlash('Your email address is not registered', 'error');
				}
		}

		$cookies = $this->Cookie->read('rememberMe');
		if(isset($cookies['remember_me'])){
			$remember_me = $cookies['remember_me'];
		}
		$email = $cookies['email'] ;
		$password = $cookies['password'] ;
		$this->set(compact('email', 'password','remember_me'));
	}

	public function index() {
		$this->layout = 'home';
	}

}
