<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class Question extends AppModel {
	public $belongsTo = array(
        'SubService' => array(
            'className' => 'SubService',
            'foreignKey' => 'sub_service_id'
        )
    );
}