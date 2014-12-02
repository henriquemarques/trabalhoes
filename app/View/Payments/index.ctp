<div class="payments index">
	<h2><?php echo __('Pagamentos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('order_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($payments as $payment): ?>
	<tr>
		<td><?php echo h($payment['Payment']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($payment['Order']['id'], array('controller' => 'orders', 'action' => 'view', $payment['Order']['id'])); ?>
		</td>
		<td><?php echo ($payment['Payment']['status']) ? '<span class="label label-success">Pago</span>
' : '<span class="label label-danger">Não Pago</span>'; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $payment['Payment']['id']), array(), __('Are you sure you want to delete # %s?', $payment['Payment']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Registrar Pagamento'), array('action' => 'add')); ?></li>
	</ul>
</div>
