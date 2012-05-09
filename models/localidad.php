<?php
class Localidad extends AppModel {
	var $name = 'Localidad';
	var $displayField = 'nombre';
	
	var $validate = array(
			'nombre' => array('notempty' => array('rule' => array('notempty'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				), ),
			'codigo_postal' => array('numeric' => array('rule' => array('numeric'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				), ),
			'provincia_id' => array('numeric' => array('rule' => array('numeric'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				), ),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array('Provincia' => array(
				'className' => 'Provincia',
				'foreignKey' => 'provincia_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
		));

	var $hasMany = array('Cliente' => array(
				'className' => 'Cliente',
				'foreignKey' => 'localidad_id',
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
	 * Aquí se realiza la actualización de provincias desde un archivo subido al servidor
	 */
	public function actualizar($filename) {
		# to avoid having to tweak the contents of
		# $data you should use your db field name as the heading name
		# eg: Post.id, Post.title, Post.description

		# set the filename to read CSV from
		$filename = TMP . 'uploads' . DS . 'localidad' . DS . $filename;

		# open the file
		$handle = fopen($filename, "r") or die('Error al abrir el archivo.');

		# read the 1st row as headings
		$header = fgetcsv($handle);

		# read each data row in the file
		while (($fila = fgetcsv($handle)) !== FALSE) {
			$data = array();

			$data['Localidad']['codigo_postal'] = $fila[0];
			$data['Localidad']['nombre'] = $fila[1];
			$data['Localidad']['provincia_id'] = (integer) trim($fila[4]);
			$data['Localidad']['id'] = (integer) trim($fila[5]);

			$this -> create($data);
			$this -> save();
		}

		return true;
	}

}
?>