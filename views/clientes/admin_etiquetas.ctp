<?php
# Se carga la librería Jquery
echo $javascript -> link(array('admin_etiquetas'), FALSE);

# Se define la ruta base
echo $javascript -> codeBlock('WEBROOT="'.$this -> Html-> url('/', true).'"');

# Se agregan las CSS
echo $html -> css('admin_etiquetas');

echo $this -> Form -> create('Clientes', array('id'=>'formulario', 'target' => '_blank'));
echo $this -> Form -> label('cliente', 'Cliente', array('class'=>'etiqueta'));
echo $this -> Form -> input('cliente', array('div' => FALSE, 'id' => 'cliente', 'label'=> FALSE, 'selected' => $cliente_id));
echo $this -> Form -> input('nombre', array('div' => FALSE, 'id' => 'nombre', 'label' => FALSE, 'autocomplete' => 'off'));
echo $this -> Form -> label('direccion', 'Dirección', array('class'=>'etiqueta', 'autocomplete' => 'off'));
echo $this -> Html -> image('load.gif', array('id' => 'direccionIMG', 'class' => 'noIMG'));
echo $this -> Form -> input('direccion', array('div' => FALSE, 'id' => 'direccion', 'label' => false, 'autocomplete' => 'off'));
echo $this -> Form -> label('localidad', 'Localidad', array('class'=>'etiqueta', 'autocomplete' => 'off'));
echo $this -> Html -> image('load.gif', array('id' => 'localidadIMG', 'class' => 'noIMG'));
echo $this -> Form -> input('localidad', array('div' => FALSE, 'id' => 'localidad', 'label' => false, 'autocomplete' => 'off'));
echo $this -> Form -> label('provincia', 'Provincia', array('class'=>'etiqueta', 'autocomplete' => 'off'));
echo $this -> Html -> image('load.gif', array('id' => 'provinciaIMG', 'class' => 'noIMG'));
echo $this -> Form -> input('provincia', array('div' => FALSE, 'id' => 'provincia', 'label' => false, 'autocomplete' => 'off'));
echo $this -> Form -> input('bultos', array('div' => FALSE, 'id' => 'bultos', 'autocomplete' => 'off'));
echo $this -> Form -> input('etiquetas', array('div' => FALSE, 'id' => 'etiquetas', 'value' => 1, 'autocomplete' => 'off'));
echo $this -> Form -> input('inicio', array('div' => FALSE, 'value' => 1));
echo $this -> Form -> end('Etiquetar');
?>
