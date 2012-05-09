<div class="articulos">
	<h2><?php __('Articulos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo 'Código';?></th>
			<th><?php echo 'Detalle';?></th>
			<th><?php echo 'Unidad';?></th>
			<th><?php echo 'Precio Costo';?></th>
			<th><?php echo 'Precio Venta';?></th>
			<th><?php echo 'Cantidad Vendida';?></th>
			<th><?php echo 'Total Costo';?></th>
			<th><?php echo 'Total Venta';?></th>
			<th><?php echo '% Total Venta';?></th>
			<th><?php echo 'Acumulado % Total Venta';?></th>
	</tr>
	<?php
	$i = $acumulado_porcentaje_total_venta = 0;
	foreach ($articulos as $articulo):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$porcentaje_total_venta = $articulo['Articulo']['cantidad_vendida'] * 100 / $articulo['Articulo']['cantidad_vendida_total'];
		$acumulado_porcentaje_total_venta += $porcentaje_total_venta;
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $articulo['Articulo']['id']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['detalle']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['unidad']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['precio']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['precio_venta']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['cantidad_vendida']; ?>&nbsp;</td>
		<td><?php echo ($articulo['Articulo']['cantidad_vendida'] * $articulo['Articulo']['precio']); ?>&nbsp;</td>
		<td><?php echo ($articulo['Articulo']['cantidad_vendida'] * $articulo['Articulo']['precio_venta']); ?>&nbsp;</td>
		<td><?php echo $porcentaje_total_venta; ?>&nbsp;</td>
		<td><?php echo $acumulado_porcentaje_total_venta; ?>&nbsp;</td>
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