<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>homepage.ctp - 
		<?php __('Peers And Rivals: '); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('cake.generic.css');
		echo $scripts_for_layout;
		echo $this->Html->script('jquery-1.6.2.min');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1>Peers And Rivals</h1>
		</div>
		<div id="content">
			
			<?php echo $this->Session->flash(); ?>
			
			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
			<?php echo $this->element('footer'); ?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>