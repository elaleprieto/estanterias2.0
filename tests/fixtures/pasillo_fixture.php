<?php
/* Pasillo Fixture generated on: 2011-08-04 12:08:36 : 1312471056 */
class PasilloFixture extends CakeTestFixture {
	var $name = 'Pasillo';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => false, 'length' => 50),
		'lado' => array('type' => 'string', 'null' => false, 'length' => 50),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id')),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'nombre' => 'Lorem ipsum dolor sit amet',
			'lado' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-08-04 12:17:36',
			'modified' => '2011-08-04 12:17:36'
		),
	);
}
?>