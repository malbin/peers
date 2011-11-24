<!DOCTYPE html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>signup-page</title>
	<?php echo $this->element('common_files'); ?>

</head>
<body id="homepage_mobile">
	<div id="globe">
		<div id="header">
			<div class="wrapper">
				<?php echo $this->Html->link('', '/', array('id' => 'logo')); ?>
			</div>
		</div>
		<?php echo $this->element('home/mobile_video'); ?>
		<?php echo $this->element('home/mobile_invitation'); ?>
		<?php echo $this->element('home/guest_footer'); ?>
	</div>
</body>