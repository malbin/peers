<?php html_comment('board_invitations/view.ctp'); ?>

<?php /*
<?php debug($board_invitation) // Uncomment for invitation data dump ?>

<?php echo $this->element('board_invitation_entry', array('board_invitation' => $board_invitation)); ?>
*/ ?>

<div id="workers-list" class="scrollbar-container">
	<div class="scrollbar"><div class="track"><div class="thumb"></div></div></div>
	<div class="viewport">
		<div class="overview">
			<div class="board-members-list">
				<p id="workers-list-heading">
					<span id="workers-count"><?= count($board_invitation['BoardUsers']);?></span>
					viewing the board
					<span id="co-worker-heading"><?= $board_invitation['Board']['name'];?></span>
				</p>
				<ul>
					<?php foreach ($board_invitation['BoardUsers'] as $user): ?>
						<li>
							<span class="name"><?= $user['first_name'].' '.$user['last_name'];?></span>
							<span class="info-tooltip">
								<span class="company"><?= $user['last_employer_name']; ?></span>
								<span class="title"><?= $user['last_job_title']; ?></span>
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

	<div id="board-invite">
        <div id="board-no-graph">
            <!-- <p><?php __('You are trying to view the board'); ?></p> -->
            <p class="board-name">&ldquo;<?php echo $board_invitation['Board']['name']; ?>&rdquo;</p>
            <p class="subtext"><?php __('Click join to view this board.'); ?></p>
            <div class="buttons">
                <?php
                    echo $this->Form->create('BoardInvitation', array('id' => 'form-accept-invite', 'url' => array('controller' => 'board_invitations', 'action' => 'accept')));
                    echo $this->Form->hidden('id', array('value' => $board_invitation['BoardInvitation']['id']));
                    echo $this->Form->submit('Join', array('escape' => false));
                    echo $this->Form->end();
                    
                    echo $this->Form->create('BoardInvitation', array('id' => 'form-decline-invite', 'url' => array('controller' => 'board_invitations', 'action' => 'decline')));
                    echo $this->Form->hidden('id', array('value' => $board_invitation['BoardInvitation']['id']));
                    echo $this->Form->submit('Ignore', array('escape' => false));
                    echo $this->Form->end();
                ?>
            </div>
        </div>
	</div>

</div>
