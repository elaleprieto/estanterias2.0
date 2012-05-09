<?php 
# Se carga la librería Jquery
echo $javascript -> link(array('jquery-1.7.1.min','pedidos_embalar_pedido'), FALSE);
?>
<?php echo $this -> element('mensaje_flotante', array("mensaje" => "¡Cuidado! Embalado incompleto.")); ?>
<div class="pedidos_info">
	<table cellpadding="0" cellspacing="0">
		<tr>
			<td class="info_titulo"><?php echo 'Número de pedido';?></td>
			<td class="info_data"><?php echo $pedido['Pedido']['id'];?></td>
		</tr>
		<tr>
			<td class="info_titulo"><?php echo 'Cliente';?></td>
			<td class="info_data"><?php echo $pedido['Cliente']['nombre'];?></td>
		</tr>
		<tr>
			<td class="info_titulo"><?php echo 'Cantidad de Bultos';?></td>
			<td class="info_data"><label id='total'>0</label></td>
		</tr>
	</table>
</div>
<table id='articulos_tabla' cellpadding="0" cellspacing="0">
	<?php
	# Se crea el formulario para poder manejar las modificaciones
	# de bulto de las ordenes
	echo $this -> Form -> create('Orden', array('id' => 'formulario'));
	
	# Se guarda el ID del pedido para asignarle el bulto
	echo $this -> Form -> hidden('Pedido.id', array('value' => $pedido['Pedido']['id']));
	?>
	<tr>
		<th><?php echo 'Foto';?></th>
		<th><?php echo 'Cantidad';?></th>
		<th><?php echo 'Unidad';?></th>
		<th><?php echo 'Detalle';?></th>
		<th><?php echo 'Tipo de Bulto';?></th>
		<th><?php echo 'N° de Bulto';?></th>
	</tr>
	<?php
		# Se va a iterar para generar la tabla con las ordenes del pedido
		$i = 0;
		$ordenN = 0;
		foreach ($pedido['Orden'] as $orden):
			if($orden['cantidad'] > 0):
				$ordenN++;
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
				$imagen = $this -> Foto -> articulo($orden['articulo_foto']);
				echo $this -> Html -> image($imagen, array('class' => 'ubicados_index'));
			?>
		</td>
		<td><?= $orden['cantidad']; ?></td>
		<td><?= $orden['articulo_unidad']; ?></td>
		<td><?= $orden['articulo_detalle']; ?></td>
		<td>
			<?= $this -> Form -> select('Orden.' . $ordenN . '.tipo', $bultos, null, array(
					'label' => FALSE,
					'class' => 'ordenes_preparar',
					));; ?>
		</td>
		<td>
			<?= $this -> Form -> input('Orden.' . $ordenN . '.bulto', array(
					'label' => FALSE,
					'class' => 'ordenes_preparar',
					));; ?>
		</td>
	</tr>
	<?php endif;?>
	<?php endforeach;?>
		<tr>
			<td colspan="10" class='actions'>
				<?php echo $this -> Form -> submit('Guardar Pedido', array(
					'name' => 'guardar',
					'div' => FALSE,
					'id' => 'guardar'
				));
				?>
				<?php 
					echo $this -> Html -> link('Salir', array('controller' => 'pedidos', 'action' => 'embalar'));
				?>
				<?php echo $this -> Form -> end();?>
			</td>
		</tr>
</table>