<?php html_comment('users/signup.ctp'); ?>

<?php //debug($this->data); // Uncomment for form data dump ?>

<?php __('SIGNUP'); ?><br/>

<?php 
	echo $this->Form->create('User', array('url' => '/signup/?code='.$code, 'id' => 'UserSignupForm'));
	 
		echo $this->Form->input('phone');
		echo $this->Form->select('phone_carrier', $phone_carriers, 
			array(
				'label' => __('Carrier'), 
				'selected' => isset($this->data['User']['phone_carrier']) ? $this->data['User']['phone_carrier'] : ''
			),
			array(
			 	'empty' => false
			)
		);
		
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('birthdate', array(
			'dateFormat' => 'Y', 
			'minYear' => (date('Y') - 90), 
			'maxYear' => (date('Y') - 10))
		);
		
		echo $this->Form->input('gender');
		echo $this->Form->input('email');
		echo $this->Form->input('password', array('value' => ''));
		echo $this->Form->input('verify_password', array('type' => 'password', 'value' => ''));
	 
		echo $this->Form->input('Employer.name', array('label' => __('Company name', true)));
		echo $this->Form->input('Job.title', array('label' => __('Job title', true)));
		echo $this->Form->input('Job.salary',  array('label' => __('Current compensation',  true)));
		echo $this->Form->input('Job.start_date',  array('label' => __('As of...',  true)));
	
		echo $this->Form->button(__('Continue', true), array('type' => 'submit'));
	
	echo $this->Form->end();
?>
