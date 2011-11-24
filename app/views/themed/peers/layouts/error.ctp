<?php echo $this->element('home/header'); ?>
<!DOCTYPE html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>Page not found | Peers &amp; Rivals</title>
	<?php echo $this->element('common_files'); ?>

	<?php echo $this->Html->script(array('request-invite','vimeo')); ?>
</head>
<body id="homepage" class="error404">
	<!-- layout/error.ctp -->
	<div id="globe">
		<div id="header">
			<div class="wrapper">
				<?php echo $this->Html->link('', '/', array('id' => 'logo')); ?>
				<?php echo $this->element('home/login_form'); ?>
			</div>
		</div>
		<div class="icur5 irgbaform form-container">
			<div class="wrapper">
				<h2 class="title">OH NO!</h2>
				<h3 class="sub-title">The page you are looking for cannot be found</h3>
<!--				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
			</div>
		</div>
		
		<?php echo $this->element('home/guest_footer'); ?>
	</div>

	<div id="lightbox-invite-sent" class="closed" style="display:none">
		<?php echo $this->element('signup/invite_sent'); ?>
	</div>
</body>
