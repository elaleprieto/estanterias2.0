<?php
/* Provincia Fixture generated on: 2012-05-04 12:05:11 : 1336146371 */
class ProvinciaFixture extends CakeTestFixture {
	var $name = 'Provincia';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => false, 'length' => 100),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id')),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'nombre' => 'Lorem ipsum dolor sit amet',
			'created' => '2012-05-04 12:46:11',
			'modified' => '2012-05-04 12:46:11'
		),
	);
}
?>