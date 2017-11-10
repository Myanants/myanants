<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class Customer extends AppModel {

	public $hasMany = array (
		'ServiceRequest'
	);

	public $belongsTo = array(
        'Service' => array(
            'className' => 'Service',
            'foreignKey' => 'service_id'
        )
    );

	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please fill name !',
				'required' => true
			)
		),
		'email' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill email address !',
				'required' => true,
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
		'phone_number' => array(
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
		'address' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please fill address !',
				'required' => true
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