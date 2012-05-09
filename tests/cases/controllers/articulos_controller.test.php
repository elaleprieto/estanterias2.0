<?php
/* Articulos Test cases generated on: 2011-08-04 12:08:57 : 1312471017*/
App::import('Controller', 'Articulos');

class TestArticulosController extends ArticulosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this -> redirectUrl = $url;
	}

}

class ArticulosControllerTestCase extends CakeTestCase {
	// var $fixtures = array(
		// 'app.articulo',
		// 'app.ubicado'
	// );

	function startCase() {
		echo '<h2>Comenzando Test Case</h2>';
	}

	function endCase() {
		echo '<h2>Terminado Test Case</h2>';
	}

	function startTest($method) {
		$this -> Articulos = &new TestArticulosController();
		$this -> Articulos -> constructClasses();
		echo '<h3>Comenzando método ' . $method . '</h3>';
	}

	function endTest() {
		unset($this -> Articulos);
		ClassRegistry::flush();
		echo '<hr />';
	}

	function testIndex() {
		$resultado = $this -> testAction('/articulos/index');
		$esperado = '';
		$this->assertEqual($resultado, $esperado);
	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

	// function testIndexGetRenderedHtml() {
		// $result = $this -> testAction('/articulos/index', array('return' => 'render'));
		// debug(htmlentities($result));
	// }

	// function testIndexGetViewVars() {
		// $result = $this -> testAction('/articulos/index', array('return' => 'vars'));
		// debug($result);
	// }
// 
	// function testIndexFixturized() {
		// $result = $this -> testAction('/articulos/index', array('fixturize' => true));
		// debug($result);
	// }
// 
	// function testIndexPostFixturized() {
		// $data = array('Articulo' => array(
				// 'id' => 1,
			// ));
		// $result = $this -> testAction('/articulos/index', array(
			// 'fixturize' => true,
			// 'data' => $data,
			// 'method' => 'post'
		// ));
		// debug($result);
	// }

}
?>