<?php html_comment('jobs/edit.ctp'); ?>

<?php //debug($this->data); //Uncomment for form data dump ?>

<div class="jobs form">
<?php echo $this->Form->create('Job', array('url' => array('controller' => 'jobs', 'action' => 'edit', $this->data['Job']['id'])));?>
	<fieldset>
		<legend><?php __('EDIT JOB'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('Employer.name', array('type' => 'text', 'label' => 'Employer'));
		echo $this->Form->input('country_id');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('zip_code');
		echo $this->Form->input('salary');
		echo $this->Form->input('start_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('EDIT JOB', true));?>
</div>