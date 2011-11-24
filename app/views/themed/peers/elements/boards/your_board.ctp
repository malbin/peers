<div id="board-so-far" class="board-panel">
	<h1>Your Board So Far</h1>
	<h2 class="network-text">Network</h2>
    <?php foreach ($networks as $network): ?>
	<div class="group-box" id="group-box-<?php echo $network['Network']['id']; ?>">
        <h3><?php echo $network['Network']['name']; ?></h3>
        <span class="group-box-counter">0</span>
        <span class="clr"></span>
        <ul></ul>
	</div>
    <?php endforeach; ?>
	<h2 class="other-text">Other</h2>
	<div class="group-box" id="group-box-other">
        <ul>
        <?php
        if (!empty($this->data['User']['User'])):
            foreach ($this->data['User']['User'] as $invitedUserId):
                $invitedUserDetails = Set::extract("/User[id={$invitedUserId}]", $this->data);
        ?>
            <li><?php // Don't leave whitespace; Sorting of the names in this panel depends on it
                echo $invitedUserDetails[0]['User']['first_name'] . ' ' . $invitedUserDetails[0]['User']['last_name'];
                echo $this->Form->input('User', array('type' => 'hidden', 'name' => "data[User][User][{$invitedUserId}]", 'value' => $invitedUserId));
                echo $this->Html->link('', 'javascript:void(0);', array('class' => 'dlt-co-name'));
            ?></li>
        <?php
            endforeach;
        endif;
        ?>
        </ul>
	</div>
    <?php
    $createBoardButtonText = ($this->params['action'] == 'invite' ? 'invite' : 'invite');
    echo $this->Form->submit($createBoardButtonText, array('div' => false, 'name' => 'create-board-submit', 'id' => 'create-board', 'escape' => false));
    echo $this->Html->link('cancel', '/dashboard', array('id' => 'create-board-cancel', 'name' => 'create-board-cancel'));
    ?>
</div>
