
<?php __('BOARDS');?><br/>

<?php echo  $this->Html->link(__('Add board', true), array('controller' => 'boards', 'action' => 'add')); ?><br/>

<?php foreach ($boards as $board): ?>
	<p>------------------------------------</p>
	<?php echo $this->element('board_entry', array('board' => $board)); ?>
<?php endforeach; ?>