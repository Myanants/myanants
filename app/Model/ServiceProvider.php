<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class ServiceProvider extends AppModel {
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please fill name !',
				'required' => true
			)
		),
		'company_name' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please fill company_name !',
				'required' => true
			)
		),
		'teammember' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please select team member !',
				'required' => true
			)
		),
		'business_type' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please fill business type !',
				'required' => true
			)
		),
		'pricing' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please fill pricing !',
				'required' => true
			)
		),
		'experience' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please fill experience !',
				'required' => true
			)
		),
		'townships' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please fill township !',
				'required' => true
			)
		),
		'email' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill email address !',
				'allowEmpty' => true,
				'required' => false
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please refill valid email address !',
			),
			'maxLength' => array(
				'rule' => array('maxLength', 60),
				'message' => 'Your email must be less than 60 !',
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This email has already been registered!',
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

	public function generateToken($length = 10) {
		$possible = '0123456789abcdefghijklmnopqrstuvwxyz';
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
		return parent::beforeSave($options);
	}
}