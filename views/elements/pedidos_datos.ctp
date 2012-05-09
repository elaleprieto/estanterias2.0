<fieldset>
	<legend>
		<?php echo 'Datos del Pedido';?>
	</legend>
	<label id="labelCliente" class="datosCliente">Cliente:</label>
	<?php
	echo $this -> Form -> input('cliente_id', array(
			'class' => 'articulo desplegable',
			'div' => FALSE,
			'label' => FALSE,
			'id' => 'cliente'
	));
	?>
	<label id="labelObservaciones" class="datosCliente">Observaciones:</label>
	<?php
	echo $this -> Form -> input('observaciones', array(
			'class' => 'textfield',
			'div' => FALSE,
			'label' => FALSE,
			'type' => 'text'
	));
	?>
	<br />
	<label class="datosCliente">Transporte:</label>
	<?php
	echo $this -> Form -> input('transporte_id', array(
			'class' => 'desplegable',
			'div' => FALSE,
			'label' => FALSE,
			'empty' => '(elija Transporte)',
			'id' => 'transporte'
	));
	?>
	<label class="datosCliente">Contrarrembolso:</label>
	<input id="contrarrembolso" type="checkbox" class="pedidos_add" name="data[Pedido][contrarrembolso]" value="0"/>
	<label class="datosCliente">Cobinpro:</label>
	<input id="cobinpro" type="checkbox" class="pedidos_add" name="data[Pedido][cobinpro]" value="1" />
	<div id="load_cliente">
		<?php echo $this -> Html -> image('load.gif', array('class' => 'load'));?>
		Cargando Cliente...
	</div>
</fieldset>