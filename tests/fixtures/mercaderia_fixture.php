<?php
/* Mercaderia Fixture generated on: 2012-05-04 12:05:45 : 1336146525 */
class MercaderiaFixture extends CakeTestFixture {
	var $name = 'Mercaderia';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'cantidad' => array('type' => 'integer', 'null' => false),
		'cantidad_anterior' => array('type' => 'integer', 'null' => false),
		'observaciones' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'articulo_id' => array('type' => 'integer', 'null' => false),
		'movimiento' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id')),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'cantidad' => 1,
			'cantidad_anterior' => 1,
			'observaciones' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2012-05-04 12:48:45',
			'modified' => '2012-05-04 12:48:45',
			'articulo_id' => 1,
			'movimiento' => 1
		),
	);
}
?>