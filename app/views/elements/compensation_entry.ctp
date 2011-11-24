<?php html_comment('elements/compensation_entry.ctp'); ?>
<?php 
	/**
	 * Compensation entry element
	 * @param $comp = array('Compensation' =>  array(...));
	 */
     if (isset($comp['Compensation'])) {
         $comp = $comp['Compensation'];
     }
?>
<div class="compensation">
    <span class="base-salary"><?= $comp['type']; ?><sub><?= $this->Format->date($comp['award_date']);?></sub></span>
    <?php if (!empty($comp['cash']) && $comp['cash'] != 0): ?>
    <span class="base-salary"><span class="base-salary-amount"><?= $this->Format->salary($comp['currency'],$comp['cash']); ?></span>cash</span>
    <?php endif; ?>
    <?php if (!empty($comp['deferred']) && $comp['deferred'] != 0): ?>
    <span class="base-salary"><span class="base-salary-amount"><?= $this->Format->salary($comp['currency'],$comp['deferred']); ?></span>deferred</span>
    <?php endif; ?>
</div>