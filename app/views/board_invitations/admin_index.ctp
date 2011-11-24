<div class="boardInvitations index">
	<h2><?php __('Board Invitations');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('inviter_id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('board_id');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($boardInvitations as $boardInvitation):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $boardInvitation['BoardInvitation']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($boardInvitation['Inviter']['email'], array('controller' => 'users', 'action' => 'view', $boardInvitation['Inviter']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($boardInvitation['User']['email'], array('controller' => 'users', 'action' => 'view', $boardInvitation['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($boardInvitation['Board']['name'], array('controller' => 'boards', 'action' => 'view', $boardInvitation['Board']['id'])); ?>
		</td>
		<td><?php echo $boardInvitation['BoardInvitation']['status']; ?>&nbsp;</td>
		<td><?php echo $boardInvitation['BoardInvitation']['created']; ?>&nbsp;</td>
		<td><?php echo $boardInvitation['BoardInvitation']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $boardInvitation['BoardInvitation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $boardInvitation['BoardInvitation']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $boardInvitation['BoardInvitation']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $boardInvitation['BoardInvitation']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Board Invitation', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inviter', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards', true), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board', true), array('controller' => 'boards', 'action' => 'add')); ?> </li>
	</ul>
</div>