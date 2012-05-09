<?php
/* Transporte Fixture generated on: 2012-05-04 12:05:30 : 1336146450 */
class TransporteFixture extends CakeTestFixture {
	var $name = 'Transporte';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => false, 'length' => 50),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id')),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'nombre' => 'Lorem ipsum dolor sit amet',
			'created' => '2012-05-04 12:47:30',
			'modified' => '2012-05-04 12:47:30'
		),
	);
}
?>