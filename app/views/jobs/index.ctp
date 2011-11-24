<?php html_comment('jobs/index.ctp'); ?>

<?php //debug($jobs); // Uncomment for jobs data dump ?>

<?php echo $this->element('jobs', array('jobs' => $jobs));?>
