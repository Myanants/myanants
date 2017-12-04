<?php

App::uses('UserAppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class ServiceRequestsController extends UserAppController {
	public $components = array('RequestHandler');
	public $uses = array('Customer','Service','Question','SubService','ServiceRequest','TransactionManager');

	public function add($id = null){
		$this->layout = 'user';
		$service = $this->Service->findById($id);

		$question = $this->Question->find('all');

		$lastrequestID = $this->ServiceRequest->find('first',array('order' => array('id' => 'DESC'),'fields' => 'service_request_id'));

		if (!empty($lastrequestID['Customer']['service_request_id'])) {
			$temp = substr($lastrequestID['Customer']['service_request_id'], 2);
			$num = $temp+1;
			$RequestID = str_pad($num, 6, '0', STR_PAD_LEFT);
		} else {
			$num = 1;
			$RequestID = str_pad($num, 6, '0', STR_PAD_LEFT);
		}
		$prefix = 'SR-';
		$UserCode = $prefix.$RequestID;


		$data = array();
		$data['ServiceRequest']['service_request_id'] = $UserCode;

		$this->set(compact('service','id','question'));

	}

	public function ajaxTest() {
		$this->autoRender = FALSE;
		
		$myArray = array();
		if ($this->request->is('ajax')) {
			// get values here 
			if ($this->request->data) {
				$checkId = $this->request->data['checked'] ;
				$subService = $this->SubService->findById($checkId);
// $this->log($subService);
				$question = $subService['Question'] ;
				return json_encode($question);
			}
		}

	}


}