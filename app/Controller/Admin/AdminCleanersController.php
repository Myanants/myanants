<?php
App::uses('AdminAppController', 'Controller');
class AdminCleanersController extends AdminAppController {
	public $components = array('RequestHandler','OptionCommon');
	public $uses = array('Cleaner','TransactionManager');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->layout = 'admin';
	}

	public function index() {
		$limit = (!empty($this->params->query['limit'])) ? $this->params->query['limit'] : 50;
		$keyword = (!empty($this->params->query['keyword'])) ? trim($this->params->query['keyword']) : '';
		$status = !empty($this->request->query['status']) ? trim($this->request->query['status']) : '';
		$township = !empty($this->request->query['township']) ? trim($this->request->query['township']) : '';
		$condition = array();

		$townships = $this->OptionCommon->townships;

		if ($township) {
			
			if ($status == 1 ) { //Active Cleaner list
				$condition = array('Cleaner.township' => $township, 'Cleaner.deactivate' => 0,'Cleaner.deleted ' => 0);
			}	elseif ($status == 2 ) { //Deactivated Cleaner list
				$condition = array( 'Cleaner.township' => $township,'Cleaner.deactivate' => 1,'Cleaner.deleted ' => 0);
			} else {
				$condition = array('Cleaner.township' => $township,'Cleaner.deleted ' => 0);
			}

		} else {
			if ($status == 1 ) { //Active Cleaner list
				$condition = array( 'Cleaner.deactivate' => 0,'Cleaner.deleted ' => 0);
			} elseif ($status == 2 ) { //Deactivated Cleaner list
				$condition = array( 'Cleaner.deactivate' => 1,'Cleaner.deleted ' => 0);
			} else {
				$condition = array(
					array(
						'Cleaner.deleted' => 0
					),
					'OR' => array(
						array('Cleaner.cleaner_id LIKE' => '%'. $keyword .'%'),
						array('Cleaner.name LIKE' => '%'. $keyword .'%'),
						// array('Cleaner.company_name LIKE' => '%'. $keyword .'%'),
						array('Cleaner.phone LIKE' => '%'. $keyword .'%')
					)
				);
			}
		}
			
		$this->paginate = array(
			'paramType' => 'querystring',
			'limit' => $limit,
			'order' => array('id' => 'ASC'),
			'conditions' => $condition
		);
		$pag = $this->paginate('Cleaner');
		$this->set(compact('pag','limit','townships'));
	}

	public function add() {	
		$townships = $this->OptionCommon->townships;

		$lastCleanerID = $this->Cleaner->find('first',array('order' => array('id' => 'DESC'),'fields' => 'cleaner_id'));

		if (!empty($lastCleanerID['Cleaner']['cleaner_id'])) {
			$temp = substr($lastCleanerID['Cleaner']['cleaner_id'], 3);
			$num = $temp+1;
			$CleanerID = str_pad($num, 6, '0', STR_PAD_LEFT);
		} else {
			$num = 1;
			$CleanerID = str_pad($num, 6, '0', STR_PAD_LEFT);
		}
		$prefix = 'FC-';
		$UserCode = $prefix.$CleanerID;
		
		$error = false;

		$this->set(compact('UserCode','townships'));

		if ($this->request->is(array('post', 'put'))) {

			try {
				$transaction = $this->TransactionManager->begin();

				$this->request->data['Cleaner']['cleaner_id'] = $UserCode;

				// validate the upload file.
				if (!empty($this->request->data['Cleaner']['photo']['name'])) {
					$tmpName = $this->request->data['Cleaner']['photo']['tmp_name'];
					$name = $this->request->data['Cleaner']['photo']['name'];
					unset($this->request->data['Cleaner']['photo']);

					move_uploaded_file($tmpName, WWW_ROOT . '/img/' . $name);
					$this->request->data['Cleaner']['photo'] = $name;

				} else {
					unset($this->request->data['Cleaner']['photo']);
				}


				/****** Calculation age from birthday
				***** object oriented
				*********************************/
				$birth_date = $this->request->data['Cleaner']['date_of_birth'] ;
				unset($this->request->data['Cleaner']['date_of_birth']);
				$tmp = $birth_date['year'].'-'.$birth_date['month'].'-'.$birth_date['day'] ;
				$cal_age = date_diff(date_create($tmp), date_create('today'))->y ;
				
				$this->request->data['Cleaner']['date_of_birth'] = $tmp ;
				$this->request->data['Cleaner']['age'] = $cal_age ;				
// debug($this->request->data);
				// save to the database
				if (!$this->Cleaner->save($this->request->data)) {
					throw new Exception('ERROR COULD NOT ADD Tag');
				}

				$this->TransactionManager->commit($transaction);
				$this->redirect(array('action' => 'index'));

			} catch (Exception $e) {
				$this->set(compact('image'));
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
			}
		}
	}

	public function browse($id) {
		$townships = $this->OptionCommon->townships;

		if (!$id) {
			$this->Session->setFlash('Enter Cleaner ID。', "error");
			$this->redirect(array('action' => 'index'));
		}
		$data = $this->Cleaner->findByid($id);

		$this->set(compact('data','townships'));
	}

	public function edit($id) {
		$townships = $this->OptionCommon->townships;

		if (!$this->request->data) {
			$this->request->data = $this->Cleaner->findById($id);
		}

		$this->set(compact('townships'));

		if ($this->request->is(array('post', 'put'))) {

			try {
				$transaction = $this->TransactionManager->begin();

				// validate the upload file.
				if (!empty($this->request->data['Cleaner']['photo']['name'])) {
					$tmpName = $this->request->data['Cleaner']['photo']['tmp_name'];
					$name = $this->request->data['Cleaner']['photo']['name'];
					unset($this->request->data['Cleaner']['photo']);

					move_uploaded_file($tmpName, WWW_ROOT . '/img/' . $name);
					$this->request->data['Cleaner']['photo'] = $name;

				} else {
					unset($this->request->data['Cleaner']['photo']);
				}


				/****** Calculation age from birthday
				***** object oriented
				*********************************/
				$birth_date = $this->request->data['Cleaner']['date_of_birth'] ;
				unset($this->request->data['Cleaner']['date_of_birth']);
				$tmp = $birth_date['year'].'-'.$birth_date['month'].'-'.$birth_date['day'] ;
				$cal_age = date_diff(date_create($tmp), date_create('today'))->y ;
				
				$this->request->data['Cleaner']['date_of_birth'] = $tmp ;
				$this->request->data['Cleaner']['age'] = $cal_age ;

				if ($this->request->data['Cleaner']['monday_check'] == 1) {
					$this->request->data['Cleaner']['monday_from'] = '';
					$this->request->data['Cleaner']['monday_to'] = '';
				}
				if ($this->request->data['Cleaner']['tuesday_check'] == 1) {
					$this->request->data['Cleaner']['tuesday_from'] = '';
					$this->request->data['Cleaner']['tuesday_to'] = '';
				}
				if ($this->request->data['Cleaner']['wednesday_check'] == 1) {
					$this->request->data['Cleaner']['wednesday_from'] = '';
					$this->request->data['Cleaner']['wednesday_to'] = '';
				}
				if ($this->request->data['Cleaner']['thursday_check'] == 1) {
					$this->request->data['Cleaner']['thursday_from'] = '';
					$this->request->data['Cleaner']['thursday_to'] = '';
				}
				if ($this->request->data['Cleaner']['friday_check'] == 1) {
					$this->request->data['Cleaner']['friday_from'] = '';
					$this->request->data['Cleaner']['friday_to'] = '';
				}
				if ($this->request->data['Cleaner']['saturday_check'] == 1) {
					$this->request->data['Cleaner']['saturday_from'] = '';
					$this->request->data['Cleaner']['saturday_to'] = '';
				}
				if ($this->request->data['Cleaner']['sunday_check'] == 1) {
					$this->request->data['Cleaner']['sunday_from'] = '';
					$this->request->data['Cleaner']['sunday_to'] = '';
				}

				$this->request->data['Cleaner']['id'] = $id ;

				// save to the database
				if (!$this->Cleaner->save($this->request->data)) {
					throw new Exception('ERROR COULD NOT ADD Tag');
				}

				$this->TransactionManager->commit($transaction);
				$this->redirect(array('action' => 'index'));

			} catch (Exception $e) {
				$this->set(compact('image'));
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
				throw new Exception('ERROR Cleaner ID NOT EXISTS');
			}
			$this->Cleaner->id = $id;
			if (!$this->Cleaner->exists()) {
				throw new Exception('ERROR Cleaner NOT EXISTS');
			}
			if (!$this->Cleaner->save(array('Cleaner' => array('deleted' => 1, 'deleted_date' => date('Y-m-d H:i:s'))), array('validate' => false))) {
				throw new Exception('ERROR COULD NOT DELETE Cleaner');
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
		$approved = $this->Cleaner->findById($id);
		$this->Cleaner->id = $id;
		if ($approved['Cleaner']['deactivate'] == true){
			$this->Cleaner->saveField('deactivate', '0');
		} else {
			if (!$this->Cleaner->save(array('Cleaner' => array('deactivate' => 1, 'deactivate_date' => date('Y-m-d H:i:s'))), array('validate' => false))) {
				throw new Exception('ERROR COULD NOT STOP MASTER USER');
			}
		}
		$this->redirect( array('action' => 'index'));
	}

}