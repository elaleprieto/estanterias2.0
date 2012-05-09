<div class="mercaderias form">
<?php echo $this->Form->create('Mercaderia');?>
	<fieldset>
 		<legend><?php __('Edit Mercaderia'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('cantidad');
		echo $this->Form->input('cantidad_anterior');
		echo $this->Form->input('observaciones');
		echo $this->Form->input('ingreso');
		echo $this->Form->input('egreso');
		echo $this->Form->input('articulo_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Mercaderia.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Mercaderia.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Mercaderias', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Articulos', true), array('controller' => 'articulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Articulo', true), array('controller' => 'articulos', 'action' => 'add')); ?> </li>
	</ul>
</div>