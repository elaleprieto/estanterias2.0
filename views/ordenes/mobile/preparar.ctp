<?php
	# Se cargan las librería JavaScript
	echo $javascript -> link('prototype');
	echo $javascript -> link('scriptaculous');
	# Se define la ruta base
	echo $javascript -> codeBlock('WEBROOT="../../"', 
		$options = array('allowCache' => true, 'safe' => true, 'inline' => true));

	# Se crean las funciones auxiliares
	# (en webroot/js) 
	echo $javascript -> link('ordenes_preparar');
?>
<div class="ordenes_view">
<h2><?php echo 'Preparación de pedidos'; ?></h2>
	<div class="pedidos_info">
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td class="info_titulo"><?php echo 'Número de pedido'; ?></td>
				<td class="info_data"><?php echo $pedido['Pedido']['id']; ?></td>
			</tr>
			<tr>
				<td class="info_titulo"><?php echo 'Cliente'; ?></td>
				<td class="info_data"><?php echo $pedido['Cliente']['nombre']; ?></td>
			</tr>
			<tr>
				<td class="info_titulo"><?php echo 'Fecha'; ?></td>
				<td class="info_data"><?php echo $this -> Time -> format($format = 'd/m/Y H:i', $pedido['Pedido']['created']); ?></td>
			</tr>
		</table>
	</div>
	<br />
	<div id="listado">
		<table id='articulos_tabla' cellpadding="0" cellspacing="0">
			<?php 
				# Se crea el formulario para poder manejar las modificaciones
				# de estado de las ordenes
				echo $this -> Form -> create('Orden');
				# Guardo el ID del pedido para cambiarle el estado a Finalizado
				echo $this -> Form -> hidden('Pedido.id', 
					array('value' => $pedido['Pedido']['id']));
				echo $this -> Form -> hidden('Pedido.estado', 
					array('value' => TRUE));
			?>
			<tr>
				<th><?php echo 'Foto';?></th>
				<th><?php echo 'Cant';?></th>
				<th><?php echo 'Unid';?></th>
				<th><?php echo 'Detalle';?></th>
				<th><?php echo 'Pasillo';?></th>
				<th><?php echo 'Lado';?></th>
				<th><?php echo 'Pos';?></th>
				<th><?php echo 'A';?></th>
				<th><?php echo 'U';?></th>
				<th><?php echo 'Obs';?></th>
				<th><?php echo 'Listo';?></th>
			</tr>
			<?php
				# Se va a iterar para generar la tabla con las ordenes del pedido
				$i = 0;
				$ordenN = 0;
				foreach ($articulos as $articulo):
					$ordenN++;
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
					<td><?php 
						//echo $articulo['cantidad'];
 						echo $this -> Form -> input('Orden.' . $ordenN . '.cantidad', array(
									'label' => FALSE,
									'value' => $articulo['cantidad'],
									'class' => 'ordenes_preparar',
									'id' => 'ca' . $articulo['orden_id']
							));
						if($articulo['sin_cargo']) {
						?>
							<div class="preparar_sin_cargo">Sin Cargo</div>						
						<?php
						}
						
						# Definición del evento JavaScript que guarda el estado y la cantidad de la orden
						# cada vez que se hace clic.
						# La función orden_actualizar_estado() se encuentra en el archivo 
						# webroot/js/ordenes_preparar.js
						echo $javascript -> event('ca'.$articulo['orden_id'], 'keyup', 'orden_actualizar('.$articulo['orden_id'].')');
						?>&nbsp;</td>
					<td><?php echo $articulo['unidad'];?>&nbsp;</td>
					<td>
						<?php 
						# Se define el Detalle del Artículo y un enlace a su descripción
						// echo $this -> Html -> link($articulo['detalle'], 
							// array('controller' => 'articulos',
							// 'action' => 'view',
							// $articulo['id']));
							echo $articulo['detalle']; 
						?>&nbsp;
					</td>
					<?php
					# Defino la Ubicación del Artículo
					$pasillo = $lado = $posicion = $altura = $estado = "";
					
					// foreach ($articulo['Articulo']['Ubicado'] as $ubicacion):
						# como no puedo ordenarlo en el controller, hago este trampa
						# si el estado es temporal (estado=1), lo agrego al final de cada string
						# si el estado es fijo (estado=0), lo agrego al principio de cada string
						// if($articulo['ubicacion_estado']) {
							// $pasillo 	.= $articulo['nombre'] . "<br />";
							// $lado 		.= $articulo['lado'] . "<br />";
							// $posicion 	.= $articulo['posicion'] . "<br />";
							// $altura 	.= $articulo['altura'] . "<br />";
							// $estado 	.= 'Temporal' . "<br />";
						// } else {
							// $pasillo 	= $articulo['nombre'] . "<br />" . $pasillo;
							// $lado 		= $articulo['lado'] . "<br />" . $lado;
							// $posicion 	= $articulo['posicion'] . "<br />" . $posicion;
							// $altura 	= $articulo['altura'] . "<br />" . $altura;
							// $estado 	= "Fijo" . "<br />" . $estado;
						// }
					// endforeach;
					
					# Acá se arma la columna "Pasillo".
					# Se acondiciona el array que viene del Postgres.
					$articulo['pasillo_nombre'] = explode(",", substr($articulo['pasillo_nombre'], 1, -1));
					
					# Se itera sobre el array acondicionado.
					foreach ($articulo['pasillo_nombre'] as $pasillo_nombre) {
						if($pasillo_nombre != "NULL") {
							$pasillo .= $pasillo_nombre. "<br />";
						}
					}
					
					# Acá se arma la columna "Lado".
					# Se acondiciona el array que viene del Postgres.
					$articulo['pasillo_lado'] = explode(",", substr($articulo['pasillo_lado'], 1, -1));
					
					# Se itera sobre el array acondicionado.
					foreach ($articulo['pasillo_lado'] as $pasillo_lado) {
						if($pasillo_lado != "NULL") {
							$lado .= $pasillo_lado. "<br />";
						}
					}
					
					# Acá se arma la columna "Posición".
					# Se acondiciona el array que viene del Postgres.
					$articulo['ubicacion_posicion'] = explode(",", substr($articulo['ubicacion_posicion'], 1, -1));
					
					# Se itera sobre el array acondicionado.
					foreach ($articulo['ubicacion_posicion'] as $ubicacion_posicion) {
						if($ubicacion_posicion != "NULL") {
							$posicion .= $ubicacion_posicion. "<br />";
						}
					}
					
					# Acá se arma la columna "Altura".
					# Se acondiciona el array que viene del Postgres.
					$articulo['ubicacion_altura'] = explode(",", substr($articulo['ubicacion_altura'], 1, -1));
					
					# Se itera sobre el array acondicionado.
					foreach ($articulo['ubicacion_altura'] as $ubicacion_altura) {
						if($ubicacion_altura != "NULL") {
							$altura .= $ubicacion_altura. "<br />";
						}
					}
					
					# Acá se arma la columna "Estado".
					# Se acondiciona el array que viene del Postgres.
					$articulo['ubicacion_estado'] = explode(",", substr($articulo['ubicacion_estado'], 1, -1));
					
					// debug($articulo['ubicacion_estado']);
					
					# Se itera sobre el array acondicionado.
					foreach ($articulo['ubicacion_estado'] as $ubicacion_estado) {
						if($ubicacion_estado != "NULL") {
							if($ubicacion_estado == "t") {
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
					<td><?php echo $articulo['observaciones'];?>&nbsp;</td>
					<td>
						<?php 
							# Aquí armo el formulario para modificar el estado de las ordenes (artículos)
							# del pedido cuando se cierre.
							echo $this -> Form -> hidden('Orden.'.$ordenN.'.id', 
								array('value' => $articulo['orden_id']));
							echo $this -> Form -> input('Orden.'.$ordenN.'.estado', 
								array('label' => FALSE, 'checked' => $articulo['orden_estado'],
									'id' => 'es'.$articulo['orden_id']));

							# Definicion del evento JavaScript que guarda el estado y la cantidad de la orden
							# cada vez que se hace clic.
							# La funcion orden_actualizar_estado() se encuentra en el archivo 
							# webroot/js/ordenes_preparar.js
							echo $javascript -> event('es'.$articulo['orden_id'], 'click', 'orden_actualizar('.$articulo['orden_id'].')');
						?>&nbsp;
					</td>
			</tr>
			<?php endforeach;?>
			<tr>
				<td colspan="10">
					<?php echo $this -> Form -> submit('Guardar Pedido', array('name' => 'guardar', 'div' => FALSE));?>
					<?php echo $this -> Form -> submit('Finalizar Pedido', array('name' => 'finalizar', 'div' => FALSE));?>
					<?php echo $this -> Form -> submit('Salir', array('name' => 'salir', 'div' => FALSE));?>
					<?php echo $this -> Form -> end();?>
				</td>
			</tr>
		</table>
	</div>
</div>
