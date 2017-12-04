<?php
App::uses('AdminAppController', 'Controller');
class AdminCustomersController extends AdminAppController {
	public $components = array('RequestHandler');
	public $uses = array('Customer','Service','SubService','TransactionManager');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->layout = 'admin';
	}

	public function index() {
		$limit = (!empty($this->params->query['limit'])) ? $this->params->query['limit'] : 50;
		$keyword = (!empty($this->params->query['keyword'])) ? trim($this->params->query['keyword']) : '';
		$condition = array();

	
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
		
		$this->paginate = array(
			'paramType' => 'querystring',
			'limit' => $limit,
			'order' => array('id' => 'ASC'),
			'conditions' => $condition
		);
		$pag = $this->paginate('Customer');
		$this->set(compact('pag','limit'));
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
		$user = $this->Customer->findById($id);
		$service = $this->Service->findById($user['Service']['id']);
// debug($service);
		$this->set(compact('service'));
	

	debug($this->request->data);
	}


	public function ajaxTest() {
		$this->autoRender = FALSE;
		if ($this->request->is('ajax')) {
			if ($this->request->data) {
				$subservice = $this->SubService->findById($this->request->data['checkval']);
// $this->log($subservice);
				$question = $subservice['Question'] ;
				return json_encode($question);
			}
		}

	}

	public function browse($id) {
		if (!$id) {
			$this->Session->setFlash('Enter Customer ID。', "error");
			$this->redirect(array('action' => 'index'));
		}

		// Service Names
		$services = $this->Service->find('list',array('fields' => 'name'));

		$data = $this->Customer->findByid($id);

		$this->set(compact('data','services'));
	}

	public function edit($id) {
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