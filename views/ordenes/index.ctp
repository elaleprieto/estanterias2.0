<div class="ordenes index">
	<h2><?php __('Ordenes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('estado');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th><?php echo $this->Paginator->sort('articulo_id');?></th>
			<th><?php echo $this->Paginator->sort('pedido_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($ordenes as $orden):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $orden['Orden']['id']; ?>&nbsp;</td>
		<td><?php echo $orden['Orden']['estado']; ?>&nbsp;</td>
		<td><?php echo $orden['Orden']['created']; ?>&nbsp;</td>
		<td><?php echo $orden['Orden']['modified']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($orden['Articulo']['detalle'], array('controller' => 'articulos', 'action' => 'view', $orden['Articulo']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($orden['Pedido']['id'], array('controller' => 'pedidos', 'action' => 'view', $orden['Pedido']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $orden['Orden']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $orden['Orden']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $orden['Orden']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $orden['Orden']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Orden', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Articulos', true), array('controller' => 'articulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Articulo', true), array('controller' => 'articulos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pedidos', true), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>