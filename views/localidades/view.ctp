<div class="localidades view">
<h2><?php  __('Localidad');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $localidad['Localidad']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $localidad['Localidad']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Codigo Postal'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $localidad['Localidad']['codigo_postal']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $localidad['Localidad']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $localidad['Localidad']['modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Provincia'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($localidad['Provincia']['id'], array('controller' => 'provincias', 'action' => 'view', $localidad['Provincia']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Localidad', true), array('action' => 'edit', $localidad['Localidad']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Localidad', true), array('action' => 'delete', $localidad['Localidad']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $localidad['Localidad']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Localidades', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Localidad', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Provincias', true), array('controller' => 'provincias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Provincia', true), array('controller' => 'provincias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clientes', true), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cliente', true), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Clientes');?></h3>
	<?php if (!empty($localidad['Cliente'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Codigo'); ?></th>
		<th><?php __('Nombre'); ?></th>
		<th><?php __('Direccion'); ?></th>
		<th><?php __('Cuit'); ?></th>
		<th><?php __('Bonificacion'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Localidad Id'); ?></th>
		<th><?php __('Iva Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($localidad['Cliente'] as $cliente):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $cliente['id'];?></td>
			<td><?php echo $cliente['codigo'];?></td>
			<td><?php echo $cliente['nombre'];?></td>
			<td><?php echo $cliente['direccion'];?></td>
			<td><?php echo $cliente['cuit'];?></td>
			<td><?php echo $cliente['bonificacion'];?></td>
			<td><?php echo $cliente['created'];?></td>
			<td><?php echo $cliente['modified'];?></td>
			<td><?php echo $cliente['localidad_id'];?></td>
			<td><?php echo $cliente['iva_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'clientes', 'action' => 'view', $cliente['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'clientes', 'action' => 'edit', $cliente['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'clientes', 'action' => 'delete', $cliente['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $cliente['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Cliente', true), array('controller' => 'clientes', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
