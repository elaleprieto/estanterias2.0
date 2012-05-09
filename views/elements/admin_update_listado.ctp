<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this -> Paginator -> sort('foto');?></th>
		<th><?php echo $this -> Paginator -> sort('Articulo', 'Articulo.detalle');?></th>
		<th><?php echo $this -> Paginator -> sort('Pasillo', 'Pasillo.nombre');?></th>
		<th><?php echo $this -> Paginator -> sort('Lado', 'Pasillo.lado');?></th>
		<th><?php echo $this -> Paginator -> sort('Posición', 'Ubicacion.posicion');?></th>
		<th><?php echo $this -> Paginator -> sort('Altura', 'Ubicacion.altura');?></th>
		<th><?php echo $this -> Paginator -> sort('Estado', 'Ubicado.estado');?></th>
		<th><?php echo 'Acciones'; ?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($ubicados as $ubicado):
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
			$imagen = $this -> Foto -> articulo($ubicado['Articulo']['foto']);
			echo $this -> Html -> image($imagen, array('class' => 'ubicados_index'));
			?>&nbsp;
		</td>
		<td><?php echo $this -> Html -> link($ubicado['Articulo']['detalle'], array('controller' => 'articulos',
			'action' => 'view',
			$ubicado['Articulo']['id']));
		?></td>
		<td><?php echo $ubicado['Pasillo']['nombre'];?>&nbsp;</td>
		<td><?php echo $ubicado['Pasillo']['lado'];?>&nbsp;</td>
		<td><?php echo $ubicado['Ubicacion']['posicion'];?>&nbsp;</td>
		<td><?php echo $ubicado['Ubicacion']['altura'];?>&nbsp;</td>
		<td>
			<?php
			if($ubicado['Ubicado']['estado'])
				echo "Temporal";
			else
				echo "Fijo";
			?>&nbsp; 
		</td>
		<td class="actions">
			<?php echo $this->Html->link('Agregar Ubicación', array('action' => 'add', $ubicado['Articulo']['id'])); ?>
			<?php echo $this->Html->link('Editar', array('action' => 'edit', $ubicado['Ubicado']['id'])); ?>
			<?php echo $this->Html->link('Eliminar', array('action' => 'delete', $ubicado['Ubicado']['id']), null, sprintf('¿Eliminar # %s?', $ubicado['Ubicado']['id'])); ?>
		</td>
	</tr> 
	<?php 
	endforeach;
	?>
</table>
