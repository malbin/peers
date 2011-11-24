<div style="color: #7f674c; font-family: Arial; font-size: 18px; padding-bottom: 5px; text-align: center;">Your Board</div>
<div style="color: #6d593e; font-family: Arial; font-size: 23px; font-weight: bold; padding-bottom: 10px; text-align: center;"><span style="color: #c2b3a0;">&ldquo;</span><?php echo $boardName; ?><span style="color: #c2b3a0;">&rdquo;</span></div>
<div style="color: #80684d; font-family: Arial; font-size: 13px; line-height: 18px; text-align: center;">
    Has dropped below <?php echo Configure::read('App.MinBoardMembers'); ?> members &amp; will shortly disband.
</div>
<div style="background: #d0c7bd; height: 1px; margin: 18px 0;"></div>
<div style="text-align: center;">
    <?php echo $this->Html->image(FULL_BASE_URL . 'theme/peers/img/PR-email-add-members.png', array('url' => Router::url(array('controller' => 'boards', 'action' => 'invite', $boardId), true), 'alt' => 'Add Members')); ?>
</div>
<div style="background: #d0c7bd; height: 1px; margin: 18px 0;"></div>
<div style="color: #80684d; font-family: Arial; font-size: 13px; text-align: center; padding: 0 10px;">
    Please Note: If no action is taken, this board will automatically close in <?php echo Configure::read('App.BoardExpiryInDays'); ?> days.
</div>