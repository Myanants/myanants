<?php

App::uses('CakeEmail', 'Network/Email');
App::uses('UserAppController', 'Controller');

class ServiceRequestsController extends UserAppController {
	public $components = array('RequestHandler','OptionCommon');
	public $uses = array('Customer','Service','Question','SubService','ServiceRequest','TransactionManager');
	
	public function add($id = null){
		$this->layout = 'user';

		$townships = $this->OptionCommon->townships;

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

		$this->set(compact('serviceName','id','question','service','townships'));

		if ($this->request->is(array('post', 'put'))) {
			try {

// $this->log($this->request->data);
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
						$data['Customer']['address'] = $this->request->data['ServiceRequest']['township'] ;

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
						$cID = $this->Customer->find('first',array('order' => array('Customer.id' => 'DESC'),'fields' => 'id'));
						
						$customerid = $cID['Customer']['id'] ;
					} else {
						$customerid = $existData['Customer']['id'] ;
					}
				} else {
					$customerid = $this->Auth->user('id');
				}


				$request_datetime = $this->request->data['ServiceRequest']['request_datetime'];
				$township = $this->request->data['ServiceRequest']['township'];

				unset($this->request->data['ServiceRequest']['name']);
				unset($this->request->data['ServiceRequest']['phone_number']);
				unset($this->request->data['ServiceRequest']['request_datetime']);
				unset($this->request->data['ServiceRequest']['township']);


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
				$this->request->data['ServiceRequest']['request_datetime'] = $request_datetime;
				$this->request->data['ServiceRequest']['township'] = $township;
				
				$allInfo = $this->request->data ;
				// save to the database 
				$this->ServiceRequest->create();

				$originalDate = $this->request->data['ServiceRequest']['request_datetime'];
				$newDate = date("Y-m-d H:m", strtotime($originalDate));
				
				$this->request->data['ServiceRequest']['request_datetime'] = $newDate;

				if(!$this->ServiceRequest->save($this->request->data)) {
					throw new Exception("ERROR OCCUR DURING REGISTER OF USER INFORMATION");
				}

				if (!empty($this->Auth->user('email'))) {
					$user_mail = $this->Auth->user('email') ;

					// Mail Send to Customer
					$defaults = array(
						'to' => $user_mail ,
						'from' => 'info@myanants.com',
						'subject' => "[MyanAnts]",
						'template' => 'user_service_request',
						'emailFormat' => CakeEmail::MESSAGE_TEXT,
						'layout' => 'default'
					);

					$options = array();
					$options = array_merge($defaults, $options);

					$Email = $this->_getMailInstance();
					$Email->to($user_mail);
					$Email->from($options['from']);
					$Email->emailFormat($options['emailFormat']);
					$Email->subject($options['subject']);
					$Email->template($options['template']);
					// $Email->layout($options['layout']);
					// $Email->viewVars(array(
					// 	'model' => $this->modelClass));

					// $Email->send();
					$Email->send();

				}


				/******************* Mail Send to Admin **************************/

				$main_service = array();
				$sub_service = array();
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

				$pairQandA = explode('###', $allInfo['ServiceRequest']['answer']) ;

				$string = '' ;
				$ansstring = '' ;
				foreach ($pairQandA as $pairkey => $pairvalue) {
					$pos = strpos($pairvalue, '$$');
					if ($pos) {
						$tmpArr = explode('/', $pairvalue);
						$ans = explode('$$', $tmpArr[1]) ;
						foreach ($ans as $anskey => $ansvalue) {
							$ansstring .= $ansvalue.'<br/>';
						}
						$string .= $question[$tmpArr[0]].'<br/>'.$ansstring.'###';
					

					} else {
						$tmpArr = explode('/', $pairvalue);
						// $tmpArr[0] // Question
						// $tmpArr[1] // Answer
						$string .= $question[$tmpArr[0]].'<br/>'.$tmpArr[1].'###';

					}
				}

				$this->Session->write('mainService', $main_service[$id]);
				$this->Session->write('subService', $sub_service[$sub_service_id]);
				$this->Session->write('emailContent', $string);

				$admin_defaults = array(
					'to' => 'myothandarkhaing18@gmail.com' ,
					'from' => 'info@myanants.com',
					'subject' => 'Service Request Alert from Customer',
					'template' => 'service_request_alert',
					'emailFormat' => CakeEmail::MESSAGE_TEXT,
					'layout' => 'default'
				);

				$admin_options = array();
				$admin_options = array_merge($admin_defaults, $admin_options);

				$AdminEmail = $this->_getMailInstance();
				$AdminEmail->to('myothandarkhaing18@gmail.com');
				$AdminEmail->from($admin_options['from']);
				$AdminEmail->emailFormat($admin_options['emailFormat']);
				$AdminEmail->subject($admin_options['subject']);
				$AdminEmail->template($admin_options['template']);
				// $AdminEmail->send();
				if ($AdminEmail->send()) {
					$this->log("sent");
				}else{
					$this->log("not sent");

				}
				/******************* Mail Send to Admin **************************/

				$this->TransactionManager->commit($transaction);

				$this->redirect(array('controller'=>'users','action' => 'index'));

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