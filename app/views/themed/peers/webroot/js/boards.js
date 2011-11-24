var b_inc = 0;
var scrollE;
$(document).ready(function(){
	// Attach tooltip
	$('#container #workers-list ul li .name').live({
		mouseenter: function() {
            // Fix: Tooltips are hidden by container with custom scrollbar (overflow: hidden)
            // Create a clone, add an identifier 'cloned' for removal later, append to the document
            $(this).parent().children('.info-tooltip').clone().addClass('cloned').appendTo('body').show().position({
			  my: "left bottom",
			  at: "left top",
			  of: $(this).parent()
			}).css('marginTop', '-=20');
		},
		mouseleave: function() {
            $('.info-tooltip.cloned').remove();
		}
	});
	
	// View all boards
	$("#my-board-button").live('click',function(e) {
		showMyBoards();
		e.preventDefault();
	});

	// View all Invitations
	$("#invitations-count-button").live('click',function(e) {
		showAllInvitations();
		e.preventDefault();
	});

	// View Board
	$(".board-option").live("click", function(e) {
		var boardId = $(this).attr("data");
		viewBoard(boardId);
		$(this).make_active_board();
		e.preventDefault();
	});
	
	$("#form-leave-board").live("submit", function(e) {
		submitLeaveBoardForm(this);
		e.preventDefault();
	});
	
	$("#workers-leave-button, #leave-board").live("click", function(e) {
		$("#form-leave-board").trigger('submit');
		e.preventDefault();
	});
	
	// View Invitation
	$(".board-invite-option").live("click", function(e) {
		var invitationId = $(this).attr("data");
		viewInvitation(invitationId);
		$(this).make_active_board();
		e.preventDefault();
	});

	$("#form-accept-invite").live("submit", function(e) {
		submitAcceptInviteForm(this);
		e.preventDefault();
	});
	
	$("#form-decline-invite").live("submit", function(e) {
		submitDeclineInviteForm(this);
		e.preventDefault();
	});

	showMyBoards();

});

function showMyBoards() {
	PR.Board.all(function(result) {
		$("#board-content").html(result);
		/*$("#boards-list .board-option:first-child").trigger('click');*/
		 $('#board_menu_0').trigger('click');
	});
}

function viewBoard(boardId) {
	PR.Board.view(boardId, function(result) {
		$.when( $("#chart-sheet").html(result) ).done(function(){
            $('.scrollbar-container').tinyscrollbar();

            var $reportIntroTooltip = $('#report-intro-tooltip');
            if ($reportIntroTooltip.length != 0) {
                var rankBubbleOffset = $("#chart-sheet").find('.rank-meter:last').find('.roller').filter('.scnd').offset();
                var tooltipLeft = rankBubbleOffset.left - $reportIntroTooltip.outerWidth() + 40;
                var tooltipTop = rankBubbleOffset.top - $reportIntroTooltip.outerHeight() - 40;
                $('#report-intro-tooltip').css({'top': tooltipTop, 'left': tooltipLeft}).fadeIn(500);
            }
        });
	});

}

function showAllInvitations() {
	PR.BoardInvitation.all(function(result) {
		$("#board-content").html(result);
		$(".board-invite-option:first-child").trigger('click');
	});
}

function viewInvitation(invitationId) {
	PR.BoardInvitation.view(invitationId, function(result) {
		$("#chart-sheet").html(result);
	});

}

function submitLeaveBoardForm(form) {
	// TODO: Present Confirmation Dialog!!!
	var data = $(form).serialize();
	PR.Board.leave(data, function(result) {
		if (result.form_result.success) {
			showMyBoards();
		}
	});
}

function submitAcceptInviteForm(form) {
	var data = $(form).serialize();
	PR.BoardInvitation.accept(data, function(result) {
		if (result.form_result.success) {
			showAllInvitations();
			var count = parseInt($("#invitations-count").html()) - 1;
			if (count <= 0) {
				$("#invitations-count").remove();
			} else {
				$("#invitations-count").html(count);
			}
		}
	});
}

function submitDeclineInviteForm(form) {
	var data = $(form).serialize();
	PR.BoardInvitation.decline(data, function(result) {
		if (result.form_result.success) {
			showAllInvitations();
			var count = parseInt($("#invitations-count").html()) - 1;
			if (count <= 0) {
				$("#invitations-count").remove();
			} else {
				$("#invitations-count").html(count);
			}
		}
	});
}

$(document).ready(function(){
	
	$('.view-more-boards').live('mousedown',function(){
		scrollBoardList('down');
		scrollE = setInterval('scrollBoardList("down")',300);
	});
	$('.view-back-boards').live('mousedown',function(){
		scrollBoardList('up');
		scrollE = setInterval('scrollBoardList("up")',300);
	});
	$('body').live('mouseup',function(){
		clearInterval(scrollE);
	});
});

function scrollBoardList(direction){
	if (direction == 'up'){
		var bc = $('#board_count').val();
		if (b_inc > 0){
		$('#board_menu_'+(b_inc + 6)).addClass('option_hidden');
		b_inc--;
		$('#board_menu_'+b_inc).removeClass('option_hidden');
		var bleft = (bc - (b_inc + 7));
		$('#more_boards_count').html(bleft);
		$('#back_boards_count').html(b_inc);
		}
		else {
			clearInterval(scrollE);
			return false;
		}
	}
	else if (direction == 'down'){
		var bc = $('#board_count').val();
		if (b_inc < (bc - 7)){
		$('#board_menu_'+b_inc).addClass('option_hidden');
		b_inc++;
		var showit = (b_inc + 6);
		$('#board_menu_'+showit).removeClass('option_hidden');
		var bleft = (bc - (b_inc + 7));
		$('#more_boards_count').html(bleft);
		$('#back_boards_count').html(b_inc);
		}
		else {
			clearInterval(scrollE);
			return false;
		}
	}
	
	if ((bleft < 1)||(bleft == undefined)){		
		$('#view-more-boards').removeClass('view-more-boards').addClass('button_off');
		}
	else {
		$('#view-more-boards').addClass('view-more-boards').removeClass('button_off');
	}
	if (b_inc > 0){
		$('#view-back-boards').addClass('view-back-boards').removeClass('button_off');
	}
	else {
		$('#view-back-boards').removeClass('view-back-boards').addClass('button_off');
	}
}

$.fn.make_active_board = function(){
	$('.active-board').removeClass('active-board');
	$(this).addClass('active-board').children('span.count').removeClass('updated');
	var board_data = '#'+$(this).attr('id') + '-list';
	var board_salary_slider = '#salary-slider-'+$(this).attr('id');

	var board_compensation_slider = '#compensation-slider-'+$(this).attr('id');
	
	$('.active-board-list, .active-board-list').fadeOut(300);
	$(board_data).delay(350).fadeIn(300).addClass('active-board-list');

	$(board_salary_slider).delay(350).fadeIn(300).addClass('active-board-list');
}