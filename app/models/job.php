<?php
   class Job extends AppModel {
	var $name = 'Job';
	var $displayField = 'title';
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Employer' => array(
			'className' => 'Employer',
			'foreignKey' => 'employer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Compensation' => array(
			'className' => 'Compensation',
			'foreignKey' => 'job_id',
			'dependent' => true,
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

	var $validate = array(
		'title' => array(
			'rule' => array('between', 2, 100),
			'message' => 'Title must be between 2 and 100 characters long.',
			'allowEmpty' => false
		),
		'salary' => array(
			'rule' => 'numeric',
			'message' => 'Please enter the your salary in USD.'
		),
		'start_date' => array(
            'notempty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter start date.'
            ),
            'validateAfterBirthDate' => array(
                'rule' => 'validateAfterBirthDate',
                'message' => 'Pleae enter a date that is after your date of birth.'
            )
		)
	);
    
    function validateAfterBirthDate($check) {
        if (!empty($this->data['Job']['user_id'])) {
            $user = $this->User->findById($this->data['Job']['user_id']);
            $jobStartDate = strtotime($this->data['Job']['start_date']);
            $birthDate = strtotime($user['User']['birthdate']);
            return ($jobStartDate > $birthDate);
        }
        return true;
    }
	
	function beforeValidate() {
		if (!empty($this->data['Job']['title'])) {
			App::import('Sanitize');
			$this->data['Job']['title'] = Sanitize::html($this->data['Job']['title'], array('remove' => true));
		}
        // Remove currency symbol, commas [Keep numbers, and period]
        if (!empty($this->data['Job']['salary'])) {
            $this->data['Job']['salary'] = preg_replace('/[^0-9\.]/', '', $this->data['Job']['salary']);
        }
		return true;
	}
	
	function beforeSave($options = array()) {
		if (!empty($this->data)) {
            if (empty($this->data['Job']['currency'])) {
                $this->data['Job']['currency'] = 'USD';
            } elseif ($this->data['Job']['currency'] != 'USD') {
                App::import('Model', 'ExchangeRate');
                $ExchangeRate = new ExchangeRate();
                $this->data['Job']['salary'] = $ExchangeRate->convertToUSD($this->data['Job']['salary'], $this->data['Job']['currency']);
            }
		}
  		return true;
  	}
    
    function afterFind($results, $primary = false) {
        if (isset($results[$this->alias]['salary']) && isset($results[$this->alias]['currency']) && $results[$this->alias]['currency'] != 'USD') {
            App::import('Model', 'ExchangeRate');
            $ExchangeRate = new ExchangeRate();
            $this->data['Job']['salary'] = $ExchangeRate->convertFromUSD($results[$this->alias]['salary'], $results[$this->alias]['currency']);
        } else {
            foreach ($results as $key => $val) {
                if (!is_numeric($key)) { break; } // Since we can't rely on $primary
                if (isset($val[$this->alias]['salary']) && isset($val[$this->alias]['currency']) && $val[$this->alias]['currency'] != 'USD') {
                    App::import('Model', 'ExchangeRate');
                    $ExchangeRate = new ExchangeRate();
                    $results[$key][$this->alias]['salary'] = $ExchangeRate->convertFromUSD($val[$this->alias]['salary'], $val[$this->alias]['currency']);
                }
            }
        }
        return $results;
    }
  	
	function afterSave($created) {
		$job = $this->findById($this->id);
		$this->_updateJobsDatesForUserId($job['User']['id']);
	}
	
	function beforeDelete() {
		$job = $this->findById($this->id);
		$this->user_id = $job['User']['id'];
		return true;
	}

	function afterDelete() {
		$this->_updateJobsDatesForUserId($this->user_id);
	}
	
	// TODO: Move Update Jobs Dates to TimelineBehaviour
	function _updateJobsDatesForUserId($userId) {
		if (0 < $userId) {
			$jobs =  $this->find('all', array(
	  			'conditions' => array(
	  				'user_id' => $userId
	  			),
	  			'order' => 'start_date ASC'
	  		));
	  		if (!empty($jobs)) {
		  		$end_date = '0000-00-00';
		  		for ($i = count($jobs) - 1; 0 <= $i; --$i) {
		  			$job = &$jobs[$i];
		  			$job_id = $job['Job']['id'];
		  			$query = "UPDATE jobs SET end_date = '$end_date' WHERE id = $job_id LIMIT 1";
					$this->query($query);
		  			$end_date = $job['Job']['start_date'];
		  		}

		  		// Updating users last job and employer info
		  		$lastJob = $jobs[count($jobs) - 1];
		  		$userData = array(
		  			'User' => array(
		  				'last_employer_name' => $lastJob['Employer']['name'],
		  				'last_job_title' => $lastJob['Job']['title']
		  			)
		  		);
		  		$this->User->id = $userId;
		  		$this->User->save($userData);
	  		} else {
                $userData = array(
		  			'User' => array(
		  				'last_employer_name' => null,
		  				'last_job_title' => null
		  			)
		  		);
		  		$this->User->id = $userId;
		  		$this->User->save($userData);
            }
		}
	}
	
  	function getAllForUserId($user_id) {
  		return $this->find('all', array(
  			'conditions' => array(
  				'user_id' => $user_id
  			),
  			'order' => 'start_date DESC'
  		));
  	}
  	
  	function getLastJobForUserId($user_id) {
  		return $this->find('first', array(
  			'conditions' => array(
  				'user_id' => $user_id
  			),
  			'order' => 'start_date DESC',
  			'limit' => 1
  		));
  	}
  	
  	function createJob($data) {
  		$this->create();
  		return $this->save($data);
  	}

    function getSearchJobs($data){
        return $this->find('all',array(
            'conditions' => array('title'=>$field),
            'order' =>'created DESC'
        ));
    }
    
    function getAutocomplete($term, $limit = 1) {
        $jobs = $this->find('list', array(
            'conditions' => array(
                'Job.title LIKE' => $term . '%'
            ),
            'limit' => $limit
        ));
        return array_values($jobs);
    }
}
