<div id="header">
	<div class="wrapper">
		<?php echo $this->Html->link('', '/', array('id' => 'logo')); ?>
		<div id="welcome-bar">
			<p class="welcome-user fl">Welcome <span class="user-name"><? if (array_key_exists ('User',$user)){echo $user['User']['first_name'];} else { echo $user['first_name'];} ?></span></p>
			<div id="invite-friends" class="fl">Invite</div>
			<?php echo $this->Html->link('Log Out', array('controller' => 'users', 'action' => 'logout'), array('id' => 'log-out', 'class' => 'fl')); ?>
		</div>
	</div>
</div>
