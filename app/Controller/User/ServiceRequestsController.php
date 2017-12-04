<?php

App::uses('CakeEmail', 'Network/Email');
App::uses('UserAppController', 'Controller');

class ServiceRequestsController extends UserAppController {
	public $components = array('RequestHandler');
	public $uses = array('Customer','Service','Question','SubService','ServiceRequest','TransactionManager');
	
	public function add($id = null){
		$this->layout = 'user';
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
				
				$sub_service_id = $this->request->data['ServiceRequest']['sub_service_id'];
				unset($this->request->data['ServiceRequest']['sub_service_id']);

				// // For not logined customer, save customer data
				if (empty($this->Auth->user('id'))) {

					$input_phone = $this->request->data['ServiceRequest']['phone_number'] ;
					$existData = $this->Customer->findByPhoneNumber($input_phone);

					if (empty($existData)) {					
						$data['Customer']['name'] = $this->request->data['ServiceRequest']['name'] ;
						$data['Customer']['phone_number'] = $this->request->data['ServiceRequest']['phone_number'] ;

						$lastcustomerID = $this->Customer->find('first',array('order' => array('Customer.id' => 'DESC'),'fields' => 'customer_id'));

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
						$data['Customer']['customer_id'] = $UserCode;
						$data['Customer']['deactivate'] = 0;

						// remove validate
						$validateAttrKey = array(
							'email','address','password','confirm_password'
						);


						foreach ($validateAttrKey as $key => $value) {
							$this->Customer->validator()->remove($value);
						}

						$this->Customer->create();
						if(!$this->Customer->save($data)) {
							throw new Exception("ERROR OCCUR DURING REGISTER OF USER INFORMATION");
						}
						$customerID = $this->Customer->find('first',array('order' => array('Customer.id' => 'DESC'),'fields' => 'id'));
						$customerid = $customerID['Customer']['id'] ;
					} else {
						$customerid = $existData['Customer']['id'] ;
					}
				} else {
					$customerid = $this->Auth->user('id');
				}

				unset($this->request->data['ServiceRequest']['name']);
				unset($this->request->data['ServiceRequest']['phone_number']);


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


				// Mail Send to Admin
				$defaults = array(
					'to' => 'myothandarkhaing.myanants@gmail.com' ,
					'from' => 'info@myanants.com',
					'subject' => "[MyanAnts]",
					'template' => 'user_service_request',
					'emailFormat' => CakeEmail::MESSAGE_TEXT,
					'layout' => 'default'
				);

				$options = array();
				$options = array_merge($defaults, $options);

				$Email = $this->_getMailInstance();
				$Email->to('myothandarkhaing.myanants@gmail.com');
				$Email->from($options['from']);
				$Email->emailFormat($options['emailFormat']);
				$Email->subject($options['subject']);
				$Email->template($options['template']);
				// $Email->layout($options['layout']);
				// $Email->viewVars(array(
				// 	'model' => $this->modelClass));

				// $Email->send();
		        $result = $Email->send();
if ($Email->send() ) {
    $this->log('Success');
    $this->log($result);
} else {
   $this->log("Fail");
}


				$this->TransactionManager->commit($transaction);

				// $this->redirect(array('controller'=>'users','action' => 'index'));

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
			}
		}
	}

	protected function _getMailInstance() {
		$emailConfig = Configure::read('Customers.emailConfig');

		if ($emailConfig) {
			return new CakeEmail($emailConfig);
		} else {
			return new CakeEmail('default');
		}
	}

}