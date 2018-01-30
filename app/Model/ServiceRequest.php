<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class ServiceRequest extends AppModel {

	public $belongsTo = array(
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id'
		),
		'Service' => array(
			'className' => 'Service',
			'foreignKey' => 'service_id'
		)
	);
}