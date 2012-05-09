<div class="ordenes_add">
	<fieldset>
		<legend>
			<?php echo 'Nuevo Pedido';?>
		</legend>
		<?php
			# Se cargan las librería JavaScript
			echo $javascript->link('prototype');
			echo $javascript->link('scriptaculous');
		
			# Aquí se arma el Formulario de Creación del Pedido
			echo $this -> Form -> create('Orden');
			echo $this -> Form -> input('cliente_id');
			echo $this -> Form -> input('cantidad');
			echo $this -> Form -> input('articulo_id');
			
			# Se definen las opciones del elemento Ajax
			$options = array(
					'url' => array('action' => 'update_listado'),
					'update' => 'listado',
					'div' => false
			);
			
			# Se inserta el botón buscar
			echo $ajax -> submit('Agregar Artículo', $options);
			
		?>
	</fieldset>
	<?php echo $this -> Form -> end('Crear Pedido');?>
</div>
