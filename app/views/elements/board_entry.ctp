<?php html_comment('elements/board_entry.ctp'); ?>
<?php 
	/**
	 * Board entry element
	 * @param $board = array('Board' =>  array(...));
	 */  
?>

<div>
	<?php echo $board['Board']['name']; ?><br/>
	<?php echo $this->Html->link(__('View', true), array('controller' => 'boards', 'action' => 'view', $board['Board']['id'])); ?>
	<?php echo $this->Html->link(__('Invite', true), array('controller' => 'boards', 'action' => 'invite', $board['Board']['id'])); ?>
	<form method="POST" action="<?php echo Router::url(array('controller' => 'boards', 'action' => 'leave'));?>" >
		<div style="display:none;">
			<input type="hidden" name="_method" value="DELETE" />
			<input type="hidden" name="data[Board][id]" value="<?php echo $board['Board']['id'];?>" />
		</div>
		<input type="submit" value="<?php __('Leave');?>" />
	</form>
	<ul>
	<?php foreach($board['User'] as $user): ?>
		<li>
			<?php echo $user['first_name'].' '.$user['last_name']; ?>
		</li>
	<?php endforeach;?>
	</ul>

</div>