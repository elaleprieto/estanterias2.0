<?php
# Se carga la librería Jquery
echo $javascript -> link(array('jquery-1.7.1.min','admin_articulos_buscar'), FALSE);

# Se define la ruta base
echo $javascript -> codeBlock('WEBROOT="' . $this -> Html -> url('/', true) . '"', $options = array('inline' => true));

# Se agregan las CSS
echo $this -> Html -> css('admin_articulos_buscar');
?>
<div class="articulos buscar">
	<fieldset>
		<legend>
			<?php __('Buscar Artículos');?>
		</legend>
		<?php
		# Aquí se inicia el Formulario para Buscar
		echo $this -> Form -> create('Articulo', array('id' => 'formulario'));

		# Se define el campo de búsqueda
		echo $this -> Form -> input('articulo', array(
				'id' => 'articulo',
				'div' => false,
				'label' => false,
				'class' => 'articulo'
		));
		# Se define el campo de búsqueda
		echo $this -> Form -> submit('Buscar', array(
				'div' => false,
				'label' => false,
				'class' => 'articulo'
		));

		# Se finaliza el formulario
		echo $this -> Form -> end();
		?>
	</fieldset>
	<div id="listado">
	</div>
</div>
