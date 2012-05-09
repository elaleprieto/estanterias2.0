<?php //debug($articulos); ?>

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
				<td class="info_data"><?php echo 'Ferretería del Sur'; ?></td>
			</tr>
			<tr>
				<td class="info_titulo"><?php echo 'Fecha'; ?></td>
				<td class="info_data"><?php echo $this -> Time -> format($format = 'd/m/Y H:i', $pedido['Pedido']['created']); ?></td>
			</tr>
		</table>
	</div>
	<br />
	<div id="listado">
		<table cellpadding="0" cellspacing="0">
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
				<th><?php echo 'Codigo';?></th>
				<th><?php echo 'Preparado';?></th>
				<th><?php echo 'Cantidad';?></th>
				<th><?php echo 'Unidad';?></th>
				<th><?php echo 'Detalle';?></th>
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
					<td><?php echo $articulo['id'];?>&nbsp;</td>
					<td>
						<?php 
							# Aquí armo el formulario para modificar el estado de las ordenes (artículos)
							# del pedido cuando se cierre.
							echo $this -> Form -> hidden('Orden.'.$ordenN.'.id', 
								array('value' => $articulo['orden_id']));
							echo $this -> Form -> input('Orden.'.$ordenN.'.estado', 
								array('label' => FALSE, 'checked' => $articulo['orden_estado']));
						?>&nbsp;
					</td>
					<td><?php echo $articulo['cantidad'];?>&nbsp;</td>
					<td><?php echo $articulo['unidad'];?>&nbsp;</td>
					<td>
						<?php 
						# Se define el Detalle del Artículo y un enlace a su descripción
						echo $this -> Html -> link($articulo['detalle'], 
							array('controller' => 'articulos',
							'action' => 'view',
							$articulo['id']));
						?>&nbsp;
					</td>
					
			</tr>
			<?php endforeach;?>
			<tr>
				<td colspan="10">
					<?php //echo $this -> Form -> submit('Finalizar Pedido', array('name' => 'finalizar', 'div' => FALSE));?>
					<?php echo $this -> Form -> submit('Cancelar', array('name' => 'cancelar', 'div' => FALSE));?>
					<?php echo $this -> Form -> end();?>
				</td>
			</tr>
		</table>
	</div>
</div>
