<div class="pasillos view">
<h2><?php  __('Pasillo');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pasillo['Pasillo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pasillo['Pasillo']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pasillo['Pasillo']['lado']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pasillo['Pasillo']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pasillo['Pasillo']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Pasillo', true), array('action' => 'edit', $pasillo['Pasillo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Pasillo', true), array('action' => 'delete', $pasillo['Pasillo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pasillo['Pasillo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Pasillos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pasillo', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ubicaciones', true), array('controller' => 'ubicaciones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ubicacion', true), array('controller' => 'ubicaciones', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Ubicaciones');?></h3>
	<?php if (!empty($pasillo['Ubicacion'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Altura'); ?></th>
		<th><?php __('Posicion'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($pasillo['Ubicacion'] as $ubicacion):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $ubicacion['id'];?></td>
			<td><?php echo $ubicacion['altura'];?></td>
			<td><?php echo $ubicacion['posicion'];?></td>
			<td><?php echo $ubicacion['created'];?></td>
			<td><?php echo $ubicacion['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'ubicaciones', 'action' => 'view', $ubicacion['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'ubicaciones', 'action' => 'edit', $ubicacion['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'ubicaciones', 'action' => 'delete', $ubicacion['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ubicacion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Ubicacion', true), array('controller' => 'ubicaciones', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
