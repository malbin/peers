<?php html_comment('elements/job_entry.ctp'); ?>
<?php 
	/**
	 * Job entry element
	 * @param $job = array('Job' =>  array(...));
	 */  
?>

<div>
	<h3><?php echo $job['Job']['title']; ?></h3>
	
	<?php echo $this->Html->link(__('Add Compensation', true), array('controller' => 'compensations', 'action'=> 'add', $job['Job']['id'])); ?>
	<?php echo $this->Html->link(__('View', true), array('controller' => 'jobs', 'action' => 'view', $job['Job']['id'])); ?>
	<?php echo $this->Html->link(__('Edit', true), array('controller' => 'jobs', 'action'=> 'edit', $job['Job']['id'])); ?>
	<form method="POST" action="<?php echo Router::url(array('controller' => 'jobs', 'action' => 'delete'));?>" >
		<div style="display:none;">
			<input type="hidden" name="_method" value="DELETE" />
			<input type="hidden" name="data[Job][id]" value="<?php echo $job['Job']['id'];?>" />
		</div>
		<input type="submit" value="<?php __('Delete');?>" />
	</form>
	
	<div><?php echo $job['Employer']['name'];?></div>
	<?php
		$endDate = '0000-00-00' == $job['Job']['end_date'] ? 'PERSENT' : $this->Time->format('M Y', $job['Job']['end_date']); 
		echo $this->Time->format('M Y', $job['Job']['start_date']), ' - ', $endDate;
	?>
	<div><?php __('Base salary');?>: $<?php echo $job['Job']['salary']; ?></div>
	<?php if (!empty($job['Compensation'])): ?>
		<?php __('Compensation');?>
		<ul>
		<?php foreach($job['Compensation'] as $comp):?>
			<li>
				<?php echo $this->element('compensation_entry', array('comp' => array('Compensation' => $comp))); ?>
			</li>
		<?php endforeach;?>
		</ul>
	<?php endif;?>
</div>
