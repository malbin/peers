<div id="network-dropdown-container">&nbsp;</div>
<div id="network-panel">
<div class="wrapper">

		<!-- <div style="overflow:hidden;"> -->
			<p class="fl network-text">network</p>
			<div id="searchwrapper">
				<form action="" onsubmit="return false;">
					<input type="text" class="searchbox" name="s" id="network-panel-search" placeholder="search the network" />
				</form>
			</div>
		<!-- </div> -->

		<div id="network-panel-body">
			<div id="networks-list" class="fl">
				<p id="group-title">Groups</p>
                <div class="network-list">
                    <ul>
                        <?php foreach ($networks as $network): ?>
                            <li id="network-<?php echo $network['Network']['id']; ?>"><?php echo $this->Text->truncate($network['Network']['name'], 18); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
				<span id="add-group">&nbsp;</span>
			</div>
			<div id="network-data">
				<div class="network-panel-container" id="network-panel-container" style="display:none">
					<div class="scrollbar"><div class="track"><div class="thumb"></div></div></div>
					<div class="viewport">
						<div class="overview">
							<?php foreach ($networks as $network) {
							echo $this->element('network/network_entry',array('network'=>$network));
							} ?>
						</div>
					</div>

				</div>
				<div class="banner">
					<div class="dummy-text-group">select a group to view</div>
					<div  id="start-new-group">&nbsp;</div>
					<span class="clr">&nbsp;</span>
				</div>
				<div id="create-group-container" class="network-panel-container" style="display:none">
					<?php echo $this->element('network/create_group'); ?>
				</div>
			</div>
			<span class="clr">&nbsp;</span>
		</div>
	</div>
</div>