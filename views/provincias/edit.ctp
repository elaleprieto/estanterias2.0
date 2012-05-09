<div class="provincias form">
<?php echo $this->Form->create('Provincia');?>
	<fieldset>
 		<legend><?php __('Edit Provincia'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Provincia.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Provincia.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Provincias', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Localidades', true), array('controller' => 'localidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Localidad', true), array('controller' => 'localidades', 'action' => 'add')); ?> </li>
	</ul>
</div>