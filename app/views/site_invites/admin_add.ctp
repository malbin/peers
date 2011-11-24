<div class="siteInvites form">
<?php echo $this->Form->create('SiteInvite');?>
	<fieldset>
		<legend><?php __('Add Site Invite'); ?></legend>
	<?php
		echo $this->Form->input('country_id');
		echo $this->Form->input('email');
		echo $this->Form->input('name');
		echo $this->Form->input('code');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Site Invites', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li>
	</ul>
</div>