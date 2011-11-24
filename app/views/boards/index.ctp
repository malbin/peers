<?php html_comment('boards/index.ctp'); ?>
<?php /*
<?php //debug($boards); // Uncomment for data dump ?>

<?php echo $this->element('boards', array('boards' => $boards)); ?>
<p>------------------</p>
*/ ?>

<?php if (!empty($boards)): ?>
	<div id="board-containt-lower-menu">

		<ul id="boards-list">
			<?php if(count($boards) > 7): ?>
			<span href="#" id="view-back-boards" class="button_off unselectable" onselectstart="return false">View <span id="back_boards_count">0</span> More</span>
			<?php endif; ?>
			<?php $n = count($boards) > 6 ? 7:count($boards); ?>
            <input type="hidden" id="board_count" value="<? echo count($boards); ?>"/>
            <?
			for($i=0; $i < $n; $i++): 
				$board = $boards[$i];
			?>
				<li class="board-option" id="board_menu_<?php echo $i ?>" data="<?php echo $board['Board']['id'];?>">
					<?php
                    echo $this->Text->truncate($board['Board']['name'], 18);
                    $isUpdated = (!empty($board['BoardUpdate']['id']) && (empty($board['BoardUpdate']['last_viewed']) || strtotime($board['BoardUpdate']['last_viewed']) < strtotime($board['Board']['modified'])));
                    ?>
					<span class="count<?php echo ($isUpdated ? ' updated' : ''); ?>"><?php echo $board['Board']['count'];?></span>
				</li>
			<?php endfor; ?>
                
		<?php if(count($boards) > 7): ?>
			<?php for($i=7;$i<count($boards);$i++): $board = $boards[$i]; ?>
				<li class="board-option option_hidden" id="board_menu_<?php echo $i ?>" data="<?php echo $board['Board']['id'];?>">
					<?php
                    echo $this->Text->truncate($board['Board']['name'], 18);
                    $isUpdated = (!empty($board['BoardUpdate']['id']) && (empty($board['BoardUpdate']['last_viewed']) || strtotime($board['BoardUpdate']['last_viewed']) < strtotime($board['Board']['modified'])));
                    ?>
					<span class="count<?php echo ($isUpdated ? ' updated' : ''); ?>"><?php echo $board['Board']['count'];?></span>
				</li>
			<?php endfor; ?>
		<?php endif; ?>
                
        </ul>
        <?php if(count($boards) > 7): ?>
        <span href="#" id="view-more-boards" class="view-more-boards unselectable" onselectstart="return false">View <span id="more_boards_count"><?php echo count($boards)-7; ?></span> More</span>
        <?php endif; ?>
	</div>
	
	<div id="chart-sheet">
		<?php /* loaded with AJAX from /boards/view/BOARD_ID */ ?>
	</div>
<?php else: ?>
    <div id="no-boards">
        <p>You are not currently a<br />member of any boards.</p>
        <?php echo $this->Html->link('Create a Board Now!', array('controller' => 'boards', 'action' => 'add')); ?>
    </div>
<?php endif; ?>
