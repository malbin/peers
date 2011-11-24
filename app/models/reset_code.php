<?php
class ResetCode extends AppModel {
	var $name = 'ResetCode';

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function getResetCodeWithCode($code) {
		return $this->find('first', array('conditions' => array('code' => $code)));
	}
	
	function getCodeForUserId($userId) {
		$seed = 0;
		do {
			$codeStr = md5($userId . time() . $seed++);
			$code = $this->getResetCodeWithCode($codeStr);
			$unique = !empty($code);
		} while($unique);
		$existingCode = $this->find('first', array(
			'conditions' => array(
				'user_id' => $userId
			)
		));
		if (empty($existingCode)) {
			$this->create();
		} else {
			$this->id = $existingCode['ResetCode']['id'];
		}
		$data = array('ResetCode' => array(
			'user_id' => $userId,
			'code' => $codeStr
		));
		return $this->save($data);
	}
}
