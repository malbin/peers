<?php html_comment('board_invitations/index.ctp'); ?>

<?php /*
<?php debug($board_invitations) // Uncomment for invitations data dump ?>
<?php echo $this->element('board_invitations', array('board_invitations' => $board_invitations)); ?>
*/ ?>
<?php if (!empty($board_invitations)): ?>
	<div id="board-containt-lower-menu">
		<ul id="boards-list">
			<?php
			  for($i=0; $i < count($board_invitations); $i++): 
			  $invite = $board_invitations[$i];
			?>
				<li class="board-invite-option" data="<?php echo $invite['BoardInvitation']['id'];?>">
					<?php echo $invite['Board']['name'];?>
				</li>
			<?php endfor; ?>
		</ul>
	</div>
	
	<div id="chart-sheet">
		<?php /* loaded with AJAX from /boards/view/BOARD_ID */ ?>
	</div>
<?php else: ?>
    <div id="no-invites">
        <p>You currently have<br />no invitations.</p>
        <?php echo $this->Html->link('Create a Board Now!', array('controller' => 'boards', 'action' => 'add')); ?>
    </div>
<?php endif; ?>