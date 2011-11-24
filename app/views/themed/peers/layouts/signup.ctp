<!DOCTYPE html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>Signup | Peers &amp; Rivals</title>
<?php
	echo $this->element('common_files');

	echo $this->Html->script(array('signup-form','pr','lib/jquery.smart_autocomplete','jobs-common'));
	
	// Jquery UI Elements
	echo $this->Html->css('jquery.ui.datepicker');
?>
	<script type="text/javascript">
		var BASEURL = "<?php echo Router::url('/', true); ?>";
		var SIGNUP_CODE = "<?php echo @$code; ?>";
	</script>	
</head>
<body id="signup_activation">
		<?php /*
		<div class="left-panel disabled" href="#" id="goto-prev"><span class="left-button"></span></div>
		<div class="right-panel" href="#" id="goto-next"><span class="right-button"></span></div>
		*/?>
		<?php echo $this->element('signup/guest_header'); ?>
		<?php echo $this->element('signup/progress_bar'); ?>

<div id="signup-form">
	<div id="wrapper-mask">
		<!-- Step 1: Mobile number input -->
		<div id="signup-panel-mobile" class="slide-container">
			<div class="icur5 irgbaform form-container slide-wrapper">
				<?php echo $this->element('signup/signup_mobile'); ?>
			</div>
		</div>

		<!-- Step 2: Signup form -->
		<div id="signup-panel-details"  class="slide-container">
			<div class="icur5 irgbaform form-container slide-wrapper">
				<?php echo $this->element('signup/signup_form'); ?>
			</div>
		</div>

		<!-- Step 3: enter activation code sent to mobile -->
		<div id="signup-panel-activation"  class="slide-container">
			<div class="icur5 irgbaform form-container slide-wrapper">
				<?php echo $this->element('signup/signup_activation'); ?>
			</div>
		</div>
	</div>
</div>
</body>