<div class="jobs view">
<h2><?php  __('Search Jobs Form');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($job['User']['email'], array('controller' => 'users', 'action' => 'view', $job['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Employer'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($job['Employer']['name'], array('controller' => 'employers', 'action' => 'view', $job['Employer']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Country'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($job['Country']['name'], array('controller' => 'countries', 'action' => 'view', $job['Country']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['department']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Salary'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['salary']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Currency'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['currency']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Start Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['start_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('End Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['end_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Address'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['address']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('City'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['city']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('State'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['state']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Zip Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['zip_code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Job', true), array('action' => 'edit', $job['Job']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Job', true), array('action' => 'delete', $job['Job']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $job['Job']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Jobs', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Job', true), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php __('Related Compensations');?></h3>
	<?php if (!empty($job['Compensation'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Job Id'); ?></th>
		<th><?php __('Currency'); ?></th>
		<th><?php __('Cash'); ?></th>
		<th><?php __('Type'); ?></th>
		<th><?php __('Deferred'); ?></th>
		<th><?php __('Award Date'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($job['Compensation'] as $compensation):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $compensation['id'];?></td>
			<td><?php echo $compensation['job_id'];?></td>
			<td><?php echo $compensation['currency'];?></td>
			<td><?php echo $compensation['cash'];?></td>
			<td><?php echo $compensation['type'];?></td>
			<td><?php echo $compensation['deferred'];?></td>
			<td><?php echo $compensation['award_date'];?></td>
			<td><?php echo $compensation['created'];?></td>
			<td><?php echo $compensation['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'compensations', 'action' => 'view', $compensation['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'compensations', 'action' => 'edit', $compensation['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'compensations', 'action' => 'delete', $compensation['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $compensation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Compensation', true), array('controller' => 'compensations', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
