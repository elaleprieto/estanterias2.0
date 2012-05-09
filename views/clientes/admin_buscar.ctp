<?php
# Se carga la librería Jquery
echo $javascript -> link(array('jquery-1.7.1.min','clientes_admin_buscar'), FALSE);

# Se define la ruta base
echo $javascript -> codeBlock('WEBROOT="' . $this -> Html -> url('/', true) . '"');

# Se agregan las CSS
echo $this -> Html -> css('clientes_admin_buscar');
?>
<div class="clientes buscar">
	<fieldset>
		<legend>
			<?php __('Buscar Cliente');?>
		</legend>
		<?php
		# Aquí se inicia el Formulario para Buscar
		echo $this -> Form -> create('Cliente', array('id' => 'formulario'));

		# Se define el campo de búsqueda
		echo $this -> Form -> input('cliente', array(
				'id' => 'cliente',
				'div' => false,
				'label' => false,
				'class' => 'cliente'
		));
		# Se define el campo de búsqueda
		echo $this -> Form -> submit('Buscar', array(
				'div' => false,
				'label' => false,
				'class' => 'cliente'
		));

		# Se finaliza el formulario
		echo $this -> Form -> end();
		?>
	</fieldset>
	<div id="listado">
	</div>
</div>
