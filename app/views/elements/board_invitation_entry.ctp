<?php html_comment('elements/board_invitation_entry.ctp'); ?>
<?php 
	/**
	 * Board invitation entry element
	 * @param $board_invitation = array('BoardInvitation' =>  array(...));
	 */  
?>
<div>
	<?php printf(__('You have been invited to "%s" board', true), $board_invitation['Board']['name']); ?>
	<form method="POST" action="<?php echo Router::url(array('controller' => 'board_invitations', 'action' => 'accept'));?>" >
		<div style="display:none;">
			<input type="hidden" name="_method" value="POST" />
			<input type="hidden" name="data[BoardInvitation][id]" value="<?php echo $board_invitation['BoardInvitation']['id'];?>" />
		</div>
		<input type="submit" value="<?php __('Accept');?>" />
	</form>
	<form method="POST" action="<?php echo Router::url(array('controller' => 'board_invitations', 'action' => 'decline'));?>" >
		<div style="display:none;">
			<input type="hidden" name="_method" value="POST" />
			<input type="hidden" name="data[BoardInvitation][id]" value="<?php echo $board_invitation['BoardInvitation']['id'];?>" />
		</div>
		<input type="submit" value="<?php __('Decline');?>" />
	</form>
</div>

