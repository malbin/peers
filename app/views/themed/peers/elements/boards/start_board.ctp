<?php
// debug($networks);
?>
<div id="start-a-board" class="board-panel">
	<h1 class="start-a-board">Start a Board</h1>
    <?php
    if (!empty($this->data['Board']['id'])) {
        echo $this->Form->input('Board.id');
        echo $this->Form->input('Board.name', array('readonly' => 'readonly', 'class' => 'board-name', 'label' => false, 'placeholder' => 'Board name...'));
    } else {
        echo $this->Form->input('Board.name', array('class' => 'board-name validate[required]', 'label' => false, 'placeholder' => 'Board name...', 'maxlength'=>35));
    }
    ?>
    <div id="choose-participants">
        <h2>Choose Participants</h2>
        <div class="network-list">
            <ul>
                <?php foreach ($networks as $i => $network): ?>
                    <li id="network-<?php echo $network['Network']['id']; ?>"<?php echo ($i == 0 ? ' class="active"' : ''); ?>><?php echo $this->Text->truncate($network['Network']['name'], 18); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="work-group">
            <?php foreach ($networks as $i => $network): ?>
                <?php
                echo $this->element('boards/board_entry', array(
                    'networkId' => $network['Network']['id'],
                    'users' => $network['User'],
                    'visible' => ($i == 0)
                ));
                ?>
            <?php endforeach; ?>
        </div>
        <span class="clr">&nbsp;</span>
    </div>
    <div id="search-participants">
        <h2>Search</h2>
        <?php echo $this->Form->input('search', array('id' => 'search-participants-box', 'div' => false, 'label' => false, 'name' => 'search-participants', 'placeholder' => 'Search the Network')); ?>
        <div class="work-group">
            <div class="dummy-text-group" style="font-weight:200;">Search by<br />Name, Title, or Company</div>
            <?php
            echo $this->element('boards/board_entry', array(
                'users' => $users,
                'visible' => false
            ));
            ?>
        </div>
    </div>
</div>
