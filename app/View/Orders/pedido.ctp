<div class="orders form">
	<?php if(count($pedidos_sessao) > 0){ ?>
	<fieldset>
		<legend>Produtos ja adicionados</legend>
		<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<th>Produto</th>
				<th>Quantidade</th>
				<th>Preço</th>
				<th>SubTotal</th>
				<th></th>
			</tr>
			<?php foreach($pedidos_sessao['Product'] as $pedido){ ?>
			<tr>
				<td><?php echo $pedido['Product']['name']; ?></td>
				<td><?php echo $pedido['quantity']; ?></td>
				<td><?php echo $pedido['Product']['price']; ?></td>
				<td><?php echo $pedido['Product']['price'] * $pedido['quantity']; ?></td>
				<td><?php echo $this->Html->link("Excluir", array('action'=> 'cancelar_pedido','product_id' => $pedido['Product']['id']), array( 'class' => 'button')); ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td colspan="4"><strong>Total</strong></td>
				<td><?php echo $pedidos_sessao['total']; ?></td>
			</tr>
		</table>
	</fieldset>
	<?php } ?>
	<?php echo $this->Form->create('Order',array("action" => "adicionar_pedido")); ?>
	<fieldset>
		<legend><?php echo __('Efetuar Pedido'); ?></legend>
		<?php
		array_walk_recursive($products, function(&$item, $key){
			if(!mb_detect_encoding($item, 'utf-8', true)){
				$item = utf8_encode($item);
			}
		});
		echo $this->Form->input('table_id',array('value'=>$this->Session->read("Table"),'type'=>'hidden')); 
		echo $this->Form->input('status',array('value'=>'Aberto','type'=>'hidden'));
		?>
		<div class="form-group">
		<?php
		echo $this->Form->input('OrderDetail.product_id',array('options'=>$products,'type'=>'select','class'=>'form-control','label'=>'Produto'));
		?>
		</div>
		<div class="form-group">
		<?php
		echo $this->Form->input('quantity',array('name'=>'data[OrderDetail][quantity]','type'=>'number','class'=>'form-control','label'=>'Quantidade'));
		?>
		</div>
	</fieldset>
	<?php if(count($pedidos_sessao) > 0){
		echo $this->Html->link("Finalizar Pedido", array('action'=> 'finalizar_pedido'), array( 'class' => 'button'));
	} ?>
	<?php echo $this->Form->end(__('Adicionar Pedido')); ?>
</div>

