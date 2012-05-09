<?php
	echo $this -> Form -> create('Localidad', array('enctype' => 'multipart/form-data'));
	echo $this -> Form -> input('Localidad.archivo', array('between' => '<br />', 'type' => 'file', 'label' => __('Actualización de Localidades', true)));
	echo $this -> Form -> end(__('Actualizar', true));
	echo $this -> Html -> link(_('Listar Localidades'), array('action' => 'view'));
?>