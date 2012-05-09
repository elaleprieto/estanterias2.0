<div class="pedidos_add">
	<?php echo $this -> Form -> create('Pedido');?>
	<fieldset>
		<legend>
			<?php echo 'Modificar Pedido';?>
		</legend>
		<?php
			# Se cargan las librería JavaScript
			echo $javascript -> link('prototype');
			echo $javascript -> link('scriptaculous');
			# Se define la ruta base
			echo $javascript -> codeBlock('WEBROOT="../../"', $options = array('allowCache'=>true,'safe'=>true,'inline'=>true));

			# Se crean las funciones auxiliares
			# (en webroot/js) 
			echo $javascript -> link('pedidos_edit');

			# Aquí se arma el Formulario de Creación del Pedido
			echo $this -> Form -> input('cliente_id', array(
					'class' => 'articulo',
					'div' => FALSE,
			));
			echo $this -> Form -> submit('Guardar Modificaciones', array(
					'class' => 'articulo',
					'div' => FALSE,
					'name' => 'guardar',
			));
		?>
		<table class="pedido_add" cellpadding="0" cellspacing="0">
			<thead>
			<tr>
				<th class="pedido_add">Cantidad</th>
				<th class="pedido_add">Articulo</th>
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
				<td class="pedido_add"><?php
					echo $this -> Form -> input('articulo_id', array(
							'id' => 'articulo_id',
							'div' => FALSE,
							'class' => 'articulo',
							'label' => FALSE,
					));
				?></td>
				<td class="pedido_add"><?php
					echo "<input type='button' id='agregar' class='articulo' value='Agregar Artículo' />";
					echo $javascript -> event('agregar', 'click', 'articulos_actualizar()');
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
				<th><?php echo 'Articulo';?></th>
				<th><?php echo 'Acciones';?></th>
			</tr>
		</thead>
		<tbody id='articulos'>
			<?php
				foreach ($ordenes as $orden) {
			?>
					<tr>
						<td class="invisible">
							<input type="hidden" value="<?php echo $orden['Orden']['cantidad']; ?>"
								name="data[Orden][<?php echo $orden['Articulo']['id']; ?>][cantidad]"
							/>
						</td>
						<td class="invisible">
							<input type="hidden" value="<?php echo $orden['Orden']['estado']; ?>"
								name="data[Orden][<?php echo $orden['Articulo']['id']; ?>][estado]"
							/>
						</td>
						<td id="<?php echo 'f'.$orden['Articulo']['id']; ?>">
							<?php
								echo $this->element('get_foto', 
									array('articulo' => $orden));
							?>
						</td>
						<td id="<?php echo 'c'.$orden['Articulo']['id']; ?>"><?php echo $orden['Articulo']['codigo']; ?></td>
						<td><?php echo $orden['Orden']['cantidad']; ?></td>
						<td><?php echo $orden['Articulo']['detalle']; ?></td>
						<td><input class="articulo" type="button" value="Quitar" onclick="quitar_articulo(this);"></td>
					</tr>
			<?php		
				}
			?>
		</tbody>
	</table>
	<?php echo $this -> Form -> end();?>
</div>
