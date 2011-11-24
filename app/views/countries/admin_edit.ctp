<div class="countries form">
<?php echo $this->Form->create('Country');?>
	<fieldset>
		<legend><?php __('Admin Edit Country'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('sms');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Country.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Country.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Countries', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Jobs', true), array('controller' => 'jobs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Job', true), array('controller' => 'jobs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Site Invites', true), array('controller' => 'site_invites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Site Invite', true), array('controller' => 'site_invites', 'action' => 'add')); ?> </li>
	</ul>
</div>