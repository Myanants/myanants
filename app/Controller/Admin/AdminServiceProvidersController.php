<?php
App::uses('AdminAppController', 'Controller');
class AdminServiceProvidersController extends AdminAppController {
	public $components = array('RequestHandler','OptionCommon');
	public $uses = array('ServiceProvider','TransactionManager');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->layout = 'admin';
	}

	public function index() {
		$limit = (!empty($this->params->query['limit'])) ? $this->params->query['limit'] : 50;
		$keyword = (!empty($this->params->query['keyword'])) ? trim($this->params->query['keyword']) : '';
		$status = !empty($this->request->query['status']) ? trim($this->request->query['status']) : '';
		$condition = array();


		if ($status == 1 ) { //Active ServiceProvider list
			$condition = array( 'ServiceProvider.deactivate' => 0,'ServiceProvider.deleted ' => 0);
		} elseif ($status == 2 ) { //Deactivated ServiceProvider list
			$condition = array( 'ServiceProvider.deactivate' => 1,'ServiceProvider.deleted ' => 0);
		} else {
			$condition = array(
				array(
					'ServiceProvider.deleted' => 0
				),
				'OR' => array(
					array('ServiceProvider.service_provider_id LIKE' => '%'. $keyword .'%'),
					array('ServiceProvider.name LIKE' => '%'. $keyword .'%'),
					array('ServiceProvider.email LIKE' => '%'. $keyword .'%'),
					array('ServiceProvider.company_name LIKE' => '%'. $keyword .'%'),
					array('ServiceProvider.phone LIKE' => '%'. $keyword .'%')
				)
			);
		}

			
		$this->paginate = array(
			'paramType' => 'querystring',
			'limit' => $limit,
			'order' => array('id' => 'DESC'),
			'conditions' => $condition
		);
		$pag = $this->paginate('ServiceProvider');
		$this->set(compact('pag','limit'));
	}

	public function add() {		
		$experience = $this->OptionCommon->experience;
		$townships = $this->OptionCommon->townships;
		$lastServiceProviderID = $this->ServiceProvider->find('first',array('order' => array('id' => 'DESC'),'fields' => 'service_provider_id'));

		if (!empty($lastServiceProviderID['ServiceProvider']['service_provider_id'])) {
			$temp = substr($lastServiceProviderID['ServiceProvider']['service_provider_id'], 3);
			$num = $temp+1;
			$CompanyID = str_pad($num, 6, '0', STR_PAD_LEFT);
		} else {
			$num = 1;
			$CompanyID = str_pad($num, 6, '0', STR_PAD_LEFT);
		}
		$prefix = 'SP-';
		$UserCode = $prefix.$CompanyID;
		
		$error = false;

		$this->set(compact('UserCode','experience','townships'));

		if ($this->request->is(array('post', 'put'))) {

			try {
				$transaction = $this->TransactionManager->begin();

				$this->request->data['ServiceProvider']['service_provider_id'] = $UserCode;
				$this->request->data['ServiceProvider']['deactivate'] = 0;

				// validate the upload file.
				if (!empty($this->request->data['ServiceProvider']['image']['name'])) {
					$tmpName = $this->request->data['ServiceProvider']['image']['tmp_name'];
					$name = $this->request->data['ServiceProvider']['image']['name'];
					unset($this->request->data['ServiceProvider']['image']);

					move_uploaded_file($tmpName, WWW_ROOT . '/img/' . $name);
					$this->request->data['ServiceProvider']['image'] = $name;

				} else {
					unset($this->request->data['ServiceProvider']['image']);
				}


				// TOWNSHIPS 
				$this->request->data['ServiceProvider']['experience'] = $experience[$this->request->data['ServiceProvider']['experience']] ;
				$this->request->data['ServiceProvider']['townships'] = $townships[$this->request->data['ServiceProvider']['townships']] ;

				// save to the database
				// $this->ServiceProvider->create();
				if (!$this->ServiceProvider->save($this->request->data)) {
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
		if (!$id) {
			$this->Session->setFlash('Enter ServiceProvider ID。', "error");
			$this->redirect(array('action' => 'index'));
		}
		$data = $this->ServiceProvider->findByid($id);

		$this->set(compact('data'));
	}

	public function edit($id) {
		$experience = $this->OptionCommon->experience;
		$townships = $this->OptionCommon->townships;

		$this->set(compact('experience','townships'));

		$sp_info = $this->ServiceProvider->findById($id);


		$sp_info['ServiceProvider']['experience'] = array_search($sp_info['ServiceProvider']['experience'], $experience);
		$sp_info['ServiceProvider']['townships'] = array_search($sp_info['ServiceProvider']['townships'], $townships);
		  

		if (!$this->request->data) {
			$this->request->data = $sp_info;
		}

		if ($this->request->is(array('post', 'put'))) {

			// remove validate
			$validateAttrKey = array(
				'password',
				'confirm_password'
			);

			foreach ($validateAttrKey as $key => $value) {
				$this->ServiceProvider->validator()->remove($value);
			}

			try {
				$transaction = $this->TransactionManager->begin();
				$this->request->data['ServiceProvider']['id'] = $id;

				if (!empty($this->request->data['ServiceProvider']['password_update'])) {
					$this->request->data['ServiceProvider']['password'] = $this->request->data['ServiceProvider']['password_update'];
				}

				// validate the upload file.
				if (!empty($this->request->data['ServiceProvider']['image']['name'])) {
					$tmpName = $this->request->data['ServiceProvider']['image']['tmp_name'];
					$name = $this->request->data['ServiceProvider']['image']['name'];
					unset($this->request->data['ServiceProvider']['image']);

					move_uploaded_file($tmpName, WWW_ROOT . '/img/' . $name);
					$this->request->data['ServiceProvider']['image'] = $name;

				} else {
					unset($this->request->data['ServiceProvider']['image']);
				}

				if (!$this->ServiceProvider->saveAll($this->request->data)) {
					// $this->set('error', 'true');
					throw new Exception('ERROR COULD NOT ADD ServiceProvider DATA');
				}
				$this->TransactionManager->commit($transaction);
				$this->Session->setFlash('Successfully edited Service Provider', 'success');
				$this->redirect(array('action' => 'index'));

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
				$this->Session->setFlash('Couldn\'t edit headhunter', 'error');
				return;
			}

		}
		
		$this->set(compact('sp_info'));

	}

	public function delete($id = null) {
		try {
			$transaction = $this->TransactionManager->begin();
			if (empty($id)) {
				throw new Exception('ERROR ServiceProvider ID NOT EXISTS');
			}
			$this->ServiceProvider->id = $id;
			if (!$this->ServiceProvider->exists()) {
				throw new Exception('ERROR ServiceProvider NOT EXISTS');
			}
			if (!$this->ServiceProvider->save(array('ServiceProvider' => array('deleted' => 1, 'deleted_date' => date('Y-m-d H:i:s'))), array('validate' => false))) {
				throw new Exception('ERROR COULD NOT DELETE ServiceProvider');
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
		$approved = $this->ServiceProvider->findById($id);
		$this->ServiceProvider->id = $id;
		if ($approved['ServiceProvider']['deactivate'] == true){
			$this->ServiceProvider->saveField('deactivate', '0');
		} else {
			if (!$this->ServiceProvider->save(array('ServiceProvider' => array('deactivate' => 1, 'deactivate_date' => date('Y-m-d H:i:s'))), array('validate' => false))) {
				throw new Exception('ERROR COULD NOT STOP MASTER USER');
			}
		}
		$this->redirect( array('action' => 'index'));
	}

}