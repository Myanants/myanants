<?php
App::uses('AdminAppController', 'Controller');
class AdminCustomersController extends AdminAppController {
	public $components = array('RequestHandler');
	public $uses = array('Customer','Service','SubService','Question','ServiceRequest','TransactionManager');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->layout = 'admin';
	}

	public function index() {
		$limit = (!empty($this->params->query['limit'])) ? $this->params->query['limit'] : 50;
		$keyword = (!empty($this->params->query['keyword'])) ? trim($this->params->query['keyword']) : '';
		$status = !empty($this->request->query['status']) ? trim($this->request->query['status']) : '';
		$condition = array();

		$service = $this->Service->find('list',array(
			'fields' => array(
				'id','name')));

		if ($status == 1 ) { //Active customer list
			$condition = array( 'Customer.deactivate' => 0,'Customer.deleted ' => 0);
		} elseif ($status == 2 ) { //Deactivated customer list
			$condition = array( 'Customer.deactivate' => 1,'Customer.deleted ' => 0);
		} else {
			$condition = array(
				array(
					'Customer.deleted ' => 0
				),
				'OR' => array(
					array('Customer.customer_id LIKE' => '%'. $keyword .'%'),
					array('Customer.name LIKE' => '%'. $keyword .'%'),
					array('Customer.email LIKE' => '%'. $keyword .'%'),
					array('Customer.address LIKE' => '%'. $keyword .'%'),
					array('Customer.phone_number LIKE' => '%'. $keyword .'%')
				)
			) ;
		}

				
		$this->paginate = array(
			'paramType' => 'querystring',
			'limit' => $limit,
			'order' => array('id' => 'ASC'),
			'conditions' => $condition
		);
		$pag = $this->paginate('Customer');
		$this->set(compact('pag','limit','service'));
	}

	public function add() {

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
		
		// Service Names
		$services = $this->Service->find('list',array('fields' => 'name'));

		$error = false;

		$this->set(compact('UserCode','services'));

		if ($this->request->is(array('post', 'put'))) {

			try {
				$transaction = $this->TransactionManager->begin();

				$this->request->data['Customer']['customer_id'] = $UserCode;
				$this->request->data['Customer']['deactivate'] = 0;
				
				// save to the database
				$this->Customer->create();
				if (!$this->Customer->saveAssociated($this->request->data, array('deep' => true))) {
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

	public function addRequest($id) {

		$postdata = explode('&', $id) ;
		$customerid = $postdata[0] ;
		$id = $postdata[1] ;

		$serviceName = array();
		$checkString = '' ;
		$data = array();
		$answer = '' ;

		$service = $this->Service->findById($id);
		foreach ($service['SubService'] as $key => $value) {
			$serviceName[$value['id']] = $value['name'];
		}

		$question = $this->Question->find('all',array(
			'conditions' => array(
				'Question.service_id' => $id)));

		$lastrequestID = $this->ServiceRequest->find('first',array('order' => array('ServiceRequest.id' => 'DESC'),'fields' => 'service_request_id'));


		if (!empty($lastrequestID['ServiceRequest']['service_request_id'])) {
			$temp = substr($lastrequestID['ServiceRequest']['service_request_id'], 3);
			$num = $temp+1;
			$RequestID = str_pad($num, 6, '0', STR_PAD_LEFT);
		} else {
			$num = 1;
			$RequestID = str_pad($num, 6, '0', STR_PAD_LEFT);
		}
		$prefix = 'SR-';
		$RequestCode = $prefix.$RequestID;


		$this->set(compact('serviceName','id','question','service'));

		if ($this->request->is(array('post', 'put'))) {
			try {
				$transaction = $this->TransactionManager->begin();
				$sub_service_id = $this->request->data['ServiceRequest']['sub_service_id'] ;

				unset($this->request->data['ServiceRequest']['sub_service_id']);

				foreach ($this->request->data['ServiceRequest'] as $key => $value) {
					$tempString = '' ;
					if (is_array($value)) {						
						foreach ($value as $innerkey => $innervalue) {
							$tempString .= $innervalue.'$$' ;
						}
						$tempString = substr($tempString, 0, -2);
					} else {
						$tempString .=  $value;
					}
					$answer .= $key.'/'.$tempString.'###' ;

					unset($this->request->data['ServiceRequest'][$key]);
				}

				$answer = substr($answer, 0, -3);

				$this->request->data['ServiceRequest']['answer'] = $answer ;
				$this->request->data['ServiceRequest']['service_id'] = $id ;							
				$this->request->data['ServiceRequest']['sub_service_id'] = $sub_service_id ;							
				$this->request->data['ServiceRequest']['service_request_id'] = $RequestCode;
				$this->request->data['ServiceRequest']['customer_id'] = $customerid;

				// save to the database
				$this->ServiceRequest->create();

				if(!$this->ServiceRequest->save($this->request->data)) {
					throw new Exception("ERROR OCCUR DURING REGISTER OF USER INFORMATION");
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

	public function browse($id) {
		$main_service = array();
		$sub_service = array();
		if (!$id) {
			$this->Session->setFlash('Enter Customer ID。', "error");
			$this->redirect(array('action' => 'index'));
		}

		$data = $this->Customer->findByid($id);

		$question = $this->Question->find('list',array(
			'fields' => array(
				'id','Ename')));

		$service = $this->Service->find('all');

		foreach ($service as $key => $value) {
			$main_service[$value['Service']['id']] = $value['Service']['name'] ;
			foreach ($value['SubService'] as $subkey => $subvalue) {
				$sub_service[$subvalue['id']] = $subvalue['name'] ;
			}
		}
		$this->set(compact('data','question','main_service','sub_service'));
	}

	public function edit($id) {

		$customer_info = $this->Customer->findById($id);


		if (!$this->request->data) {
			$this->request->data = $customer_info;
		}

		if ($this->request->is(array('post', 'put'))) {
			// remove validate
			$validateAttrKey = array(
				'password',
				'confirm_password'
			);

			foreach ($validateAttrKey as $key => $value) {
				$this->Customer->validator()->remove($value);
			}

			try {
				$transaction = $this->TransactionManager->begin();
				$this->request->data['Customer']['id'] = $id;

				if (!empty($this->request->data['Customer']['password_update'])) {
					$this->request->data['Customer']['password'] = $this->request->data['Customer']['password_update'];
				}

// debug($this->request->data);
				$this->Customer->create();
				if (!$this->Customer->saveAssociated($this->request->data, array('deep' => true))) {
					// $this->set('error', 'true');
					throw new Exception('ERROR COULD NOT ADD Customer DATA');
				}
				$this->TransactionManager->commit($transaction);
				$this->Session->setFlash('Successfully edited customer', 'success');
				$this->redirect(array('action' => 'index'));

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
				$this->Session->setFlash('Couldn\'t edit customer', 'error');
				return;
			}


		}


		
		$this->set(compact('customer_info'));
	}	

	public function delete($id = null) {
		try {
			$transaction = $this->TransactionManager->begin();
			if (empty($id)) {
				throw new Exception('ERROR CUSTOMER ID NOT EXISTS');
			}
			$this->Customer->id = $id;
			if (!$this->Customer->exists()) {
				throw new Exception('ERROR CUSTOMER NOT EXISTS');
			}
			if (!$this->Customer->save(array('Customer' => array('deleted' => 1, 'deleted_date' => date('Y-m-d H:i:s'))), array('validate' => false))) {
				throw new Exception('ERROR COULD NOT DELETE CUSTOMER');
			}
			$this->TransactionManager->commit($transaction);
		} catch (Exception $e) {
			$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
			$this->log($e->getMessage(), LOG_ERR);
			$this->TransactionManager->rollback($transaction);
			$this->redirect(array('action' => 'index'));
		}
		$this->redirect(array('action' => 'index'));
	}

	public function approved($id = null) {
		$approved = $this->Customer->findById($id);
		$this->Customer->id = $id;
		if ($approved['Customer']['deactivate'] == true){
			$this->Customer->saveField('deactivate', '0');
		} else {
			if (!$this->Customer->save(array('Customer' => array('deactivate' => 1, 'deactivate_date' => date('Y-m-d H:i:s'))), array('validate' => false))) {
				throw new Exception('ERROR COULD NOT STOP MASTER USER');
			}
		}
		$this->redirect( array('action' => 'index'));
	}

}