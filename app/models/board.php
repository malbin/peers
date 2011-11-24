<?php
class Board extends AppModel {
	var $name = 'Board';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Owner' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'BoardInvitation' => array(
			'className' => 'BoardInvitation',
			'foreignKey' => 'board_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
        'BoardNotification' => array(
			'className' => 'BoardNotification',
			'foreignKey' => 'board_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
        'BoardUpdate' => array(
			'className' => 'BoardUpdate',
			'foreignKey' => 'board_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);


	var $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User',
			'joinTable' => 'users_boards',
			'foreignKey' => 'board_id',
			'associationForeignKey' => 'user_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
	
	var $validate = array(
		'name' => array(
			'rule' => array('between', 2, 100),
			'message' => 'Name must be between 2 and 100 characters long.',
			'allowEmpty' => false
		)
	);
	
	function beforeSave($options = array()) {
		if (!empty($this->data)) {
            if (empty($this->data['Board']['id'])) {
                // Newly created board: Set expiry_date to +(App.BoardExpiryInDays) days
                $boardExpiryInDays = Configure::read('App.BoardExpiryInDays');
                $this->data['Board']['expiry_date'] = date('Y-m-d H:i:s', strtotime("+{$boardExpiryInDays} days"));
            }
			if (empty($this->data['User']['User'])) {
				$this->data['User']['User'] = array();
			}
		}
  		return true;
  	}
  	
	function afterFind($results, $primary = false) {
		$results = parent::afterFind($results, $primary);
		// Append [MembersIds] array to each board entry
		if (!empty($results)) foreach($results as &$row){
			if (!empty($row['Board'])) {
				$row['MembersIds'] = array_pluck('id', @$row['User']);
			}
		}
		return $results;
	}

	function createBoard($data) {
  		$this->create();
  		return $this->save($data);
  	}
  	
	function getAllForUserId($user_id) {
		$user = $this->User->getWithId($user_id);
		$boardsIds = array_pluck('id', $user['BoardMembership']);
		if (!empty($boardsIds)) {
            $this->unbindModel(array('hasMany' => array('BoardUpdate')));
            $this->bindModel(array('hasOne' => array('BoardUpdate' => array('conditions' => array('BoardUpdate.user_id' => $user_id)))));
            
			return $this->find('all', array(
	  			'conditions' => array(
	  				'Board.id' => $boardsIds
	  			),
	  			'order' => 'Board.modified DESC, Board.name ASC'
	  		));
		} else {
			return array();
		}
  	
  	}
    
    function getCountActiveAndSalariedUsers($boardId) {
        return $this->find('count', array(
            'conditions' => array(
                'Board.id' => $boardId
            ),
            'joins' => array(
                array(
                    'table' => 'users_boards',
                    'alias' => 'UsersBoard',
                    'foreignKey' => false,
                    'type' => 'inner',
                    'conditions' => array(
                        "UsersBoard.board_id = Board.id"
                    )
                ),
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'foreignKey' => false,
                    'type' => 'inner',
                    'conditions' => array(
                        "User.id = UsersBoard.user_id",
                        'User.status' => 'active'
                    )
                ),
                array(
                    'table' => 'jobs',
                    'alias' => 'Job',
                    'foreignKey' => false,
                    'type' => 'inner',
                    'conditions' => array(
                        "Job.user_id = User.id",
                        'Job.end_date' => '0000-00-00'
                    )
                )
            )
        ));
    }
  	
  	function getCompensationRankingsForBoardId($boardId) {
  		$query = "SELECT User.*,". 
				 ' ( SELECT IF(SUM(C.cash) + SUM(C.deferred) IS NOT NULL, SUM(C.cash) + SUM(C.deferred), 0) FROM compensations C WHERE C.job_id=Job.id ) + Job.salary AS total_compensation'. 
				 ' FROM jobs Job, users User'.
				 " WHERE Job.end_date = '0000-00-00'". 
				 ' AND User.id = Job.user_id'.
				 " AND User.status = 'active'".
				 " AND Job.user_id IN (SELECT user_id FROM users_boards WHERE board_id = $boardId)".
				 ' ORDER BY total_compensation DESC;';
  		$results = $this->query($query);
  		$rankings = array();
        $i = 0;
  		$rank = 0;
        $reportedRank = 0;
        $lastAmount = -1;
        $tie = false;
        
  		foreach($results as $row) {
            ++$rank;
            if ($row[0]['total_compensation'] != $lastAmount) {
                $lastAmount = $row[0]['total_compensation'];
                $reportedRank = $rank;
                $tie = false;
            } else {
                $tie = true;
                $rankings[$i - 1]['tie'] = true;
            }
  			$rankings[$i++] = array(
  				'Ranking' => array('rank' => $rank, 'reported_rank' => $reportedRank, 'amount' => $row[0]['total_compensation'], 'tie' => $tie),
  				'User' => $row['User']
  			);
  		}
  		return $rankings;
  	}
  	
  	function getSalaryRankingsForBoardId($boardId) {
  		$query = "SELECT Job.salary, User.*". 
				 ' FROM jobs Job, users User'.
				 " WHERE Job.end_date = '0000-00-00'". 
				 ' AND User.id = Job.user_id'.
				 " AND User.status = 'active'".
				 " AND Job.user_id IN (SELECT user_id FROM users_boards WHERE board_id = $boardId)".
				 ' ORDER BY Job.salary DESC;';
  		$results = $this->query($query);
  		$rankings = array();
        $i = 0;
  		$rank = 0;
        $reportedRank = 0;
        $lastAmount = -1;
        $tie = false;
        
  		foreach($results as $row) {
            ++$rank;
            if ($row['Job']['salary'] != $lastAmount) {
                $lastAmount = $row['Job']['salary'];
                $reportedRank = $rank;
                $tie = false;
            } else {
                $tie = true;
                $rankings[$i - 1]['tie'] = true;
            }
  			$rankings[$i++] = array(
  				'Ranking' => array('rank' => $rank, 'reported_rank' => $reportedRank, 'amount' => $row['Job']['salary'], 'tie' => $tie),
  				'User' => $row['User']
  			);
  		}
  		return $rankings;
  	}

}
