<?php html_comment('boards/view.ctp'); ?>

<?php /*
<?php //debug($board); // Uncomment for data dump ?>
<?php //debug($rankings_salary); // Uncomment for all salary rankings data ?>
<?php //debug($rankings_compensation); // Uncomment for all compensations rankings data ?>
*/ ?>
<?php $demoBoardIds = array( Configure::read('App.MaleDemoBoardId'), Configure::read('App.FemaleDemoBoardId') ); ?>
<div id="workers-list" class="scrollbar-container">
	<div class="scrollbar"><div class="track"><div class="thumb"></div></div></div>
	<div class="viewport">
		<div class="overview">
			<div class="board-members-list" id="board-<?= $board['Board']['id'];?>-list">
				<p id="workers-list-heading">
					<span id="workers-count"><?= count($rankings_salary); ?></span>
					viewing the board 
					<span id="co-worker-heading"><?= $board['Board']['name']; ?></span>
				</p>
				<ul>
					<?php foreach ($rankings_salary as $rank): ?>
						<li>
							<span class="name"><?= $rank['User']['first_name'].' '.$rank['User']['last_name'];?></span>
							<span class="info-tooltip">
								<span class="company"><?= $rank['User']['last_employer_name']; ?></span>
								<span class="title"><?= $rank['User']['last_job_title']; ?></span>
							</span>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<div id="salary-slider" style="width: 270px"></div>


<div id="interactive-graph">
<?php if (empty($logged_user_salary_ranking)): ?>
    <div>
		<form id="form-leave-board" method="POST" action="<?php echo Router::url(array('controller' => 'boards', 'action' => 'leave'));?>" >
			<div style="display:none;">
				<input type="hidden" name="_method" value="DELETE" />
				<input type="hidden" name="data[Board][id]" value="<?php echo $board['Board']['id'];?>" />
			</div>

			<div id="board-no-invite">
				<div id="board-no-graph">
					<!-- <p>You are trying to view the board named</p> -->
					<p class="board-name">&ldquo;<?= $board['Board']['name']?>&rdquo;</p>
                    <p class="subtext">You must have a job to view the details of this board.</p>
					<div class="buttons">
						<?php echo $this->Html->link('Add Job', 'javascript:void(0);', array('id' => 'add-job-for-board')); ?>
						<?php echo $this->Html->link('Leave Board', 'javascript:void(0);', array('id' => 'leave-board')); ?>
					</div>
				</div>
			</div>
		</form>
	</div>
<?php elseif ($min_required_members <= count($rankings_salary)): ?>
	<div>
		<form id="form-leave-board" method="POST" action="<?php echo Router::url(array('controller' => 'boards', 'action' => 'leave'));?>" >
			<div style="display:none;">
				<input type="hidden" name="_method" value="DELETE" />
				<input type="hidden" name="data[Board][id]" value="<?php echo $board['Board']['id'];?>" />
			</div>
		</form>
        <?php echo $this->Html->link('leave', 'javascript:void(0);', array('id' => 'workers-leave-button')); ?>
        <?php if (!in_array($board['Board']['parent_id'], $demoBoardIds)): ?>
            <?php echo $this->Html->link('invite', array('controller' => 'boards', 'action' => 'invite', $board['Board']['id']), array('id' => 'workers-invite-button')); ?>
        <?php endif; ?>
		<div class="board-slider-container" id="salary-slider-board-<?php echo $board['Board']['id'];?>">
			<?php
			echo $this->element('boards/salary_slider', array('rankings_salary' => $rankings_salary, 'my_ranking' => $logged_user_salary_ranking, 'slider_title' => 'Base Salary'));
			echo $this->element('boards/salary_slider',array('rankings_salary' => $rankings_compensation, 'my_ranking' => $logged_user_compensation_ranking, 'slider_title' => 'Total Compensation'));
			?>
		</div>
	</div>
<?php else: ?>
	<div>
		<form id="form-leave-board" method="POST" action="<?php echo Router::url(array('controller' => 'boards', 'action' => 'leave'));?>" >
			<div style="display:none;">
				<input type="hidden" name="_method" value="DELETE" />
				<input type="hidden" name="data[Board][id]" value="<?php echo $board['Board']['id'];?>" />
			</div>

			<div id="board-no-invite">
				<div id="board-no-graph">
					<!-- <p>The Board named</p> -->
					<p class="board-name">&ldquo;<?= $board['Board']['name']?>&rdquo;</p>
                    <p class="subtext">has fewer than <?php echo $min_required_members; ?> members. <!-- If members are not added to this board, it will be dispandened in <?php echo $expires_in . ' ' . __n('day', 'days', $expires_in, true); ?>.--></p>
					<div class="buttons">
                        <?php if (!in_array($board['Board']['parent_id'], $demoBoardIds)): ?>
						<?php echo $this->Html->link('Add Members', array('controller' => 'boards', 'action' => 'invite', $board['Board']['id']), array('id' => 'invite-members')); ?>
                        <?php endif; ?>
						<?php echo $this->Html->link('Leave Board', 'javascript:void(0);', array('id' => 'leave-board')); ?>
					</div>
				</div>
			</div>
		</form>
	</div>
<?php endif; ?>
</div>
