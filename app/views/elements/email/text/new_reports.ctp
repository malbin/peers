Dear <?php echo $userName; ?>,

You have <?php echo $reportCount; ?> New <?php __n('Report', 'Reports', $reportCount); ?> Available!

To view them now, use the link below:

<?php echo Router::url('/dashboard', true); ?>