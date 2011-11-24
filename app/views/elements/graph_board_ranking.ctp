<?php html_comment('elemetns/graph_board_ranking.ctp'); ?>
<?php 
	/**
	 * Graph for board ranking
	 * 
	 * @param $first_ranking = array('rank' => 1, 'salary' => 10000.0)
	 * @param $user_ranking = array('rank' => 1, 'salary' => 10000.0)
	 * @param $last_ranking = array('rank' => 1, 'salary' => 10000.0)
	 */

?>

<?php if ($user_ranking['rank'] != $last_ranking['rank']): ?>
	<?php echo $last_ranking['rank'].'($'.$last_ranking['amount'].')'; ?> 
 	&lt; ------- &gt;
<?php endif;?>

<strong><?php echo $user_ranking['rank'].'($'.$user_ranking['amount'].')'; ?></strong>

<?php if ($user_ranking['rank'] != $first_ranking['rank']): ?>
 	&lt; ------- &gt;
	<?php echo $first_ranking['rank'].'($'.$first_ranking['amount'].')'; ?>
<?php endif; ?>