
<div style="float:left; width:300px; border: overflow: hidden;">
	<div>
		<?php echo $this->element('users_profile', array('user' => $logged_user)); ?>
	</div>
	<div>
		<?php echo $this->element('jobs', array('jobs' => $jobs));?>
                &nbsp;&nbsp;
                <?php echo $this->element('jobs', array('jobs' => $jobs));?>
	</div>
</div>
<div style="width: 510px; height:300px; float:right;">
	<?php echo $this->element('networks', array('networks' => $networks)); ?>
</div>
<div style="clear: both;"></div>
<div id="boards" style="width: 858px; height:300px;">
	<?php echo $this->element('boards', array('boards' => $boards)); ?>
</div>
<div style="width: 858px; height:300px;">
	<?php echo $this->element('board_invitations', array('board_invitations' => $board_invitations)); ?>
</div>