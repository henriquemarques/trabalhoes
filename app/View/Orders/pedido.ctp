<div class="orders form">
	<?php echo $this->Form->create('Order'); ?>
	<fieldset>
		<legend><?php echo __('Efetuar Pedido'); ?></legend>
		<?php
		array_walk_recursive($products, function(&$item, $key){
			if(!mb_detect_encoding($item, 'utf-8', true)){
				$item = utf8_encode($item);
			}
		});
		echo $this->Form->input('table_id',array('value'=>'1','type'=>'hidden')); 
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
	<?php echo $this->Form->end(__('Confirmar Pedido')); ?>
</div>

