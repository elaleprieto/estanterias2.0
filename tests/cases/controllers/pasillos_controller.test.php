<?php
/* Pasillos Test cases generated on: 2011-08-04 12:08:37 : 1312471057*/
App::import('Controller', 'Pasillos');

class TestPasillosController extends PasillosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PasillosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.pasillo', 'app.ubicacion', 'app.ubicado', 'app.articulo');

	function startTest() {
		$this->Pasillos =& new TestPasillosController();
		$this->Pasillos->constructClasses();
	}

	function endTest() {
		unset($this->Pasillos);
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