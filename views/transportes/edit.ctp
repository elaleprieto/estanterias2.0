<div class="transportes form">
<?php echo $this->Form->create('Transporte');?>
	<fieldset>
 		<legend><?php __('Edit Transporte'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Transporte.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Transporte.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Transportes', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Pedidos', true), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>