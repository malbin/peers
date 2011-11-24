
<?php __('EMPLOYMENT');?><br/>

<?php echo  $this->Html->link(__('Add job', true), array('controller' => 'jobs', 'action' => 'add')); ?><br/>

<?php 
	foreach ($jobs as $job):
		echo $this->element('job_entry', array('job' => $job));
		echo '<p>---------------------------------</p>';
	endforeach; 
?>