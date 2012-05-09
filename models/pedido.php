<?php
class Pedido extends AppModel {
	var $name = 'Pedido';
	var $validate = array(
		//'numero' => array(
			//'numeric' => array(
				//'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
		//	),
		//),
	);
	
	var $virtualFields = array(
		'cliente_nombre' => 'SELECT nombre FROM Clientes as cliente WHERE cliente.id = Pedido.cliente_id',
		'articulos' => 'SELECT COUNT(*) FROM Ordenes AS ordenes WHERE ordenes.pedido_id = Pedido.id GROUP BY ordenes.pedido_id',
		'progreso' => 'SELECT b.completadas / a.cantidad * 100
						FROM (SELECT CAST(COUNT(*) AS FLOAT) AS cantidad
								FROM Ordenes AS ordenes
								WHERE  ordenes.pedido_id = Pedido.id
								GROUP BY ordenes.pedido_id) AS a,
							(SELECT CAST(COUNT(*) AS FLOAT) AS completadas
								FROM Ordenes AS ordenes
								WHERE ordenes.pedido_id = Pedido.id
								AND ordenes.estado = TRUE
								GROUP BY ordenes.pedido_id) AS b'
	);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Cliente' => array(
			'className' => 'Cliente',
			'foreignKey' => 'cliente_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
		'Transporte' => array(
			'className' => 'Transporte',
			'foreignKey' => 'transporte_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
		)
	);
	
	
	var $hasMany = array(
		'Orden' => array(
			'className' => 'Orden',
			'foreignKey' => 'pedido_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	

}
?>