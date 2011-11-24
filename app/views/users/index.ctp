<?php html_comment('users/index.ctp'); ?>

<?php //debug($logged_user); // Uncomment for logged user data dump ?>

<?php echo $this->element('users_profile', array('user' => $logged_user)); ?>
