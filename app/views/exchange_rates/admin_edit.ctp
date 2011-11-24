<div class="exchangeRates form">
<?php echo $this->Form->create('ExchangeRate');?>
	<fieldset>
		<legend><?php __('Admin Edit Exchange Rate'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('currency_code');
		echo $this->Form->input('value_usd');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ExchangeRate.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ExchangeRate.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Exchange Rates', true), array('action' => 'index'));?></li>
	</ul>
</div>