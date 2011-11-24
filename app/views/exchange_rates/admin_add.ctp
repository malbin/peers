<div class="exchangeRates form">
<?php echo $this->Form->create('ExchangeRate');?>
	<fieldset>
		<legend><?php __('Admin Add Exchange Rate'); ?></legend>
	<?php
		echo $this->Form->input('currency_code');
		echo $this->Form->input('value_usd');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Exchange Rates', true), array('action' => 'index'));?></li>
	</ul>
</div>