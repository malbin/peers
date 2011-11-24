<?php
$panelId = 'participants-panel' . (isset($networkId) ? "-{$networkId}" : '');
?>
<div id="<?= $panelId; ?>" class="participants-wrap<?php echo (isset($visible) && !$visible ? '' : ' active'); ?>">
	<table>
		<thead>
			<tr>
				<th class="checkbox">
                   <!-- <?php echo $this->Form->label('Assign'); ?> -->
                    <?php echo $this->Form->checkbox('assign', array('name' => '')); ?>
				</th>
				<th class="name"><?php echo $this->Html->link('Name', 'javascript:void(0);'); ?></th>
				<th class="company"><?php echo $this->Html->link('Company', 'javascript:void(0);'); ?></th>
				<th class="title"><?php echo $this->Html->link('Title', 'javascript:void(0);'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
        foreach ($users as $user):
            if (isset($user['User'])) {
                $user = $user['User'];
            }
        ?>
		<tr>
			<td class="checkbox">
                <?= $this->Form->checkbox("board_participants.{$user['id']}", array('label' => false, 'value' => $user['id'], 'checked' => (@in_array($user['id'], $this->data['User']['User'])))); ?>
			</td>
			<td class="name">
                <?= $user['first_name'].' '.$user['last_name']; ?>
			</td>
			<td class="company">
				<?= $user['last_employer_name']; ?>
			</td>
			<td class="title">
				<?= $user['last_job_title']; ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
