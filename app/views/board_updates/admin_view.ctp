<div class="boardUpdates view">
<h2><?php  __('Board Update');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $boardUpdate['BoardUpdate']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Board'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($boardUpdate['Board']['name'], array('controller' => 'boards', 'action' => 'view', $boardUpdate['Board']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($boardUpdate['User']['email'], array('controller' => 'users', 'action' => 'view', $boardUpdate['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Last Viewed'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $boardUpdate['BoardUpdate']['last_viewed']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $boardUpdate['BoardUpdate']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $boardUpdate['BoardUpdate']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Board Update', true), array('action' => 'edit', $boardUpdate['BoardUpdate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Board Update', true), array('action' => 'delete', $boardUpdate['BoardUpdate']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $boardUpdate['BoardUpdate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Board Updates', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board Update', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards', true), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board', true), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
