<?php
/* Pedido Fixture generated on: 2012-05-04 12:05:54 : 1336145934 */
class PedidoFixture extends CakeTestFixture {
	var $name = 'Pedido';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'finalizado' => array('type' => 'datetime', 'null' => true),
		'cliente_id' => array('type' => 'integer', 'null' => false),
		'estado' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'transporte_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'cobinpro' => array('type' => 'boolean', 'null' => false, 'default' => 'false'),
		'contrarrembolso' => array('type' => 'boolean', 'null' => false, 'default' => 'false'),
		'observaciones' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'iniciado' => array('type' => 'datetime', 'null' => true),
		'tiempo_preparacion' => array('type' => 'float', 'null' => false, 'default' => '0'),
		'controlado' => array('type' => 'datetime', 'null' => true),
		'tiempo_control' => array('type' => 'float', 'null' => false, 'default' => '0'),
		'prioridad' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'facturado' => array('type' => 'datetime', 'null' => true),
		'tiempo_facturacion' => array('type' => 'float', 'null' => false, 'default' => '0'),
		'embalado' => array('type' => 'datetime', 'null' => true),
		'despachado' => array('type' => 'datetime', 'null' => true),
		'tiempo_embalado' => array('type' => 'float', 'null' => false, 'default' => '0'),
		'tiempo_despacho' => array('type' => 'float', 'null' => false, 'default' => '0'),
		'preparacion_orden' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id')),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'created' => '2012-05-04 12:38:54',
			'modified' => '2012-05-04 12:38:54',
			'finalizado' => '2012-05-04 12:38:54',
			'cliente_id' => 1,
			'estado' => 1,
			'transporte_id' => 1,
			'cobinpro' => 1,
			'contrarrembolso' => 1,
			'observaciones' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'iniciado' => '2012-05-04 12:38:54',
			'tiempo_preparacion' => 1,
			'controlado' => '2012-05-04 12:38:54',
			'tiempo_control' => 1,
			'prioridad' => 1,
			'facturado' => '2012-05-04 12:38:54',
			'tiempo_facturacion' => 1,
			'embalado' => '2012-05-04 12:38:54',
			'despachado' => '2012-05-04 12:38:54',
			'tiempo_embalado' => 1,
			'tiempo_despacho' => 1,
			'preparacion_orden' => 1
		),
	);
}
?>