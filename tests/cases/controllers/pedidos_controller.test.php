<?php
/* pedidos Test cases generated on: 2012-05-07 13:05:24 : 1336407684*/
App::import('Controller', 'Pedidos');

class TestPedidosController extends PedidosController {
	var $name = 'Pedidos';
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this -> redirectUrl = $url;
	}

	function render($action = null, $layout = null, $file = null) {
		$this -> renderedAction = $action;
	}

	function _stop($status = 0) {
		$this -> stopped = $status;
	}

}

class PedidosControllerTestCase extends CakeTestCase {

	function startTest() {
		$this -> Pedidos = &new TestPedidosController();
		$this -> Pedidos -> constructClasses();
		$this -> Pedidos -> Component -> initialize($this -> Pedidos);
	}

	function endTest() {
		$this -> Pedidos -> Session -> destroy();
		unset($this -> Pedidos);
		ClassRegistry::flush();
	}

	function testAdminImprimirIdNull() {
		$this -> Pedidos -> params = Router::parse('/admin/pedidos/imprimir');
		$this -> Pedidos -> beforeFilter();
		$this -> Pedidos -> Component -> startup($this -> Pedidos);
		$this -> Pedidos -> admin_imprimir();

		//assert that some sort of session flash was set.
		$this -> assertTrue($this -> Pedidos -> Session -> check('Message.flash.message'));
		$this -> assertEqual($this -> Pedidos -> redirectUrl, array('action' => 'index'));
	}

	function testAdminImprimirOk() {
		$this -> Pedidos -> admin_imprimir(12);

		//assert that some sort of session flash was set.
		$this -> assertFalse($this -> Pedidos -> Session -> check('Message.flash.message'));
		// debug($this -> Pedidos -> Session -> read('Message.flash.message'));
		$this -> assertFalse(isset($this -> Pedidos -> redirectUrl));
	}
	function testAdminImprimirIdNoExiste() {
		$this -> Pedidos -> admin_imprimir(1);

		//assert that some sort of session flash was set.
		$this -> assertTrue($this -> Pedidos -> Session -> check('Message.flash.message'));
		// debug($this -> Pedidos -> Session -> read('Message.flash.message'));
		$this -> assertEqual($this -> Pedidos -> redirectUrl, array('action' => 'index'));
	}

}
?>