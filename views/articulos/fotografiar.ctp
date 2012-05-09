<div class="articulos form">
<?php echo $this -> Form -> create('Articulo', array('enctype' => 'multipart/form-data'));?>
	<fieldset>
 		<legend><?php __('Fotografiar Articulo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this -> Form -> input('Articulo.archivo', array('between' => '<br />', 'type' => 'file', 'label' => __('Actualización de Foto', true)));
		echo $this -> Form -> end(__('Actualizar', true));
		echo $this -> Html -> link(_('Listar Articulos'), array('action' => 'view'));
		
	?>
	</fieldset>
<?php echo $this->Form->end();?>
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