<div class="boards view">
<h2><?php  __('Board');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $board['Board']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Owner'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($board['Owner']['email'], array('controller' => 'users', 'action' => 'view', $board['Owner']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $board['Board']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $board['Board']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $board['Board']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Board', true), array('action' => 'edit', $board['Board']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Board', true), array('action' => 'delete', $board['Board']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $board['Board']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Owner', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Board Invitations', true), array('controller' => 'board_invitations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board Invitation', true), array('controller' => 'board_invitations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Board Invitations');?></h3>
	<?php if (!empty($board['BoardInvitation'])):?>
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
		foreach ($board['BoardInvitation'] as $boardInvitation):
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
	<h3><?php __('Related Users');?></h3>
	<?php if (!empty($board['User'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Group Id'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('Password'); ?></th>
		<th><?php __('First Name'); ?></th>
		<th><?php __('Last Name'); ?></th>
		<th><?php __('Birthdate'); ?></th>
		<th><?php __('Gender'); ?></th>
		<th><?php __('Language'); ?></th>
		<th><?php __('Currency'); ?></th>
		<th><?php __('Phone'); ?></th>
		<th><?php __('Phone Carrier'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Last Employer Name'); ?></th>
		<th><?php __('Last Job Title'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($board['User'] as $user):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $user['id'];?></td>
			<td><?php echo $user['group_id'];?></td>
			<td><?php echo $user['email'];?></td>
			<td><?php echo $user['password'];?></td>
			<td><?php echo $user['first_name'];?></td>
			<td><?php echo $user['last_name'];?></td>
			<td><?php echo $user['birthdate'];?></td>
			<td><?php echo $user['gender'];?></td>
			<td><?php echo $user['language'];?></td>
			<td><?php echo $user['currency'];?></td>
			<td><?php echo $user['phone'];?></td>
			<td><?php echo $user['phone_carrier'];?></td>
			<td><?php echo $user['status'];?></td>
			<td><?php echo $user['last_employer_name'];?></td>
			<td><?php echo $user['last_job_title'];?></td>
			<td><?php echo $user['created'];?></td>
			<td><?php echo $user['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'users', 'action' => 'delete', $user['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
