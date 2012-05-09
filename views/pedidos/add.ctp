<div class="pedidos_add">
	<?php echo $this -> Form -> create('Pedido', array('class' => 'pedidos_add'));?>
	<fieldset>
		<legend>
			<?php echo 'Nuevo Pedido';?>
		</legend>
		<?php
		# Se cargan las librería JavaScript
		// echo $javascript -> link('prototype');
		// echo $javascript -> link('scriptaculous');
		
		# Se carga la librería Jquery
		echo $javascript -> link(array('jquery-1.7.1.min', 'jquery-ui-1.8.4.custom.min', 'jquery.autocomplete.min'), FALSE);
		
		# Se define la ruta base
		echo $javascript -> codeBlock('WEBROOT="../"', $options = array(
				'allowCache' => true,
				'safe' => true,
				'inline' => true
		));

		# Se crean las funciones auxiliares
		# (en webroot/js)
		echo $javascript -> link('pedidos_add');

		# Aquí se arma el Formulario de Creación del Pedido
		echo $this -> Form -> input('cliente_id', array(
				'class' => 'articulo',
				'div' => FALSE,
		));
		echo $this -> Form -> submit('Crear Pedido', array(
				'class' => 'articulo',
				'div' => FALSE,
		));
		?>
		<label class="cantidad_articulos">Cantidad Artículos: </label>
		<div id="cantidad_articulos" class="cantidad_articulos">
			0
		</div>
		<div id="serial_articulos" class="invisible">
			0
		</div>
		<table class="pedido_add" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th class="pedido_add">Cantidad</th>
					<th class="pedido_add">Unidad</th>
					<th class="pedido_add">Articulo</th>
					<th class="pedido_add" id="sin_cargo">Sin Cargo</th>
					<th class="pedido_add"></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="pedido_add"><?php
					echo $this -> Form -> input('cantidad', array(
							'id' => 'cantidad',
							'div' => FALSE,
							'label' => FALSE,
					));
					?></td>
					<td class="pedido_add"><label id="unidad" class="pedidos_add_unidad"></label></td>
					<td class="pedido_add" id="auto_complete"><?php
					echo $ajax -> autoComplete('Pedido.articulo', '/pedidos/autoComplete', array('id' => 'articulo_autocomplete'));
					echo $this -> Form -> input('aux_articulo_id', array(
							'id' => 'aux_articulo_id',
							'div' => FALSE,
							'type' => 'hidden',
							'label' => FALSE,
					));
					?></td>
					<td class="pedido_add">
					<input id="sin_cargo_ckeckbox" type="checkbox" class="pedidos_add"/>
					</td>
					<td class="pedido_add"><?php
					echo "<input type='button' id='agregar' class='articulo' value='Agregar Artículo' />";
					// echo $javascript -> event('agregar', 'click', 'articulos_actualizar()');
					?></td>
				</tr>
			</tbody>
		</table>
	</fieldset>
	<table id="ordenes" cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th><?php echo 'Foto';?></th>
				<th><?php echo 'Codigo';?></th>
				<th><?php echo 'Cantidad';?></th>
				<th><?php echo 'Unidad';?></th>
				<th><?php echo 'Articulo';?></th>
				<th><?php echo 'Acciones';?></th>
			</tr>
		</thead>
		<tbody id='articulos'></tbody>
	</table>
	<?php echo $this -> Form -> end();?>
</div>