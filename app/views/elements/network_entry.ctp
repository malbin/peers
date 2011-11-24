<?php html_comment('elements/network_entry.ctp'); ?>
<?php 
	/**
	 * Network entry element
	 * @param $network = array('Network' =>  array(...));
	 */  
?>

<div>
	<?php echo $network['Network']['name']; ?><br/>
	<?php echo $this->Html->link(__('View', true), array('controller' => 'networks', 'action' => 'view', $network['Network']['id'])); ?>
	<?php echo $this->Html->link(__('Edit', true), array('controller' => 'networks', 'action' => 'edit', $network['Network']['id'])); ?>
	<form method="POST" action="<?php echo Router::url(array('controller' => 'networks', 'action' => 'delete'));?>" >
		<div style="display:none;">
			<input type="hidden" name="_method" value="DELETE" />
			<input type="hidden" name="data[Network][id]" value="<?php echo $network['Network']['id'];?>" />
		</div>
		<input type="submit" value="<?php __('Delete');?>" />
	</form>
	
	<ul>
	<?php foreach($network['User'] as $user): ?>
		<li>
			<?php echo $user['first_name'].' '.$user['last_name']; ?>
			<form method="POST" action="<?php echo Router::url(array('controller' => 'networks', 'action' => 'delete_member'));?>" >
				<div style="display:none;">
					<input type="hidden" name="_method" value="DELETE" />
					<input type="hidden" name="data[Network][id]" value="<?php echo $network['Network']['id'];?>" />
					<input type="hidden" name="data[User][id]" value="<?php echo $user['id'];?>" />
				</div>
				<input type="submit" value="<?php __('Remove');?>" />
			</form>
		</li>
	<?php endforeach;?>
	</ul>
</div>