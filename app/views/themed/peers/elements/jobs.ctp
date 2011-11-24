<div id="no-jobs"<?php echo (!empty($jobs) ? ' style="display: none;"' : ''); ?>>
    <?php echo $this->Html->image('no-jobs.png'); ?>
    <p>You currently<br />have no jobs</p>
</div>
<?php
    foreach ($jobs as $job) {
        echo $this->element('job_entry', array('job' => $job));
    }
?>