<?php html_comment('users/edit.ctp'); ?>

<?php //debug($this->data); //Uncomment for form data dump ?>

<?php __('EDIT PROFILE'); ?><br/>

<?php 
	echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'edit')));
		
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('email');		
		echo $this->Form->input('phone');
		echo $this->Form->select('phone_carrier', $phone_carriers, 
			array(
				'label' => __('Carrier'), 
				'selected' => isset($this->data['User']['phone_carrier']) ? $this->data['User']['phone_carrier'] : ''
			)
		);

		echo $this->Form->input('birthdate', array(
			'dateFormat' => 'Y', 
			'minYear' => (date('Y') - 90), 
			'maxYear' => (date('Y') - 10))
		);

		echo $this->Form->input('gender');
		
 	echo $this->Form->end(__('Save', true));
?>

<?php __('CHANGE PASSWORD'); ?> <br/>

<?php
	echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'edit')));
	
		echo $this->Form->input('current_password', array('type' => 'password', 'value' => ''));
		echo $this->Form->input('password', array('type' => 'password', 'value' => ''));
		echo $this->Form->input('verify_password', array('type' => 'password', 'value' => ''));
		
	echo $this->Form->end(__('Change', true));
?>
