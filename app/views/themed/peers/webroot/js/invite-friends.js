$(function(){
    // invite friends
    $('#invite-friends').click(function(){
        $('#invite-overlay').fadeIn(300);
    });

    // close the invite friends window when clicking anywhere outside
    $('#invite-friends-overlay').hover(function(){
        $(this).addClass('hover');
    },function(){
        $(this).removeClass('hover');
    });

    // close button
    $('#invite-friends-overlay .close').click(function(){
        $('#invite-overlay').fadeOut(300);
    });

    $('body').mouseup(function(){ 
        if(!$('#invite-friends-overlay').hasClass('hover')){
            $('#invite-overlay').fadeOut(300);
        }
    });
    
});

function invite_friends(){
	var flag = true;
	var invite_email = $('#invite-email').attr('value');
	var invite_name = $('#invite-fname').attr('value');
	if(!validate_email(invite_email)){
		$('#invite-email').siblings('.error').html('Please enter a valid email');	
		flag = false;
	} else{
		$('#invite-email').siblings('.error').html('');
	}

	if( invite_name == ''){
		$('#invite-fname').siblings('.error').html('Field required');	
		flag=false;
	} else{
		$('#invite-fname').siblings('.error').html('');	
	}

	if(flag){
		$('#invite-overlay').fadeOut(300);
		$.ajax({
			url: BASEURL + "/site_invites/index?output=json&ajax=true",
			type: "POST",
			data: {
				'data[SiteInvite][country_id]':'1',
				'data[SiteInvite][email]':invite_email,
				'data[SiteInvite][name]':invite_name
			},
			dataType: 'json',
			success: function(data){
                $('#invite-friends-form').resetForm();
			}
		});
	}
	return false;
}