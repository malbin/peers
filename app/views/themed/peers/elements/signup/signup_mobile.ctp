<form id="signup-mobile">
	<div class="wrapper irgbawrapper icur3">
		<div class="iform signup-form">
			<p class="form-text text-one">Enter Your</p>
			<p class="form-text text-two">Mobile Phone Number</p>
			<p class="form-text text-three">You will receive a free text message with your unique activation code in.</p>
				<div class="form-block">
					<?php echo $this->Form->input('User.phone',array('label'=> false, 'div'=>false, 'id'=> 'mobile-number', 'placeholder'=>'Your Mobile Number...', 'class'=> 'validate[required,custom[phone]]','alt'=>'phone-us')); ?>
				</div>
				<div class="form-block" id="form-block-two">
					<span id="what-is-this">Why do we need your phone number?</span>
					<input id="authenticate" type="submit" value="Authenticate" name="continue">
				</div>
		</div>
	</div>
</form>
<div id="what-is-this-lightbox" style="display:none">
	We will not use your number for marketing purposes
</div>