<?php
	# Se cargan las librería JavaScript
	echo $javascript -> link('prototype');
	echo $javascript -> link('scriptaculous');
	# Se define la ruta base
	echo $javascript -> codeBlock('WEBROOT="../"', 
		$options = array('allowCache'=>true,'safe'=>true,'inline'=>true));

	# Se crean las funciones auxiliares
	# (en webroot/js) 
	echo $javascript -> link('articulos_listar_desubicados');
?>
<div class="acciones">
		<?php echo $this -> Html -> link(__('Listar Artículos', true), array(
				'controller' => 'articulos',
				'action' => 'index'
		));
		?>
		<?php echo $this -> Html -> link(__('Listar Ubicados', true), array(
				'controller' => 'ubicados',
				'action' => 'index'
		));
		?>
		<?php echo $this -> Html -> link(__('Nuevo Pasillo', true), array(
				'controller' => 'pasillos',
				'action' => 'add'
		));
		?>
		<?php echo $this -> Html -> link(__('Nueva Posición', true), array(
				'controller' => 'ubicacion',
				'action' => 'add'
		));
		?>
</div>
<div class="articulos index">
	<?php
	# Formulario
	echo $this -> Form -> create(null, array('url' => array('controller' => 'ubicados', 'action' => 'agregar'), 'class' => 'articulos'));
	
	# Paginación
	echo $this -> element('paging');
	
	# Submit Formulario
	echo $this -> Form -> submit('Agregar Seleccionados', array('div' => array('class' => 'agregar')));
	
	# Inicialización de variables
	$i = 0;
	$articuloN = 0;
	
	# Lista de Articulos
	foreach ($data as $articulo) {
		$class = null;
		$articuloN++;
		if ($i++ % 2 == 0) {
			$class = 'altrow ';
		}

	?>
	<div id="div<?php echo $articulo['Articulo']['id']; ?>" class="<?php echo $class;?>articulo">
		<span class="oculto	"> <?php
		echo $this -> Form -> hidden('Articulos.' . $articuloN . '.id', array('value' => $articulo['Articulo']['id']));
		echo $this -> Form -> input('Articulos.' . $articuloN . '.estado', array(
				'label' => FALSE,
				'type' => 'checkbox',
				'class' => 'oculto',
				'div' => FALSE
		));
			?></span>
		<span class="codigo"> <?php echo $articulo['Articulo']['id'];?></span>
		<span class="detalle"> <?php
		echo $articulo['Articulo']['detalle'];
			?></span>
		<span class="actions ubicar"> <?php
		echo $this -> Html -> link('Ubicar', array(
				'controller' => 'ubicados',
				'action' => 'add',
				$articulo['Articulo']['id']
		));
			?></span>
	</div>
	<?php
		# Definición del evento JavaScript que cambia el estilo y tilda el checkbox
		# cada vez que se hace clic.
		# La función cambiar_estilo(fila_id) se encuentra en el archivo 
		# webroot/js/articulos_listar_desubicados.js
		echo $javascript -> event('div'.$articulo['Articulo']['id'], 'click', 'cambiar_estilo("div'.$articulo['Articulo']['id'].'", "Articulos'.$articuloN.'Estado")');
	?>
	<?php
	} # Fin foreach

	# Fin Lista de Articulos

	# Fin Formulario
	echo $this -> Form -> end(array('label' => 'Agregar Seleccionados','div' => array('class' => 'agregar')));

	# Paginación
	echo $this -> element('paging');
	?>
</div>

