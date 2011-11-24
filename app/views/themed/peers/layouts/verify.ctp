<!DOCTYPE html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>signup-page</title>
	<?php echo $this->element('common_files'); ?>

	<? echo $this->Html->script('signup-form'); ?>
	<? echo $this->Html->script('pr'); ?>
	<script type="text/javascript">
		var BASEURL = "<?php echo Router::url('/', true); ?>";
	</script>
</head>
<body id="signup_activation">
		<?php echo $this->element('signup/guest_header'); ?>
		<?php echo $this->element('signup/progress_bar_final'); ?>

<div id="signup-form">
	<div id="signup-panel-activation">
		<div class="icur5 irgbaform form-container slide-wrapper">
			<?php echo $this->element('signup/signup_activation'); ?>
		</div>
	</div>
</div>
</body>