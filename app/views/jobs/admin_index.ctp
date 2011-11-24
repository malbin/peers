<div class="jobs index">
	<h2><?php __('Jobs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('employer_id');?></th>
			<th><?php echo $this->Paginator->sort('country_id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('department');?></th>
			<th><?php echo $this->Paginator->sort('salary');?></th>
			<th><?php echo $this->Paginator->sort('currency');?></th>
			<th><?php echo $this->Paginator->sort('start_date');?></th>
			<th><?php echo $this->Paginator->sort('end_date');?></th>
			<th><?php echo $this->Paginator->sort('address');?></th>
			<th><?php echo $this->Paginator->sort('city');?></th>
			<th><?php echo $this->Paginator->sort('state');?></th>
			<th><?php echo $this->Paginator->sort('zip_code');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($jobs as $job):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $job['Job']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($job['User']['email'], array('controller' => 'users', 'action' => 'view', $job['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($job['Employer']['name'], array('controller' => 'employers', 'action' => 'view', $job['Employer']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($job['Country']['name'], array('controller' => 'countries', 'action' => 'view', $job['Country']['id'])); ?>
		</td>
		<td><?php echo $job['Job']['title']; ?>&nbsp;</td>
		<td><?php echo $job['Job']['department']; ?>&nbsp;</td>
		<td><?php echo $job['Job']['salary']; ?>&nbsp;</td>
		<td><?php echo $job['Job']['currency']; ?>&nbsp;</td>
		<td><?php echo $job['Job']['start_date']; ?>&nbsp;</td>
		<td><?php echo $job['Job']['end_date']; ?>&nbsp;</td>
		<td><?php echo $job['Job']['address']; ?>&nbsp;</td>
		<td><?php echo $job['Job']['city']; ?>&nbsp;</td>
		<td><?php echo $job['Job']['state']; ?>&nbsp;</td>
		<td><?php echo $job['Job']['zip_code']; ?>&nbsp;</td>
		<td><?php echo $job['Job']['created']; ?>&nbsp;</td>
		<td><?php echo $job['Job']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $job['Job']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $job['Job']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $job['Job']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $job['Job']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Job', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Employers', true), array('controller' => 'employers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Employer', true), array('controller' => 'employers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Compensations', true), array('controller' => 'compensations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Compensation', true), array('controller' => 'compensations', 'action' => 'add')); ?> </li>
	</ul>
</div>