<div class="wrapper irgbawrapper icur3">
	<div class="iform signup-form">
		<p class="form-text text-one">Welcome</p>
		<p class="form-text text-two" id="screen-name"><?php echo $this->viewVars['logged_user']['User']['first_name']; ?></p>

			<?php echo $this->Form->create('User',array('controller' => 'User', 'action'=>'edit', 'id' => 'form-update-phone')); ?>
			<div class="form-block border-double">
				<p class="code-sent">We have sent your activation code to</p>

				<?php echo $this->Form->input('User.phone', array('id' => 'activation-update-phone', 'div'=>false, 'class'=>'text validate[required,custom[number]]', 'label'=>false, 'class'=>'activation-contact-number', 'value'=>$this->viewVars['logged_user']['User']['phone'])); ?>

				<p class="code-sent">Please check your phone and enter your code:</p>
			</div>
			<?php echo $this->Form->end(); ?>

			<?php echo $this->Form->create('AuthCode',array('controller' => 'auth_code', 'action'=>'verify', 'id' => 'signup-form-activation')); ?>
			<div class="form-block border-bottom" id="form-block-code">
				<?php echo $this->Form->input('AuthCode.code', array('div'=>false, 'class'=>'text validate[required,custom[number]]', 'label'=>'Activation Code','id'=>'activation-code')); ?>
				<input id="activation-submit" type="submit" value="Submit" name="continue">
				<ol class="resend-links">
					<li id="resend-code" class="link"><a style="color: #A49F9A;" href="<?php echo Router::url('/users/resend_auth_code', true);?>">Resend Code</a></li>
				</ol>
			</div>
			<?php echo $this->Form->end(); ?>
	</div>
</div>
