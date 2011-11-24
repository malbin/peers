Dear <?php echo $userName; ?>,

Your Board, &ldquo;<?php echo $boardName; ?>&rdquo;, has dropped below <?php echo Configure::read('App.MinBoardMembers'); ?> members &amp; will shortly disband.

Use the link below to add new members:
<?php echo Router::url(array('controller' => 'boards', 'action' => 'invite', $boardId), true); ?>

Please Note: If no action is taken, this board will automatically close in <?php echo Configure::read('App.BoardExpiryInDays'); ?> days.