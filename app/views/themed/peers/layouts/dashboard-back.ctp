<!DOCTYPE html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>Dashboard | Peers &amp; Rivals</title>
	<?php
		echo $this->element('common_files');
		echo $this->Html->css(array('home','dashboard','network-panel','jquery.ui.datepicker'));
		echo $this->Html->script(array('dashboard','network-panel','boards','invite-friends','lib/jquery.smart_autocomplete','jobs-common'));
	?>
</head>
<body id="dashboard">
	<?php echo $this->element('dashboard-header'); ?>
	<div id="global-wrapper">
		<div id="container">
			<div class="wrapper">
				<div id="containt">
					<div id="brdcntnt-and-yrbrd">
						<div id="user-profile">
							<?php echo $this->element('dashboard/user_profile_info'); ?>
							<?php echo $this->element('dashboard/user_profile_employment'); ?>
						</div>
						<?php echo $this->element('network/network_panel'); ?>
					</div>
					<?php echo $this->element('boards/dashboard_boards'); ?>
				</div>
			</div>
		</div>
		<?php echo $this->element('footer'); ?>
	</div>
<?php echo $this->element('invite_friends'); ?>
<?php
if (empty($user['last_logged_in'])) {
    echo $this->element('dashboard/intro_tooltips');
}
?>
</body>