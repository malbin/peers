<?php
class Network extends AppModel {
	var $name = 'Network';
	var $displayField = 'name';

	var $belongsTo = array(
		'Owner' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User',
			'joinTable' => 'users_networks',
			'foreignKey' => 'network_id',
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
            'nameRule' => array(
                'rule' => array('between', 2, 100),
                'message' => 'Name must be between 2 and 100 characters long.',
                'allowEmpty' => false
            ),
            'uniqueForUser' => array(
                'rule' => array('uniqueForUser'),
                'message' => 'A group with this name already exists in your network.',
                
            )
		),
        'user_id' => array(
            'rule' => array('numeric'),
            'message' => "This group must belong to someone's network.",
            'required' => true
        )
	);
    
    function uniqueForUser($check) {
        $conditions = array(
            'Network.user_id' => $this->data['Network']['user_id'],
            'Network.name' => $check
        );
        if (!empty($this->data['Network']['id'])) {
            $conditions['Network.id !='] = $this->data['Network']['id'];
        }
        $count = $this->find('count', array('conditions' => $conditions));
        return ($count == 0);
    }

	function beforeValidate() {
		if (!empty($this->data['Network']['name'])) {
			App::import('Sanitize');
			$this->data['Network']['name'] = Sanitize::html($this->data['Network']['name'], array('remove' => true));
		}	
		return true;
	}
	
	function beforeSave($options = array()) {
		if (!empty($this->data)) {
			if (empty($this->data['User']['User'])) {
				$this->data['User']['User'] = array();
			}
		}
  		return true;
  	}
	
	function afterFind($results, $primary = false) {
		$results = parent::afterFind($results, $primary);
		// Append [MembersIds] array to each network entry
		if (!empty($results)) foreach($results as &$row){
			if (!empty($row['Network'])) {
				$row['MembersIds'] = array_pluck('id', @$row['User']);
			}
		}
		return $results;
	}
	
	function getAllForUserId($user_id) {
  		return $this->find('all', array(
  			'conditions' => array(
  				'user_id' => $user_id
  			),
  			'order' => 'name ASC'
  		));
  	}
  	
	function createNetwork($data) {
  		$this->create();
  		return $this->save($data);
  	}
}
