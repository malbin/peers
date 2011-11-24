<div class="jobs form">
<?php echo $this->Form->create('Job');?>
	<fieldset>
		<legend><?php __('Edit Job'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('employer_id');
		echo $this->Form->input('country_id');
		echo $this->Form->input('title');
		echo $this->Form->input('department');
		echo $this->Form->input('salary');
		echo $this->Form->input('currency');
		echo $this->Form->input('start_date');
		echo $this->Form->input('end_date');
		echo $this->Form->input('address');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('zip_code');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Job.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Job.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Jobs', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Employers', true), array('controller' => 'employers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Employer', true), array('controller' => 'employers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Compensations', true), array('controller' => 'compensations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Compensation', true), array('controller' => 'compensations', 'action' => 'add')); ?> </li>
	</ul>
</div>