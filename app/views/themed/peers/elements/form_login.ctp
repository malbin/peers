<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){

		$('#video-container').css('display','none');

		$.confirm({
			'title'		: 'Login Failed',
			'message'	: 'Please check your email/password and try again',
			'buttons'	: {
				'Back to Site'	: {
					'action': function(){}
				}
			}
		});
	});
</script>