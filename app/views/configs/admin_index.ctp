<div class="configs index">
	<h2><?php __('Configs');?></h2>
	<ul>
		<li>App.BoardExpiryInDays - Number of days before a board with less than App.MinBoardMembers expires</li>
		<li>App.Email - Email used to send all Peers And Rivals emails</li>
		<li>App.FemaleDemoBoardId - Board ID for Female Demo Board (0 - disabled)</li>
		<li>App.MaleDemoBoardId - Board ID for Male Demo Board (0 - disabled)</li>
		<li>App.MinBoardMembers - Min number of require board member</li>
		<li>App.SignupWithCode - Signup only with code (1 -YES, 0 - NO)</li>
	</ul>
	<br/>
	<?php echo $this->Form->create('Config'); ?>
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php __('Key');?></th>
				<th><?php __('Value');?></th>
		</tr>
		<?php
		$i = 0;
		foreach ($configs as $config):
			$class = null;
			$key = $config['Config']['key'];
			$value = $config['Config']['value'];
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr <?php echo $class;?>>
			<td><?php echo $key; ?>&nbsp;</td>
			<td><input type="text" name="<?php echo "config[$key]";?>" value="<?php echo $value; ?>" /></td>
		</tr>
		<?php endforeach;?>
		</table>
	<?php echo $this->Form->end(__('Save', true));?>
</div>