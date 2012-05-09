<?php
# Se carga la librería Jquery
echo $javascript -> link(array('jquery-1.7.1.min','ubicados_index'), FALSE);

# Se define la ruta base
echo $javascript -> codeBlock('WEBROOT="' . $this -> Html -> url('/', true) . '"', $options = array('inline' => true));
?>
<div class="ubicados_index">
	<h2><?php echo 'Ubicación de los artículos';?></h2>
	<h4><?php echo 'Artículos que se encuentran con una ubicación asignada';?></h4>
	<fieldset>
		<legend>
			<?php __('Buscar');?>
		</legend>
		<?php
		# Aquí se inicia el Formulario para Buscar
		echo $this -> Form -> create('Ubicado', array('id' => 'formulario'));

		# Se define el campo de búsqueda
		echo $this -> Form -> input('articulo', array(
				'id' => 'articulo',
				'div' => false,
				'label' => false,
				'class' => 'articulo'
		));

		# Se finaliza el formulario
		echo $this -> Form -> end('Buscar');

		?>
	</fieldset>
	<div id="listado">
	</div>
	
</div>
