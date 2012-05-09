<?php
/* Ubicaciones Test cases generated on: 2011-08-04 12:08:52 : 1312471072*/
App::import('Controller', 'Ubicaciones');

class TestUbicacionesController extends UbicacionesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class UbicacionesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.ubicacion', 'app.pasillo', 'app.ubicado', 'app.articulo');

	function startTest() {
		$this->Ubicaciones =& new TestUbicacionesController();
		$this->Ubicaciones->constructClasses();
	}

	function endTest() {
		unset($this->Ubicaciones);
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