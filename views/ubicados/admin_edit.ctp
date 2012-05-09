<div class="ubicados form">
<?php echo $this->Form->create('Ubicado');?>
	<fieldset>
 		<legend><?php __('Edit Ubicado'); ?></legend>
 		<h3><?php echo $this -> data['Articulo']['detalle']; ?></h3>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('pasillo_id');
		echo $this->Form->input('ubicacion_id');
		echo $this -> Form -> input('estado', array('label' => 'Temporal'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Ubicado.id')), null, sprintf(__('¿Eliminar # %s?', true), $this->Form->value('Ubicado.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Ubicados', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Articulos', true), array('controller' => 'articulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Articulo', true), array('controller' => 'articulos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ubicaciones', true), array('controller' => 'ubicaciones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ubicacion', true), array('controller' => 'ubicaciones', 'action' => 'add')); ?> </li>
	</ul>
</div>