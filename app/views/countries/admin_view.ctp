<div class="countries view">
<h2><?php  __('Country');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $country['Country']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $country['Country']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sms'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $country['Country']['sms']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Country', true), array('action' => 'edit', $country['Country']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Country', true), array('action' => 'delete', $country['Country']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $country['Country']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Jobs', true), array('controller' => 'jobs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Job', true), array('controller' => 'jobs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Site Invites', true), array('controller' => 'site_invites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Site Invite', true), array('controller' => 'site_invites', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Jobs');?></h3>
	<?php if (!empty($country['Job'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Employer Id'); ?></th>
		<th><?php __('Country Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Department'); ?></th>
		<th><?php __('Salary'); ?></th>
		<th><?php __('Currency'); ?></th>
		<th><?php __('Start Date'); ?></th>
		<th><?php __('End Date'); ?></th>
		<th><?php __('Address'); ?></th>
		<th><?php __('City'); ?></th>
		<th><?php __('State'); ?></th>
		<th><?php __('Zip Code'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($country['Job'] as $job):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $job['id'];?></td>
			<td><?php echo $job['user_id'];?></td>
			<td><?php echo $job['employer_id'];?></td>
			<td><?php echo $job['country_id'];?></td>
			<td><?php echo $job['title'];?></td>
			<td><?php echo $job['department'];?></td>
			<td><?php echo $job['salary'];?></td>
			<td><?php echo $job['currency'];?></td>
			<td><?php echo $job['start_date'];?></td>
			<td><?php echo $job['end_date'];?></td>
			<td><?php echo $job['address'];?></td>
			<td><?php echo $job['city'];?></td>
			<td><?php echo $job['state'];?></td>
			<td><?php echo $job['zip_code'];?></td>
			<td><?php echo $job['created'];?></td>
			<td><?php echo $job['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'jobs', 'action' => 'view', $job['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'jobs', 'action' => 'edit', $job['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'jobs', 'action' => 'delete', $job['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $job['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Job', true), array('controller' => 'jobs', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Site Invites');?></h3>
	<?php if (!empty($country['SiteInvite'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Country Id'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Code'); ?></th>
		<th><?php __('Scheduled Time'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($country['SiteInvite'] as $siteInvite):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $siteInvite['id'];?></td>
			<td><?php echo $siteInvite['country_id'];?></td>
			<td><?php echo $siteInvite['email'];?></td>
			<td><?php echo $siteInvite['name'];?></td>
			<td><?php echo $siteInvite['code'];?></td>
			<td><?php echo $siteInvite['scheduled_time'];?></td>
			<td><?php echo $siteInvite['user_id'];?></td>
			<td><?php echo $siteInvite['status'];?></td>
			<td><?php echo $siteInvite['created'];?></td>
			<td><?php echo $siteInvite['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'site_invites', 'action' => 'view', $siteInvite['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'site_invites', 'action' => 'edit', $siteInvite['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'site_invites', 'action' => 'delete', $siteInvite['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $siteInvite['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Site Invite', true), array('controller' => 'site_invites', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
