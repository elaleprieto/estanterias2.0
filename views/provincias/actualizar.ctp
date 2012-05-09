<?php
	echo $this -> Form -> create('Provincia', array('enctype' => 'multipart/form-data'));
	echo $this -> Form -> input('Provincia.archivo', array('between' => '<br />', 'type' => 'file', 'label' => __('Actualización de Provincias', true)));
	echo $this -> Form -> end(__('Actualizar', true));
	echo $this -> Html -> link(_('Listar Provincias'), array('action' => 'view'));
?>