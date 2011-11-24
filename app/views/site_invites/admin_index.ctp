<div class="siteInvites index">
	<h2><?php __('Site Invites');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('country_id');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('code');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('scheduled_time');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($siteInvites as $siteInvite):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $siteInvite['SiteInvite']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($siteInvite['Country']['name'], array('controller' => 'countries', 'action' => 'view', $siteInvite['Country']['id'])); ?>
		</td>
		<td><?php echo $siteInvite['SiteInvite']['email']; ?>&nbsp;</td>
		<td><?php echo $siteInvite['SiteInvite']['name']; ?>&nbsp;</td>
		<td><?php echo $siteInvite['SiteInvite']['code']; ?>&nbsp;</td>
		<td><?php echo $siteInvite['SiteInvite']['status']; ?>&nbsp;</td>
		<td><?php echo $siteInvite['SiteInvite']['scheduled_time']; ?>&nbsp;</td>
		<td><?php echo $siteInvite['User']['first_name'] . ' ' . $siteInvite['User']['last_name']; ?>&nbsp;</td>
		<td><?php echo $siteInvite['SiteInvite']['created']; ?>&nbsp;</td>
		<td><?php echo $siteInvite['SiteInvite']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Send', true), array('action' => 'send', $siteInvite['SiteInvite']['id']), null,
				sprintf(__("Send signup invite to '%s'", true), $siteInvite['SiteInvite']['email'])); ?>
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $siteInvite['SiteInvite']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $siteInvite['SiteInvite']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $siteInvite['SiteInvite']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $siteInvite['SiteInvite']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Site Invite', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li>
	</ul>
</div>