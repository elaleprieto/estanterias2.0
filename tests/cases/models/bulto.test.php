<?php
/* Bulto Test cases generated on: 2012-02-16 13:02:16 : 1329411076*/
App::import('Model', 'Bulto');

class BultoTestCase extends CakeTestCase {
	var $fixtures = array('app.bulto', 'app.orden', 'app.articulo', 'app.ubicado', 'app.pasillo', 'app.ubicacion', 'app.pedido', 'app.cliente', 'app.localidad', 'app.provincia', 'app.iva', 'app.transporte');

	function startTest() {
		$this->Bulto =& ClassRegistry::init('Bulto');
	}

	function endTest() {
		unset($this->Bulto);
		ClassRegistry::flush();
	}

}
?>