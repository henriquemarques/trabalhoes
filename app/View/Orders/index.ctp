<div class="orders index">
	<h2><?php echo __('Pedidos'); ?></h2>
	<div class="row">
		<?php						debug($orders);
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
						foreach ($order['OrderDetail'] as $product):
							$total += ($product['Product']['price']*$product['quantity']);
						?>

						- <?php echo utf8_encode($product['Product']["name"]);?></br>
					<?php endforeach; ?>
						<strong>Valor: </strong>R$ <?php echo $total;?></br>
				</p>
				<p><a href="#" class="btn btn-success" role="button">Liberar Pedido</a></p>
			</div>
		</div>
	</div>
<?php endforeach; ?>
</div>