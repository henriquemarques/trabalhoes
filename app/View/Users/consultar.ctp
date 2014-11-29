<div class="users index">
	<?php
		 echo $this->Form->create("User",array("type"=>"get"));
		 echo $this->Form->input("name",array("label"=>"Nome do Funcionario"));
		 echo $this->Form->end("Consultar");
	?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Consultar'), array('action' => 'consultar')); ?></li>
		<li><?php echo $this->Html->link(__('Inserir Funcionário'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
