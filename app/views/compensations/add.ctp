<?php html_comment('compensations/add.ctp');?>

<?php //debug($this->data); // Uncomment for form data ?>

<div class="compensations form">
<?php echo $this->Form->create('Compensation', array('url' => array('controller' => 'compensations', 'action' => 'add', $this->data['Compensation']['job_id']))); ?>
	<fieldset>
		<legend><?php __('ADD COMPENSATION'); ?></legend>
	<?php
		echo $this->Form->input('cash');
		echo $this->Form->input('type');
		echo $this->Form->input('deferred');
		echo $this->Form->input('award_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('ADD NOW', true));?>
</div>