$(document).ready(function(){
    // add compensation
	$('#CompensationIndexForm').validationEngine({
		validationEventTrigger:'submit',
		promptPosition : 'topRight',
		scroll: false
	});
	
	// prevents the add-job dialogue from closing when a date is selected
	$('#ui-datepicker-div').live('hover',function(){
		$('.add-job-lightbox').addClass('hover');
	});
});

function add_compensation(){
	var form = $('#CompensationIndexForm');
    
    if (form.validationEngine('validate')) {
		$.ajax({
			url: form.attr('action')+"?output=json&ajax=true",
			type: "POST",
			data: form.serialize(),
			dataType: 'json',
			success: function(data){
				if(!data.form_result.success){
					for (var key in data.form_result.errors) {
                        var field = null;
                        if (key == 'type') {
                            field = $('#CompensationType_input');
                        } else if (key == 'award_date') {
                            field = $('#CompensationAwardDateDisplay');
                        } else {
                            field = form.find('*[name="data\\[Compensation\\]\\[' + key + '\\]"]');
                        }
                        if (field.length != 0) {
                            field.validationEngine('showPrompt', data.form_result.errors[key]);
                        }
                    }
				} else {
					load_compensation(data.compensation_id);
                    showMyBoards();
				}
			}
		});
	}
	return false;
}

function load_compensation(id){
	var container = $('#profile-jobs .compensation-lightbox-open').parent();
	$.ajax({
		url: BASEURL + 'compensations/view/'+id+'/?ajax=true',
		type: "GET",
		dataType: 'html',
		success: function(data){
			container.append(data);
			$(this).compensation_lightbox_remove();
            $('#CompensationIndexForm').resetForm();
		}
	});
}


// user profile employment
$(document).ready(function(){
	
	// add compensation, dropdown
	$('#add-compensation-lightbox #CompensationType').selectbox();
	
	$('#profile-jobs .add-compansation .add-com-button').live('click',function(){

		// toggles, if lightbox is already open, then closes it	
		if($(this).parent().hasClass('compensation-lightbox-open')) {
			$(this).compensation_lightbox_remove();
		} else {
			$(this).compensation_lightbox_attach();
		}
	});
	
	$("body").mouseup(function(event){ 
        var $target = $(event.target);
        if ((!$target.is('#add-compensation-lightbox') && $target.parents('#add-compensation-lightbox').length == 0) &&
            (!$target.is('#ui-datepicker-div') && $target.parents('#ui-datepicker-div').length == 0) && (!$target.is('.compensation-lightbox-open .add-com-button'))) {
			$(this).compensation_lightbox_remove();
		}
	});
	
	// accordian
	$('#profile-jobs').accordion({
		collapsible: true,
		header: '.profile-header',
		autoHeight: false
	});
	
	// remove job
	$('.profile-block .remove-job').live('click', function(e){
        var $profileJobs = $('#profile-jobs');
		$profileJobs.accordion("disable");
        var current_job = $(this).parents('.profile-block').addClass('job-removed').attr('id');
        current_job = current_job.replace('job-','');

        var data = {'data[Job][id]':current_job, '_method':'DELETE'};

        PR.Job.del(data,
            function(result) {
                if(result.form_result.success){
                    $('.job-removed').slideUp(300,function(){
                        $(this).remove();
                        if ($profileJobs.children('.profile-block').length == 0) {
                            $("#no-jobs").fadeIn(function(){$("#no-jobs").show();});
                        }
                        $profileJobs.accordion("enable");
                        showMyBoards();
                    });
                } else {
                    alert("something went wrong, unable to delete job");
                }
            }
        );
        e.preventDefault();
	});
    
	// Mask Telephone Input
	// switched to a different & more efficient plugin @TC
	$('#profile-user-tel').mask('(999) 999 9999',{
		placeholder: " ",
		completed: null
	});
});

$.fn.compensation_lightbox_attach = function(){
	$('.compensation-lightbox-open').removeClass('compensation-lightbox-open');

	var lightbox = $('#add-compensation-lightbox').detach();

	$(this).parent().addClass('compensation-lightbox-open').after(lightbox);
	var job_id = $(this).siblings(".job-id").attr('value');
	$('#add-compensation-lightbox').find('form').attr('action',BASEURL+'compensations/add/'+job_id)
	$('#add-compensation-lightbox').css('display','block');
	return $(this);
}

$.fn.compensation_lightbox_remove = function(){
	$('.compensation-lightbox-open').removeClass('compensation-lightbox-open');
	$('#add-compensation-lightbox').css('display','none');
	return $(this);
}


// Add Job

$(document).ready(function(){
	$('#add-job-button').click(function(){
		if(!$(this).hasClass('job-lightbox-open')){
			job_lightbox_open();
		}
	});
	
	$('.add-job-lightbox').hover(function(){
		$(this).addClass('hover');
	}, function(){
		$(this).removeClass('hover');
	});
	
	$("body").mouseup(function(){ 
		if(!$('.add-job-lightbox.active').hasClass('hover')){
			job_lightbox_close();
		}
	});

	$('.add-job-lightbox').find('form').validationEngine({
		validationEventTrigger:'submit',
		promptPosition : 'topRight'
	});
    
    $('#add-job-for-board').live('click', function(){
        $.scrollTo('#user-profile', 'slow', function(){
           $('#add-job-button').click(); 
        });
    });
});

function job_lightbox_close(){
	$('.add-job-xpand-stndrd').fadeOut(200,function(){
		$(this).removeClass('active');
		$('#add-job-button').removeClass('job-lightbox-open');
	});
	
}
function job_lightbox_open(){
	$('.add-job-xpand-stndrd').fadeIn(100,function(){
		$(this).addClass('active');
		$('#add-job-button').addClass('job-lightbox-open');
	});
}

function add_job(){
	var form = $('.add-job-lightbox.active').find('form');

	if(form.validationEngine('validate')){
		$.ajax({
			url: form.attr('action')+"?output=json&ajax=true",
			type: "POST",
			data: form.serialize(),
			dataType: 'json',
			success: function(data){
				if(!data.form_result.success){
					for (var model in data.form_result.errors) {
						for (var key in data.form_result.errors[model]) {
							var field = null;
							if (model == 'Job' && key == 'start_date') {
								field = $('#JobStartDateDisplay');
							} else {
								field = form.find('*[name="data\\[' + model + ']\\[' + key + '\\]"]');
							}
							if (field.length != 0) {
								field.validationEngine('showPrompt', data.form_result.errors[model][key]);
							}
						}
					}
				} else {
					refresh_jobs();
					job_lightbox_close();
					form.resetForm();
                    showMyBoards();
				}
			}
		});
	}
	return false;
}

function refresh_jobs(){
	var container = $('#profile-jobs');
	$.ajax({
		url: BASEURL + 'jobs/index/?ajax=true',
		type: "GET",
		dataType: 'html',
		success: function(data){
			container.accordion('destroy');
			container.html(data);
			container.accordion({
				collapsible: true,
				header: '.profile-header',
				autoHeight: false
			});
			$('body').trigger(resize);
		}
	});
}

// Profile Info

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
		var input_field = $(this).siblings('input');
		input_field.removeAttr('disabled').trigger('focus');
		if (input_field.attr('id') == 'profile-user-password') {
			input_field.val('');
		}
	});

	// Store original values in case of reset
	$('#user-edit-form input').each(function(){
		$(this).data('original', $(this).val());
	});

	$('#user-edit-form input').bind('blur',function(){
		var form = $(this).parents('form');
		var input_field = $(this);

		// If blank, reset the value
		if (input_field.val() == '') {
			if (input_field.attr('id') == 'profile-user-confirm-password') {
				input_field.attr('disabled', 'true').parent().hide();
				$('#profile-user-password').val($('#profile-user-password').data('original')).parent().show();
			}
			input_field.val(input_field.data('original')).attr('disabled', 'true');

		} else if (input_field.val() == input_field.data('original') && input_field.attr('id') != 'profile-user-password') {
			input_field.attr('disabled', 'true');
			
			if (input_field.attr('id') == 'profile-user-email') {
				input_field.truncate_email();
			}

		} else if ( !form.validationEngine('validateField', '#'+input_field.attr('id')) ){
			// Special Case: Password - Show Confirm Password Field
			if (input_field.attr('id') == 'profile-user-password') {
				input_field.attr('disabled', 'true').parent().hide();
				$('#profile-user-confirm-password').removeAttr('disabled').val('').parent().show().focus();

				return false;
			} else if (input_field.attr('id') == 'profile-user-confirm-password') {
				$.ajax({
					url: form.attr('action')+"?output=json&ajax=true",
					type: "POST",
					data: build_post_data(input_field),
					dataType: 'json',
					success: function(data){
						// console.log(data);
						if(!data.form_result.success){
							input_field.validationEngine('showPrompt', 'Update failed');
						} else {
							$(input_field).validationEngine('hidePrompt');
							$('#profile-user-password').val($('#profile-user-password').data('original')).parent().show().attr('disabled','true');
							$('#profile-user-confirm-password').parent().hide();

							$.confirm({
								'title'		: 'Save Profile',
								'message'	: 'Your password has been successfully updated',
								'buttons'	: {
									'OK'	: {
										'action': function(){

										}
									}
								}
							});

						}
					}
				});
			} else{
				$.confirm({
					'title'		: 'Save Profile',
					'message'	: 'Do you want to save changes to profile?',
					'buttons'	: {
						'Yes'	: {
							'class'	: 'blue',
							'action': function(){
								$.ajax({
									url: form.attr('action')+"?output=json&ajax=true",
									type: "POST",
									data: build_post_data(input_field),
									dataType: 'json',
									success: function(data){
										// console.log(data);
										if(!data.form_result.success){
											input_field.validationEngine('showPrompt', 'Update failed');
										} else {
											$(input_field).validationEngine('hidePrompt');
											input_field.data('original', input_field.val());

											if (input_field.attr('id') == 'profile-user-name') {
												showMyBoards();
											}
											if (input_field.attr('id') == 'profile-user-email') {
												input_field.truncate_email();
											}
										}
									}
								});
							}
						},
						'No'	: {
							'class'	: 'gray',
							'action': function(){
								if (input_field.attr('id') == 'profile-user-confirm-password') {
									input_field.attr('disabled', 'true').parent().hide();
									$('#profile-user-password').parent().show();
								} else {
									input_field.val(input_field.data('original'));
								}
							}
						}
					}
				});
			}
			$(this).attr('disabled','true');
		} else {
			input_field.focus();
		}

	});
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
	} else if (input_field.attr('id') == 'profile-user-confirm-password') {
		data = "data[User][password]=" + input_field.val();
	} else{
		data = input_field.attr('name')+'='+input_field.attr('value');
	}
	return data;
}

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


$.fn.truncate_email = function(){
	$(this).data('original',$(this).val());
	
	if($(this).val().length > 30){
		var new_val = $(this).val();
		new_val = new_val.substring(0,30)+'...';
		$(this).val(new_val);
	}
	return $(this);
}