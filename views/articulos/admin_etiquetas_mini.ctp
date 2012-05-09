<?php
# Se carga la librería Jquery
echo $javascript -> link(array('admin_etiquetas_mini'), FALSE);

echo $this -> Form -> create('Articulos', array('target' => '_blank'));
echo $this -> Form -> input('articulo', array('div' => FALSE, 'id' => 'articulo', 'selected' => $id));
echo $this -> Form -> input('detalle', array('div' => FALSE, 'id' => 'detalle', 'label' => FALSE));
echo $this -> Form -> input('unidades', array('value' => 50));
echo $this -> Form -> input('unidad', array('value' => 'unidades'));
echo $this -> Form -> input('etiquetas', array('value' => 1));
echo $this -> Form -> input('inicio', array('value' => 1));
echo $this -> Form -> end('Etiquetar');
?>
