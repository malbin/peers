
<?php __('NETWORK');?><br/>

<?php echo  $this->Html->link(__('Add network', true), array('controller' => 'networks', 'action' => 'add')); ?><br/>

<?php foreach ($networks as $net): ?>
	<p>------------------------------------</p>
	<?php echo $this->element('network_entry', array('network' => $net)); ?>
<?php endforeach; ?>