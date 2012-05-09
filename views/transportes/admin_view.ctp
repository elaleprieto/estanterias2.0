<div class="transportes view">
<h2><?php  __('Transporte');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $transporte['Transporte']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $transporte['Transporte']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $transporte['Transporte']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $transporte['Transporte']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Transporte', true), array('action' => 'edit', $transporte['Transporte']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Transporte', true), array('action' => 'delete', $transporte['Transporte']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $transporte['Transporte']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Transportes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transporte', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pedidos', true), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Pedidos');?></h3>
	<?php if (!empty($transporte['Pedido'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Finalizado'); ?></th>
		<th><?php __('Cliente Id'); ?></th>
		<th><?php __('Estado'); ?></th>
		<th><?php __('B'); ?></th>
		<th><?php __('Transporte Id'); ?></th>
		<th><?php __('Contrarrembolso'); ?></th>
		<th><?php __('Cobinpro'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($transporte['Pedido'] as $pedido):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $pedido['id'];?></td>
			<td><?php echo $pedido['created'];?></td>
			<td><?php echo $pedido['modified'];?></td>
			<td><?php echo $pedido['finalizado'];?></td>
			<td><?php echo $pedido['cliente_id'];?></td>
			<td><?php echo $pedido['estado'];?></td>
			<td><?php echo $pedido['b'];?></td>
			<td><?php echo $pedido['transporte_id'];?></td>
			<td><?php echo $pedido['contrarrembolso'];?></td>
			<td><?php echo $pedido['cobinpro'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'pedidos', 'action' => 'view', $pedido['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'pedidos', 'action' => 'edit', $pedido['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'pedidos', 'action' => 'delete', $pedido['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pedido['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
