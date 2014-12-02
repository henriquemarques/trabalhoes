<div class="payments form">
<?php echo $this->Form->create('Payment'); ?>
	<fieldset>
		<legend><?php echo __('Registrar Pagamento'); ?></legend>
	<?php
		echo $this->Form->input('table_id',array("options"=>$tables, "label"=>"Mesa"));
		echo $this->Form->input('status',array('value'=>'1','type'=>'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar Pagamentos'), array('action' => 'index')); ?></li>

	</ul>
</div>
