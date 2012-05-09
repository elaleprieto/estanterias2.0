<tr>
	<td><?php
	# Se verifica la existencia de la foto del artículo en el directorio,
	# si no existe se carga la foto "nofoto.png"
	$imagen = $this -> Foto -> articulo($articulo['Articulo']['foto']);
	echo $this -> Html -> image($imagen, array('class' => 'ubicados_index'));
	?>&nbsp; </td>
	<td><?php echo $articulo['Articulo']['id'];?>&nbsp;</td>
	<td><?php echo $articulo['Articulo']['codigo'];?>&nbsp;</td>
	<td><?php echo $this -> Html -> link($articulo['Articulo']['detalle'], array(
				'controller' => 'articulos',
				'action' => 'view',
				$articulo['Articulo']['id']
		));
	?></td>
</tr>
