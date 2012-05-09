<div class="ivas view">
<h2><?php  __('Iva');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $iva['Iva']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Categoria'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $iva['Iva']['categoria']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $iva['Iva']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $iva['Iva']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Iva', true), array('action' => 'edit', $iva['Iva']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Iva', true), array('action' => 'delete', $iva['Iva']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $iva['Iva']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ivas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Iva', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clientes', true), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cliente', true), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Clientes');?></h3>
	<?php if (!empty($iva['Cliente'])):?>
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
		foreach ($iva['Cliente'] as $cliente):
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
