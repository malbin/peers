function mobile_tooltip_init(){
	$('#what-is-this-lightbox').position({
	  my: "center bottom",
	  at: "center top",
	  of: "#what-is-this"
	});
	
	// mobile_tooltip_show();
	
	$('body').click(function(){
		mobile_tooltip_hide();
	});	
}

function mobile_tooltip_hide(){
	$('#what-is-this-lightbox.open').fadeOut(300,function(){
		$(this).removeClass('open');
	});
}
function mobile_tooltip_show(){
	$('#what-is-this-lightbox').fadeIn(300,function(){
		$(this).addClass('open');
	});
}


$(document).ready(function() {
	$(window).resize(function () {
		resizePanel();
	});
	resizePanel();
	
	mobile_tooltip_init();
	
	$('#what-is-this').click(mobile_tooltip_show);
	
// MASKED INPUT FOR MOBILE
	$('#mobile-number').mask('(999) 999 9999',{
		placeholder: " ",
		completed: null
	});
	
// SUBMIT
	$("#signup-mobile").live("submit", function(e) { 
		formSubmitPhoneNumber(this);
		e.preventDefault();
	});
	
	$("#signup-form-details").live("submit", function(e) {
		formSubmitDetails(this);
		e.preventDefault();
	});
	
	$("#signup-form-activation").live("submit", function(e) {
		formSubmitVerificationCode(this);
		e.preventDefault();
	});
	
	$('#activation-update-phone').live('blur', function(e) {
		formSubmitUpdatePhone($("#form-update-phone"));
	});
	
// CLICK
	$("#goto-prev").live('click',function(e) {
		e.preventDefault();
	});
	
	$("#goto-next").bind('click', function(e) {
		e.preventDefault();
	});
	
	
// FOCUS
	$("#mobile-number").live('focus', function(e) {
		SignUpView.hideError($('#mobile-number'));
	});
	
	$('input[name="data[User][first_name]"]').live('focus', function(e) {
		SignUpView.hideError($(this));
	});
	$('input[name="data[User][last_name]"]').live('focus', function(e) {
		SignUpView.hideError($(this));
	});
	$('input[name="data[User][email]"]').live('focus', function(e) {
		SignUpView.hideError($(this));
	});
	$('input[name="data[User][password]"]').live('focus', function(e) {
		SignUpView.hideError($(this));
	});
	$('input[name="data[Employer][name]"]').live('focus', function(e) {
		SignUpView.hideError($(this));
	});
	$('input[name="data[Job][title]"]').live('focus', function(e) {
		SignUpView.hideError($(this));
	});
	$('input[name="data[Job][salary]"]').live('focus', function(e) {
		SignUpView.hideError($(this));
	});
	$('input[name="data[Job][start_date]"]').live('focus', function(e) {
		SignUpView.hideError($(this));
	});
	
	$('input[name="data[AuthCode][code]"]').live('focus', function(e) {
		SignUpView.hideError($(this));
	});
	
});


function formSubmitPhoneNumber(form) {
	SignUpView.hideError($('#mobile-number'));
	
	// var data = $(form).serialize();
	// Serialize wont work properly with the input mask plugin, manually building up data
	
	var data = 'data[User][phone]='+$("#mobile-number").mask();
	
	PR.Validation.validate(data, 
		function(result) {
			if (result.validation.User.valid) {	
				// var number = $("#mobile-number").val();	
				// changed from val() to mask() to allow sending of unmasked input
				var number = $("#mobile-number").mask();	
				$("#phone-placeholder").val(number);
				$("#UserPhone").val(number);
				$('#activation-update-phone').val(number);
				SignUpView.switchToPanel("mobile", "details");
			} else {
				var message = result.validation.User.errors.phone;
				var field = $('#mobile-number');
				SignUpView.showError(field, message);
			}
		}
	);
}

function formSubmitDetails(form) {
	var data = $(form).serialize();
	var code = SIGNUP_CODE;
	var formFileds = SignUpView.detailsFormFields;
	
	SignUpView.hideDetailFromFieldsErrors();
	
	PR.User.signup(code, data,
		function(result) {
			// Validate both passwords
			var password = $('input[name="data[User][password]"]').val();
			var confirm_password = $('input[name="data[User][verify_password]"]').val();
			if (password != confirm_password) {
				result.form_result.success = false;
				result.form_result.errors["User"]["verify_password"] = "Doesn't match password";
			}

			if (result.form_result.success) {
				SignUpView.switchToPanel("details", "activation");
			} else {
				SignUpView.showDetailFromFieldsErrors(result.form_result.errors);
				SignUpView.scrollToFirstError(-40);
			}
		}
	);
}

function formSubmitVerificationCode(form) {
	SignUpView.hideError($('input[name="data[AuthCode][code]"]'));
	
	var data = $(form).serialize();
	PR.AuthCode.verify(data, function(result) {
		if (result.form_result.success) {
			window.location = BASEURL + 'dashboard'; 
		} else {
			var message = "Invalid code. Please try again";
			var field = $('input[name="data[AuthCode][code]"]');
			SignUpView.showError(field, message);
		}
	});
}

function formSubmitUpdatePhone(form) {
	var data = $(form).serialize();
	SignUpView.hideError($('#activation-update-phone'));
	
	PR.User.update_phone(data, 
		function(result) {
			if (!result.form_result.success) {
				var message = result.form_result.errors.User.phone;
				var field = $('#activation-update-phone');
				SignUpView.showError(field, message);
			}
		}
	);
}

var SignUpView = (function(){
// Private	
	var detailsFormFields = {
		User : ["first_name", "last_name", "email", "password", "verify_password"],
		Employer : ["name"],
		Job : ["title", "salary", "start_date"]
	};
	
	function transition(panel){
		$('body').scrollTo(0, 800);	
		$('#signup-form').scrollTo($('#signup-panel-'+panel), 800);	
	}
	
	function disableNav(nav){
		$(nav).addClass('disabled');
	}
	
	function enableNav(nav){
		if($(nav).hasClass('disabled')){
			$(nav).removeClass('disabled')
		}
	}
	
	function showFieldsErrors(fields, errors) {
		for (var section in fields) {
			for(var i=0; i < fields[section].length;  i++ ) {
				var value = fields[section][i];
				if (errors[section][value]) {
					var message = errors[section][value];
					var field =  $('input[name="data['+section+']['+value+']"]');
					SignUpView.showError(field, message);
				}
			}
		}
	}
	
	function hideFieldsErrors(fields) {
		for (var section in fields) {
			for(var i=0; i < fields[section].length;  i++ ) {
				var value = fields[section][i];
				var field =  $('input[name="data['+section+']['+value+']"]');
				SignUpView.hideError(field);
			}
		}
	}
	
	function animateProgressBar(from, to) {
		if(from == 'mobile' && to == 'details'){	
			$(".progress-step-two").css({'left':'-6px'}).fadeOut(0);
			$(".progress-step-two span").removeClass("progress-inactive").addClass("progress-pre");
			$(".progress-step-one").animate({'left':'160px'}, function(){
				$(".progress-step-two").fadeIn();
			});
		} else if(from == 'details' && to == 'activation'){
			$(".progress-step-three").css({'left':'160px'}).fadeOut(0);
			$(".progress-step-three span").removeClass("progress-inactive").addClass("progress-pre");
			$(".progress-step-one").animate({'left':'325px'}, function(){
				$(".progress-step-three").fadeIn();
			});
		} else if(from == 'activation' && to == 'details'){
			$(".progress-step-three").css({'left':'325px'}).fadeOut(0);
			$(".progress-step-three span").removeClass("progress-pre").addClass("progress-inactive");
			$(".progress-step-one").animate({'left':'160px'}, function(){
				$(".progress-step-three").fadeIn();
			});
		} else if(from == 'details' && to == 'mobile'){
			$(".progress-step-two").css({'left':'160px'}).fadeOut(0);
			$(".progress-step-two span").removeClass("progress-pre").addClass("progress-inactive");
			$(".progress-step-one").animate({'left':'-6px'}, function(){
				$(".progress-step-two").fadeIn();
			});
		}
	}
	
	function animatePanel(from, to) {
		transition(to);
	}

// Public
	return {		
		switchToPanel : function(from, to) {
			animateProgressBar(from, to);
			animatePanel(from, to);
		},
		showError : function(element, message) {
			element.validationEngine('showPrompt', message);
			element.addClass('error');
		},
		hideError : function(element) {
			element.validationEngine('hide');
			element.removeClass('error');
		},
		showDetailFromFieldsErrors : function(errors) {
			showFieldsErrors(detailsFormFields, errors);
		},
		hideDetailFromFieldsErrors : function() {
			hideFieldsErrors(detailsFormFields);
		},
		scrollToFirstError : function(marginTop, marginLeft) {
			// get the position of the first error, there should be at least one, no need to check this
		    //var destination = form.find(".formError:not('.greenPopup'):first").offset().top;
			if (!marginTop) marginTop = 0;
			if (!marginLeft) marginLeft = 0;
			
		    // look for the visually top prompt
		    var destination = Number.MAX_VALUE;
		    var fixleft = 0;
		    var lst = $(".formError:not('.greenPopup')");
		    
		    for (var i = 0; i < lst.length; i++) {
		        var d = $(lst[i]).offset().top + marginTop;
		        if (d < destination){
		            destination = d;
		            fixleft = $(lst[i]).offset().left + marginLeft;
		        }
		    }	
		
		    $("html:not(:animated),body:not(:animated)").animate({
		        scrollTop: destination,
		        scrollLeft: fixleft
		    }, 1100);
		}
	};
})();


function resizePanel() {
	width = $(window).width();
	height = $(window).height();
	mask_width = width * 3;

	$('.slide-container').css({width: width});
	$('#wrapper-mask').css({width: mask_width});
}

