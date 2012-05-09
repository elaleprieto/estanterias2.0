<?php
/* Mercaderium Test cases generated on: 2012-04-27 09:04:00 : 1335530220*/
App::import('Model', 'Mercaderium');

class MercaderiumTestCase extends CakeTestCase {
	function startTest() {
		$this->Mercaderium =& ClassRegistry::init('Mercaderium');
	}

	function endTest() {
		unset($this->Mercaderium);
		ClassRegistry::flush();
	}

}
?>