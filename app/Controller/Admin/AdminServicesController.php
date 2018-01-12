<?php
App::uses('AdminAppController', 'Controller');
class AdminServicesController extends AdminAppController {
	public $components = array('RequestHandler');
	public $uses = array('Service','Question','TransactionManager');

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
				'Service.deleted ' => 0
			),
			'OR' => array(
				array('Service.id LIKE' => '%'. $keyword .'%'),
				array('Service.name LIKE' => '%'. $keyword .'%'),
				array('Service.myan_name LIKE' => '%'. $keyword .'%'),
			)
		) ;
		
		$this->paginate = array(
			'paramType' => 'querystring',
			'limit' => $limit,
			'order' => array('id' => 'DESC'),
			'conditions' => $condition
		);
		$pag = $this->paginate('Service');
		$this->set(compact('pag','limit'));
	}

	public function add() {

		$lastServiceID = $this->Service->find('first',array('order' => array('id' => 'DESC'),'fields' => 'service_id'));

		if (!empty($lastServiceID['Service']['service_id'])) {
			$temp = substr($lastServiceID['Service']['service_id'], 2);
			$num = $temp+1;
			$serviceID = str_pad($num, 6, '0', STR_PAD_LEFT);
		} else {
			$num = 1;
			$serviceID = str_pad($num, 6, '0', STR_PAD_LEFT);
		}
		$prefix = 'S-';
		$UserCode = $prefix.$serviceID;
		$this->set(compact('UserCode'));


		if ($this->request->is(array('post', 'put'))) {

			try {
				$transaction = $this->TransactionManager->begin();

				$this->request->data['Service']['service_id'] = $UserCode;
				// save to the database
				$this->Service->create();
				if (!$this->Service->saveAssociated($this->request->data, array('deep' => true))) {
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

	public function edit($id = null) {
		$service_info = $this->Service->findByid($id);

		if (!$this->request->data) {
			$this->request->data = $service_info ;
		}

		$this->set(compact('service_info'));

		if ($this->request->is(array('post', 'put'))) {
			try {
				$transaction = $this->TransactionManager->begin();
				$this->request->data['Service']['id'] = $id;
				if (!$this->Service->saveAll($this->request->data)) {
					// $this->set('error', 'true');
					throw new Exception('ERROR COULD NOT ADD Service DATA');
				}
				$this->TransactionManager->commit($transaction);
				$this->Session->setFlash('Successfully edited Service', 'success');
				$this->redirect(array('action' => 'index'));

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
				$this->Session->setFlash('Couldn\'t edit Service', 'error');
				return;
			}
		}

	}

	public function browse($id) {
		if (!$id) {
			$this->Session->setFlash('Enter Service ID。', "error");
			$this->redirect(array('action' => 'index'));
		}


		$data = $this->Service->findByid($id);

		$this->set(compact('data','services'));
	}

	public function addQuestion($id=null) {
		$data = array() ;
		$service_name = $this->Service->findByid($id,array(
			'fields' => 'name'));
		$service_id = $id ;

		$this->set(compact('service_name','service_id'));

		if ($this->request->is(array('post', 'put'))) {

			try {
				$transaction = $this->TransactionManager->begin();

				$i = 0 ;
				foreach ($this->request->data['Question'] as $key => $value) {
					$data['Question'][$i]['Ename'] = $value['Ename'] ;
					$data['Question'][$i]['Mname'] = $value['Mname'] ;
					$data['Question'][$i]['service_id'] = $service_id ;
					$i++ ;
				}

				debug($data);
				// $this->Question->create();
				// if (!$this->Question->saveMany($data)) {
				// 	throw new Exception('ERROR COULD NOT ADD Tag');
				// }

				if (!$this->Question->saveAll($data)) {
					throw new Exception('ERROR COULD NOT ADD Tag');
				}

				$this->TransactionManager->commit($transaction);
				// $this->redirect(array('action' => 'index'));

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
			}
		}

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
}