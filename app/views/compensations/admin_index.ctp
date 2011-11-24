<div class="compensations index">
	<h2><?php __('Compensations');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('job_id');?></th>
			<th><?php echo $this->Paginator->sort('currency');?></th>
			<th><?php echo $this->Paginator->sort('cash');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('deferred');?></th>
			<th><?php echo $this->Paginator->sort('award_date');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($compensations as $compensation):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $compensation['Compensation']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($compensation['Job']['title'], array('controller' => 'jobs', 'action' => 'view', $compensation['Job']['id'])); ?>
		</td>
		<td><?php echo $compensation['Compensation']['currency']; ?>&nbsp;</td>
		<td><?php echo $compensation['Compensation']['cash']; ?>&nbsp;</td>
		<td><?php echo $compensation['Compensation']['type']; ?>&nbsp;</td>
		<td><?php echo $compensation['Compensation']['deferred']; ?>&nbsp;</td>
		<td><?php echo $compensation['Compensation']['award_date']; ?>&nbsp;</td>
		<td><?php echo $compensation['Compensation']['created']; ?>&nbsp;</td>
		<td><?php echo $compensation['Compensation']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $compensation['Compensation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $compensation['Compensation']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $compensation['Compensation']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $compensation['Compensation']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Compensation', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Jobs', true), array('controller' => 'jobs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Job', true), array('controller' => 'jobs', 'action' => 'add')); ?> </li>
	</ul>
</div>