<?php html_comment('boards/invite.ctp'); ?>

<div class="boardInvitations form">
<?php echo $this->Form->create('BoardInvitation', array('url' => array('controller' => 'boards', 'action' => 'invite', $board['Board']['id'])));?>
	<fieldset>
		<legend><?php __('Invite users to "'.$board['Board']['name'].'" board' ); ?></legend>
		<table>
		<?php foreach($users as $user): ?>
			<?php if (!in_array($user['User']['id'], $board['MembersIds'])): ?>
			<tr>
				<td><input type="checkbox" name="data[User][User][]" value="<?php echo $user['User']['id']; ?>" /></td>
				<td><?php echo $user['User']['first_name'].' '.$user['User']['last_name']; ?></td>
			</tr>
			<?php endif;?>
		<?php endforeach;?>
		</table>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
