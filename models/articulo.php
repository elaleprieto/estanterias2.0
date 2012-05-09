<?php
class Articulo extends AppModel {
	var $name = 'Articulo';
	var $displayField = 'detalle';
	var $virtualFields = array(
		// 'precio_venta' => 'SELECT COUNT(*) FROM Ordenes AS ordenes WHERE ordenes.pedido_id = Pedido.id GROUP BY ordenes.pedido_id',
		'precio_venta' => 'SELECT (precio + precio * porcentaje / 100) FROM Articulos AS articulos WHERE articulos.id = Articulo.id',
		'cantidad_vendida' => 'SELECT SUM(ordenes.cantidad) 
								FROM Ordenes AS ordenes 
								WHERE ordenes.articulo_id = Articulo.id
								GROUP BY Articulo.id',
		// 'total_costo' => 'precio * cantidad_vendida',
		'cantidad_vendida_total' => 'SELECT SUM(ordenes.cantidad) FROM Ordenes AS ordenes'
	);

	var $validate = array(
		'detalle' => array('notempty' => array('rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			), ),
		'unidad' => array('notempty' => array('rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			), ),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Ubicado' => array(
			'className' => 'Ubicado',
			'foreignKey' => 'articulo_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Orden' => array(
			'className' => 'Orden',
			'foreignKey' => 'articulo_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Mercaderia' => array(
			'className' => 'Mercaderia',
			'foreignKey' => 'articulo_id',
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

	/**
	 * Aquí se realiza la actualización de articulos desde un archivo subido al servidor
	 */
	public function actualizar($filename) {
		# to avoid having to tweak the contents of
		# $data you should use your db field name as the heading name
		# eg: Post.id, Post.title, Post.description

		# set the filename to read CSV from
		$filename = TMP . 'uploads' . DS . 'Articulo' . DS . $filename;

		# open the file
		$handle = fopen($filename, "r") or die('Error al abrir el archivo.');

		# read the 1st row as headings
		$header = fgetcsv($handle);

		# read the 2st row as headings
		$header2 = fgetcsv($handle);

		# create a message container
		$return = array(
			'messages' => array(),
			'errors' => array(),
		);

		# inicializo las variables
		$nuevos = 0;

		# read each data row in the file
		while (($fila = fgetcsv($handle, 0, ";")) !== FALSE) {
			if (trim($fila[0]) != '999999') {
				$data = array();

				$data['Articulo']['orden'] = (integer) trim($fila[0]);
				$data['Articulo']['id'] = (integer) trim($fila[1]);
				$data['Articulo']['detalle'] = utf8_encode($fila[2]);
				$data['Articulo']['unidad'] = $fila[6];
				$data['Articulo']['precio'] = (float) str_replace(",", ".", $fila[8]);

				$this -> create($data);
				$this -> save($data);

				# busco si existe el producto con el código
				// $producto = $this -> findByCodigo($data['Articulo']['codigo']);

				# si existe, se actualiza, sino se crea
				// if (isset($producto['Articulo'])) {
				// $this -> id = $producto['Articulo']['id'];
				// } else {
				// $this -> create();
				// $nuevos++;
				// }
				// $this -> set($data);
			}
		}
		// return $nuevos;
	}

	function getTotalVendido() {
		return $this -> query("SELECT SUM(S.valor_total) AS sumatoria_valor_total
								FROM (
									-- Artículos: valor total vendido
									SELECT A.id, ((A.precio + A.precio * A.porcentaje / 100) * SUM(O.cantidad)) AS valor_total
									FROM Articulos A, Ordenes O 
									WHERE A.id = O.articulo_id
									GROUP BY A.id, A.precio, A.porcentaje
									ORDER BY valor_total DESC
								) AS S");

	}

}
?>