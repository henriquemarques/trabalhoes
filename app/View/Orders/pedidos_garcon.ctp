<div class="orders index">
	<h2><?php echo __('Pedidos'); ?></h2>
	<div class="row">
			
		<?php foreach ($orders as $order): ?>
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
							$total += ($product['price']*$product['OrdersProduct']['quantity']);
						?>

						- <?php echo utf8_encode($product["name"]);?></br>
					<?php endforeach; ?>
						<strong>Valor: </strong>R$ <?php echo $total;?></br>
						<strong>Status: </strong><?php echo ($order['Order']['status']) ? '<span style="color:#009900">Pedido liberado</span>' : '<span style="color:#990000">Aguardando cozinha</span>';?></br>
				</p>
			</div>
		</div>
	</div>
<?php endforeach; ?>
</div>