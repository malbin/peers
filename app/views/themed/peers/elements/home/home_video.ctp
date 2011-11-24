<div class="icur5 irgbaform form-container">
		<div class="wrapper irgbawrapper icur3 video-wrapper">
			<div href="#" id="video-container" class="iform">
				 <iframe id="player_1" src="http://player.vimeo.com/video/30567628?api=1&amp;player_id=player_1&amp;autoplay=0" width="936" height="433" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>
			</div>
		</div>
</div>

<?php
echo $this->Html->script(array('lib/vimeo'));
?>
 <script>
$(document).ready(function(){
	var vimeoPlayers = document.querySelectorAll('#player_1'), player;
	for (var i = 0, length = vimeoPlayers.length; i < length; i++) {
		player = vimeoPlayers[i];
		$f(player).addEvent('ready', ready);
	}

	function addEvent(element, eventName, callback) {
		if (element.addEventListener) {
			element.addEventListener(eventName, callback, false);
		}
		else {
			element.attachEvent(eventName, callback, false);
		}
	}

	function ready(player_id) {
		var container = document.getElementById(player_id).parentNode.parentNode,
		froogaloop = $f(player_id);
		function onFinish() {
			froogaloop.addEvent('finish', function(data) {
				$('#homepage .form-container > .video-wrapper').css({'-moz-box-shadow':'none','-webkit-box-shadow':'none','box-shadow':'none'});
				$('#video-container').fadeOut(300);
				$('#invitation').animate({marginTop:'-40px',marginBottom:'110px'},500);
			});
		}
		onFinish();
	}

});
</script>
