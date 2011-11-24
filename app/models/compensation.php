<?php
class Compensation extends AppModel {
	var $name = 'Compensation';
	var $displayField = 'id';

	const TYPE_SIGNING = 'Signing';
	const TYPE_PERFORMANCE = 'Performance';
	const TYPE_SEVERANCE = 'Severance';
	const TYPE_OTHER = 'Other';
	
	var $belongsTo = array(
		'Job' => array(
			'className' => 'Job',
			'foreignKey' => 'job_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $validate = array(
        'job_id' => array(
            'rule' => 'numeric',
            'message' => 'Please enter a valid Job.',
            'required' => true
        ),
		'cash' => array(
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Please enter amount in USD.',
                'allowEmpty' => false
            ),
            'cashOrDeferred' => array(
                'rule' => 'validateCashOrDeferred',
                'message' => 'Atleast one of Cash/Deferred must be entered.'
            )
		),
		'deferred' => array(
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Please enter amount in USD.',
                'allowEmpty' => false
            ),
            'cashOrDeferred' => array(
                'rule' => 'validateCashOrDeferred',
                'message' => 'Atleast one of Cash/Deferred must be entered.'
            )
		),
        'award_date' => array(
            'rule' => 'validateWithinJobDateRange',
            'message' => 'Award Date must be between the start and end date of the Job.',
            'allowEmpty' => false
        )
	);
	
	function beforeValidate() {
		if (!empty($this->data)) {
			if (self::TYPE_SIGNING == $this->data['Compensation']['type']) {
				$comp = $this->find('first', array(
					'conditions' => array(
						'job_id' => $this->data['Compensation']['job_id'],
						'type' => self::TYPE_SIGNING
					)
				));
				if (!empty($comp) && $comp['Compensation']['id'] != $this->id) {
					$this->invalidate('type', __('You cannot enter more than one signing bonus.', true));
				}
			}
            $currencyFields = array('cash', 'deferred');
            foreach ($currencyFields as $currencyField) {
                if (isset($this->data['Compensation'][$currencyField])) {
                    if (empty($this->data['Compensation'][$currencyField])) {
                        $this->data['Compensation'][$currencyField] = 0;
                    }
                    $this->data['Compensation'][$currencyField] = preg_replace('/[^0-9\.]/', '', $this->data['Compensation'][$currencyField]);
                }
            }
		}
		return true;
	}
    
    function validateWithinJobDateRange() {
        $job = $this->Job->findById($this->data['Compensation']['job_id']);
        $awardDate = strtotime($this->data['Compensation']['award_date']);
        $jobStartDate = strtotime($job['Job']['start_date']);
        $jobEndDate = strtotime($job['Job']['end_date']);
        if ($awardDate < $jobStartDate || (!empty($jobEndDate) && $awardDate > $jobEndDate)) {
            return false;
        }
        return true;
    }
    
    function validateCashOrDeferred() {
        if (empty($this->data['Compensation']['cash']) && empty($this->data['Compensation']['deferred'])) {
            return false;
        }
        return true;
    }
	
	function createCompensation($data) {
		$this->create();
		return $this->save($data);
	}
}
