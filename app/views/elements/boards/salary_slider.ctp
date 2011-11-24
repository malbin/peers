<?php

$max_rank = count($rankings_salary);
$my_pos = $my_ranking['reported_rank'] - 1;

$dispersion = round($max_rank * 0.05);
if ($dispersion < 2) {
    $dispersion = 2;
}

$right_marker = $my_pos - $dispersion;
$left_marker = $my_pos + $dispersion;

if ($my_pos == 0) {
    $right_marker = -1;
} elseif ($my_pos <= $dispersion - 1) {
    $right_marker = 0; // Rank 1
} elseif ($my_pos == $max_rank - 1) {
    $left_marker = -1;
} elseif ($my_pos >= $max_rank - $dispersion - 1) {
    $left_marker = $max_rank - 1;
}

if ($logged_user_salary_ranking['tie']) {
    $left_marker = -1;
}

$width = 410;
$my_x = $width * ($max_rank - 1 - $my_pos) / ($max_rank - 1) ;
$left_x = $left_marker < 0 ? 0 : $width * ($max_rank - 1 - $left_marker) / ($max_rank - 1);
$right_x = $right_marker < 0 ? 0 : $width * ($max_rank - 1 - $right_marker) / ($max_rank - 1);

/* if there are too many members, then the markers overlap each other.
* This fix is for giving a minimum distance between markers
* @TC
**/
if($max_rank > 10){
	$left_x = $left_marker < 0 ? 0 : $my_x - 100;
	$right_x = $right_marker < 0 ? 0 : $my_x + 100;	
	if($left_x < 0){
		$my_x = 60;
		$right_x = 120;
		$left_x = 0;
	} else if($right_x >= 410){
		$my_x = 340;
		$right_x = 410;
		$left_x = 270;
	}
}

$left_text_x = ($left_x + $my_x)/2;
$right_text_x = ($right_x + $my_x)/2;

?>

<div class="rank-meter" class="base-salary-rank">
	<p class="grph-hd-txt">rank</p>
	<p class="graph-scale"><span class="graph-scale-end"><?= $max_rank; ?></span><span class="graph-scale-start">1</span></p>
	<?php if($left_marker != -1): ?>
	<div class="roller frst" style="left:<?= $left_x;?>px;">
		<a href="#" class="small-roller"><?= $rankings_salary[$left_marker]['Ranking']['rank']; ?></a>
	</div>
	<?php endif ?>
	<div class="roller scnd" style="left:<?= $my_x; ?>px">
		<span class="weigh-tooltip">$<?= number_format($my_ranking['amount'],0,'.',','); ?></span>
		<a href="#" class="big-roller" style="background-color:<?= $this->Format->roller_color($max_rank, $my_ranking['reported_rank']);?>"><?= $my_ranking['reported_rank']; ?></a>
	</div>
	
	<?php if($right_marker != -1): ?>
		<div class="roller thrd"  style="left:<?= $right_x;?>px"><a href="#" class="small-roller"><?= $rankings_salary[$right_marker]['Ranking']['rank']; ?></a></div>
	<?php endif ?>
	<?php if($left_marker != -1): ?>
	<p class="financial-gap frst" style="left:<?= $left_text_x;?>px">
		$<?= number_format(($my_ranking['amount'] - $rankings_salary[$left_marker]['Ranking']['amount']),0,'.',','); ?>
	</p>
	<?php endif ?>
	<?php if($right_marker != -1): ?>
	<p class="financial-gap scnd" style="left:<?= $right_text_x;?>px">
		$<?= number_format(( $rankings_salary[$right_marker]['Ranking']['amount'] - $my_ranking['amount']),0,'.',','); ?></p>
	<?php endif ?>
	<p><?= $slider_title;?></p>
</div>