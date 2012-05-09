<div class="ubicados view">
<h2><?php  __('Ubicado');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ubicado['Ubicado']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ubicado['Ubicado']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ubicado['Ubicado']['modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Articulo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($ubicado['Articulo']['detalle'], array('controller' => 'articulos', 'action' => 'view', $ubicado['Articulo']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Pasillo Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ubicado['Ubicado']['pasillo_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ubicacion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($ubicado['Ubicacion']['id'], array('controller' => 'ubicaciones', 'action' => 'view', $ubicado['Ubicacion']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ubicado', true), array('action' => 'edit', $ubicado['Ubicado']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Ubicado', true), array('action' => 'delete', $ubicado['Ubicado']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ubicado['Ubicado']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ubicados', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ubicado', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articulos', true), array('controller' => 'articulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Articulo', true), array('controller' => 'articulos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ubicaciones', true), array('controller' => 'ubicaciones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ubicacion', true), array('controller' => 'ubicaciones', 'action' => 'add')); ?> </li>
	</ul>
</div>
