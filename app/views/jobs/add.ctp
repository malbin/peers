<?php html_comment('jobs/add.ctp');?>

<?php //debug($this->data); // Uncomment for form data dump ?>
<?php //debug($employers); // Uncomment for employers list data dump ?>
<?php //debug($countries); // Uncomment for countries list data dump ?>


<div class="jobs form">
<?php echo $this->Form->create('Job', array('url' => array('controller' => 'jobs', 'action' => 'add')));?>
	<fieldset>
		<legend><?php __('ADD JOB'); ?></legend>
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
<?php echo $this->Form->end(__('ADD JOB', true));?>
</div>
