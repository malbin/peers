<?php
class SiteInvite extends AppModel {
	const STATUS_ACCEPTED = 'accepted';
	const STATUS_EXPIRED = 'expired';
	const STATUS_PENDING = 'pending';
	const STATUS_SENT = 'sent';
	
	var $name = 'SiteInvite';
	var $displayField = 'name';

	var $belongsTo = array(
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
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
		)
	);
	
	var $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please provide your first name'
			)
		),
		'email' => array(
			'email' => array(
				'rule' => 'email',
				'message' => 'Please enter valid email address'
			)
		)
	);

	function beforeValidate() {
		if (!empty($this->data['SiteInvite']['name'])) {
			App::import('Sanitize');
			$this->data['SiteInvite']['name'] = Sanitize::html($this->data['SiteInvite']['name'], array('remove' => true));
		}	
		return true;
	}
	
	function beforeSave() {
		if (!empty($this->data) && $this->id < 1) {
			$email = $this->data['SiteInvite']['email'];
			$this->data['SiteInvite']['code'] = $this->getCodeForEmail($email);
            if (empty($this->data['SiteInvite']['user_id'])) {
                $requestInviteDelay = Configure::read('App.RequestInviteDelayInSeconds');
                $this->data['SiteInvite']['scheduled_time'] = date('Y-m-d H:i:s', strtotime("+{$requestInviteDelay} seconds"));
            } else {
                $this->data['SiteInvite']['scheduled_time'] = null; // Send Immediately
            }
		}
		return true;
	}
	
	function createSiteInvite($data) {
		$this->create();
		return $this->save($data);
	}
	
	function getSiteInviteWithCode($code) {
		return $this->find('first', array('conditions' => array('code' => $code)));
	}
    
    function getPendingScheduledInvites() {
        return $this->find('all', array(
            'conditions' => array(
                array(
                    'SiteInvite.status' => self::STATUS_PENDING,
                    'or' => array(
                        'SiteInvite.scheduled_time' => null,
                        'SiteInvite.scheduled_time <=' => date('Y-m-d H:i:s')
                    ),
                ),
            )
        ));
    }
	
	function getCodeForEmail($email) {
		$seed = 0;
		do {
			$codeStr = md5($email . time() . $seed++);
			$code = $this->getSiteInviteWithCode($codeStr);
			$unique = !empty($code);
		} while($unique);
		return $codeStr;
	}
	
}
