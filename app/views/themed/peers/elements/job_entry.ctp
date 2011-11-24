<?php
if (isset($job['Compensation'])) {
    $compensations = $job['Compensation'];
}
if (isset($job['Employer'])) {
    $employer = $job['Employer'];
}
if (isset($job['Job'])) {
    $job = $job['Job'];
}
$loc_editable= false;
if( $job['city'] == '' && $job['state'] == '' ){
	$loc_editable = true;
}

?>
<div class="profile-block <?= $loc_editable?"loc-edit":"";?>" id="job-<?=$job['id'];?>">
    <div class="profile-header">
        <a href="#" class="slider-button slide-down">&nbsp;</a>
        <div class="job-title-wrap">
            <a href="#" class="job-title"><?= $job['title'];?></a><a href="#" class="remove-job"></a><a href="#" class="alert-job"></a>
        </div>
        <a href="#" class="company-name-date">
            <span class="company-name">
                <?= $this->Format->company($job, $employer);?>
            </span>
            <span class="date"><?= $this->Format->date($job['start_date']);?> - <?= $this->Format->date($job['end_date']);?></span>
        </a>
    </div>
    <div class="sliding-show-hide compensation-container">
        <div class="base-salary">Base salary:
            <span class="base-salary-amount">
                <?= $this->Format->salary($job['currency'],$job['salary']); ?>
            </span>
        </div>
        <div class="add-compansation">
            <span class="add-com-button">add bonus</span>
            <input type="hidden" class="job-id" value="<?= $job['id'];?>">	
        </div>
        <?php if (!empty($compensations)): ?>
            <p class="other-com">other compensation</p>
            <?php foreach ($compensations as $compensation): ?>
                <?php echo $this->element('compensation_entry', array('comp' => $compensation)); ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
