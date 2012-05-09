<?php
	/* /app/views/helpers/pedidos.php */
	/**
	 * Este Helper se crea para ayudar con todo lo referente al tratamiento de pedidos
	 * dentro del sistema.
	 */
	class PedidoHelper extends AppHelper {
		
		function getFinalizadosCount() {
			App::import('Controller', 'Pedido');
			$Pedidos = new PedidosController;
			return $Pedidos -> getFinalizadosCount();
		}
	}
		