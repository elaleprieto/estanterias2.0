<?php
/* Ubicacion Fixture generated on: 2011-08-04 12:08:09 : 1312471029 */
class UbicacionFixture extends CakeTestFixture {
	var $name = 'Ubicacion';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'altura' => array('type' => 'string', 'null' => false, 'length' => 100),
		'posicion' => array('type' => 'string', 'null' => false, 'length' => 100),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'pasillo_id' => array('type' => 'integer', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id')),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'altura' => 'Lorem ipsum dolor sit amet',
			'posicion' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-08-04 12:17:09',
			'modified' => '2011-08-04 12:17:09',
			'pasillo_id' => 1
		),
	);
}
?>