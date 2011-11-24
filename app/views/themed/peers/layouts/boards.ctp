<!DOCTYPE html> 
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>Boards | Peers &amp; Rivals</title>
	<?php
	echo $this->element('common_files');
	echo $this->Html->css(array('home', 'boards'));
    echo $this->Html->script(array('lib/jquery.tablesorter.custom', 'boards_add', 'invite-friends'));
	?>
    <?php if (!empty($this->data['User']['User'])): ?>
    <script type="text/javascript">
        boardUsers = <?php echo $this->Js->object(array_values($this->data['User']['User'])); ?>;
    </script>
    <?php endif; ?>
</head>
<body id="boards">
	<div id="global-wrapper">
		<?php echo $this->element('dashboard-header'); ?>
		<div id="container">
			<div class="wrapper">
                <?php echo $this->Form->create('Board'); ?>
				<?php echo $this->element('boards/start_board',array('networks' => $networks)); ?>
				<?php echo $this->element('boards/your_board'); ?>
                <?php echo $this->Form->end();?>
				<span class="clr">&nbsp;</span>
			</div>
		</div>
		<?php echo $this->element('footer'); ?>
	</div>
	<?php echo $this->element('invite_friends'); ?>
</body>