<?php
# Se carga la librería Jquery
echo $javascript -> link(array('jquery-1.7.1.min','pedidos_admin_add_edit','pedidos_admin_add'), FALSE);

# Se define la ruta base
echo $javascript -> codeBlock('WEBROOT="'.$this -> Html-> url('/', true).'"');

# Se agregan las CSS
echo $html -> css('mostrador_pedidos_add');

# Aquí se arma el Formulario de Creación del Pedido
echo $this -> Form -> create('Pedido', array(
		'class' => 'pedidos_add',
		'id' => 'formulario'
));
?>
<?php echo $this -> element('mensaje_flotante', array("mensaje" => "Código inválido.")); ?>
<div class="pedidos_add">
	<?php echo $this -> element('pedidos_datos'); ?>
	<?php echo $this -> element('pedidos_articulos'); ?>
	<fieldset>
		<legend>
			<?php echo 'Pedido';?>
		</legend>
		<input id="prioridad" type="hidden" class="pedidos_add" name="data[Pedido][prioridad]" value="0"/>
		<?= $this -> Html -> image('prioridad_no.png', array('alt'=> __('ELEFE', true), 'class' => 'pedidos_add', 'id' => 'prioridad_imagen')); ?>
		<?php
		echo $this -> Form -> button('Crear Pedido', array(
				'class' => 'articulo',
				'type' => 'button',
				'div' => FALSE,
				'id' => 'crear',
		));
		?>
		<div class="cantidad_articulos">
			<label class="cantidad_articulos">Cantidad Artículos: </label>
			<label id="cantidad_articulos">
				0
			</label>
		</div>
		<table id="ordenes" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th><?php echo 'Foto';?></th>
					<th><?php echo 'Codigo';?></th>
					<th><?php echo 'Cantidad';?></th>
					<th><?php echo 'Unidad';?></th>
					<th><?php echo 'Articulo';?></th>
					<th><?php echo 'Notas';?></th>
					<th><?php echo 'Acciones';?></th>
				</tr>
			</thead>
			<tbody id='articulos'></tbody>
		</table>
	</fieldset>
</div>
<div id="serial_articulos" class="invisible">0</div>
<?php echo $this -> Form -> end();?>