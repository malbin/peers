
<div id="sign-in">
	<?php echo $this->Form->create('User', array('controller' => 'users', 'action' => 'login'));?>
	<fieldset>	
		<?php
			echo $this->Form->input('email', array('div' => false, 'label' => false,  'placeholder' => 'Email', 'id' => 'signin-email'));
			echo $this->Form->input('password', array('div' => false, 'label' => false,  'placeholder' => 'Password', 'id' => 'signin-pass'));
			echo $this->Form->Submit('Login', array('div' => false, 'id'=>'signin-submit'));
		?>

		<div id="remember-and-forgot">
			<?php
			echo $this->Form->checkbox('remember_me', array('id' => 'remember-me'));
			echo $this->Form->label('remember_me', 'Remember', array('for' => 'remember-me'));
			?>
			<a href="#" class="forgot">Forgot Password?</a>
		</div>
		</fieldset>
	<?php echo $this->Form->end();?>
</div>
<?php echo $this->element('home/forgot_password'); ?>
