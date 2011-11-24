<?php
class User extends AppModel {
	
	const STATUS_ACTIVE = 'active';
	const STATUS_INACTIVE = 'inactive';
	const STATUS_BANNED = 'banned';
	
	var $name = 'User';
	
	var $displayField = 'email';	

	var $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasOne = array(
		'AuthCode' => array(
			'className' => 'AuthCode',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ResetCode' => array(
			'className' => 'ResetCode',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasMany = array(
		'BoardInvitation' => array(
			'className' => 'BoardInvitation',
			'foreignKey' => 'user_id',
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
		'Board' => array(
			'className' => 'Board',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => ''
		),
		'BoardNotification' => array(
			'className' => 'BoardNotification',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => ''
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
		'Job' => array(
			'className' => 'Job',
			'foreignKey' => 'user_id',
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
		'Network' => array(
			'className' => 'Network',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	var $hasAndBelongsToMany = array(
		'BoardMembership' => array(
			'className' => 'Board',
			'joinTable' => 'users_boards',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'board_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'NetworkMembership' => array(
			'className' => 'Network',
			'joinTable' => 'users_networks',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'network_id',
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
		'phone' => array(
			'rule' => '/^[0-9]{10,20}$/i',
			'message' => 'Invalid phone number.',
			'allowEmpty' => false
		),
		'first_name' => array(
			'rule' => '/^[a-zA-Z]{2,40}$/i',
			'message' => 'First name must have between 6 and 40 alphanumeric characters.'
		),
		'last_name' => array(
			'rule' => '/^[a-zA-Z]{2,40}$/i',
			'message' => 'Last name must have between 6 and 40 alphanumeric characters.'
		),
		'email' => array(
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This email address already exists in our system.'
			),
			'email' => array(
				'rule' => 'email',
				'message' => 'Invalid email address.'
			)
		),
		'password' => array(
			'rule' => array('between', 6, 15),
			'message' => 'Passwords must be between 5 and 15 characters long.',
			'allowEmpty' => false
		),
		'phone_carrier' => array(
			'rule' => 'notEmpty',
			'message' => 'Please choose phone carrier from following list'
		)
	);
	
  	function beforeValidate($options = array()) {

  		// Phone validation
  		if (!empty($this->data['User']['phone'])) {
  			$phone = $this->data['User']['phone'];
  			$phone = $this->_parsePhone($phone);
  			$this->data['User']['phone'] = $phone;
  			$user = $this->getUserWithPhone($this->data['User']['phone']);
  			if (!empty($user) && $user['User']['id'] != $this->id) {
  				$this->invalidate('phone', __('This phone already exists in our system', true));
  			}
  		}
  		
  		// Password validation
  		if (!empty($this->data['User']['password'])) {
  			if (0 < $this->id) {
  				$user = $this->getWithId($this->id);
				// removed support to verification for changing passwords
  				if (isset($this->data['User']['reset_code']) && empty($this->data['User']['reset_code'])) {
  					$this->invalidate('current_password', __('Incorect current password.', true));
  				}
  			}
			// password matching removed for testing @TC
  			// if ($this->data['User']['password'] != $this->data['User']['verify_password']) {
  			// 	$this->invalidate('verify_password', __('Both password has to match.', true));
  			// }
	 	}
	 	
	 	// Birthdate validation
	 	if (!empty($this->data['User']['birthdate'])) {
	 		if (date('Y') - date('Y', strtotime($this->data['User']['birthdate'])) < 16) {
	 			$this->invalidate('birthdate', __('You must be at least 16 years old.', true));
	 		}
	 	}
	 		
  		return true;
  	}
  	
  	function beforeSave($options = array()) {
  		if (!empty($this->data)) {
  			if (!empty($this->data['User']['password'])) {
  				$this->data['User']['password'] = Security::hash($this->data['User']['password'],'md5',true);//md5($this->data['User']['password']);	
  			}
  		}
  		return true;
  	}
    
    function updateLastLoggedIn($id) {
        $this->create();
        $this->id = $id;
        $this->saveField('last_logged_in', date('Y-m-d H:i:s'));
    }
  	
  	function getUserWithEmail($email) {
  		$user = $this->find('first', array(
  			'conditions' => array(
  				'email' => $email
  			)
  		));
  		return $user;
  	}
  	function getUserWithId($id) {
  		$user = $this->find('first', array(
  			'conditions' => array(
  				'User.id' => $id
  			)
  		));
  		return $user;
  	}
  	
  	function getUserWithEmailAndPassword($email, $password) {
  		$user = $this->getUserWithEmail($email);
  		if (!empty($user) && Security::hash($password,'md5',true) == $user['User']['password']) {
  			return $user;
  		} else {
  			return null;
  		}
  	}
  	
  	function getUserWithPhone($phone) {
  		return $this->find('first', array(
  			'conditions' => array(
  				'phone' => $phone
  			)
  		));
  	}
  
  	function createUser($data) {
  		$this->create();
  		$data['User']['group_id'] = 1;
		return $this->save($data);
  	}
  	
  	function getSearchConditionsForQuery($query) {
  		App::import('Sanitize');
		$query = Sanitize::escape(trim($query), 'default');
		$keywords = explode(' ', $query);
		$searchConditions = array(
			"User.first_name LIKE '$query'",
			"User.last_name LIKE '$query'",
			"User.last_employer_name LIKE '$query'",
            "User.last_job_title LIKE '$query'"
		);
		foreach ($keywords as $word) {
			$cond = array(
				"User.first_name LIKE '$word%'",
				"User.last_name LIKE '$word%'",
                "User.last_employer_name LIKE '$word%'",
                "User.last_job_title LIKE '$word%'"
			);
			$searchConditions = array_merge($searchConditions, $cond);
		}
		return array('OR' => $searchConditions);;
  	}
    
    function isActiveAndSalaried($userId) {
        return 0 < $this->find('count', array(
            'conditions' => array(
                'User.id' => $userId,
                'User.status' => 'active'
            ),
            'joins' => array(
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
    
    function createRememberMeToken($md5Password) {
        return Security::hash($md5Password, null, true);
    }

    function isValidRememberMeCookie($cookie) {
        $user = $this->find('first', array(
            'conditions' => array('User.id' => $cookie['id']),
            'fields' => array('User.email', 'User.password'),
            'recursive' => -1
        ));
        if ($user && $this->createRememberMeToken($user['User']['password']) == $cookie['token']) {
            return true;
        }
        return false;
    }
  	
  	function _parsePhone($phone) {
		// $phone = preg_replace('/\.|\s|-|\)|\(|\+/i', '', $phone);
		// if (10 == strlen($phone)) {
		// 	$phone = '1'.$phone;
		// }
		//  disabled it as currently we are only dealing with US phone no. This is w.r.t tracker story #18909607 @TC
		return $phone;
	}
}
