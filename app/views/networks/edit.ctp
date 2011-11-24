<?php html_comment('network/edit.ctp'); ?>

<?php //debug($this->data); //Uncomment for form data dump ?>

<div class="network form">
<?php echo $this->Form->create('Network', array('url' => array('controller' => 'networks', 'action' => 'edit', $this->data['Network']['id'])));?>
	<fieldset>
		<legend><?php __('EDIT NETWORK'); ?></legend>
		<?php echo $this->Form->input('name'); ?>
		<table>
		<?php foreach($users as $user): ?>
			<?php if ($user['User']['id'] != $logged_user['User']['id']): ?>
			<?php $checked = in_array($user['User']['id'], $this->data['MembersIds']) ? 'checked="checked"' : ''; ?>
			<tr>
				<td><input type="checkbox" name="data[User][User][]" value="<?php echo $user['User']['id'];?>" <?php echo $checked; ?>/></td>
				<td><?php echo $user['User']['first_name'].' '.$user['User']['last_name']; ?></td>
			</tr>
			<?php endif;?>
		<?php endforeach;?>
		</table>
	</fieldset>
<?php echo $this->Form->end(__('EDIT NETWORK', true));?>
</div>