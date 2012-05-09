<?php
	/* /app/views/helpers/pedidos.php */
	/**
	 * Este Helper se crea para ayudar con todo lo referente al tratamiento de pedidos
	 * dentro del sistema.
	 */
	 App::import('Model', 'Pedido');		

	class PedidoHelper extends AppHelper {
		
		function getFinalizadosCount() {
			return $this -> Pedido -> getFinalizadosCount();
		}
	}
		