<?php
class Pasillo extends AppModel {
	var $name = 'Pasillo';
	var $displayField = 'nombre';
    var $virtualFields = array(
    	# con MySQL sería así: 'pasillo_completo' => 'CONCAT(Pasillo.nombre, " - Lado ", Pasillo.lado)'
    	# con PostgreSQL sería así: 'pasillo_completo' => 'Pasillo.nombre || \' - Lado \' || Pasillo.lado'
    	'pasillo_completo' => 'Pasillo.nombre || \' - Lado \' || Pasillo.lado'
    );

	
	var $validate = array(
		'nombre' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lado' => array(
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
			'foreignKey' => 'pasillo_id',
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