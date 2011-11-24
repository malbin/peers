<div id="network-<?= $network['Network']['id']; ?>-panel" class="network-panel-wrap">
	<h2 class="heading">Currently Viewing</h2>
    <input class="sub-heading network-name" value="&ldquo;<?= $network['Network']['name']; ?>&rdquo;" />
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th>Name</th>
				<th>Company</th> 
				<th>Title</th>
				<th><!-- blank above curved td --></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($network['User'] as $user): ?>
			<tr>
				<td class="name"><?= $user['first_name'].' '.$user['last_name']; ?></td>
				<td class="company">
						<p><?= $user['last_employer_name']; ?></p>
				</td> 
				<td class="title"><?= $user['last_job_title']; ?></td>
				<td class="icons"><span class="delete">&nbsp;</span></td>
				<td class="id"><?= $user['id'];?></td>
				<td><!-- curved td --></td>
			</tr>
			<?php endforeach; ?>

			<!--  TEST DATA for checking scrolling -->
			<?php   /* for ($i=0; $i < 100; $i++) { 
				echo '<tr><td class="name">Rob Palmer</td><td class="company"><p>Apple inc</p></td><td class="title">Designer</td><td class="icons"><span class="delete">&nbsp;</span></td><td class="id">9</td></tr>';
				}  */ ?>
		</tbody>
	</table>
</div>