<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class Cleaner extends AppModel {
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please fill name !',
				'required' => true
			)
		),
		'phone' => array(
			'numeric' => array(
				'rule' => '/^[0-9]*$/',
				'message' => 'Please enter a valid phone number !',
				'required' => true
			),
			'minLength' => array(
				'rule' => array('minLength', 6),
				'message' => 'Your mobile phone must be 6 to 20 digits !',
			),
			'maxLength' => array(
				'rule' => array('maxLength', 20),
				'message' => 'Your mobile phone must be 6 to 20 digits !',
			)
		),
		'password' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'on' => 'create',
				'message' => 'Please enter password !',
			),
			'minLength' => array(
				'rule' => array('minLength', 8),
				'message' => 'Password must be 8 to 20 digits !',
			),
			'maxLength' => array(
				'rule' => array('maxLength', 20),
				'message' => 'Password must be 8 to 20 digits!',
			)
		),
		'confirm_password' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'on' => 'create',
				'message' => 'Please enter confirm password !',
			),
			'sameCheck' => array(
				'rule' => array('sameCheck', 'password'),
				'message' => 'Password and confirm password must be same !',
			)
		),
		'password_update' => array(
			'minLength' => array(
				'rule' => array('minLength', 8),
				'message' => 'Password must be 8 to 20 digits !',
				'allowEmpty' => true,
				'required' => false
			),
			'maxLength' => array(
				'rule' => array('maxLength', 20),
				'message' => 'Password must be 8 to 20 digits !',
			)
		),
		'confirm_password_update' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill Confirm Password !',
				'allowEmpty' => true
			),
			'sameCheck' => array(
				'rule' => array('sameCheck', 'password'),
				'message' => 'Password and confirm password must be same !',
			)
		)
	);

	public function sameCheck($value , $field_name) { //Confirm Password
		$v1 = array_shift($value);
		$v2 = $this->data[$this->name][$field_name];
		return $v1 == $v2;
	}

	// Save password from reset password page
	public function passwordReset($postData = array()) {
		$user = $this->find('first' ,array(
				'conditions' => array(
					$this->alias . '.email' => $postData[$this->alias]['email']
				)
			)
		);

		unset($user['Cleaner']['password']);

		if (!empty($user) && $user[$this->alias]['deleted'] == 0) {
			$sixtyMins = time() + 3600;
			$token = $this->generateToken();
			$user[$this->alias]['password_token'] = $token;
			$user[$this->alias]['password_token_expires'] = date('Y-m-d H:i:s', $sixtyMins);
			$user = $this->save($user, false);
			$this->data = $user;
			return $user;
		} else {
			$this->invalidate('email', "The email address you entered does not exist !");
		}
		return false;
	}

	// Check password token after click reset password link from mail
	public function checkPasswordToken($token = null) {

		// Find User with password_token = $token and password_token_expires = now()
		$user = $this->find('first', array(
				'conditions' => array(
					$this->alias . '.deleted' => 0,
					$this->alias . '.password_token' => $token,
					$this->alias . '.password_token_expires >=' => date('Y-m-d H:i:s')
				)
			)
		);

		if (empty($user)) {
			return false;
		}

		return $user;
	}

	//Password Reseting
	public function resetPassword($postData = array()) {
		$result = false;
		$this->set($postData);
		$this->validates = false ;
		if ($this->validates()) {
			$this->data['Cleaner']['default_password'] = $postData['Cleaner']['password'];
			$this->data['Cleaner']['password_token'] = null;
			$result = $this->save($this->data);
		}
		return $result;
	}

	// Generate Token for password Reset
	public function generateToken($length = 10) {

		// Initialize possible character
		$possible = '0123456789abcdefghijklmnopqrstuvwxyz';

		// Genterate token
		$token = "";
		$i = 0;
		while ($i < $length) {
			$char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
			if (!stristr($token, $char)) {
				$token .= $char;
				$i++;
			}
		}

		return $token;
	}

	public function beforeSave($options = array()) {
		if (!empty($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
		}
		return true;
		// return parent::beforeSave($options);
	}
}