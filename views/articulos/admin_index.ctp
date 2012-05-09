<?php
# Se agregan las CSS
echo $this -> Html -> css('admin_articulos_index');
?>
<div class="articulos index">
	<h2><?php __('Listado de Artículos');?></h2>
	<?php 
	# Paginación
	echo $this -> element('paging', array('accion' => 'index'));
	?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this -> Paginator -> sort('foto');?></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('detalle');?></th>
			<th><?php echo $this->Paginator->sort('unidad');?></th>
			<th><?php echo $this->Paginator->sort('precio_venta');?></th>
			<th><?php echo $this->Paginator->sort('stock');?></th>
			<th><?php echo $this->Paginator->sort('pack');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions">Acciones</th>
	</tr>
	<?php
	$i = 0;
	foreach ($articulos as $articulo):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php 
				# Se verifica la existencia de la foto del artículo en el directorio,
				# si no existe se carga la foto "nofoto.png"
				$imagen = $this -> Foto -> articulo($articulo['Articulo']['foto']);
				echo $this -> Html -> image($imagen, array('class' => 'ubicados_index'));
			?>
			&nbsp;
		</td>
		<td><?php echo $articulo['Articulo']['id']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['detalle']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['unidad']; ?>&nbsp;</td>
		<td><?php echo sprintf('$ %.2f', $articulo['Articulo']['precio_venta']); ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['stock']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['pack']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['created']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link('Ver', array('action' => 'view', $articulo['Articulo']['id'], 'admin' => TRUE)); ?>
			<?php echo $this->Html->link('Editar', array('action' => 'edit', $articulo['Articulo']['id'])); ?>
			<?php echo $this->Html->link('Set Stock', array('action' => 'set_stock', $articulo['Articulo']['id'])); ?>
			<?php echo $this->Html->link('Set Pack', array('action' => 'set_pack', $articulo['Articulo']['id'])); ?>
			<?php echo $this->Html->link('Fotografiar', array('action' => 'fotografiar', $articulo['Articulo']['id'])); ?>
			<?php echo $this->Html->link('Eliminar', array('action' => 'delete', $articulo['Articulo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $articulo['Articulo']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<?php 
	# Paginación
	echo $this -> element('paging', array('accion' => 'index'));
	?>
</div>
