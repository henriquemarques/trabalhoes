<div class="orders index">
	<h2><?php echo __('Pedidos'); ?></h2>
	<div class="row">
		<?php						
 foreach ($orders as $order): ?>
		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<div class="caption">
					<h3>Pedido <?php echo $order['Order']['id'];?></h3>
					<p>
						<strong>Clinte:</strong><?php echo h($order['User']['name']); ?><br/>
						<strong>Mesa:</strong><?php echo h($order['Table']['number']); ?><br/>	
						<strong>Itens:</strong></br>
						<?php 
						$total = 0;
						foreach ($order['Product'] as $product):
							$total += ($product['price']*$product["OrdersProduct"]['quantity']);
						?>

						- <?php echo utf8_encode($product["name"]);?></br>
					<?php endforeach; ?>
						<strong>Valor: </strong>R$ <?php echo $total;?></br>
				</p>
				<p>
					<?php
					 echo $this->Form->create("Order",array("action"=>"liberar_pedido"));
					 echo $this->Form->input("id",array("value"=>$order['Order']['id'],'type'=>'hidden'));
					 echo $this->Form->button("Liberar Pedido",array("class"=>"btn btn-success","type"=>"submit"));
					 echo $this->Form->end();
					 ?>
					</p>
			</div>
		</div>
	</div>
<?php endforeach; ?>
</div>