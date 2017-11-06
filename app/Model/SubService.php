<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class SubService extends AppModel {

	public $hasMany = array (
		'Question'
	);
	
	public $belongsTo = array(
        'Service' => array(
            'className' => 'Service',
            'foreignKey' => 'service_id'
        )
    );

	public $validate = array(
		'service_id' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please choose service name !',
				'required' => true
			)
		),
		'name' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please fill name !',
				'required' => true
			)
		),
		'myan_name' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please fill myan_name !',
				'required' => true
			)
		)
	);

}