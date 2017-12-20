<?php

App::uses('CakeEmail', 'Network/Email');
App::uses('UserAppController', 'Controller');

class ServiceProvidersController extends UserAppController {
	public $components = array('RequestHandler','OptionCommon');
	public $uses = array('ServiceProvider','Service','TransactionManager');
	
	public function index() {
		$this->layout = 'usertopic';
	}


}