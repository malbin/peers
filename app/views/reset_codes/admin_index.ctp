<div class="resetCodes index">
	<h2><?php __('Reset Codes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('code');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($resetCodes as $resetCode):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $resetCode['ResetCode']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($resetCode['User']['email'], array('controller' => 'users', 'action' => 'view', $resetCode['User']['id'])); ?>
		</td>
		<td><?php echo $resetCode['ResetCode']['code']; ?>&nbsp;</td>
		<td><?php echo $resetCode['ResetCode']['created']; ?>&nbsp;</td>
		<td><?php echo $resetCode['ResetCode']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $resetCode['ResetCode']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $resetCode['ResetCode']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $resetCode['ResetCode']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $resetCode['ResetCode']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Reset Code', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>