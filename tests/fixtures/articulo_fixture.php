<?php
/* Articulo Fixture generated on: 2011-08-04 12:08:53 : 1312471013 */
class ArticuloFixture extends CakeTestFixture {
	var $name = 'Articulo';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'orden' => array('type' => 'integer', 'null' => false, 'default' => 999999, 'length' => 11),
		'codigo' => array('type' => 'string', 'null' => false, 'length' => 10),
		'detalle' => array('type' => 'string', 'null' => false, 'length' => 250),
		'unidad' => array('type' => 'string', 'null' => false, 'length' => 10),
		'precio' => array('type' => 'float', 'null' => false, 'default' => '0.0'),
		'porcentaje' => array('type' => 'float', 'null' => false, 'default' => '0.0'),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id')),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'orden' => 1,
			'codigo' => 'Lorem ip',
			'detalle' => 'Lorem ipsum dolor sit amet',
			'unidad' => 'Lorem ip',
			'precio' => 1,
			'created' => '2011-08-04 12:16:53',
			'modified' => '2011-08-04 12:16:53'
		),
	);
}
?>