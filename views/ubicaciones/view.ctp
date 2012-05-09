<div class="ubicaciones view">
<h2><?php  __('Ubicacion');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ubicacion['Ubicacion']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Altura'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ubicacion['Ubicacion']['altura']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Posicion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ubicacion['Ubicacion']['posicion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ubicacion['Ubicacion']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ubicacion['Ubicacion']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ubicacion', true), array('action' => 'edit', $ubicacion['Ubicacion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Ubicacion', true), array('action' => 'delete', $ubicacion['Ubicacion']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ubicacion['Ubicacion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ubicaciones', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ubicacion', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pasillos', true), array('controller' => 'pasillos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pasillo', true), array('controller' => 'pasillos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ubicados', true), array('controller' => 'ubicados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ubicado', true), array('controller' => 'ubicados', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Ubicados');?></h3>
	<?php if (!empty($ubicacion['Ubicado'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Articulo Id'); ?></th>
		<th><?php __('Pasillo Id'); ?></th>
		<th><?php __('Ubicacion Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($ubicacion['Ubicado'] as $ubicado):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $ubicado['id'];?></td>
			<td><?php echo $ubicado['created'];?></td>
			<td><?php echo $ubicado['modified'];?></td>
			<td><?php echo $ubicado['articulo_id'];?></td>
			<td><?php echo $ubicado['pasillo_id'];?></td>
			<td><?php echo $ubicado['ubicacion_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'ubicados', 'action' => 'view', $ubicado['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'ubicados', 'action' => 'edit', $ubicado['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'ubicados', 'action' => 'delete', $ubicado['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ubicado['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Ubicado', true), array('controller' => 'ubicados', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
