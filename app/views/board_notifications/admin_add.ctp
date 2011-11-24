<div class="boardNotifications form">
<?php echo $this->Form->create('BoardNotification');?>
	<fieldset>
		<legend><?php __('Admin Add Board Notification'); ?></legend>
	<?php
		echo $this->Form->input('board_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('cause');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Board Notifications', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Boards', true), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board', true), array('controller' => 'boards', 'action' => 'add')); ?> </li>
	</ul>
</div>