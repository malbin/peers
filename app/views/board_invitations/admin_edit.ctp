<div class="boardInvitations form">
<?php echo $this->Form->create('BoardInvitation');?>
	<fieldset>
		<legend><?php __('Edit Board Invitation'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('inviter_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('board_id');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('BoardInvitation.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('BoardInvitation.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Board Invitations', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inviter', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards', true), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board', true), array('controller' => 'boards', 'action' => 'add')); ?> </li>
	</ul>
</div>