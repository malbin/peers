<?php
class BoardNotification extends AppModel {
    
    const CAUSE_JOB_CHANGED = 'job_changed';
    const CAUSE_COMPENSATION_CHANGED = 'compensation_changed';
    const CAUSE_USER_JOINED = 'user_joined';
    const CAUSE_USER_LEFT = 'user_left';
	
	const STATUS_PENDING = 'pending';
	const STATUS_SENT = 'sent';
    
	var $name = 'BoardNotification';
	var $displayField = 'id';

	var $belongsTo = array(
		'Board' => array(
			'className' => 'Board',
			'foreignKey' => 'board_id',
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
	);
    
    /**
     * Notify a single board. Used for board-specific effects like USER_LEFT
     * or USER_JOINED.
     * 
     * @param type $boardId
     * @param type $userId
     * @param type $cause 
     */
    function createNotification($boardId, $userId, $cause) {
        $data = array(
            'BoardNotification' => array(
                'board_id'=> $boardId,
                'user_id' => $userId,
                'cause' => $cause,
                'status' => self::STATUS_PENDING
            )
        );
        $this->create();
        $this->save($data);
        
        // To order boards by "last updated"
        $now = date('Y-m-d H:i:s');
        $this->Board->updateAll(array('Board.modified' => "'{$now}'"), array('Board.id' => $boardId));
        
        // To indicate if board members have seen updates
        $board = $this->Board->getWithId($boardId);
        $boardUpdates = $this->Board->BoardUpdate->findAllByBoardId($boardId);
        $data = array();
        foreach ($board['MembersIds'] as $memberId) {
            foreach ($boardUpdates as &$boardUpdate) {
                if ($boardUpdate['BoardUpdate']['user_id'] == $memberId) {
                    $data[] = array(
                        'id' => $boardUpdate['BoardUpdate']['id']
                    ); // Will automagically change just the 'modified' field
                    continue 2;
                }
            }
            $data[] = array(
                'board_id' => $boardId,
                'user_id' => $memberId
            );
        }
        $this->Board->BoardUpdate->create();
        $this->Board->BoardUpdate->saveAll($data);
    }
    
    /**
     * Notify every board that the user belongs to. Used when every board is
     * affected by a cause like JOB_CHANGED or COMPENSATION_CHANGED.
     * 
     * @param type $user
     * @param type $cause 
     */
    function createNotifications($user, $cause) {
        $boardIds = Set::extract('/BoardMembership/id', $user);
        $minRequiredMembers = Configure::read('App.MinBoardMembers');
        foreach ($boardIds as $boardId) {
            $boardMemberCount = $this->Board->getCountActiveAndSalariedUsers($boardId);
            if ($boardMemberCount >= $minRequiredMembers) {
                $this->createNotification($boardId, $user['User']['id'], $cause);
            }
        }
    }
    
    function getBelowMinimumReports() {
        $this->recursive = -1;
        $belowMinimumReports = $this->find('all', array(
            'fields' => array('Board.id', 'Board.name', 'UsersBoard.user_id', 'User.email', 'User.first_name', 'User.last_name'),
            'conditions' => array(
                'BoardNotification.status' => BoardNotification::STATUS_PENDING,
                'BoardNotification.cause' => BoardNotification::CAUSE_USER_LEFT
            ),
            'joins' => array(
                array(
                    'table' => 'boards',
                    'alias' => 'Board',
                    'foreignKey' => false,
                    'type' => 'inner',
                    'conditions' => array(
                        'Board.id = BoardNotification.board_id',
                        'Board.expiry_date <>' => null
                    )
                ),
                array(
                    'table' => 'users_boards',
                    'alias' => 'UsersBoard',
                    'foreignKey' => false,
                    'type' => 'inner',
                    'conditions' => array(
                        'UsersBoard.board_id = BoardNotification.board_id',
                        'UsersBoard.user_id != BoardNotification.user_id'
                    )
                ),
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'foreignKey' => false,
                    'type' => 'inner',
                    'conditions' => array('User.id = UsersBoard.user_id')
                )
            ),
            'group' => array('UsersBoard.user_id'),
            'recursive' => -1
        ));
        
        $expiredBoardIds = Set::extract('/Board/id', $belowMinimumReports);
        $this->updateAll(array('BoardNotification.status' => "'" . BoardNotification::STATUS_SENT . "'"), array('BoardNotification.board_id' => $expiredBoardIds));
        
        return $belowMinimumReports;
    }
    
    function getPendingReports() {
        $this->recursive = -1;
        $pendingReports = $this->find('all', array(
            'fields' => array('UsersBoard.user_id', 'COUNT(DISTINCT UsersBoard.board_id) AS report_count', 'User.email', 'User.first_name', 'User.last_name'),
            'conditions' => array('BoardNotification.status' => BoardNotification::STATUS_PENDING),
            'joins' => array(
                array(
                    'table' => 'users_boards',
                    'alias' => 'UsersBoard',
                    'foreignKey' => false,
                    'type' => 'inner',
                    'conditions' => array(
                        'UsersBoard.board_id = BoardNotification.board_id',
                        'UsersBoard.user_id != BoardNotification.user_id'
                    )
                ),
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'foreignKey' => false,
                    'type' => 'inner',
                    'conditions' => array('User.id = UsersBoard.user_id')
                )
            ),
            'group' => array('UsersBoard.user_id')
        ));
        
        $this->updateAll(array('BoardNotification.status' => "'" . BoardNotification::STATUS_SENT . "'"), array('BoardNotification.status' => BoardNotification::STATUS_PENDING));
        
        return $pendingReports;
    }
}
