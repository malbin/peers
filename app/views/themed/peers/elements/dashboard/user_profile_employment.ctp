<div id="user-profile-employment">
	<p class="fl choose-par-text">EMPLOYMENT</p>
	<input type="button" name="add-job-button" value="" id="add-job-button">
	<?php echo $this->element('dashboard/add_job_standard'); ?>

	<div id="profile-jobs">
		<?php echo $this->element('jobs', array('jobs' => $jobs)); ?>	
	</div>
	<div id="add-compensation-lightbox" style="display:none">
		<?php echo $this->element('dashboard/add_compensation'); ?>
	</div>
</div>