$(document).ready(function(){

	$('#back-to-site, #close-app-invt').live('click',function(){
		$('#lightbox-invite-sent').fadeOut(500).addClass('closed');
	});
	
	$('#lightbox-invite-sent #mask').click(function(){
		if($('#lightbox-invite-sent #app-invt:hover').length == 0){
			$('#lightbox-invite-sent').addClass('closed').fadeOut(200);
		}
	});
	
	$('#SiteInviteEmail').bind('blur',function(){
		if($('body').hasClass('error')){
			if(validate_email($('#SiteInviteEmail').attr('value'))){
				$('body').removeClass('error');
			}
		}
	});
});

function request_invite(){
	if(validate_email($('#SiteInviteEmail').attr('value'))){
		if($('#SiteInviteName').attr('value') != ''){
			$.ajax({
				url: BASEURL + "/site_invites/index?output=json&ajax=true",
				type: "POST",
				data: $(document.invite).serialize(),
				dataType: 'json',
				success: function(data){
					if(data.form_result.success){
						$('#lightbox-invite-sent').fadeIn(500).removeClass('closed');
					}
				}
			});
		} else{
			$('body').addClass('error').addClass('error-name');
		}
	} else{
		$('body').addClass('error').removeClass('error-name');
	}

	return false;
}