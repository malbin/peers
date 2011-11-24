(function($){

	$.confirm = function(params){

		if($('#confirmOverlay').length){
			// A confirm is already shown on the page:
			return false;
		}

		var buttonHTML = '';
		$.each(params.buttons,function(name,obj){

			// Generating the markup for the buttons:

			buttonHTML += '<a href="#" class="button '+obj['class']+'">'+name+'<span></span></a>';

			if(!obj.action){
				obj.action = function(){};
			}
		});

		var markup = [
			'<div id="confirmOverlay">',
			'<div id="confirmBox">',
			'<div id="confirmBody">',
			'<h1>',params.title,'</h1>',
			'<p>',params.message,'</p>',
			'<div id="confirmButtons">',
			buttonHTML,
			'</div></div></div></div>'
		].join('');

		$(markup).hide().appendTo('body').fadeIn();

		var buttons = $('#confirmBox .button'),
			i = 0;

		$.each(params.buttons,function(name,obj){
			buttons.eq(i++).click(function(){

				// Calling the action attribute when a
				// click occurs, and hiding the confirm.

				obj.action();
				$.confirm.hide();
				return false;
			});
		});
	}

	$.confirm.hide = function(){
		hide_confirm_dialog();
	}

	$('#confirmOverlay').live('click',function(){
		if($('#confirmBody:hover').length == 0){
			hide_confirm_dialog();
		}
	});
	
	// checks if esc key is pressed. to dismiss all lightboxes
	$(document).keyup(function(e) {
		if (e.keyCode == 27 && $('#confirmOverlay').length != 0){
			hide_confirm_dialog();
		}
	});
			
	function hide_confirm_dialog(){
		$('#confirmOverlay').fadeOut(function(){
			$(this).remove();
		});
	}
})(jQuery);