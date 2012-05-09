<?php
class UbicadosController extends AppController {
	var $name = 'Ubicados';
	var $components = array('RequestHandler');
	var $helpers = array(
			'Ajax',
			'Paginator',
			'Foto'
	);

	var $paginate = array('Ubicado' => array(
				'limit' => 25,
				'order' => array(
						'Articulo.orden' => 'asc',
						'Ubicado.estado' => 'asc',
				)
		));

	function index() {
	}

	public function get_ubicados() {
		$this -> layout = 'ajax';
		if (!empty($this->data)) {
			$cadena = explode(' ', mb_strtoupper($this->data['Ubicado']['articulo'], 'utf-8'));
			$consulta = "SELECT  id, detalle, unidad, foto, 
							array_agg(pasillo_nombre) AS pasillo_nombre, array_agg(pasillo_lado) AS pasillo_lado, 
							min(pasillo_distancia) AS pasillo_distancia, array_agg(ubicacion_altura) AS ubicacion_altura, 
							array_agg(ubicacion_posicion) AS ubicacion_posicion, array_agg(ubicacion_estado) AS ubicacion_estado 
						FROM (SELECT 	A.id AS id, A.detalle AS detalle, A.unidad AS unidad, A.foto AS foto, A.orden AS orden,
								P.nombre AS pasillo_nombre, P.lado AS pasillo_lado, 
								P.distancia AS pasillo_distancia, Ub.altura AS ubicacion_altura, 
								Ub.posicion AS ubicacion_posicion, U.estado AS ubicacion_estado 
							FROM Articulos AS A LEFT JOIN Ubicados AS U ON U.articulo_id = A.id 
								LEFT JOIN Pasillos AS P ON U.pasillo_id = P.id LEFT JOIN Ubicaciones AS Ub ON U.ubicacion_id = Ub.id
							WHERE 1=1";
			foreach ($cadena as $palabra) {
				$consulta .= "AND A.detalle LIKE '%" . $palabra . "%'";
			}
			$consulta .= "ORDER BY ubicacion_estado DESC
					) AS E
					GROUP BY id, detalle, unidad, foto, orden
					ORDER BY orden ASC";
			$this -> set('ubicados', $this -> Ubicado -> query($consulta));
		}
		$origen = explode('/', $this->referer());
		if($origen[1] == 'admin') {
			# La consulta es la misma, lo que cambia es la vista porque tiene acciones en el admin
			$this -> render('admin_get_ubicados');
		}
	}

	function admin_index() {
		if (!empty($this -> data)) {
			# Acá se redirige a la misma página pero pasando el argumento como parámetro
			# para el paginate
			$this -> redirect(array(
					'action' => 'index',
					$this -> data['Ubicado']['articulo']
			));
		}
		if (!empty($this -> params['pass'])) {
			$cadena = mb_strtoupper($this -> params['pass'][0], 'utf-8');

			$articulos = $this -> Ubicado -> Articulo -> find('list', array('conditions' => array("Articulo.detalle LIKE" => "%" . $cadena . "%")));
			$this -> set('ubicados', $this -> paginate('Ubicado', array('Ubicado.articulo_id' => array_keys($articulos))));
			$this -> set('Ubicado.articulo', $this -> data['Ubicado']['articulo']);
			$this -> render();
		}
		$this -> Ubicado -> recursive = 0;
		$this -> set('ubicados', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid ubicado', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('ubicado', $this -> Ubicado -> read(null, $id));
	}

	function admin_add($articulo_id = null) {
		if (!empty($this -> data)) {
			# se busca la ubicación
			$ubicacion = $this -> Ubicado -> Ubicacion -> find('first', array(
					'fields' => 'Ubicacion.id',
					'conditions' => array(
							'Ubicacion.posicion' => $this -> data['Ubicado']['posicion'],
							'Ubicacion.altura' => $this -> data['Ubicado']['altura']
					)
			));
			# si no existe, se crea
			if (!isset($ubicacion['Ubicacion']['id'])) {
				$data_ubicacion = array(
						'posicion' => $this -> data['Ubicado']['posicion'],
						'altura' => $this -> data['Ubicado']['altura']
				);
				$this -> Ubicado -> Ubicacion -> create($data_ubicacion);
				$this -> Ubicado -> Ubicacion -> save($data_ubicacion);
				$this -> data['Ubicado']['ubicacion_id'] = $this -> Ubicado -> Ubicacion -> id;
			} else {
				$this -> data['Ubicado']['ubicacion_id'] = $ubicacion['Ubicacion']['id'];
			}
			$this -> Ubicado -> create();
			if ($this -> Ubicado -> save($this -> data)) {
				$this -> Session -> setFlash('El artículo ha sido guardado');
				$this -> redirect(array(
						'controller' => 'articulos',
						'action' => 'listar',
						$this -> Session -> read('URL.letra'),
						'page:' . $this -> Session -> read('URL.page')
				));
			} else {
				$this -> Session -> setFlash('Ocurrió un problema y no se ha guardado el artículo.');
			}
		}
		if ($articulo_id) {
			$articulo = $this -> Ubicado -> Articulo -> findById($articulo_id);
			// $ubicaciones = $this->Ubicado->Ubicacion->find('list');
			$pasillos = $this -> Ubicado -> Pasillo -> find('list', array(
					'fields' => array('Pasillo.pasillo_completo'),
					'order' => 'Pasillo.nombre'
			));
			$consulta = 'SELECT DISTINCT posicion
				FROM ubicaciones
				ORDER BY posicion';
			$posiciones_aux = $this -> Ubicado -> Ubicacion -> query($consulta);
			foreach ($posiciones_aux as $key => $value) {
				$valor = $value[0]['posicion'];
				if (substr($valor, 0, 1) == '0') {
					$valor = substr($valor, 1);
				}
				$posiciones[$value[0]['posicion']] = $valor;
			}

			$consulta = 'SELECT DISTINCT altura
				FROM ubicaciones
				ORDER BY altura';
			$alturas_aux = $this -> Ubicado -> Ubicacion -> query($consulta);
			foreach ($alturas_aux as $key => $value) {
				$alturas[$value[0]['altura']] = $value[0]['altura'];
			}

			$this -> set(compact('articulo', 'pasillos', 'posiciones', 'alturas'));

			# Descomentar para la vista mobile
			// $this -> render('mobile/admin_add', 'mobile');
		} else {
			$this -> redirect(array(
					'controller' => 'articulos',
					'action' => 'listar',
					$this -> Session -> read('URL.letra'),
					'page:' . $this -> Session -> read('URL.page')
			));
		}
	}

	function admin_agregar() {
		if (!empty($this -> data['Ubicado'])) {
			$articulos = explode(",", $this -> data['Ubicado']['articulos']);
			# se busca la ubicación
			$ubicacion = $this -> Ubicado -> Ubicacion -> find('first', array(
					'fields' => 'Ubicacion.id',
					'conditions' => array(
							'Ubicacion.posicion' => $this -> data['Ubicado']['posicion'],
							'Ubicacion.altura' => $this -> data['Ubicado']['altura']
					)
			));
			# si no existe, se crea
			if (!isset($ubicacion['Ubicacion']['id'])) {
				$data_ubicacion = array(
						'posicion' => $this -> data['Ubicado']['posicion'],
						'altura' => $this -> data['Ubicado']['altura']
				);
				$this -> Ubicado -> Ubicacion -> create($data_ubicacion);
				$this -> Ubicado -> Ubicacion -> save($data_ubicacion);
				$this -> data['Ubicado']['ubicacion_id'] = $this -> Ubicado -> Ubicacion -> id;
			} else {
				$this -> data['Ubicado']['ubicacion_id'] = $ubicacion['Ubicacion']['id'];
			}
			foreach ($articulos as $key => $id) {
				if ($id) {
					$this -> data['Ubicado']['articulo_id'] = $id;
					$this -> Ubicado -> create();
					$this -> Ubicado -> save($this -> data);
				}
			}
			$this -> Session -> setFlash('Articulos guardados');
			$this -> redirect(array(
					'controller' => 'articulos',
					'action' => 'listar',
					$this -> Session -> read('URL.letra'),
					'page:' . $this -> Session -> read('URL.page')
			));
		}
		if ($this -> data['Articulos']) {
			$articulos = "";
			foreach ($this -> data['Articulos'] as $articulo) {
				if ($articulo['estado']) {
					$articulos .= $articulo['id'] . ",";
				}
			}
			$pasillos = $this -> Ubicado -> Pasillo -> find('list', array(
					'fields' => array('Pasillo.pasillo_completo'),
					'order' => 'Pasillo.nombre'
			));
			$consulta = 'SELECT DISTINCT posicion
				FROM ubicaciones
				ORDER BY posicion';
			$posiciones_aux = $this -> Ubicado -> Ubicacion -> query($consulta);
			foreach ($posiciones_aux as $key => $value) {
				$valor = $value[0]['posicion'];
				if (substr($valor, 0, 1) == '0') {
					$valor = substr($valor, 1);
				}
				$posiciones[$value[0]['posicion']] = $valor;
			}

			$consulta = 'SELECT DISTINCT altura
				FROM ubicaciones
				ORDER BY altura';
			$alturas_aux = $this -> Ubicado -> Ubicacion -> query($consulta);
			foreach ($alturas_aux as $key => $value) {
				$alturas[$value[0]['altura']] = $value[0]['altura'];
			}

			$this -> set(compact('articulos', 'pasillos', 'posiciones', 'alturas'));

			# Descomentar para la vista mobile
			// $this -> render('mobile/admin_agregar', 'mobile');
		} else {
			$this -> redirect(array(
					'controller' => 'articulos',
					'action' => 'listar',
					$this -> Session -> read('URL.letra'),
					'page:' . $this -> Session -> read('URL.page')
			));
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash('Artículo inválido');
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Ubicado -> save($this -> data)) {
				$this -> Session -> setFlash('El artículo ha sido modificado');
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash('Ocurrió un problema y no se ha modificado el artículo.');
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Ubicado -> read(null, $id);
		}
		$pasillos = $this -> Ubicado -> Pasillo -> find('list', array(
				'fields' => array('Pasillo.pasillo_completo'),
				'order' => 'Pasillo.nombre'
		));
		$ubicaciones = $this -> Ubicado -> Ubicacion -> find('list', array(
				'fields' => array('Ubicacion.ubicacion_completo'),
				'order' => array(
						'Ubicacion.posicion',
						'Ubicacion.altura'
				)
		));
		$this -> set(compact('ubicaciones', 'pasillos'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for ubicado', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Ubicado -> delete($id)) {
			$this -> Session -> setFlash(__('Ubicado deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Ubicado was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function update_listado() {
		$this -> layout = 'ajax';
		if (!empty($this -> data)) {
			//$cadena = strtoupper($this -> data['Buscar']['articulo']);
			$cadena = mb_strtoupper($this -> data['Buscar']['articulo'], 'utf-8');

			$articulos = $this -> Ubicado -> Articulo -> find('list', array('conditions' => array("Articulo.detalle LIKE" => "%" . $cadena . "%")));

			$this -> set('ubicados', $this -> paginate('Ubicado', array('Ubicado.articulo_id' => array_keys($articulos))));
			$this -> render("/elements/update_listado");
		}
	}

	function admin_update_listado() {
		$this -> layout = 'ajax';
		if (!empty($this -> data)) {
			$cadena = mb_strtoupper($this -> data['Buscar']['articulo'], 'utf-8');

			$articulos = $this -> Ubicado -> Articulo -> find('list', array('conditions' => array("Articulo.detalle LIKE" => "%" . $cadena . "%")));

			$this -> set('ubicados', $this -> paginate('Ubicado', array('Ubicado.articulo_id' => array_keys($articulos))));
			$this -> render("/elements/admin_update_listado");
		}
	}

	public function actualizar_codigos() {
		$ubicados = $this -> Ubicado -> find('all');

		foreach ($ubicados as $ubicado) {
			$articulo = $this -> Ubicado -> Articulo -> findById($ubicado['Ubicado']['articulo_id']);
			$this -> Ubicado -> id = $ubicado['Ubicado']['id'];
			$this -> Ubicado -> saveField('articulo_id', $articulo['Articulo']['codigo']);

		}
	}

}
?>