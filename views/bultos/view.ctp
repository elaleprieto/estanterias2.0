<div class="bultos view">
<h2><?php  __('Bulto');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bulto['Bulto']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Categoria'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bulto['Bulto']['categoria']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bulto['Bulto']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bulto['Bulto']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Bulto', true), array('action' => 'edit', $bulto['Bulto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Bulto', true), array('action' => 'delete', $bulto['Bulto']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $bulto['Bulto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Bultos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bulto', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ordenes', true), array('controller' => 'ordenes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Orden', true), array('controller' => 'ordenes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Ordenes');?></h3>
	<?php if (!empty($bulto['Orden'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Cantidad'); ?></th>
		<th><?php __('Estado'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Articulo Id'); ?></th>
		<th><?php __('Pedido Id'); ?></th>
		<th><?php __('Sin Cargo'); ?></th>
		<th><?php __('Observaciones'); ?></th>
		<th><?php __('Cantidad Original'); ?></th>
		<th><?php __('Bulto Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($bulto['Orden'] as $orden):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $orden['id'];?></td>
			<td><?php echo $orden['cantidad'];?></td>
			<td><?php echo $orden['estado'];?></td>
			<td><?php echo $orden['created'];?></td>
			<td><?php echo $orden['modified'];?></td>
			<td><?php echo $orden['articulo_id'];?></td>
			<td><?php echo $orden['pedido_id'];?></td>
			<td><?php echo $orden['sin_cargo'];?></td>
			<td><?php echo $orden['observaciones'];?></td>
			<td><?php echo $orden['cantidad_original'];?></td>
			<td><?php echo $orden['bulto_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'ordenes', 'action' => 'view', $orden['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'ordenes', 'action' => 'edit', $orden['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'ordenes', 'action' => 'delete', $orden['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $orden['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Orden', true), array('controller' => 'ordenes', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
