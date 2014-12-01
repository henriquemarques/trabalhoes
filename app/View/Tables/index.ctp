<div class="tables index">
	<h2><?php echo __('Tables'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('number'); ?></th>
			<th>Status</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($tables as $table): ?>
	<tr>
		<td><?php echo h($table['Table']['id']); ?>&nbsp;</td>
		<td><?php echo h($table['Table']['number']); ?>&nbsp;</td>
		<td><?php echo ($table['Table']['disponivel']) ? 'Liberada' : 'Ocupada'; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $table['Table']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $table['Table']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $table['Table']['id']), array(), __('Are you sure you want to delete # %s?', $table['Table']['id'])); ?>
			<?php if(!$table['Table']['disponivel']){ ?>
			<?php echo $this->Html->link(__('Liberar'), array('action' => 'liberar', $table['Table']['id'])); ?>
			<?php } ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Table'), array('action' => 'add')); ?></li>
	</ul>
</div>
