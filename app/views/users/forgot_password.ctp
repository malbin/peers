<?php html_comment('users/forgot_password.ctp'); ?>

<?php //debug($this->data); // Uncomment for form data dump ?>

<?php __('FORGOT PASSWORD');?><br/>

<div class="reset_password form">
<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'forgot_password')));?>
	<fieldset>
		<legend><?php __('Forgot password'); ?></legend>
	<?php
		echo $this->Form->input('email');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>