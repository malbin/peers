<div class="compensations form">
<?php echo $this->Form->create('Compensation');?>
	<fieldset>
		<legend><?php __('Add Compensation'); ?></legend>
	<?php
		echo $this->Form->input('job_id');
		echo $this->Form->input('currency');
		echo $this->Form->input('cash');
		echo $this->Form->input('type');
		echo $this->Form->input('deferred');
		echo $this->Form->input('award_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Compensations', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Jobs', true), array('controller' => 'jobs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Job', true), array('controller' => 'jobs', 'action' => 'add')); ?> </li>
	</ul>
</div>