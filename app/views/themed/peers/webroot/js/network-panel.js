$(document).ready(function(){
	
	/* for removing shadow when hovering over the last item in the list of network, [tracker story: 19246131] */
	$(".network-list ul li:last-child").live({
		mouseenter: function() {
			$('#networks-list .network-list').css('background','transparent');
		},
		mouseleave: function() {
			$('#networks-list .network-list').css('background','');
		}
	});
		
	$('#start-new-group, #add-group').click(function(){
		if ($('#network-panel-container').is(':visible')) {
			$('#network-panel-container').fadeOut(300);
		}

		if($('#network-data .active-network').length){
			$('#network-data .active-network').removeClass('active-network').fadeOut(300,function(){
				collapse_network_menu(function(){
					$('#create-group-container').fadeIn(300).addClass('active-network');
				});
			});
		} else{
			collapse_network_menu(function(){
				$('#create-group-container').fadeIn(300).addClass('active-network');
			});
		}
	});
	
	$('#group-title').click(function(){
		expand_network_menu(function(){});
	});

	$('#networks-list .network-list li').live('click',function(){
		panel = $(this).attr('id')+'-panel';
		collapse_network_menu(function(){
			$('#network-panel-container').fadeIn(100,function(){
				$('#network-panel-container #'+panel).fadeIn(200,function(){
					resize_network_panel();
				}).addClass('active-network');
			});
		});
	});
	
	$('#network-panel-search').autocomplete({
		minLength: 2,
		appendTo: '#network-dropdown-container',
		position:{
		  my: "left top",
		  at: "left bottom",
		  of: "#network-panel-search"
		},
		source: function( request, response ) {
			$.ajax({
				url: BASEURL + "users/network_search/query:"+request.term.trim()+'?output=json',
				dataType: "json",
				success: function( data ) {
					// console.log(data);
					response( data.data);
					}
				});
			},
		open: function(event,ui) {
			$('#network-dropdown-container .search-result-item').each(function(){
				$(this).check_added();
			});
			}
		}).data( "autocomplete" )._renderItem = function( ul, item ) {
		data = '<div class="suggest-info"><div class="name">' + item.name + '</div>';
		data += '<div class="job">' + item.job + '</div>';
		data += '<div class="company"><strong>' + item.company + '</strong>&nbsp;-&nbsp;<span class="address">' + item.company + '</span></div></div>';
		data += '<span class="suggest-add">Add</span>';
		data += '<span class="suggest-added">added ✔</span>';
		data += '<span class="clr">&nbsp;</span>';
		return $( "<li class='search-result-item' id='search-result-"+item.id+"'></li>" ).data( "item.autocomplete", item ).append( data ).appendTo( ul );
	};
    $('#network-panel-search').keypress(function(e){
        if (e.which == 13) {
			$('#network-panel-search').autocomplete("search",$(this).val());
			return false;
        }
    });
	
	$('.ui-autocomplete .search-result-item').live('hover',function(){
		// $(this).check_added();
	});
	
	$('.ui-autocomplete .search-result-item .suggest-add').live('click',function(){
		$(this).parent().addClass('suggest-list-added');

		var usr_id = $(this).parent().attr('id');
		usr_id = usr_id.replace("search-result-",'');
		var usr_name = $(this).parent().find('.name').html();
		var usr_job = $(this).parent().find('.job').html();
		var usr_company = $(this).parent().find('.company').html();
		var usr_company_name = $(this).parent().find('.company strong').html();
		var usr_address = $(this).parent().find('.company .address').html();
		
		// TODO: fetch these params
		var usr_department = '';
		
		// if there is no current group, then start a new group
		if($('.active-network').length == 0){
			$('#start-new-group').trigger('click');
			$('#create-group-container').addClass('active-network');
		}

		if($('.active-network').attr('id') == 'create-group-container'){
			// creating a new group, add the member to list and dont do any server action
			var row_data = '<tr>';
			row_data += '	<td class="name">'+usr_name+'</td>';
			row_data += '	<td class="field">' + usr_job +'</td>';
			row_data += '	<td class="location">' + usr_company + '</td>';
			row_data += '	<td class="cross">&nbsp;</td>';
			row_data += '	<td class="id" style="display:none">'+usr_id+'</td>';
			row_data += '</tr>';
			$('#create-group-container .create-group table tbody').append(row_data);
			
		} else{
			//  refresh container and update on server as well
			var row_data = "<tr>";
			row_data += '	<td class="name">'+usr_name+'</td>';
			row_data += '	<td class="company"><p>'+usr_company_name;
			row_data += '	</p></td>';
			row_data += '	<td class="title">'+usr_job+'</td>';
			row_data += '	<td class="icons"><span class="delete">&nbsp;</span></td>';
			row_data += '	<td class="id" style="display:none">'+usr_id+'</td>';
			row_data += '</tr>';

			$('.active-network table tbody').append(row_data);
			
			$('.active-network').update_panel();
		}
		
		$('#network-panel-search').autocomplete("close");
		$('#network-panel-search').trigger('focus');
		resize_network_panel();
	});
	
	// delete user in a network
	$('#network-panel-container table tr .delete').live('click',function(){
		var panel_container = $(this).parents('.network-panel-wrap');
		$(this).parents('tr').fadeOut(200,function(){
			$(this).remove();
			panel_container.update_panel();
			
			// remove empty networks
			if($(panel_container).find('.id').length == 0){
				var id = panel_container.attr('id');
				id = id.replace('network-','');
				id = id.replace('-panel','');
			
				data = { '_method':'DELETE', 'data[Network][id]':id };
				PR.Network.del(data,
					function(result) {
						// remove the network from menu
						$('#network-'+id).remove();
						
						// remove the empty div containing the network's data
						expand_network_menu(function(){});
						panel_container.remove();
					}
				);
			}
		});
	});
	
	// create group section
	$('#create-group-container .create-group .cross').live('click',function(){
		$(this).parent().remove_fade();
	});
	
	$('#create-group-container .create-bt').live('click',function(){
		usr_array = new Array();
		$('#create-group-container .create-group table').find('.id').each(function(){
			usr_array.push($(this).html());
		});
		
		var group_name = $('#create-group-container .create-group .group-name').attr('value');
        $('#create-group-validation-prompt').validationEngine('hideAll');
		$.ajax({
			url: BASEURL + "networks/add/?output=json&ajax=true",
			dataType: "json",
			type: "POST",
			data:{
				"data[Network][name]" : group_name,
				"data[User][User]" : usr_array
			},
			success: function( data ) {
				if(data.form_result.success){
					var network_redirect_url = data.redirect.split('/');
					var network_id = network_redirect_url[network_redirect_url.length - 1];
					var menu_link = '<li id="network-'+network_id+'">'+group_name+'</li>';
					$('#network-panel #networks-list .network-list ul').append(menu_link);
					add_network_panel(data.redirect);
					expand_network_menu(function(){
						$('#create-group-container').html('<div class="create-group">\
							<input type="text" name="group-name" class="group-name placeholder" placeholder="Group Name...">\
							<h3 class="title">Group So Far</h3>\
							<div class="scroll-wrap">\
								<table cellpadding="0" cellspacing="0">\
									<tbody>\
									</tbody>\
								</table>\
							</div>\
							<span class="create-bt">&nbsp;</span>\
						</div>');

						// apply jquery placeholder once DOM is updated.
						$('#create-group-container').ready(function(){
							$('.create-group .placeholder').placeholder();
						});
						
					});
				} else {
                    if (data.form_result.errors.name) {
                        $('#create-group-validation-prompt').validationEngine('showPrompt', data.form_result.errors.name)
                    }
                }
			}
		});
	});
	
	$('.network-panel-wrap .network-name')
        .live('focus', function(){
            var networkName = $(this).val().replace(/^\u201c+|\u201d+$/g, '');
            $(this).val(networkName);
        })
        .live('blur', function(){
            $(this).parents('.network-panel-wrap').update_panel();
            var networkName = '\u201c' + $(this).val() + '\u201d';
            $(this).val(networkName);
        });
});

function add_network_panel(load_url){
	$.ajax({
		url: load_url+'/?ajax=true',
		success: function( data ) {
			$('#network-panel-container').find('.overview').append(data);
		}
	});
}

// collapses the panel which shows list of networks
function collapse_network_menu(callback){
	$('#network-panel-body').addClass('panel-closing');
	$('#networks-list .network-list').fadeOut(300,function(){
		$('#networks-list #group-title').animate({width:'20px'},200);
		$('#networks-list').animate({width:'50px'},300,function(){
			$('#network-data .banner').fadeOut(200,function(){
				$('#network-panel-body').addClass('panel-closed');
				callback();	
			});
		});
	});
}

// expands the panel which shows list of networks
function expand_network_menu(callback){
	$('#network-panel-body').removeClass('panel-closed');

	$('#network-panel-container').fadeOut(100,function(){
		$('#network-data .active-network').removeClass('active-network').css('display','none');

			$('#networks-list').animate({width:'168px'},300);
			$('#networks-list #group-title').animate({width:'136px'},300,function(){
				$('#networks-list .network-list').fadeIn(300,function(){
					$('#network-data .banner').fadeIn(200,function(){
						$('#network-panel-body').removeClass('panel-closing');
						callback();
					});
				});
			});

	});
}

$.fn.remove_fade = function(){
	$(this).fadeOut(200,function(){
		$(this).remove();
	});
}

$.fn.update_panel = function(){
	var panel_id = $(this).attr('id');
	panel_id = panel_id.replace('network-','');
	panel_id = panel_id.replace('-panel','');
	
	var usr_array = new Array();
	$(this).find('.id').each(function(){
		usr_array.push($(this).html());
	});

	var network_name = $(this).find('.network-name').attr('value');

	$('#networks-list #network-'+panel_id).html(network_name);

	$.ajax({
		url: BASEURL + "networks/edit/"+panel_id+"?output=json&ajax=true",
		dataType: "json",
		type: "POST",
		data:{
			"data[Network][name]" : network_name,
			"data[User][User]" : usr_array
		},
		success: function( data ) {
			// console.log(data);
		}
	});

}

$.fn.check_added = function(){
	var search_item = $(this);
	var id=search_item.attr('id');
	id = id.replace("search-result-",'');

	$('.active-network table').find('tr .id').each(function(){
		if(id == $(this).html()){
			search_item.addClass('suggest-list-added');
		}
	});
}

function resize_network_panel(){
	var ht = Math.max($('#user-profile').height(),$('#networks-list .network-list').height());
	$('#network-data, #network-panel-container,#network-panel .viewport, #networks-list').height(ht);
	$('#network-panel-container').tinyscrollbar();
}