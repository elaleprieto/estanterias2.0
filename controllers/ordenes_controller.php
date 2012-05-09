<?php
class OrdenesController extends AppController {
	var $name = 'Ordenes';
	var $components = array('RequestHandler');
	var $helpers = array(
			'Paginator',
			'Form',
			'Time',
			'Ajax',
			'Foto'
	);
	var $paginate = array('Orden' => array(
			//'limit' => 25,
			'recursive' => 3,
			// 'order' => array('Pasillo.distancia' => 'asc', )
		), );

	function index() {
		$this -> Orden -> recursive = 0;
		$this -> set('ordenes', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid orden', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('orden', $this -> Orden -> read(null, $id));
	}

	function add() {
		if (!empty($this -> data)) {
			$this -> Orden -> create();
			if ($this -> Orden -> save($this -> data)) {
				$this -> Session -> setFlash(__('The orden has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The orden could not be saved. Please, try again.', true));
			}
		}
		$clientes = $this -> Orden -> Pedido -> Cliente -> find('list');
		$articulos = $this -> Orden -> Articulo -> find('list');
		$pedidos = $this -> Orden -> Pedido -> find('list');
		$this -> set(compact('clientes', 'articulos', 'pedidos'));
	}

	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid orden', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Orden -> save($this -> data)) {
				$this -> Session -> setFlash(__('The orden has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The orden could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Orden -> read(null, $id);
		}
		$articulos = $this -> Orden -> Articulo -> find('list', array('order' => array('Articulo.detalle' => 'asc', )));
		$pedidos = $this -> Orden -> Pedido -> find('list');
		$this -> set(compact('articulos', 'pedidos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for orden', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Orden -> delete($id)) {
			$this -> Session -> setFlash(__('Orden deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Orden was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function preparar($pedido_id = null) {
		if (isset($this -> params['form']['guardar'])) {
			# si se presionó el botón "Guardar Pedido",
			# se actualizan las Ordenes pero no el estado del Pedido.
			if (!$pedido_id && empty($this -> data)) {
				$this -> Session -> setFlash('Pedido Inválido');
				$this -> redirect(array(
						'controller' => 'pedidos',
						'action' => 'index'
				));
			}
			if (!empty($this -> data)) {
				# Se define el pedido
				$pedido_id = $this -> data['Pedido']['id'];
				
				# Se calcula el tiempo de preparación en segundos.
				$fecha = new DateTime();
				$iniciado = $this -> Orden -> Pedido -> read('iniciado', $pedido_id);
				$iniciado = new DateTime($iniciado['Pedido']['iniciado']);
				$intervalo = $fecha -> diff($iniciado);
				$tiempo_preparacion = $this -> Orden -> Pedido -> read('tiempo_preparacion', $pedido_id);
				$this -> Orden -> Pedido -> id = $pedido_id;
				$this -> Orden -> Pedido -> saveField('tiempo_preparacion', $tiempo_preparacion['Pedido']['tiempo_preparacion'] + $intervalo->format('%d') * 24 * 3600 + $intervalo->format('%h') * 3600 + $intervalo->format('%i') * 60 + $intervalo->format('%s'));

				# Se recorre cada Orden del Pedido y se lo salva.
				# Esto es igual que el Finalizar Pedido.
				foreach ($this->data['Orden'] as $index => $orden) {
					$this -> Orden -> create($orden);
					$this -> Orden -> id = $orden['id'];
					if ($this -> Orden -> saveField('cantidad', $orden['cantidad']) && $this -> Orden -> saveField('estado', $orden['estado'])) {
						$this -> Session -> setFlash('El Pedido ha sido Guardado');
					} else {
						$this -> Session -> setFlash('Se ha producido un error. Por favor, avise al Administrador.');
					}
				}
				$this -> redirect(array(
						'controller' => 'pedidos',
						'action' => 'index'
				));
			}
		} elseif (isset($this -> params['form']['finalizar'])) {
			# si se presionó el botón Finalizar Pedido...
			if (!$pedido_id && empty($this -> data)) {
				$this -> Session -> setFlash('Pedido Inválido');
				$this -> redirect(array(
						'controller' => 'pedidos',
						'action' => 'index'
				));
			}
			if (!empty($this -> data)) {
				# Se define el Pedido
				$pedido_id = $this -> data['Pedido']['id'];
				
				# Se calcula el tiempo de preparación en segundos.
				$pedido_id = $this -> data['Pedido']['id'];
				$fecha = new DateTime();
				$iniciado = $this -> Orden -> Pedido -> read('iniciado', $pedido_id);
				$iniciado = new DateTime($iniciado['Pedido']['iniciado']);
				$intervalo = $fecha -> diff($iniciado);
				$tiempo_preparacion = $this -> Orden -> Pedido -> read('tiempo_preparacion', $pedido_id);
				
				# Se guardan los datos del Pedido
				$this -> Orden -> Pedido -> id = $pedido_id;
				$this -> Orden -> Pedido -> saveField('tiempo_preparacion', $tiempo_preparacion['Pedido']['tiempo_preparacion'] + $intervalo->format('%d') * 24 * 3600 + $intervalo->format('%h') * 3600 + $intervalo->format('%i') * 60 + $intervalo->format('%s'));
				$this -> Orden -> Pedido -> saveField('estado', 1);
				$this -> Orden -> Pedido -> saveField('finalizado', $fecha -> format('Y-m-d H:i:s'));

				# Luego se recorre cada Orden del Pedido y se salvan los campos de cantidad y el estado.
				# Esto es igual que el Guardar Pedido.
				# Además, se resta la cantidad de la Orden del Stock del Artículo
				foreach ($this->data['Orden'] as $index => $orden) {
					$this -> Orden -> create($orden);
					$this -> Orden -> id = $orden['id'];
					if ($this -> Orden -> saveField('estado', $orden['estado'])) {
						if ($orden['estado']) {
							$this -> Orden -> saveField('cantidad', $orden['cantidad']);
						} else {
							$this -> Orden -> saveField('cantidad', 0);
						}
						$this -> Session -> setFlash('El Pedido ha sido Finalizado');
					} else {
						$this -> Session -> setFlash('Se ha producido un error. Por favor, avise al Administrador.');
					}
					$this -> render();
				}
				$this -> redirect(array(
						'controller' => 'pedidos',
						'action' => 'index'
				));
			}
		} elseif (isset($this -> params['form']['salir'])) {
			# si se presionó el botón Cancelar...
			$this -> redirect(array(
					'controller' => 'pedidos',
					'action' => 'index'
			));
		}
		$this -> set('pedido', $this -> Orden -> Pedido -> read(null, $pedido_id));
		$consulta = "SELECT orden_id, posicion, cantidad, cantidad_original, orden_estado, sin_cargo, id, detalle, unidad, foto, observaciones, 
					array_agg(pasillo_nombre) AS pasillo_nombre, array_agg(pasillo_lado) AS pasillo_lado, 
					min(pasillo_distancia) AS pasillo_distancia, array_agg(ubicacion_altura) AS ubicacion_altura, 
					array_agg(ubicacion_posicion) AS ubicacion_posicion, array_agg(ubicacion_estado) AS ubicacion_estado 
				FROM (SELECT O.id AS orden_id, O.cantidad AS cantidad, O.cantidad_original AS cantidad_original, O.estado AS orden_estado, O.sin_cargo AS sin_cargo, O.observaciones AS observaciones, 
						A.id AS id, A.detalle AS detalle, A.unidad AS unidad, A.foto AS foto,
						A.orden AS posicion,
						P.nombre AS pasillo_nombre, P.lado AS pasillo_lado, 
						P.distancia AS pasillo_distancia, Ub.altura AS ubicacion_altura, 
						Ub.posicion AS ubicacion_posicion, U.estado AS ubicacion_estado 
					FROM Ordenes AS O, Articulos AS A LEFT JOIN Ubicados AS U ON U.articulo_id = A.id 
						LEFT JOIN Pasillos AS P ON U.pasillo_id = P.id LEFT JOIN Ubicaciones AS Ub ON U.ubicacion_id = Ub.id
					WHERE O.pedido_id	= $pedido_id
					AND O.articulo_id 	= A.id
					ORDER BY ubicacion_estado DESC
					) AS E
				GROUP BY orden_id, posicion, cantidad, cantidad_original, orden_estado, sin_cargo, id, detalle, unidad, foto, observaciones
				ORDER BY posicion";
		$articulos = $this -> Orden -> query($consulta);
		$this -> set(compact('articulos'));

		# Se define el tiempo de inicialización del pedido
		$fecha = new DateTime();
		$this -> Orden -> Pedido -> id = $pedido_id;
		$this -> Orden -> Pedido -> saveField('iniciado', $fecha -> format('Y-m-d H:i:s'));
		// $this -> layout = 'mobile';
	}

	function finalizadas($pedido_id = null) {
		/*$this -> layout = 'mobile';*/
		if (isset($this -> params['form']['finalizar'])) {
			# si se presionó el botón Finalizar Pedido...
			if (!$pedido_id && empty($this -> data)) {
				$this -> Session -> setFlash('Pedido Inválido');
				$this -> redirect(array(
						'controller' => 'pedidos',
						'action' => 'index'
				));
			}
			if (!empty($this -> data)) {
				debug($this -> data);
				$this -> Orden -> Pedido -> save($this -> data['Pedido']);
				foreach ($this->data['Orden'] as $index => $orden) {
					if ($this -> Orden -> save($orden)) {
						$this -> Session -> setFlash('El Pedido ha sido Finalizado');
					} else {
						$this -> Session -> setFlash('Se ha producido un error. Por favor, avise al Administrador.');
					}
				}
				$this -> redirect(array(
						'controller' => 'pedidos',
						'action' => 'index'
				));
			}
		} elseif (isset($this -> params['form']['cancelar'])) {
			# si se presionó el botón Cancelar...
			$this -> redirect(array(
					'controller' => 'pedidos',
					'action' => 'index'
			));
		}
		$this -> set('pedido', $this -> Orden -> Pedido -> read(null, $pedido_id));
		// $this -> set('articulos', $this -> paginate('Orden', array('Orden.pedido_id' => $pedido_id)));
		// $articulos_id = $this -> Orden -> find('list', array('fields' => 'Orden.articulo_id', 'conditions' => array('Orden.pedido_id' => $pedido_id)));
		// $articulos = $this -> Orden -> Articulo -> Ubicado -> find('all', array('conditions' => array('Articulo.id' => $articulos_id, ), 'order' => 'Pasillo.distancia ASC', 'recursive' => 2,));

		/*$consulta = "SELECT O.id AS orden_id, O.cantidad, O.estado AS orden_estado, A.id, A.detalle, A.unidad, A.foto, P.nombre, P.lado, P.distancia, Ub.altura, Ub.posicion, U.estado AS ubicacion_estado
		 FROM Ordenes AS O, Articulos AS A, Ubicados AS U, Pasillos AS P, Ubicaciones AS Ub
		 WHERE O.pedido_id	= $pedido_id
		 AND O.articulo_id 	= A.id
		 AND U.articulo_id 	= A.id
		 AND U.pasillo_id	= P.id
		 AND U.ubicacion_id	= Ub.id
		 ORDER BY P.distancia
		 ;";
		 *
		 *
		 */

		$consulta = "SELECT O.id AS orden_id, O.cantidad, O.estado AS orden_estado, 
					A.id, A.detalle, A.unidad, A.foto
				FROM Ordenes AS O LEFT JOIN Articulos AS A ON O.articulo_id = A.id 
				WHERE O.pedido_id	= $pedido_id
				ORDER BY O.estado DESC, A.detalle ASC
				;";

		$articulos = $this -> Orden -> query($consulta);

		$this -> set(compact('articulos'));
	}

	function agregar($articulo_id) {
		$this -> layout = 'ajax';
		if (!empty($articulo_id)) {
			debug($articulo_id);
			$articulo = $this -> Orden -> Articulo -> findById($articulo_id);
			$this -> set(compact('articulo'));
			$this -> render("/elements/ordenes_pedido");
		}
	}

	/**
	 * actualizar_estado($orden_id):
	 * actualiza el estado a la orden con el valor pasado como parámetro.
	 */
	public function actualizar_estado($orden_id = null, $estado = null) {
		$this -> layout = 'ajax';
		if ($orden_id && $estado) {
			// $estado = $this -> Orden -> field('estado', "id = $orden_id");
			$this -> Orden -> id = $orden_id;
			$this -> Orden -> saveField('estado', $estado, $validate = false);
		}
	}

	/**
	 * set_cantidad($orden_id, $cantidad):
	 * actualiza la cantidad asignada a la orden con el valor pasado como parámetro.
	 */
	public function set_cantidad($orden_id = null, $cantidad = null) {
		$this -> layout = 'ajax';
		if ($orden_id && $cantidad) {
			$this -> Orden -> id = $orden_id;
			$this -> Orden -> saveField('cantidad', $cantidad, $validate = false);
		}
	}

	/**
	 * faltantes()
	 * Obtiene los Artículos que no fueron enviados porque faltaba mercadería.
	 */
	public function admin_faltantes() {
		$clienteSeleccionado = $articuloSeleccionado = "";
		if (!empty($this -> data)) {
			# Fecha Inicial
			$fechaInicio = new DateTime($this -> data['fechaInicio']['year'] . "-" . $this -> data['fechaInicio']['month'] . "-" . $this -> data['fechaInicio']['day']);
			$fechaInicio = $fechaInicio -> format('Y-m-d');

			# Fecha Final
			$fechaFin = new DateTime($this -> data['fechaFin']['year'] . "-" . $this -> data['fechaFin']['month'] . "-" . $this -> data['fechaFin']['day'] . " 23:59");
			$fechaFin = $fechaFin -> format('Y-m-d H:m');

			$this -> set('fechaInicio', $this -> data['fechaInicio']);
			$this -> set('fechaFin', $this -> data['fechaFin']);

			if ($this -> data['Ordenes']['cliente']) {
				$clienteSeleccionado = 'AND C.id = ' . $this -> data['Ordenes']['cliente'];
			}
			if ($this -> data['Ordenes']['articulo']) {
				$articuloSeleccionado = 'AND A.id = ' . $this -> data['Ordenes']['articulo'];
			}
		} else {
			$fecha = new DateTime();
			$fechaInicio = $fecha -> format('Y-m-d');
			$fechaFin = $fecha -> format('Y-m-d');
		}
		$consulta = "SELECT *
					FROM Ordenes O, Pedidos P, Articulos A, Clientes C
					WHERE O.articulo_id = A.id
					AND O.pedido_id = P.id
					AND P.cliente_id = C.id
					AND P.estado > 0
					AND O.cantidad_original > O.cantidad
					AND P.finalizado BETWEEN '$fechaInicio' AND '$fechaFin'
					$clienteSeleccionado
					$articuloSeleccionado
					ORDER BY P.finalizado ASC, A.detalle ASC, C.nombre ASC;";
		$this -> set('ordenes', $this -> Orden -> query($consulta));
		$this -> set('clientes', $this -> Orden -> Pedido -> Cliente -> find('list', array('order' => 'Cliente.nombre ASC')));
		$this -> set('articulos', $this -> Orden -> Articulo -> find('list', array('order' => 'Articulo.detalle ASC')));
	}
}
?>