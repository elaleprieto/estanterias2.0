<?php
/* Ubicado Fixture generated on: 2011-08-04 12:08:04 : 1312471024 */
class UbicadoFixture extends CakeTestFixture {
	var $name = 'Ubicado';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'articulo_id' => array('type' => 'integer', 'null' => false),
		'ubicacion_id' => array('type' => 'integer', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id')),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'created' => '2011-08-04 12:17:04',
			'modified' => '2011-08-04 12:17:04',
			'articulo_id' => 1,
			'ubicacion_id' => 1
		),
	);
}
?>