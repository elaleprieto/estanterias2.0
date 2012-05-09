<?php
/* Orden Fixture generated on: 2012-05-04 12:05:04 : 1336145884 */
class OrdenFixture extends CakeTestFixture {
	var $name = 'Orden';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'cantidad' => array('type' => 'float', 'null' => false),
		'estado' => array('type' => 'boolean', 'null' => false, 'default' => 'false'),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'articulo_id' => array('type' => 'integer', 'null' => false),
		'pedido_id' => array('type' => 'integer', 'null' => false),
		'sin_cargo' => array('type' => 'boolean', 'null' => false, 'default' => 'false'),
		'observaciones' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'cantidad_original' => array('type' => 'float', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id')),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'cantidad' => 1,
			'estado' => 1,
			'created' => '2012-05-04 12:38:04',
			'modified' => '2012-05-04 12:38:04',
			'articulo_id' => 1,
			'pedido_id' => 1,
			'sin_cargo' => 1,
			'observaciones' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'cantidad_original' => 1
		),
	);
}
?>