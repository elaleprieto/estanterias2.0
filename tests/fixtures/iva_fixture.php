<?php
/* Iva Fixture generated on: 2012-05-04 12:05:51 : 1336146411 */
class IvaFixture extends CakeTestFixture {
	var $name = 'Iva';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'categoria' => array('type' => 'string', 'null' => false, 'length' => 50),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id')),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'categoria' => 'Lorem ipsum dolor sit amet',
			'created' => '2012-05-04 12:46:51',
			'modified' => '2012-05-04 12:46:51'
		),
	);
}
?>