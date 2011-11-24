<?php
	$invitations_count = 0;
	foreach($logged_user['BoardInvitation'] as $invite) {
		if ('pending' == $invite['status']) {
			++$invitations_count;
		}
	}
?>
<div id="board-containt-lower">
	<p class="fl dashboard-boards-title">boards</p>
	<span class="horizon-line fl"> </span>
	<span id="invitations-count-button">invitations<?php echo 0 < $invitations_count ? '<span id="invitations-count">'.$invitations_count.'</span>' : ''; ?></span>
	<span id="my-board-button">boards</span>
    <?php echo $this->Html->link('start a board', array('controller' => 'boards', 'action' => 'add'), array('id' => 'start-a-board-button', 'escape' => false)); ?>
	<div id="board-content" class="clearfix">
		<?php /* Loaded via AJAX from either boards/index or board_invitations/index */ ?>	
	</div>
</div>
