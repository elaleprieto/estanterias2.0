<?php
class Orden extends AppModel {
	var $name = 'Orden';
	var $virtualFields = array(
		// 'precio_venta' => 'SELECT COUNT(*) FROM Ordenes AS ordenes WHERE ordenes.pedido_id = Pedido.id GROUP BY ordenes.pedido_id',
		'articulo_orden' => 'SELECT orden FROM Articulos as articulos WHERE articulos.id = Orden.articulo_id',
		'articulo_detalle' => 'SELECT detalle FROM Articulos as articulos WHERE articulos.id = Orden.articulo_id',
		'articulo_unidad' => 'SELECT unidad FROM Articulos as articulos WHERE articulos.id = Orden.articulo_id',
		'articulo_foto' => 'SELECT foto FROM Articulos as articulos WHERE articulos.id = Orden.articulo_id',
		'articulo_precio_venta' => 'SELECT (precio + precio * porcentaje / 100) FROM Articulos as articulos WHERE articulos.id = Orden.articulo_id',
	);
	var $validate = array(
		//'estado' => array(
			//'boolean' => array(
				//'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			//),
		//),
		'articulo_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'pedido_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Articulo' => array(
			'className' => 'Articulo',
			'foreignKey' => 'articulo_id',
			'conditions' => '',
			'fields' => '',
			'order' => 'orden ASC'
		),
		'Pedido' => array(
			'className' => 'Pedido',
			'foreignKey' => 'pedido_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Bulto' => array(
			'className' => 'Bulto',
			'foreignKey' => 'bulto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>