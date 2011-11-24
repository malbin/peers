<div class="boards form">
<?php echo $this->Form->create('Board');?>
	<fieldset>
		<legend><?php __('Edit Board'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('name');
		echo $this->Form->input('User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Board.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Board.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Boards', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Owner', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Board Invitations', true), array('controller' => 'board_invitations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board Invitation', true), array('controller' => 'board_invitations', 'action' => 'add')); ?> </li>
	</ul>
</div>