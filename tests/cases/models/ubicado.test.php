<?php
/* Ubicado Test cases generated on: 2011-08-04 12:08:04 : 1312471024*/
App::import('Model', 'Ubicado');

class UbicadoTestCase extends CakeTestCase {
	var $fixtures = array('app.ubicado', 'app.articulo', 'app.ubicacion');

	function startTest() {
		$this->Ubicado =& ClassRegistry::init('Ubicado');
	}

	function endTest() {
		unset($this->Ubicado);
		ClassRegistry::flush();
	}

}
?>