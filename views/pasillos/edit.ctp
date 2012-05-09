<div class="pasillos form">
<?php echo $this->Form->create('Pasillo');?>
	<fieldset>
 		<legend><?php __('Edit Pasillo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('lado');
		echo $this->Form->input('distancia');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Pasillo.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Pasillo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Pasillos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Ubicaciones', true), array('controller' => 'ubicaciones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ubicacion', true), array('controller' => 'ubicaciones', 'action' => 'add')); ?> </li>
	</ul>
</div>