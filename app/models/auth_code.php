<?php
class AuthCode extends AppModel {
	
	const STATUS_ACCEPTED = 'accepted';
	const STATUS_PENDING = 'pending';
	
	var $name = 'AuthCode';
		
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function getCodeForUserId($user_id) {
		return $this->findByUserId($user_id);
	}
}
