<?php
/* Bultos Test cases generated on: 2012-02-16 13:02:19 : 1329411079*/
App::import('Controller', 'Bultos');

class TestBultosController extends BultosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class BultosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.bulto', 'app.orden', 'app.articulo', 'app.ubicado', 'app.pasillo', 'app.ubicacion', 'app.pedido', 'app.cliente', 'app.localidad', 'app.provincia', 'app.iva', 'app.transporte');

	function startTest() {
		$this->Bultos =& new TestBultosController();
		$this->Bultos->constructClasses();
	}

	function endTest() {
		unset($this->Bultos);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>