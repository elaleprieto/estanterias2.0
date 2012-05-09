<div class="ordenes form">
<?php echo $this->Form->create('Orden');?>
	<fieldset>
 		<legend><?php __('Edit Orden'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('estado');
		echo $this->Form->input('articulo_id');
		echo $this->Form->input('pedido_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Orden.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Orden.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Ordenes', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Articulos', true), array('controller' => 'articulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Articulo', true), array('controller' => 'articulos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pedidos', true), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>