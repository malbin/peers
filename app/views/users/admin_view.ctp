<div class="users view">
<h2><?php  __('User');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Group'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Password'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['password']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('First Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['first_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Last Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['last_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Birthdate'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['birthdate']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Gender'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['gender']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Language'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['language']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Currency'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['currency']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Phone'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['phone']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Phone Carrier'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['phone_carrier']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Searchable'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['searchable']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Last Employer Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['last_employer_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Last Job Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['last_job_title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User', true), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete User', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Auth Codes', true), array('controller' => 'auth_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Auth Code', true), array('controller' => 'auth_codes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Reset Codes', true), array('controller' => 'reset_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reset Code', true), array('controller' => 'reset_codes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Board Invitations', true), array('controller' => 'board_invitations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board Invitation', true), array('controller' => 'board_invitations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards', true), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board', true), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Jobs', true), array('controller' => 'jobs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Job', true), array('controller' => 'jobs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Networks', true), array('controller' => 'networks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Network', true), array('controller' => 'networks', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php __('Related Auth Codes');?></h3>
	<?php if (!empty($user['AuthCode'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $user['AuthCode']['id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $user['AuthCode']['user_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Code');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $user['AuthCode']['code'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $user['AuthCode']['created'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $user['AuthCode']['modified'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $user['AuthCode']['status'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Auth Code', true), array('controller' => 'auth_codes', 'action' => 'edit', $user['AuthCode']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php __('Related Reset Codes');?></h3>
	<?php if (!empty($user['ResetCode'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $user['ResetCode']['id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $user['ResetCode']['user_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Code');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $user['ResetCode']['code'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $user['ResetCode']['created'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $user['ResetCode']['modified'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Reset Code', true), array('controller' => 'reset_codes', 'action' => 'edit', $user['ResetCode']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php __('Related Board Invitations');?></h3>
	<?php if (!empty($user['BoardInvitation'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Inviter Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Board Id'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['BoardInvitation'] as $boardInvitation):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $boardInvitation['id'];?></td>
			<td><?php echo $boardInvitation['inviter_id'];?></td>
			<td><?php echo $boardInvitation['user_id'];?></td>
			<td><?php echo $boardInvitation['board_id'];?></td>
			<td><?php echo $boardInvitation['status'];?></td>
			<td><?php echo $boardInvitation['created'];?></td>
			<td><?php echo $boardInvitation['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'board_invitations', 'action' => 'view', $boardInvitation['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'board_invitations', 'action' => 'edit', $boardInvitation['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'board_invitations', 'action' => 'delete', $boardInvitation['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $boardInvitation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Board Invitation', true), array('controller' => 'board_invitations', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Boards');?></h3>
	<?php if (!empty($user['Board'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Board'] as $board):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $board['id'];?></td>
			<td><?php echo $board['user_id'];?></td>
			<td><?php echo $board['name'];?></td>
			<td><?php echo $board['created'];?></td>
			<td><?php echo $board['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'boards', 'action' => 'view', $board['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'boards', 'action' => 'edit', $board['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'boards', 'action' => 'delete', $board['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $board['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Board', true), array('controller' => 'boards', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Jobs');?></h3>
	<?php if (!empty($user['Job'])):?>
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
		foreach ($user['Job'] as $job):
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
	<h3><?php __('Related Networks');?></h3>
	<?php if (!empty($user['Network'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Network'] as $network):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $network['id'];?></td>
			<td><?php echo $network['user_id'];?></td>
			<td><?php echo $network['name'];?></td>
			<td><?php echo $network['created'];?></td>
			<td><?php echo $network['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'networks', 'action' => 'view', $network['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'networks', 'action' => 'edit', $network['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'networks', 'action' => 'delete', $network['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $network['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Network', true), array('controller' => 'networks', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Boards');?></h3>
	<?php if (!empty($user['BoardMembership'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['BoardMembership'] as $boardMembership):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $boardMembership['id'];?></td>
			<td><?php echo $boardMembership['user_id'];?></td>
			<td><?php echo $boardMembership['name'];?></td>
			<td><?php echo $boardMembership['created'];?></td>
			<td><?php echo $boardMembership['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'boards', 'action' => 'view', $boardMembership['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'boards', 'action' => 'edit', $boardMembership['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'boards', 'action' => 'delete', $boardMembership['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $boardMembership['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Board Membership', true), array('controller' => 'boards', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Networks');?></h3>
	<?php if (!empty($user['NetworkMembership'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['NetworkMembership'] as $networkMembership):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $networkMembership['id'];?></td>
			<td><?php echo $networkMembership['user_id'];?></td>
			<td><?php echo $networkMembership['name'];?></td>
			<td><?php echo $networkMembership['created'];?></td>
			<td><?php echo $networkMembership['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'networks', 'action' => 'view', $networkMembership['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'networks', 'action' => 'edit', $networkMembership['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'networks', 'action' => 'delete', $networkMembership['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $networkMembership['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Network Membership', true), array('controller' => 'networks', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
