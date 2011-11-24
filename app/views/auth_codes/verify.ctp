
<div>
	<div>Hi <?php echo $logged_user['User']['first_name'];?></div>
	<p>We've sent you verification code to your phone number</p>
	
	<?php echo $this->Html->link(__('Resend auth code', true), array('controller' => 'users', 'action' => 'resend_auth_code')); ?>
	
	<?php 
		echo $this->Form->create('AuthCode', array('controller' => 'AuthCodes', 'action' => 'verify'));
			echo $this->Form->input('code', array('legend' => 'Verificaton Code'));
			echo $this->Form->button(__('Submit', true), array('type' => 'submit'));
		echo $this->Form->end();
	?>
</div>
