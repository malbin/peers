function validate_email(email){
	var regex = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i;
	return email.match(regex);
}

// @ Global
window.currency_symbol = '$';

$(function(){
    $('.currency').live('keyup', function() {
		$('.currency').formatCurrency({
            symbol: window.currency_symbol,
            roundToDecimalPlace: 0
        });
	});
	
	$('.datepicker').livequery(function(){
        $(this).datepicker({
            dateFormat: 'mm/dd/y',
            altFormat: 'yy-mm-dd',
            altField: '#' + $(this).attr('id').replace(/Display$/, '') // JobStartDateDisplay (display field) => JobStateDate (alt field, goes into db)
        });
    });
    
    $('.calendar').live('click', function(){
        if ($(this).prev().hasClass('datepicker')) {
            $(this).prev().datepicker('show');
        }
    });
    
    // Hide validation engine prompts when user cilcks anywhere on screen
    $('body').mouseup(function(){
        $('*').validationEngine('hideAll');
    });

	// checks if esc key is pressed. to dismiss all lightboxes
	// for confirmation box, added in jquery.confirm.js
	$(document).keyup(function(e) {
		if (e.keyCode == 27) {
			
			// closes add job lightbox if open
			if($('.add-job-lightbox.active').length){
				job_lightbox_close();	
			}
			
			// closes add compensation lightbox if open
			if($('.compensation-lightbox-open .add-com-button').length){
				$('.compensation-lightbox-open .add-com-button').compensation_lightbox_remove();
			}
			
			// closes invite friends lightbox
			if($('#invite-overlay').css('display')=='block'){
				$('#invite-overlay').fadeOut(200);
			}
			
			// invite sent lightbox
			if(!$('#lightbox-invite-sent').hasClass('closed')){
				$('#lightbox-invite-sent').fadeOut(200).addClass('closed');
			}
            
            $('.modal-lightbox:visible').fadeOut(200);
		}
	});
    
    $('.modal-close').click(function(){
        $('.modal-lightbox:visible').fadeOut(200);
    });
    
    $('.modal-mask').click(function(){
        if ($('.modal-body-wrapper:hover').length == 0) {
            $('.modal-lightbox:visible').fadeOut(200);
        }
    });

});

$.fn.serializeObject = function(){
	var o = {};
	var a = this.serializeArray();
	$.each(a, function() {
		if (o[this.name]) {
			if (!o[this.name].push) {
				o[this.name] = [o[this.name]];
			}
			o[this.name].push(this.value || '');
		} else {
			o[this.name] = this.value || '';
		}
	});
	return o;
};

$.fn.resetForm = function(){
	this.each(function(){
		this.reset();
        // Handling SelectBox plugin
        $(this).find('.selectbox').each(function(){
            var $select = $(this).next().next();
            $(this).next().remove();
            $(this).remove();
            $select.val('').change();
            $select.show().selectbox();
        });
	});
	return this;
}