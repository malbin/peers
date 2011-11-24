<?php html_comment('reset_codes/index.ctp'); ?>

<?php //debug($this->data); // Uncomment for form data ?>
<?php //debug($code); // Uncomment for code data ?>

<h1><?php __('RESET PASSWORD'); ?></h1>
<div id="reset-password">
	<?php 
	echo $this->Form->create('User', array('url' => '/reset_password?code='.$code['ResetCode']['code']));
    echo $this->Form->input('password', array('type' => 'password', 'value' => ''));
    echo $this->Form->input('verify_password', array('type' => 'password', 'value' => ''));
 	echo $this->Form->end('Save');
 	?>
</div>