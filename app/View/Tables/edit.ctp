<div class="tables form">
<?php echo $this->Form->create('Table'); ?>
	<fieldset>
		<legend><?php echo __('Edit Table'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('number');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Table.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Table.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Tables'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
	</ul>
</div>
