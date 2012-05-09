<div class="clientes form">
<?php echo $this->Form->create('Cliente');?>
	<fieldset>
 		<legend><?php __('Add Cliente'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('direccion');
		echo $this->Form->input('cuit');
		echo $this->Form->input('bonificacion');
		echo $this->Form->input('localidad_id');
		echo $this->Form->input('iva_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Clientes', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Pedidos', true), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>