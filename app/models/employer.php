<?php
class Employer extends AppModel {
	var $name = 'Employer';
	var $displayField = 'name';

	var $hasMany = array(
		'Job' => array(
			'className' => 'Job',
			'foreignKey' => 'employer_id',
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

	var $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'Please enter employer name.'
		)
	);
	
	function beforeValidate() {
		if (!empty($this->data['Employer']['name'])) {
			App::import('Sanitize');
			$this->data['Employer']['name'] = Sanitize::html($this->data['Employer']['name'], array('remove' => true));
		}	
		return true;
	}
	
	function getEmployerWithName($name) {
		return $this->findByName($name);
	}
	
	function createEmployer($data) {
		$employer = $this->getEmployerWithName($data['Employer']['name']);
		if (empty($employer)) {
			$this->create();
			if ($this->save($data)) {
				$employer = $this->getWithId($this->id);
			}
		}
		return $employer;
	}
    
    function getAutocomplete($term, $limit = 1) {
        $employers = $this->find('list', array(
            'conditions' => array(
                'Employer.name LIKE' => $term . '%'
            ),
            'limit' => $limit
        ));
        return array_values($employers);
    }
}
