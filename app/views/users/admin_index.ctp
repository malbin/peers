<div class="users index">
	<h2><?php __('Users');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('group_id');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('first_name');?></th>
			<th><?php echo $this->Paginator->sort('last_name');?></th>
			<th><?php echo $this->Paginator->sort('birthdate');?></th>
			<th><?php echo $this->Paginator->sort('gender');?></th>
			<th><?php echo $this->Paginator->sort('language');?></th>
			<th><?php echo $this->Paginator->sort('currency');?></th>
			<th><?php echo $this->Paginator->sort('phone');?></th>
			<th><?php echo $this->Paginator->sort('phone_carrier');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('searchable');?></th>
			<th><?php echo $this->Paginator->sort('last_employer_name');?></th>
			<th><?php echo $this->Paginator->sort('last_job_title');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($users as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $user['User']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
		</td>
		<td><?php echo $user['User']['email']; ?>&nbsp;</td>
		<td><?php echo $user['User']['first_name']; ?>&nbsp;</td>
		<td><?php echo $user['User']['last_name']; ?>&nbsp;</td>
		<td><?php echo $user['User']['birthdate']; ?>&nbsp;</td>
		<td><?php echo $user['User']['gender']; ?>&nbsp;</td>
		<td><?php echo $user['User']['language']; ?>&nbsp;</td>
		<td><?php echo $user['User']['currency']; ?>&nbsp;</td>
		<td><?php echo $user['User']['phone']; ?>&nbsp;</td>
		<td><?php echo $user['User']['phone_carrier']; ?>&nbsp;</td>
		<td><?php echo $user['User']['status']; ?>&nbsp;</td>
		<td><?php echo $user['User']['searchable']; ?>&nbsp;</td>
		<td><?php echo $user['User']['last_employer_name']; ?>&nbsp;</td>
		<td><?php echo $user['User']['last_job_title']; ?>&nbsp;</td>
		<td><?php echo $user['User']['created']; ?>&nbsp;</td>
		<td><?php echo $user['User']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New User', true), array('action' => 'add')); ?></li>
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