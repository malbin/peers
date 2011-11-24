<?php __('PROFILE'); ?><br/>

<?php echo $this->Html->link(__('Edit', true), array('controller'=> 'users', 'action' => 'edit')); ?><br/>
<ul>
	<li><?php echo $user['User']['first_name'].' '.$user['User']['last_name']; ?></li>
	<li><?php echo $user['User']['email']; ?></li>
	<li><?php echo $user['User']['phone']; ?></li>
</ul>
