<?php
/* Localidad Fixture generated on: 2012-05-04 12:05:19 : 1336146319 */
class LocalidadFixture extends CakeTestFixture {
	var $name = 'Localidad';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => false, 'length' => 100),
		'codigo_postal' => array('type' => 'integer', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'provincia_id' => array('type' => 'integer', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id')),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'nombre' => 'Lorem ipsum dolor sit amet',
			'codigo_postal' => 1,
			'created' => '2012-05-04 12:45:19',
			'modified' => '2012-05-04 12:45:19',
			'provincia_id' => 1
		),
	);
}
?>