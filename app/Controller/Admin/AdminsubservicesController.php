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


				$arr = array();
				$i = 0 ;
				foreach ($this->request->data['Question'] as $key => $value) {

					$arr[$i] = $value;
					if (!empty($value['service_id'])) {
						$this->Session->write('service_id', $value['service_id']);
						
					} 
					$i++;
				}

				$serId = $this->Session->read('service_id');

				for ($k=0; $k <$i ; $k++) { 
					$arr[$k]['service_id'] = $serId;
				}

				$this->request->data['Question'] = $arr ;

				$this->SubService->create();
				if (!$this->SubService->saveAssociated($this->request->data)) {
					throw new Exception('ERROR COULD NOT ADD Tag');
				}

				$this->TransactionManager->commit($transaction);
				$this->redirect(array('action' => 'form'));

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
			}
		}
	}


	public function add_answer($id = null) {

		$quest = $this->Question->findById($id);

		$services = $this->Service->find('all');
		$service_name = array();
		foreach ($services as $key => $value) {
			$service_name[$key+1] = $value['Service']['name'].'	'.$value['Service']['myan_name'];
		}

		// Question type
		$type = array('text','check','radio');

		$this->set(compact('services','type','quest','service_name'));

		$eAnswer = '';
		$mAnswer = '';


		if ($this->request->is(array('post', 'put'))) {
			$tooltype = $type[$this->request->data['Question']['type']];
			unset($this->request->data['Question']['type']);

			foreach ($this->request->data['Question'] as $key => $value) {
				$eAnswer .= $value['en_answer'].'@@';
				$mAnswer .= $value['mm_answer'].'@@';
			}
			$eAnswer = rtrim($eAnswer,"@@");
			$mAnswer = rtrim($mAnswer,"@@");
			
			unset($this->request->data['Question']);
			$this->request->data['Question']['en_answer'] = $eAnswer ;
			$this->request->data['Question']['mm_answer'] = $mAnswer ;
			$this->request->data['Question']['type'] = $tooltype ;
			$this->request->data['Question']['id'] = $id ;
			try {
				$transaction = $this->TransactionManager->begin();
				$this->Question->create();
				if (!$this->Question->saveMany($this->request->data)) {
					throw new Exception('ERROR COULD NOT ADD Tag');
				}

				$this->TransactionManager->commit($transaction);
				$this->redirect(array('action' => 'form'));

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
			}
		}
	}

	public function edit_answer($id = null) {

		$sub_service = $this->SubService->findById($id);
	
		$this->set(compact('sub_service'));
	}


	public function ajaxTest() {
		$this->autoRender = FALSE;
		
		$myArray = array();
		if ($this->request->is('ajax')) {
// get values here 
			if ($this->request->data) {
				
				$quest = $this->Question->find('all',array(
					'conditions' => array(
						'Question.sub_service_id' => $this->request->data['id']),
					'recursive' => -1
				));


				unset($this->request->data['id']);


				// foreach ($this->request->data as $k => $v) {
				// 	foreach ($quest as $key => $value) {

				// 		if ($v == $value['Question']['id'] ) {
				// 			$myArray[$k][$value['Question']['id']] = $value ;

				// 		}
						
				// 	}
			
				// }

				$keyArray = array();
				foreach ($this->request->data as $key => $value) {
					$keyArray[$value] =  $value ;
				}


				try {
					$transaction = $this->TransactionManager->begin();
					
					

					$this->TransactionManager->commit($transaction);
					$this->redirect(array('action' => 'form'));

				} catch (Exception $e) {
					$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
					$this->log($e->getMessage(), LOG_ERR);
					$this->TransactionManager->rollback($transaction);
				}

			}
	}

	}

	public function form() {
		$services = $this->Service->find('all');
		$service_name = array();
		foreach ($services as $key => $value) {
			$service_name[$key+1] = $value['Service']['service_id'].'@@'.$value['Service']['name'].'@@'.$value['Service']['myan_name'];
		}


		$sub_services = $this->SubService->find('all');
		$this->set(compact('services','sub_services','service_name'));
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