<?php
/* Articulo Test cases generated on: 2011-08-04 12:08:53 : 1312471013*/
App::import('Model', 'Articulo');

class ArticuloTestCase extends CakeTestCase {
	var $fixtures = array(
		'app.articulo',
		'app.ubicado',
		'app.pasillo',
		'app.ubicacion',
		'app.orden',
		'app.pedido',
		'app.cliente',
		'app.localidad',
		'app.provincia',
		'app.iva',
		'app.transporte',
		'app.bulto',
		'app.mercaderia',
	);

	function startTest() {
		$this -> Articulo = &ClassRegistry::init('Articulo');
	}

	function endTest() {
		unset($this -> Articulo);
		ClassRegistry::flush();
	}

	function testGetTotalVendido() {
		$this -> Articulo = &ClassRegistry::init('Articulo');
		$result = $this -> Articulo -> getTotalVendido();
		$expected = array(
			array('0' => array(
					'sumatoria_valor_total' => 1,
				)),
		);
		$this->assertEqual($result, $expected);
	}

}
?>