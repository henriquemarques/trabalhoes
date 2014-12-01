<div class="payments form">
<?php echo $this->Form->create('Payment'); ?>
	<fieldset>
		<legend><?php echo __('Registrar Pagamento'); ?></legend>
	<?php
		echo $this->Form->input('order_id',array("label"=>"Pedido"));
		echo $this->Form->input('status',array("options"=>array("0"=>"Não Pago","1"=>"Pago")));
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
