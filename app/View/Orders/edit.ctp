<div class="orders form">
<?php echo $this->Form->create('Order'); ?>
	<fieldset>
		<legend><?php echo __('Edit Order'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('table_id',array("options"=>$tables));
		echo $this->Form->input('status',array("options"=>array('0' => "Não Liberado",'1' => "Liberado" )));
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
