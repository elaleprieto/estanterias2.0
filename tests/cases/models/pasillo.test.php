<?php
/* Pasillo Test cases generated on: 2011-08-04 12:08:36 : 1312471056*/
App::import('Model', 'Pasillo');

class PasilloTestCase extends CakeTestCase {
	var $fixtures = array('app.pasillo', 'app.ubicacion', 'app.ubicado', 'app.articulo');

	function startTest() {
		$this->Pasillo =& ClassRegistry::init('Pasillo');
	}

	function endTest() {
		unset($this->Pasillo);
		ClassRegistry::flush();
	}

}
?>