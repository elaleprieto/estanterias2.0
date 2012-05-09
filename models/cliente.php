<?php
class Cliente extends AppModel {
	var $name = 'Cliente';
	var $displayField = 'nombre';
	var $order = 'Cliente.nombre ASC';
	var $validate = array(
			'nombre' => array('notempty' => array('rule' => array('notempty'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				), ),
			'direccion' => array('notempty' => array('rule' => array('notempty'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				), ),
			'cuit' => array('notempty' => array('rule' => array('notempty'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				), ),
			'bonificacion' => array('numeric' => array('rule' => array('numeric'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				), ),
			'localidad_id' => array('numeric' => array('rule' => array('numeric'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				), ),
			'iva_id' => array('numeric' => array('rule' => array('numeric'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				), ),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
			'Localidad' => array(
					'className' => 'Localidad',
					'foreignKey' => 'localidad_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			),
			'Iva' => array(
					'className' => 'Iva',
					'foreignKey' => 'iva_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			),
			'Transporte' => array(
					'className' => 'Transporte',
					'foreignKey' => 'transporte_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			)
	);

	var $hasMany = array('Pedido' => array(
				'className' => 'Pedido',
				'foreignKey' => 'cliente_id',
				'dependent' => false,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
		));

	/**
	 * Aquí se realiza la actualización de clientes desde un archivo subido al servidor
	 */
	public function actualizar($filename) {
		# to avoid having to tweak the contents of
		# $data you should use your db field name as the heading name
		# eg: Post.id, Post.title, Post.description

		# set the filename to read CSV from
		$filename = TMP . 'uploads' . DS . 'cliente' . DS . $filename;

		# open the file
		$handle = fopen($filename, "r") or die('Error al abrir el archivo.');

		# read the 1st row as headings
		$header = fgetcsv($handle);

		# definición de variables
		$retorno = array();

		# read each data row in the file
		while (($fila = fgetcsv($handle)) !== FALSE) {
			$data = array();

			$data['Cliente']['id'] = (integer) trim($fila[0]);
			$data['Cliente']['nombre'] = $fila[1];
			$data['Cliente']['direccion'] = $fila[2];
			$data['Cliente']['localidad_id'] = (integer) trim($fila[3]);
			$data['Cliente']['cuit'] = $fila[4];
			$data['Cliente']['bonificacion'] = (integer) trim($fila[7]);

			// debug((integer) trim($fila[0]));

			# identificación de categoría de IVA
			switch ($fila[6]) {
				case 'S' :
					$iva_categoria = 'Responsable Inscripto';
					break;
				case 'N' :
					$iva_categoria = 'Responsable No Inscripto';
					break;
				case 'M' :
					$iva_categoria = 'Monotributo';
					break;
				case 'E' :
					$iva_categoria = 'Exento';
					break;
				default :
					$iva_categoria = 'Responsable Inscripto';
					break;
			}

			# busco si existe la categoría de IVA
			$iva = $this -> Iva -> findByCategoria($iva_categoria);
			# si existe, se usa, sino se crea
			if (isset($iva['Iva'])) {
				$data['Cliente']['iva_id'] = $iva['Iva']['id'];
			} else {
				$data_iva = array();
				$data_iva['Iva']['categoria'] = $iva_categoria;
				$this -> Iva -> create($data_iva);
				$this -> Iva -> save($data_iva, FALSE);
				$iva = $this -> Iva -> findByCategoria($iva_categoria);
				$data['Cliente']['iva_id'] = $iva['Iva']['id'];
			}
			$this -> create($data);
			$this -> save($data, FALSE);
		}
		return true;
	}

}
?>