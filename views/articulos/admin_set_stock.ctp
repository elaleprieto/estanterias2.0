<div class="articulos form">
<?php echo $this->Form->create('Articulo');?>
	<fieldset>
 		<legend><?php __('Set Stock Articulo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('detalle', array('disabled' => 'disabled'));
		echo $this->Form->input('unidad', array('disabled' => 'disabled'));
		echo $this->Form->input('precio', array('disabled' => 'disabled'));
		echo $this->Form->input('stock', array('autocomplete' => 'off'));
	?>
	</fieldset>
<?php echo $this->Form->end('Guardar');?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Articulo.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Articulo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Articulos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Ubicados', true), array('controller' => 'ubicados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ubicado', true), array('controller' => 'ubicados', 'action' => 'add')); ?> </li>
	</ul>
</div>