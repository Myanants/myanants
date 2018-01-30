<?php

App::uses('AdminAppController', 'Controller');

class AdminReportsController extends AdminAppController {
	public $components = array('OptionCommon');
	public $uses = array('Customer','ServiceRequest','Cleaner','ServiceProvider','TransactionManager');

	public function beforeFilter(){
		parent::beforeFilter();
	}

	public function index() {
		$month = $this->OptionCommon->month;
		$today = date("Y-m-d");
		if (!empty($this->params['pass'][0])) {
			$limit = $this->params['pass'][0] ;
		}else {
			$limit = substr($today, 0,7);
		}

		// Registered Customer 
		$customer = $this->Customer->find('all');
		$customer_info = $this->calc_customer($limit);
		$previous_customer = $this->calc_customer(date('Y-m', strtotime($limit." -1 month")));

		// Registered Service Provider 
		$service_provider = $this->ServiceProvider->find('all');
		$service_provider_info = $this->calc_service_provider($limit);
		$previous_service_provider = $this->calc_service_provider(date('Y-m', strtotime($limit." -1 month")));

		// Registered Cleaner
		$cleaner = $this->Cleaner->find('all');
		$cleaner_info = $this->calc_cleaner($limit);
		$previous_cleaner = $this->calc_cleaner(date('Y-m', strtotime($limit." -1 month")));

		// Service Request
		$request = $this->ServiceProvider->find('all');
		$request_info = $this->calc_request($limit);
		$previous_request = $this->calc_request(date('Y-m', strtotime($limit." -1 month")));

		$this->set(compact('month','today','limit','customer_info','customer','previous_customer','service_provider_info','service_provider','previous_service_provider','cleaner_info','cleaner','previous_cleaner','request_info','request','previous_request'));
	}

	private function calc_customer($newlimit){ //Registered Customer (detail)
		$customer = $this->Customer->find('all',array(
			'conditions' => array(
				'Customer.created LIKE' => $newlimit.'%'),
			'fields' => array(
				'Customer.created')));

		for ($day=1; $day <=31 ; $day++) {
			$num_length = strlen((string)$day);
			if ($num_length == 1) {
				$day = '0'.$day ;
				$customer_count[$day] = 0 ;
			} else {
				$day = (string)$day;
				$customer_count[$day] = 0;
			}
		}
		foreach ($customer as $occkey => $occvalue) {
			$occval = explode(' ', $occvalue['Customer']['created']);
			$occex = explode('-', $occval[0]);
			$customer_count[$occex[2]]++ ;

		}

		$ctotal_count = 0 ;
		foreach ($customer_count as $key => $value) {
			$ctotal_count += $value;
		}
		$customer_count['total'] = $ctotal_count;
		return $customer_count;
	}

	private function calc_service_provider($newlimit){ //Registered service provider (detail)
		$service_provider = $this->ServiceProvider->find('all',array(
			'conditions' => array(
				'ServiceProvider.created LIKE' => $newlimit.'%'),
			'fields' => array(
				'ServiceProvider.created')));

		for ($day=1; $day <=31 ; $day++) {
			$num_length = strlen((string)$day);
			if ($num_length == 1) {
				$day = '0'.$day ;
				$service_provider_count[$day] = 0 ;
			} else {
				$day = (string)$day;
				$service_provider_count[$day] = 0;
			}
		}

		foreach ($service_provider as $occkey => $occvalue) {
			$occval = explode(' ', $occvalue['ServiceProvider']['created']);
			$occex = explode('-', $occval[0]);
			$service_provider_count[$occex[2]]++ ;

		}
		$ctotal_count = 0 ;

		foreach ($service_provider_count as $key => $value) {
			$ctotal_count += $value;
		}
		
		$service_provider_count['total'] = $ctotal_count;
		return $service_provider_count;
	}

	private function calc_cleaner($newlimit){ //Registered service provider (detail)
		$cleaner = $this->Cleaner->find('all',array(
			'conditions' => array(
				'Cleaner.created LIKE' => $newlimit.'%'),
			'fields' => array(
				'Cleaner.created')));

		for ($day=1; $day <=31 ; $day++) {
			$num_length = strlen((string)$day);
			if ($num_length == 1) {
				$day = '0'.$day ;
				$cleaner_count[$day] = 0 ;
			} else {
				$day = (string)$day;
				$cleaner_count[$day] = 0;
			}
		}
		foreach ($cleaner as $occkey => $occvalue) {
			$occval = explode(' ', $occvalue['Cleaner']['created']);
			$occex = explode('-', $occval[0]);
			$cleaner_count[$occex[2]]++ ;

		}

		$ctotal_count = 0 ;
		foreach ($cleaner_count as $key => $value) {
			$ctotal_count += $value;
		}
		$cleaner_count['total'] = $ctotal_count;
		return $cleaner_count;
	}

	private function calc_request($newlimit){ //Service Request (detail)
		$request = $this->ServiceRequest->find('all',array(
			'conditions' => array(
				'ServiceRequest.created LIKE' => $newlimit.'%'),
			'fields' => array(
				'ServiceRequest.created')));

		for ($day=1; $day <=31 ; $day++) {
			$num_length = strlen((string)$day);
			if ($num_length == 1) {
				$day = '0'.$day ;
				$request_count[$day] = 0 ;
			} else {
				$day = (string)$day;
				$request_count[$day] = 0;
			}
		}
		foreach ($request as $occkey => $occvalue) {
			$occval = explode(' ', $occvalue['ServiceRequest']['created']);
			$occex = explode('-', $occval[0]);
			$request_count[$occex[2]]++ ;

		}

		$ctotal_count = 0 ;
		foreach ($request_count as $key => $value) {
			$ctotal_count += $value;
		}
		$request_count['total'] = $ctotal_count;
		return $request_count;
	}
}