<?php html_comment('boards/add.ctp');?>

<?php //debug($this->data); // Uncomment for form data dump ?>
<?php //debug($employers); // Uncomment for employers list data dump ?>

<div class="boards form">
<?php echo $this->Form->create('Board', array('url' => array('controller' => 'boards', 'action' => 'add')));?>
	<fieldset>
		<legend><?php __('ADD BOARD'); ?></legend>
		<?php echo $this->Form->input('name'); ?>
		<table>
		<?php foreach($users as $user): ?>
			<?php if ($user['User']['id'] != $logged_user['User']['id']): ?>
			<tr>
				<td><input type="checkbox" name="data[User][User][]" value="<?php echo $user['User']['id']; ?>" /></td>
				<td><?php echo $user['User']['first_name'].' '.$user['User']['last_name']; ?></td>
			</tr>
			<?php endif;?>
		<?php endforeach;?>
		</table>
	</fieldset>
<?php echo $this->Form->end(__('ADD BOARD', true));?>
</div>

<?php echo $this->element('networks', array('networks' => $networks)); ?>

<?php echo $this->element('search');?>

