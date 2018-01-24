<?php
App::uses('AdminAppController', 'Controller');
class AdminServiceRequestsController extends AdminAppController {
	public $components = array('RequestHandler');
	public $uses = array('Customer','ServiceRequest','TransactionManager');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->layout = 'admin';
	}

	public function index() {
		$limit = (!empty($this->params->query['limit'])) ? $this->params->query['limit'] : 50;
		$keyword = (!empty($this->params->query['keyword'])) ? trim($this->params->query['keyword']) : '';
		$condition = array();

	
		// $condition = array(
		// 	array(
		// 		'ServiceRequest.deleted ' => 0
		// 	),
		// 	'OR' => array(
		// 		array('ServiceRequest.id LIKE' => '%'. $keyword .'%'),
		// 		array('ServiceRequest.name LIKE' => '%'. $keyword .'%'),
		// 		array('ServiceRequest.myan_name LIKE' => '%'. $keyword .'%'),
		// 	)
		// ) ;
		
		$this->paginate = array(
			'paramType' => 'querystring',
			'limit' => $limit,
			'order' => array('id' => 'DESC'),
			// 'conditions' => $condition
		);
		$pag = $this->paginate('ServiceRequest');
		$this->set(compact('pag','limit'));
	}


	public function browse($id= null) {

		$data = $this->ServiceRequest->findById($id);
		// debug($data);
		$this->set(Compact('data'));
	}


	public function delete($id = null) {
		try {
			$transaction = $this->TransactionManager->begin();
			if (empty($id)) {
				throw new Exception('ERROR Service ID NOT EXISTS');
			}
			$this->Service->id = $id;
			if (!$this->Service->exists()) {
				throw new Exception('ERROR Service NOT EXISTS');
			}
			if (!$this->Service->save(array('Service' => array('deleted' => 1, 'deleted_date' => date('Y-m-d H:i:s'))), array('validate' => false))) {
				throw new Exception('ERROR COULD NOT DELETE Service');
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

	public function ajaxStatus() {
		$this->autoRender = false;
		if ($this->request->is('ajax')) {		
$this->log('###################################');
$this->log($this->request->data);
			if ($this->request->data[0] == 'opt1') {
				$status = 1;
			} elseif ($this->request->data[0] == 'opt2') {
				$status = 2;
			} elseif ($this->request->data[0] == 'opt3') {
				$status = 3;
			} elseif ($this->request->data[0] == 'opt4') {
				$status = 0;
			}

			$this->ServiceRequest->id = $this->request->data['id'];
			if (!$this->ServiceRequest->saveField('status', $status)) {
				throw new Exception('ERROR COULD NOT DELETE Service');
			}
		}
	}
}