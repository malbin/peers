ERROR!!
<h2><?php echo $name; ?></h2>
<p class="error">
	<strong><?php __('Error'); ?>: </strong>
	<?php printf(__('The requested address %s was not found on this server.', true), "<strong>'{$message}'</strong>"); ?>
</p>