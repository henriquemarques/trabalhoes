<div class="row">
	<div class="col-md-6">
		<?php
		echo $this->Form->create('User', array('action' => 'cadastrar'));
		echo $this->Form->inputs(array(
		    'legend' => __('Cadastro'),
		    'name',
		    'idade',
		    'cpf'
		));
		echo $this->Form->input('sexo',array('options'=>array('M' => 'Masculino', 'F' => 'Feminino'),'type'=>'select','class'=>'form-control','label'=>'Sexo'));
		echo $this->Form->inputs(array(
		    'legend' => '',
		    'username',
		    'password'
		));
		echo $this->Form->input('group_id',array('value'=>'3','type'=>'hidden'));
		echo $this->Form->end('Cadastrar');
		?>
	</div>
	<div class="col-md-6">
		<?php
		echo $this->Form->create('User', array('action' => 'login'));
		echo $this->Form->inputs(array(
		    'legend' => __('Login'),
		    'username',
		    'password'
		));
		echo $this->Form->end('Login');
		?>
	</div>
</div>