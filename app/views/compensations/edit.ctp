<?php html_comment('compensations/edit.ctp');?>

<?php //debug($this->data); // Uncomment for form data ?>

<div class="compensations form">
<?php echo $this->Form->create('Compensation', array('url' => array('controller' => 'compensations', 'action' => 'edit', $this->data['Compensation']['id']))); ?>
	<fieldset>
		<legend><?php __('EDIT COMPENSATION'); ?></legend>
	<?php
		echo $this->Form->input('cash');
		echo $this->Form->input('type');
		echo $this->Form->input('deferred');
		echo $this->Form->input('award_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('EDIT COMPENSATION', true));?>
</div>