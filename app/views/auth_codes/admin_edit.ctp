<div class="authCodes form">
<?php echo $this->Form->create('AuthCode');?>
	<fieldset>
		<legend><?php __('Edit Auth Code'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('code');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('AuthCode.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('AuthCode.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Auth Codes', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>