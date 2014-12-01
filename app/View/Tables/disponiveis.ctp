<div class="tables form">
	<?php echo $this->Form->create('Table',array("action" => "selecionar_mesa")); ?>
	<fieldset>
		<legend><?php echo __('Selecionar Mesa'); ?></legend>
		<?php
		echo $this->Form->input('table_id',array('options'=>$tables)); 
		?>
		<div class="form-group">
	</fieldset>
	<?php echo $this->Form->end(__('Selecionar Mesa')); ?>
</div>

