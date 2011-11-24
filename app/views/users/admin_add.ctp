<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('group_id');
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('password_verify',array('type'=>'password'));
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('birthdate',array('minYear'=>1910, 'maxYear'=>2000));
		echo $this->Form->input('gender');
		echo $this->Form->input('language');
		echo $this->Form->input('currency');
		echo $this->Form->input('phone');
		echo $this->Form->input('phone_carrier');
		echo $this->Form->input('status');
		echo $this->Form->input('searchable');
		echo $this->Form->input('last_employer_name');
		echo $this->Form->input('last_job_title');
		echo $this->Form->input('BoardMembership');
		echo $this->Form->input('NetworkMembership');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Auth Codes', true), array('controller' => 'auth_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Auth Code', true), array('controller' => 'auth_codes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Reset Codes', true), array('controller' => 'reset_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reset Code', true), array('controller' => 'reset_codes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Board Invitations', true), array('controller' => 'board_invitations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board Invitation', true), array('controller' => 'board_invitations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards', true), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board', true), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Jobs', true), array('controller' => 'jobs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Job', true), array('controller' => 'jobs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Networks', true), array('controller' => 'networks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Network', true), array('controller' => 'networks', 'action' => 'add')); ?> </li>
	</ul>
</div>