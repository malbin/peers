<div class="exchangeRates view">
<h2><?php  __('Exchange Rate');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $exchangeRate['ExchangeRate']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Currency Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $exchangeRate['ExchangeRate']['currency_code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Value Usd'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $exchangeRate['ExchangeRate']['value_usd']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Exchange Rate', true), array('action' => 'edit', $exchangeRate['ExchangeRate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Exchange Rate', true), array('action' => 'delete', $exchangeRate['ExchangeRate']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $exchangeRate['ExchangeRate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Exchange Rates', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exchange Rate', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
