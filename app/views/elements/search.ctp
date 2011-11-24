
<h2><?php __('Search the network');?></h2>
	
<form method=GET action="/users/search/" >
	<input type="text" name="query" value="<?php echo isset($query) ? $query : '';?>" />
	<input type="submit" value="search" />
</form>
<?php if (!empty($query)): ?>
	<?php if (!empty($search_results)): ?>
		<?php $this->Paginator->options(array('url' => array_merge(array('query' => $query), $this->passedArgs))); // passing query with pagintion args ?>
		
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php __('Assign'); ?>
				<th><?php echo $this->Paginator->sort(__('Full name',true), 'first_name');?></th>
				<th><?php echo $this->Paginator->sort(__('Employer', true), 'last_employer_name');?></th>
				<th><?php echo $this->Paginator->sort(__('Title', true), 'last_job_title');?></th>
		</tr>
	<?php foreach ($search_results as $result): ?>
		<tr>
			<td><input type="checkbox" name="users[]" value="<?php echo $result['User']['id'];?>"/></td>
			<td><?php echo $result['User']['first_name'].' '.$result['User']['last_name']; ?></td>
			<td><?php echo $result['User']['last_employer_name'];?></td>
			<td><?php echo $result['User']['last_job_title'];?></td>
		</tr>
	<?php endforeach; ?>
		</table>
		<p>
		<?php
			echo $this->Paginator->counter(array(
				'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
			));
		?></p>
	
		<div class="paging">
			<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
		 | 	<?php echo $this->Paginator->numbers();?>
	 |
			<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
		</div>
	<?php else:?>
		No results found.
	<?php endif;?>
<?php endif; ?>