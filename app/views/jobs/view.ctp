<?php html_comment('jobs/view.ctp'); ?>

<?php //debug($job); // Uncomment for job data dump ?>

<?php echo $this->element('job_entry', array('job' => $job)); ?>
