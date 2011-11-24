<?php

$max_rank = count($rankings_compensation);

$my_pos = 0;

$ranking_data = array();
$last_amount=-1;
$count=0;
foreach($rankings_compensation as $rank){
	
	if($rank['User']['id'] == $logged_user['User']['id']){
		$my_pos = $count;
	}
	
//	if($last_amount != $rank['Ranking']['amount']){
		$rank_data = array('id'=>$rank['User']['id'],'rank'=>$rank['Ranking']['rank'],'amount'=>$rank['Ranking']['amount'] );
		$ranking_data[] = $rank_data;
		$count++;
//	}
	$last_amount = $rank['Ranking']['amount'];
}
$count_rank = count($ranking_data);
$right_marker = $my_pos - 2;
$left_marker = $my_pos + 2;

if($ranking_data[$my_pos]['rank'] == 1){
	$right_marker = -1;
} else if($my_pos == 1){
	$right_marker = 0;
} else if($my_pos == $count_rank - 1){
	$left_marker = -1;
} 	else if($my_pos == ($count_rank - 2)){
	$left_marker = $count_rank -1;
}
$width = 410;

$left_x = $left_marker < 0 ? 0 : $width * ($count_rank - $ranking_data[$left_marker]['rank'] + 1) / $max_rank;
$right_x = $right_marker < 0 ? 0 : $width * ($count_rank - $ranking_data[$right_marker]['rank'] + 1) / $max_rank;
$my_x = $width * ($count_rank - $ranking_data[$my_pos]['rank'] + 1) / $max_rank;
$left_text_x = ($left_x + $my_x)/2;
$right_text_x = ($right_x + $my_x)/2;

?>

<div class="rank-meter" class="base-salary-rank">
	<p class="grph-hd-txt">rank</p>
	<p class="graph-scale"><span class="graph-scale-end"><?= $max_rank; ?></span><span class="graph-scale-start">1</span></p>
	<?php if($left_marker != -1): ?>
	<div class="roller frst" style="left:<?= $left_x;?>px;">
		<a href="#" class="small-roller"><?= $ranking_data[$left_marker]['rank']; ?></a>
	</div>
	<?php endif ?>
	<div class="roller scnd" style="left:<?= $my_x; ?>px">
		<span class="weigh-tooltip">$<?= number_format($ranking_data[$my_pos]['amount'],0,'.',','); ?></span>
		<a href="#" class="big-roller" style="background-color:<?= $this->Format->roller_color($max_rank,$ranking_data[$my_pos]['rank']);?>"><?= $ranking_data[$my_pos]['rank']; ?></a>
	</div>
	
	<?php if($right_marker != -1): ?>
		<div class="roller thrd"  style="left:<?= $right_x;?>px"><a href="#" class="small-roller"><?= $ranking_data[$right_marker]['rank']; ?></a></div>
	<?php endif ?>
	<?php if($left_marker != -1): ?>
	<p class="financial-gap frst" style="left:<?= $left_text_x;?>px">
		$<?= number_format(($ranking_data[$my_pos]['amount'] - $ranking_data[$left_marker]['amount']),0,'.',','); ?>
	</p>
	<?php endif ?>
	<?php if($right_marker != -1): ?>
	<p class="financial-gap scnd" style="left:<?= $right_text_x;?>px">
		$<?= number_format(( $ranking_data[$right_marker]['amount'] - $ranking_data[$my_pos]['amount']),0,'.',','); ?></p>
	<?php endif ?>
	<p>total compensation</p>
</div>