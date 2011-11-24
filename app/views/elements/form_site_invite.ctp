<div class="siteInvites form">
<?php echo $this->Form->create('SiteInvite', array('controller' => 'SiteInvites', 'action' => 'index'));?>
	<fieldset>
		<legend><?php __('Request Site Invite'); ?></legend>
	<?php
		echo $this->Form->input('country_id');
		echo $this->Form->input('email');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Request Invite', true));?>
</div>