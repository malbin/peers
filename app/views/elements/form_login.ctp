<?php html_comment('form_login.ctp'); ?>
<div class="login form">
<?php echo $this->Form->create('User', array('controller' => 'users', 'action' => 'login'));?>
	<fieldset>
		<legend><?php __('Login'); ?></legend>
	<?php
		echo $this->Form->input('email');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Login', true));?>
</div>
	