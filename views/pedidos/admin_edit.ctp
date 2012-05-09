<?php
# Se carga la librería Jquery
echo $javascript -> link(array('jquery-1.7.1.min','pedidos_admin_add_edit','pedidos_admin_edit'), FALSE);

# Se define la ruta base
echo $javascript -> codeBlock('WEBROOT="'.$this -> Html-> url('/', true).'"');

# Se agregan las CSS
echo $html -> css('pedidos_admin_add');

# Aquí se arma el Formulario de Creación del Pedido
echo $this -> Form -> create('Pedido', array('class' => 'pedidos_add', 'id' => 'formulario'));?>
<div class="pedidos_add">
	<?php echo $this -> element('pedidos_datos'); ?>
	<?php echo $this -> element('pedidos_articulos'); ?>
	<fieldset>
		<legend>
			<?php echo 'Pedido';?>
		</legend>
		<?php
		switch($this->data['Pedido']['prioridad']) {
			case 1:
				echo $this -> Form -> hidden('prioridad', array('id' => 'prioridad', 'value' => '1', 'class' => 'pedidos_add'));
				echo $this -> Html -> image('prioridad_baja.png', array('alt'=> __('ELEFE', true), 'class' => 'pedidos_add', 'id' => 'prioridad_imagen'));
				break;
			case 2:
				echo $this -> Form -> hidden('prioridad', array('id' => 'prioridad', 'value' => '2', 'class' => 'pedidos_add'));
				echo $this -> Html -> image('prioridad_alta.png', array('alt'=> __('ELEFE', true), 'class' => 'pedidos_add', 'id' => 'prioridad_imagen'));
				break;
			default:
				echo $this -> Form -> hidden('prioridad', array('id' => 'prioridad', 'value' => '0', 'class' => 'pedidos_add'));
				echo $this -> Html -> image('prioridad_no.png', array('alt'=> __('ELEFE', true), 'class' => 'pedidos_add', 'id' => 'prioridad_imagen'));
		}
		echo $this -> Form -> button('Guardar Pedido', array(
				'class' => 'articulo',
				'type' => 'button',
				'div' => FALSE,
				'id' => 'crear',
		));
		?>
		<table id="ordenes" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th><?php echo 'Foto';?></th>
					<th><?php echo 'Codigo';?></th>
					<th><?php echo 'Cantidad';?></th>
					<th><?php echo 'Unidad';?></th>
					<th><?php echo 'Articulo';?></th>
					<th><?php echo 'Observ.';?></th>
					<th><?php echo 'Acciones';?></th>
				</tr>
			</thead>
			<tbody id='articulos'>
			<?php
				$indice = 0; // indice
				foreach ($ordenes as $orden) {
			?>
					<tr>
						<td class="invisible">
							<input type="hidden" value="<?php echo $orden['Articulo']['id']; ?>"
								name="data[Orden][<?php echo $indice; ?>][id]"
							/>
						</td>

						<!-- Foto -->
						<td id="<?php echo 'f'.$orden['Articulo']['id']; ?>">
							<?php echo $this->element('get_foto', array('articulo' => $orden)); ?>
						</td>

						<!-- Código -->
						<?php
						# se verifica si el artículo es Sin Cargo o no
						if($orden['Orden']['sin_cargo']) {
						?>
							<td id="<?='c'.$orden['Articulo']['id']?>">Sin Cargo</td>
							<td class="invisible"><input type="hidden" name="data[Orden][<?=$indice?>][SinCargo]" value="1"></td>
						<?php } else { ?>
							<td id="<?='c'.$orden['Articulo']['id']?>"><?=$orden['Articulo']['id']?></td>
							<td class="invisible"><input type="hidden" name="data[Orden][<?=$indice?>][SinCargo]" value="0">
						<?php }	?>

						<!-- Cantidad -->
						<td><input class="cantidad" name="data[Orden][<?=$indice?>][Cantidad]" value="<?=$orden['Orden']['cantidad']?>"></td>
						
						<!-- Unidad -->
						<td id="<?='u'.$orden['Articulo']['id']?>"><?=$orden['Articulo']['unidad']?></td>

						<!-- Detalle -->
						<td id="<?='d'.$orden['Articulo']['id']?>"><?=$orden['Articulo']['detalle']?></td>
						
						<!-- Observaciones -->
						<td><input name="data[Orden][<?=$indice?>][Observaciones]" value="<?=$orden['Orden']['observaciones']?>">

						<!-- Acciones -->
						<td><input class="articulo" type="button" value="Quitar"></td>
						<td>
							<?php if($orden['Orden']['estado']) { ?>
								<input type="checkbox" class="pedidos_add" name="data[Orden][<?=$indice?>][estado]" value="1" checked="checked"/>
							<?php } else { ?>
								<input type="checkbox" class="pedidos_add" name="data[Orden][<?=$indice?>][estado]" value="0"/>
							<?php }	?>
						</td>
					</tr>
			<?php	
					$indice++;	
				}
			?>
			</tbody>
		</table>
	</fieldset>
</div>
<div id="serial_articulos" class="invisible"><?=sizeof($ordenes)?></div>
<?=$this -> Form -> end()?>