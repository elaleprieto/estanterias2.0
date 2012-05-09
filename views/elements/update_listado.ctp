<?php
// debug($ubicados);
?>

<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo 'foto';?></th>
		<th><?php echo 'Articulo';?></th>
		<th><?php echo 'Pasillo';?></th>
		<th><?php echo 'Lado';?></th>
		<th><?php echo 'Posición';?></th>
		<th><?php echo 'Altura';?></th>
		<th><?php echo 'Estado';?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($ubicados as $ubicado):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		
		# no sé por qué la consulta personalizada del controller genera un array dentro del otro,
		# acá lo que se hace es corrigirlo para trabajar con el array interno que es el que interesa.
		$ubicado = $ubicado[0];
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php 
			# Se verifica la existencia de la foto del artículo en el directorio,
			# si no existe se carga la foto "nofoto.png"
			$imagen = $this -> Foto -> articulo($ubicado['foto']);
			echo $this -> Html -> image($imagen, array('class' => 'ubicados_index'));
			?>&nbsp;
		</td>
		<td><?php echo $this -> Html -> link($ubicado['detalle'], array('controller' => 'articulos',
			'action' => 'view',
			$ubicado['id']));
		?></td>
		<?php
		# Defino la Ubicación del Artículo
		$pasillo = $lado = $posicion = $altura = $estado = "";

		# Acá se arma la columna "Pasillo".
		# Se acondiciona el array que viene del Postgres.
		$ubicado['pasillo_nombre'] = explode(",", substr($ubicado['pasillo_nombre'], 1, -1));

		# Se itera sobre el array acondicionado.
		foreach ($ubicado['pasillo_nombre'] as $pasillo_nombre) {
			if ($pasillo_nombre != "NULL") {
				$pasillo .= $pasillo_nombre . "<br />";
			}
		}
		
		# Acá se arma la columna "Lado".
		# Se acondiciona el array que viene del Postgres.
		$ubicado['pasillo_lado'] = explode(",", substr($ubicado['pasillo_lado'], 1, -1));

		# Se itera sobre el array acondicionado.
		foreach ($ubicado['pasillo_lado'] as $pasillo_lado) {
			if ($pasillo_lado != "NULL") {
				$lado .= $pasillo_lado . "<br />";
			}
		}
		
		# Acá se arma la columna "Posición".
		# Se acondiciona el array que viene del Postgres.
		$ubicado['ubicacion_posicion'] = explode(",", substr($ubicado['ubicacion_posicion'], 1, -1));

		# Se itera sobre el array acondicionado.
		foreach ($ubicado['ubicacion_posicion'] as $ubicacion_posicion) {
			if ($ubicacion_posicion != "NULL") {
				$posicion .= $ubicacion_posicion . "<br />";
			}
		}
		
		# Acá se arma la columna "Altura".
		# Se acondiciona el array que viene del Postgres.
		$ubicado['ubicacion_altura'] = explode(",", substr($ubicado['ubicacion_altura'], 1, -1));

		# Se itera sobre el array acondicionado.
		foreach ($ubicado['ubicacion_altura'] as $ubicacion_altura) {
			if ($ubicacion_altura != "NULL") {
				$altura .= $ubicacion_altura . "<br />";
			}
		}
		
		# Acá se arma la columna "Estado".
		# Se acondiciona el array que viene del Postgres.
		$ubicado['ubicacion_estado'] = explode(",", substr($ubicado['ubicacion_estado'], 1, -1));

		# Se itera sobre el array acondicionado.
		foreach ($ubicado['ubicacion_estado'] as $ubicacion_estado) {
			if ($ubicacion_estado != "NULL") {
				if ($ubicacion_estado == "t") {
					$estado .= "Temporal<br />";
				} else {
					$estado .= "Fijo<br />";
				}
			}
		}
		?>
		<td><?php echo $pasillo;?>&nbsp;</td>
		<td><?php echo $lado;?>&nbsp;</td>
		<td><?php echo $posicion;?>&nbsp;</td>
		<td><?php echo $altura;?>&nbsp;</td>
		<td><?php echo $estado;?>&nbsp;</td>
		</tr> <?php endforeach;?>
</table>