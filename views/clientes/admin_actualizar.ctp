<?php
	echo $this -> Form -> create('Cliente', array('enctype' => 'multipart/form-data'));
	echo $this -> Form -> input('Cliente.archivo', array('between' => '<br />', 'type' => 'file', 'label' => __('Actualización de Clientes', true)));
	echo $this -> Form -> end(__('Actualizar', true));
	echo $this -> Html -> link(_('Listar Clientes'), array('action' => 'view'));
?>