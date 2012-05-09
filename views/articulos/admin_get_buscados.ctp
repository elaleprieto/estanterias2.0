<?php
// debug($articulos);
?>

<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo 'foto';?></th>
		<th><?php echo 'Articulo';?></th>
		<th><?php echo 'Unidad';?></th>
		<th><?php echo 'Precio Venta';?></th>
		<th><?php echo 'Stock';?></th>
		<th><?php echo 'Pack';?></th>
		<th><?php echo 'Pasillo';?></th>
		<th><?php echo 'Lado';?></th>
		<th><?php echo 'Posición';?></th>
		<th><?php echo 'Altura';?></th>
		<th class="actions">Acciones</th>
	</tr>
	<?php
	$i = 0;
	foreach ($articulos as $articulo):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		
		# no sé por qué la consulta personalizada del controller genera un array dentro del otro,
		# acá lo que se hace es corrigirlo para trabajar con el array interno que es el que interesa.
		$articulo = $articulo[0];
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php 
			# Se verifica la existencia de la foto del artículo en el directorio,
			# si no existe se carga la foto "nofoto.png"
			$imagen = $this -> Foto -> articulo($articulo['foto']);
			echo $this -> Html -> image($imagen, array('class' => 'ubicados_index'));
			?>&nbsp;
		</td>
		<td><?php echo $this -> Html -> link($articulo['detalle'], array('controller' => 'articulos',
			'action' => 'view',
			$articulo['id']));
		?></td>
		<td><?php echo $articulo['unidad']; ?>&nbsp;</td>
		<td><?php echo sprintf('$ %.2f', $articulo['precio_venta']); ?>&nbsp;</td>
		<td><?php echo $articulo['stock']; ?>&nbsp;</td>
		<td><?php echo $articulo['pack']; ?>&nbsp;</td>
		<?php
		# Defino la Ubicación del Artículo
		$pasillo = $lado = $posicion = $altura = $estado = "";

		# Acá se arma la columna "Pasillo".
		# Se acondiciona el array que viene del Postgres.
		$articulo['pasillo_nombre'] = explode(",", substr($articulo['pasillo_nombre'], 1, -1));

		# Se itera sobre el array acondicionado.
		foreach ($articulo['pasillo_nombre'] as $pasillo_nombre) {
			if ($pasillo_nombre != "NULL") {
				$pasillo .= $pasillo_nombre . "<br />";
			}
		}
		
		# Acá se arma la columna "Lado".
		# Se acondiciona el array que viene del Postgres.
		$articulo['pasillo_lado'] = explode(",", substr($articulo['pasillo_lado'], 1, -1));

		# Se itera sobre el array acondicionado.
		foreach ($articulo['pasillo_lado'] as $pasillo_lado) {
			if ($pasillo_lado != "NULL") {
				$lado .= $pasillo_lado . "<br />";
			}
		}
		
		# Acá se arma la columna "Posición".
		# Se acondiciona el array que viene del Postgres.
		$articulo['ubicacion_posicion'] = explode(",", substr($articulo['ubicacion_posicion'], 1, -1));

		# Se itera sobre el array acondicionado.
		foreach ($articulo['ubicacion_posicion'] as $ubicacion_posicion) {
			if ($ubicacion_posicion != "NULL") {
				$posicion .= $ubicacion_posicion . "<br />";
			}
		}
		
		# Acá se arma la columna "Altura".
		# Se acondiciona el array que viene del Postgres.
		$articulo['ubicacion_altura'] = explode(",", substr($articulo['ubicacion_altura'], 1, -1));

		# Se itera sobre el array acondicionado.
		foreach ($articulo['ubicacion_altura'] as $ubicacion_altura) {
			if ($ubicacion_altura != "NULL") {
				$altura .= $ubicacion_altura . "<br />";
			}
		}
		?>
		<td><?php echo $pasillo;?>&nbsp;</td>
		<td><?php echo $lado;?>&nbsp;</td>
		<td><?php echo $posicion;?>&nbsp;</td>
		<td><?php echo $altura;?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link('Ver', array('action' => 'view', $articulo['id'], 'admin' => TRUE)); ?>
			<?php echo $this->Html->link('Editar', array('action' => 'edit', $articulo['id'])); ?>
			<?php echo $this->Html->link('Set Stock', array('action' => 'set_stock', $articulo['id'])); ?>
			<?php echo $this->Html->link('Ingreso', array('action' => 'ingreso', $articulo['id'])); ?>
			<?php echo $this->Html->link('Set Pack', array('action' => 'set_pack', $articulo['id'])); ?>
			<?php echo $this->Html->link('Etiquetar', array('action' => 'etiquetas_mini', $articulo['id'])); ?>
		</td>
		</tr> <?php endforeach;?>
</table>