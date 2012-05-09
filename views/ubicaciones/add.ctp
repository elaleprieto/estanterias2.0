<div class="ubicaciones form">
<?php echo $this->Form->create('Ubicacion');?>
	<fieldset>
 		<legend><?php __('Add Ubicacion'); ?></legend>
	<?php
		echo $this->Form->input('altura');
		echo $this->Form->input('posicion');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Ubicaciones', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Pasillos', true), array('controller' => 'pasillos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pasillo', true), array('controller' => 'pasillos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ubicados', true), array('controller' => 'ubicados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ubicado', true), array('controller' => 'ubicados', 'action' => 'add')); ?> </li>
	</ul>
</div>