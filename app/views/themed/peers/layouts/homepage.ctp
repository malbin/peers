<?php echo $this->element('home/header'); ?>
<!DOCTYPE html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>Welcome to Peers &amp; Rivals</title>
	<?php echo $this->element('common_files'); ?>
	<?php echo $this->Html->script(array('request-invite')); ?>
</head>
<body id="homepage">
	<?php
	echo $content_for_layout;
	?>
	<!-- layout/homepage.ctp -->
	<div id="lightbox-invite-sent" class="closed" style="display:none">
		<?php echo $this->element('signup/invite_lightbox'); ?>
	</div>
	<div id="globe">
		<div id="header">
			<div class="wrapper">
				<?php echo $this->Html->link('', '/', array('id' => 'logo')); ?>
				<?php echo $this->element('home/login_form'); ?>
			</div>
		</div>
		<?php
		echo $this->element('home/home_video');
		echo $this->element('home/invitation');
		echo $this->element('home/guest_footer');
		?>
	</div>

</body>