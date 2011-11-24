
<?php __('BOARD INVITATIONS');?><br/>

<?php foreach ($board_invitations as $invite): ?>
	<p>------------------------------------</p>
	<?php echo $this->element('board_invitation_entry', array('board_invitation' => $invite)); ?>
<?php endforeach; ?>