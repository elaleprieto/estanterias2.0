<?php
	# Se verifica la existencia de la foto del artículo en el directorio,
	# si no existe se carga la foto "nofoto.png"
	$imagen = $this -> Foto -> articulo($articulo['Articulo']['foto']);
	echo $this -> Html -> image($imagen, array('class' => 'ubicados_index'));
?>