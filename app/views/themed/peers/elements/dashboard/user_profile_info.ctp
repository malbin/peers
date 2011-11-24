<p class="profile-text">profile</p>
<div class="profile-block">
	<?php echo $this->Form->create('User.edit', array('id' => 'user-edit-form', 'url' => array('controller' => 'users', 'action' => 'edit'))); ?>
	
    <div class="profile-info-cover profile-info-name">
		<?php echo $this->Form->input('User.first_name', array('id' => 'profile-user-name', 'label' => false, 'value' => $user['first_name'] . ' ' . $user['last_name'], 'div' => false, 'class' => 'validate[required]', 'disabled' => 'true')); ?>
		<span class="profile-edit-icon">&nbsp;</span>
	</div>
	
	<div class="profile-info-cover">
		<?php echo $this->Form->input('User.email', array('id' => 'profile-user-email', 'class' => 'validate[required,custom[email]]', 'label' => 'Email:', 'value' => $user['email'], 'div' => false,'disabled' => 'true')); ?> 
		<span class="profile-edit-icon">&nbsp;</span>
	</div>
	
	<div class="profile-info-cover profile-info-tel">
		<?php echo $this->Form->input('User.phone', array('id' => 'profile-user-tel', 'label' => 'Telephone:', 'value' => $user['phone'], 'div' => false, 'alt' => 'phone-us', 'disabled' => 'true')); ?> 
		<span class="profile-edit-icon">&nbsp;</span>
	</div>
	
	<div class="profile-info-cover profile-info-pass">
		<?php echo $this->Form->input('User.password', array('id' => 'profile-user-password', 'label' => 'Password:', 'div' => false, 'class' => 'validate[required,minSize[6],maxSize[15]]', 'value' => 'secret', 'disabled' => 'true')); ?> 
		<span class="profile-edit-icon">&nbsp;</span>
	</div>
    
    <div class="profile-info-cover profile-info-confirm-pass">
		<?php echo $this->Form->input('User.confirm_password', array('id' => 'profile-user-confirm-password', 'type' => 'password', 'label' => 'Confirm:', 'div' => false, 'class' => 'validate[required,minSize[6],maxSize[15],equals[profile-user-password]]')); ?> 
	</div>
		
	<?php echo $this->Form->end(); ?>

</div>


<script type="text/javascript">
var u_email = '<?= $user['email'] ?>';
var u_phone = '<?= $user['phone'] ?>';
var u_name = '<? echo $user['first_name'].' '.$user['last_name'] ?>';
	$(document).ready(function(){
		$('#user-edit-form').validationEngine({
			validationEventTrigger:'blur',
			promptPosition : 'topRight'
		});
		
		// trigger update of field on pressing enter key
		$('#user-profile input').bind('keypress', function(e) {
			var code = (e.keyCode ? e.keyCode : e.which);
		 	if(code == 13) { //Enter keycode
		   	$(this).trigger('blur');
		 	}
		});
		
		// trigger focus on pressing edit icon
		$('.profile-edit-icon').bind('click',function(){
			$(this).siblings('input').removeAttr('disabled').trigger('focus')
		});

		function build_post_data(input_field){
			var data = '';
			if(input_field.attr('id') == 'profile-user-name'){
				fullname = input_field.attr('value');
				var name_arr = fullname.split(" ");
				if(/^(?:Dr|Mr|Mrs|Miss|Master|etc)\.?$/.test(name_arr[0])) {
					name_arr.shift();
				}
				data = "data[User][first_name]=" + name_arr[0] + "&data[User][last_name]=" + name_arr[name_arr.length - 1];
			} else if(input_field.attr('id') == 'profile-user-tel'){
				data = input_field.attr('name')+'='+input_field.mask();
			} else{
				data = input_field.attr('name')+'='+input_field.attr('value');
			}
			return data;
		}
	});


	function update_user(resend){
		if(typeof resend == undefined){
			resend = false;
		}
	
		form = $('#UserEditForm');
		$.ajax({
			url: form.attr('action')+"?output=json&ajax=true",
			type: "POST",
			data: form.serialize(),
			dataType: 'json',
			success: function(data){
				if(resend == true){
					resend_code();
				}
			}
		});
		return false;
	}
</script>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
	
	// 	for autoresizing the input fields so that the edit icon appear next to text
		$('#user-edit-form input[type="text"], #user-edit-form input[type="password"]').bind('blur init',function(){
			$(this).attr('size',$(this).val().length);
			$(this).css('width','auto');
		}).trigger('init');
		
		$('#user-edit-form input[type="text"], #user-edit-form input[type="password"]').bind('focus',function(){
			$(this).val($(this).data('original'));
			$(this).removeAttr('style');
		});
		
		$('#profile-user-email').truncate_email();
	});
</script>