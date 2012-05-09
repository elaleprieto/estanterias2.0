<div class="pasillos form">
<?php echo $this->Form->create('Pasillo');?>
	<fieldset>
 		<legend><?php __('Add Pasillo'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('distancia');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Pasillos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Ubicaciones', true), array('controller' => 'ubicaciones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ubicacion', true), array('controller' => 'ubicaciones', 'action' => 'add')); ?> </li>
	</ul>
</div>