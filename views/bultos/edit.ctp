<div class="bultos form">
<?php echo $this->Form->create('Bulto');?>
	<fieldset>
 		<legend><?php __('Edit Bulto'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('categoria');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Bulto.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Bulto.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Bultos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Ordenes', true), array('controller' => 'ordenes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Orden', true), array('controller' => 'ordenes', 'action' => 'add')); ?> </li>
	</ul>
</div>