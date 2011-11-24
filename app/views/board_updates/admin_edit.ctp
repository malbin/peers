<div class="boardUpdates form">
<?php echo $this->Form->create('BoardUpdate');?>
	<fieldset>
		<legend><?php __('Admin Edit Board Update'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('board_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('last_viewed');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('BoardUpdate.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('BoardUpdate.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Board Updates', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Boards', true), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board', true), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>