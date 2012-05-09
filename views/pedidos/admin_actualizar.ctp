<?php
	echo $this -> Form -> create('Pedido', array('enctype' => 'multipart/form-data'));
	echo $this -> Form -> input('Pedido.aux', array('between' => '<br />', 'type' => 'file', 'label' => 'AUXFACTU.DBF'));
	echo $this -> Form -> input('Pedido.facturas', array('between' => '<br />', 'type' => 'file', 'label' => 'FACTURAS.DBF'));
	echo $this -> Form -> end(__('Actualizar', true));
	// echo $this -> Html -> link(_('Listar Articulos'), array('action' => 'view'));
?>