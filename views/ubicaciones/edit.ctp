<div class="ubicaciones form">
<?php echo $this->Form->create('Ubicacion');?>
	<fieldset>
 		<legend><?php __('Edit Ubicacion'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('altura');
		echo $this->Form->input('posicion');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Ubicacion.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Ubicacion.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Ubicaciones', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Pasillos', true), array('controller' => 'pasillos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pasillo', true), array('controller' => 'pasillos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ubicados', true), array('controller' => 'ubicados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ubicado', true), array('controller' => 'ubicados', 'action' => 'add')); ?> </li>
	</ul>
</div>