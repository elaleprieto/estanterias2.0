<div class="ivas form">
<?php echo $this->Form->create('Iva');?>
	<fieldset>
 		<legend><?php __('Edit Iva'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('categoria');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Iva.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Iva.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Ivas', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Clientes', true), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cliente', true), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
	</ul>
</div>