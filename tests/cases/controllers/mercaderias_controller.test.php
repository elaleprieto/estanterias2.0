<?php
/* Mercaderias Test cases generated on: 2012-04-27 09:04:02 : 1335530222*/
App::import('Controller', 'Mercaderias');

class TestMercaderiasController extends MercaderiasController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MercaderiasControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.mercaderia', 'app.articulo', 'app.ubicado', 'app.pasillo', 'app.ubicacion', 'app.orden', 'app.pedido', 'app.cliente', 'app.localidad', 'app.provincia', 'app.iva', 'app.transporte', 'app.bulto');

	function startTest() {
		$this->Mercaderias =& new TestMercaderiasController();
		$this->Mercaderias->constructClasses();
	}

	function endTest() {
		unset($this->Mercaderias);
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