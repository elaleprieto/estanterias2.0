<?php
	echo $this -> Form -> create('Articulo', array('enctype' => 'multipart/form-data'));
	echo $this -> Form -> input('Articulo.archivo', array('between' => '<br />', 'type' => 'file', 'label' => __('Actualización de Articulos', true)));
	echo $this -> Form -> end(__('Actualizar', true));
	echo $this -> Html -> link(_('Listar Articulos'), array('action' => 'view'));
?>