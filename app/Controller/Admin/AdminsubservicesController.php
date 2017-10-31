<?php
App::uses('AdminAppController', 'Controller');
class AdminSubServicesController extends AdminAppController {
	public $components = array('RequestHandler');
	public $uses = array('SubService','Service','Question','TransactionManager');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->layout = 'admin';
	}

	public function add() {

		// Service Names
		$services = $this->Service->find('list',array('fields' => 'name'));
		$this->set(compact('services'));


		if ($this->request->is(array('post', 'put'))) {

			try {
				$transaction = $this->TransactionManager->begin();
				
				$this->SubService->create();
				if (!$this->SubService->saveAssociated($this->request->data)) {
					throw new Exception('ERROR COULD NOT ADD Tag');
				}

				$this->TransactionManager->commit($transaction);
				$this->redirect(array('Controller' => 'AdminSubServicesController','action' => 'form'));

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
			}
		}
	}


	public function form() {

	}

	
	public function delete($id = null) {
		try {
			$transaction = $this->TransactionManager->begin();
			if (empty($id)) {
				throw new Exception('ERROR SubService ID NOT EXISTS');
			}
			$this->SubService->id = $id;
			if (!$this->SubService->exists()) {
				throw new Exception('ERROR SubService NOT EXISTS');
			}
			if (!$this->SubService->save(array('SubService' => array('deleted' => 1, 'deleted_date' => date('Y-m-d H:i:s'))), array('validate' => false))) {
				throw new Exception('ERROR COULD NOT DELETE SubService');
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