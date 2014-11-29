<div class="col-sm-6 col-md-4">
	<?php echo $this->Html->link("Nova Consulta",array("action"=>"consultar"),array("class"=>"btn btn-success"));?>
			<div class="thumbnail">
				<div class="caption">
					<p>
						<strong>Nome:</strong><?php echo h($user['User']['name']); ?><br/>
						<strong>Endereço:</strong><?php echo h($user['User']['address']); ?><br/>	
						<strong>Telefone:</strong><?php echo h($user['User']['phone']); ?><br/>	

				</p>
				<?php echo $this->Html->link("Fechar",array("action"=>"consultar"),array("class"=>"btn btn-default"));?>
				<?php echo $this->Html->link(__('Alterar Funcionário'), array('action' => 'edit', $user['User']['id']),array("class"=>"btn btn-primary")); ?> 
				<?php echo $this->Form->postLink(__('Excluir Funcionário'), array('action' => 'delete', $user['User']['id']), array("class"=>"btn btn-danger"), __('Tem certeza que deseja excluir o funcionário '.h($user['User']['name']).'?', $user['User']['id'])); ?> 
			</div>
		</div>
	</div>