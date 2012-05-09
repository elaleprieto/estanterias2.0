<?php
/* Cliente Fixture generated on: 2012-05-04 12:05:54 : 1336145994 */
class ClienteFixture extends CakeTestFixture {
	var $name = 'Cliente';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => false, 'length' => 50),
		'direccion' => array('type' => 'string', 'null' => false, 'length' => 50),
		'cuit' => array('type' => 'string', 'null' => false, 'length' => 15),
		'bonificacion' => array('type' => 'integer', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'localidad_id' => array('type' => 'integer', 'null' => false),
		'iva_id' => array('type' => 'integer', 'null' => false),
		'prioridad' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'transporte_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'cobinpro' => array('type' => 'boolean', 'null' => false, 'default' => 'true'),
		'contrarrembolso' => array('type' => 'boolean', 'null' => false, 'default' => 'false'),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id')),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'nombre' => 'Lorem ipsum dolor sit amet',
			'direccion' => 'Lorem ipsum dolor sit amet',
			'cuit' => 'Lorem ipsum d',
			'bonificacion' => 1,
			'created' => '2012-05-04 12:39:54',
			'modified' => '2012-05-04 12:39:54',
			'localidad_id' => 1,
			'iva_id' => 1,
			'prioridad' => 1,
			'transporte_id' => 1,
			'cobinpro' => 1,
			'contrarrembolso' => 1
		),
	);
}
?>