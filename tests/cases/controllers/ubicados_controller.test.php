<?php
/* Ubicados Test cases generated on: 2011-08-04 12:08:47 : 1312471067*/
App::import('Controller', 'Ubicados');

class TestUbicadosController extends UbicadosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class UbicadosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.ubicado', 'app.articulo', 'app.ubicacion', 'app.pasillo');

	function startTest() {
		$this->Ubicados =& new TestUbicadosController();
		$this->Ubicados->constructClasses();
	}

	function endTest() {
		unset($this->Ubicados);
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