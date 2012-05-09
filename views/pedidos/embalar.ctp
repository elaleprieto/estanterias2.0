<div class="pedidos_embalar">
	<h2><?php __('Embalar Pedidos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?='Número';?></th>
			<th><?='Cliente';?></th>
			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($pedidos as $pedido):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $pedido['Pedido']['id']; ?>&nbsp;</td>
		<td><?php echo $pedido['Cliente']['nombre']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Embalar', true), array('controller' => 'pedidos', 'action' => 'embalar', $pedido['Pedido']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
