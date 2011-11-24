<?php echo $this->element('home/header'); ?>
<!DOCTYPE html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>
        <?php
        if (!empty($title_for_layout)) {
            echo $title_for_layout . ' | ';
        }
        ?>
        Peers &amp; Rivals
    </title>
	<?php echo $this->element('common_files'); ?>

	<?php echo $this->Html->script(array('request-invite','vimeo')); ?>
</head>
<body id="homepage" class="generic">
	<!-- layout/page.ctp -->
	<div id="globe">
		<div id="header">
			<div class="wrapper">
				<?php echo $this->Html->link('', '/', array('id' => 'logo')); ?>
				<?php echo $this->element('home/login_form'); ?>
			</div>
		</div>
		<div class="icur5 irgbaform form-container">
			<div class="wrapper">
				<?php echo $content_for_layout; ?>
			</div>
		</div>
		
		<?php echo $this->element('home/guest_footer'); ?>
	</div>

	<div id="lightbox-invite-sent" class="closed" style="display:none">
		<?php echo $this->element('signup/invite_sent'); ?>
	</div>
</body>