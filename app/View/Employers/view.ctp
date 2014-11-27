<div class="employers view">
<h2><?php echo __('Employer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($employer['Employer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($employer['Employer']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Employer'), array('action' => 'edit', $employer['Employer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Employer'), array('action' => 'delete', $employer['Employer']['id']), array(), __('Are you sure you want to delete # %s?', $employer['Employer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Employers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Employer'), array('action' => 'add')); ?> </li>
	</ul>
</div>
