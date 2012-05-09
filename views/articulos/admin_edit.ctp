<div class="articulos form">
<?php echo $this->Form->create('Articulo');?>
	<fieldset>
 		<legend><?php __('Edit Articulo'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type' => 'text', 'label' => 'Código', 'disabled' => 'disabled'));
		echo $this->Form->input('detalle');
		echo $this->Form->input('unidad');
		echo $this->Form->input('precio', array('label' => 'Precio de Costo ($)'));
		echo $this->Form->input('porcentaje', array('label' => 'Porcentaje de Venta (%)'));
		echo $this->Form->input('stock');
		echo $this->Form->input('pack');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('View', true), array('action' => 'view', $this->Form->value('Articulo.id'))); ?></li>
		<li><?= $this->Html->link('Set Stock', array('action' => 'set_stock', $this->Form->value('Articulo.id'))); ?></li>
		<li><?= $this->Html->link('Set Pack', array('action' => 'set_pack', $this->Form->value('Articulo.id'))); ?></li>
		<li><?= $this->Html->link('Fotografiar', array('action' => 'fotografiar', $this->Form->value('Articulo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Articulo.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Articulo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Articulos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Ubicados', true), array('controller' => 'ubicados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ubicado', true), array('controller' => 'ubicados', 'action' => 'add')); ?> </li>
	</ul>
</div>