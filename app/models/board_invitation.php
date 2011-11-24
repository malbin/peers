<?php
class BoardInvitation extends AppModel {
	
	const STATUS_PENDING = 'pending';
	const STATUS_ACCEPTED = 'accepted';
	const STATUS_REJECTED = 'rejected';
	
	var $name = 'BoardInvitation';
	var $displayField = 'id';

	var $belongsTo = array(
		'Inviter' => array(
			'className' => 'User',
			'foreignKey' => 'inviter_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Board' => array(
			'className' => 'Board',
			'foreignKey' => 'board_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function beforeSave($options = array()) {
		if (!empty($this->data) && $this->id < 1) {
			$userId = $this->data['BoardInvitation']['user_id'];
			$boardId = $this->data['BoardInvitation']['board_id'];
			$boardInvite = $this->getPendingBoardInvitationForUserId($userId, $boardId);
			if (!empty($boardInvite)) {
				return false;
			}
		}
  		return true;
  	}
	
	function createBoardInvitation($data) {
  		$this->create();
  		return $this->save($data);
  	}
  	
  	function getWithId($id) {
  		$invitation =  $this->find('first', array(
  			'conditions' => array(
  				$this->name.'.id' => $id
  			)
  		));
  		if (!empty($invitation)) {
	  		$Board = ClassRegistry::init('Board');
	  		$board = $Board->getWithId($invitation['Board']['id']);
	  		$invitation['BoardUsers'] = $board['User'];
  		}	
  		return $invitation;
  	}
  	
  	function getPendingBoardInvitationForUserId($userId, $boardId) {
  		return $this->find('first', array(
  			'conditions' => array(
  				'BoardInvitation.user_id' => $userId,
  				'BoardInvitation.board_id' => $boardId,
  				'BoardInvitation.status' => self::STATUS_PENDING
  			)
  		));
  	}
  	
  	function getAllPendingForUserId($userId) {
  		return $this->find('all', array(
  			'conditions' => array(
  				'BoardInvitation.user_id' => $userId,
  				'BoardInvitation.status' => self::STATUS_PENDING
  			),
  			'order' => 'BoardInvitation.created DESC'
  		));
  	}
  	
}
