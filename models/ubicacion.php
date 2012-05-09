<?php
class Ubicacion extends AppModel {
	var $name = 'Ubicacion';
	var $virtualFields = array(
    	# con MySQL sería así: 'ubicacion_completo' => 'CONCAT("Posición: ", Ubicacion.posicion, " - Altura: ", Ubicacion.altura)'
    	# con PostgreSQL sería así: 'ubicacion_completo' => '\'Posición: \' || Ubicacion.posicion || \' - Altura: \' || Ubicacion.altura'
    	'ubicacion_completo' => '\'Posición: \' || Ubicacion.posicion || \' - Altura: \' || Ubicacion.altura'
    );
	
	var $validate = array(
		'altura' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'posicion' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Ubicado' => array(
			'className' => 'Ubicado',
			'foreignKey' => 'ubicacion_id',
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