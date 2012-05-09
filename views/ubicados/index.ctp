<?php
# Se carga la librería Jquery
echo $javascript -> link(array('jquery-1.7.1.min','ubicados_index'), FALSE);

# Se define la ruta base
echo $javascript -> codeBlock('WEBROOT="' . $this -> Html -> url('/', true) . '"', $options = array('inline' => true));
?>
<div class="ubicados_index">
	<fieldset>
		<legend>
			<?php __('Buscar Artículos Ubicados');?>
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
		echo $this -> Form -> submit('Buscar', array(
				'div' => false,
				'id' => 'buscar'
		));

		# Se finaliza el formulario
		echo $this -> Form -> end();
		?>
	</fieldset>
	<div id="listado"></div>
</div>
