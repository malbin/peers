<div class="create-group">
	<input type="text" name="group-name" class="group-name placeholder" placeholder="Group Name...">
    <?php // Alternative to data-prompt-position which isn't fixed in jquery.validationEngine 2.2.2 ?>
    <span id="create-group-validation-prompt" style="position: relative; top: -10px; left: -35px;">&nbsp;</span>
	<h3 class="title">Group So Far</h3>
	<div class="scroll-wrap">
		<table cellpadding="0" cellspacing="0">
			<tbody>
			</tbody>
		</table>
	</div>
	<span class="create-bt">&nbsp;</span>
</div>
<script type="text/javascript" charset="utf-8">
	$('.create-group .placeholder').placeholder();
</script>