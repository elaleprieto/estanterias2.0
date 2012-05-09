<?php
class PedidosController extends AppController {
	var $name = 'Pedidos';
	var $components = array('RequestHandler');
	var $helpers = array(
		'Ajax',
		'Paginator',
		'Time',
		'Foto',
		'Javascript',
		'Js' => array('Jquery')
	);
	
	/* ESTADOS DEL PEDIDO */
	const PENDIENTE = 0;
	const FINALIZADO = 1;
	const CONTROLADO = 2;
	const EMBALADO = 3;
	const FACTURADO = 4;
	const DESPACHADO = 5;

	function index() {
		$this -> Pedido -> recursive = 1;
		$this -> paginate = array('order' => 'Pedido.preparacion_orden DESC');
		$this -> set('pedidos', $this -> paginate('Pedido', array('Pedido.estado' => '0')));
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid pedido', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('pedido', $this -> Pedido -> read(null, $id));
	}

	function admin_index($pedido_id = null) {
		if ($pedido_id) {
			$this -> Pedido -> id = $pedido_id;
			$this -> Pedido -> saveField('estado', 0);
		}
		$this -> paginate = array('order' => 'Pedido.preparacion_orden DESC');
		$this -> Pedido -> recursive = 1;
		$this -> set('pedidos', $this -> paginate('Pedido', array('Pedido.estado' => '0')));
	}

	function admin_finalizados() {
		$this -> Pedido -> recursive = 1;
		$this -> paginate = array('Pedido' => array('order' => array('finalizado' => 'DESC'), ));
		$this -> set('pedidos', $this -> paginate('Pedido', array('Pedido.estado' => self::FINALIZADO)));
	}

	function admin_controlados($pedido_id = null) {
		if ($pedido_id) {
			# Se verifica que el estado del pedido sea "Finalizado", es decir, estado == 1 == self::FINALIZADO
			# Si no, no se cambia el estado del Pedido.
			# Además, se verifica que la petición provenga de la acción Finalizados del controller Pedidos.
			# Esto debería evitar errores.
			$estado = $this -> Pedido -> read('estado', $pedido_id);
			if ($estado['Pedido']['estado'] == self::FINALIZADO && strpos($this -> referer(), 'pedidos') && strpos($this -> referer(), 'finalizados')) {
				# Se calcula el tiempo de Control en segundos.
				$fecha = new DateTime();
				$finalizado = $this -> Pedido -> read('finalizado', $pedido_id);
				$finalizado = new DateTime($finalizado['Pedido']['finalizado']);
				$intervalo = $fecha -> diff($finalizado);
				$tiempo_control = $this -> Pedido -> read('tiempo_control', $pedido_id);

				# Se guardan los datos del Pedido
				$this -> Pedido -> id = $pedido_id;
				$this -> Pedido -> saveField('estado', self::CONTROLADO);
				$this -> Pedido -> saveField('controlado', $fecha -> format('Y-m-d H:i:s'));
				$this -> Pedido -> saveField('tiempo_control', $tiempo_control['Pedido']['tiempo_control'] + $intervalo -> format('%d') * 24 * 3600 + $intervalo -> format('%h') * 3600 + $intervalo -> format('%i') * 60 + $intervalo -> format('%s'));

				# Se actualiza el Stock
				$ordenes = $this -> Pedido -> Orden -> find('list', array(
					'conditions' => array(
						'Orden.pedido_id' => $pedido_id,
						'Orden.estado' => TRUE
					),
					'fields' => array(
						'Orden.articulo_id',
						'Orden.cantidad',
					)
				));
				foreach ($ordenes as $articulo_id => $cantidad) {
					$this -> loadModel('Articulo');
					$this -> Articulo -> recursive = 0;
					$stock = $this -> Articulo -> read('stock', $articulo_id);
					$this -> Articulo -> id = $articulo_id;
					$this -> Articulo -> saveField('stock', $stock['Articulo']['stock'] - $cantidad);
				}

				$this -> admin_correo_faltantes($pedido_id);
			}
		}
		$this -> Pedido -> recursive = 1;
		$this -> paginate = array('Pedido' => array('order' => array('finalizado' => 'DESC'), ));
		$this -> set('pedidos', $this -> paginate('Pedido', array('Pedido.estado' => self::CONTROLADO)));
	}


	function admin_embalados($pedido_id = null) {
		if ($pedido_id) {
			# Se verifica que el estado del pedido sea "Controlado", es decir, estado == 2 == self::CONTROLADO
			# Si no, no se cambia el estado del Pedido.
			# Además, se verifica que la petición provenga de la acción Controlados del controller Pedidos.
			# Esto debería evitar errores.
			$estado = $this -> Pedido -> read('estado', $pedido_id);
			if ($estado['Pedido']['estado'] == self::CONTROLADO && strpos($this -> referer(), 'pedidos') && strpos($this -> referer(), 'controlados')) {
				# Se calcula el tiempo de Facturación en segundos.
				$fecha = new DateTime();
				$controlado = $this -> Pedido -> read('controlado', $pedido_id);
				$controlado = new DateTime($controlado['Pedido']['controlado']);
				$intervalo = $fecha -> diff($controlado);
				$tiempo_embalado = $this -> Pedido -> read('tiempo_embalado', $pedido_id);

				# Se guardan los datos del Pedido
				$this -> Pedido -> id = $pedido_id;
				$this -> Pedido -> saveField('estado', self::EMBALADO);
				$this -> Pedido -> saveField('embalado', $fecha -> format('Y-m-d H:i:s'));
				$this -> Pedido -> saveField('tiempo_embalado', $tiempo_embalado['Pedido']['tiempo_embalado'] + $intervalo -> format('%d') * 24 * 3600 + $intervalo -> format('%h') * 3600 + $intervalo -> format('%i') * 60 + $intervalo -> format('%s'));
			}
		}
		$this -> Pedido -> recursive = 1;
		$this -> paginate = array('Pedido' => array('order' => array('finalizado' => 'DESC'), ));
		$this -> set('pedidos', $this -> paginate('Pedido', array('Pedido.estado' => self::EMBALADO)));
	}
	
	function admin_facturados($pedido_id = null) {
		if ($pedido_id) {
			# Se verifica que el estado del pedido sea "Embalado", es decir, estado == 3 == self::EMBALADO
			# Si no, no se cambia el estado del Pedido.
			# Además, se verifica que la petición provenga de la acción Embalados del controller Pedidos.
			# Esto debería evitar errores.
			$estado = $this -> Pedido -> read('estado', $pedido_id);
			if ($estado['Pedido']['estado'] == self::EMBALADO && strpos($this -> referer(), 'pedidos') && strpos($this -> referer(), 'embalados')) {
				# Se calcula el tiempo de Facturación en segundos.
				$fecha = new DateTime();
				$embalado = $this -> Pedido -> read('embalado', $pedido_id);
				$embalado = new DateTime($embalado['Pedido']['embalado']);
				$intervalo = $fecha -> diff($embalado);
				$tiempo_facturacion = $this -> Pedido -> read('tiempo_facturacion', $pedido_id);

				# Se guardan los datos del Pedido
				$this -> Pedido -> id = $pedido_id;
				$this -> Pedido -> saveField('estado', self::FACTURADO);
				$this -> Pedido -> saveField('facturado', $fecha -> format('Y-m-d H:i:s'));
				$this -> Pedido -> saveField('tiempo_facturacion', $tiempo_facturacion['Pedido']['tiempo_facturacion'] + $intervalo -> format('%d') * 24 * 3600 + $intervalo -> format('%h') * 3600 + $intervalo -> format('%i') * 60 + $intervalo -> format('%s'));
			}
		}
		$this -> Pedido -> recursive = 1;
		$this -> paginate = array('Pedido' => array('order' => array('finalizado' => 'DESC'), ));
		$this -> set('pedidos', $this -> paginate('Pedido', array('Pedido.estado' => self::FACTURADO)));
	}

	function admin_despachados($pedido_id = null) {
		if ($pedido_id) {
			# Se verifica que el estado del pedido sea "Facturado", es decir, estado == 4 == self::FACTURADO
			# Si no, no se cambia el estado del Pedido.
			# Además, se verifica que la petición provenga de la acción Facturados del controller Pedidos.
			# Esto debería evitar errores.
			$estado = $this -> Pedido -> read('estado', $pedido_id);
			if ($estado['Pedido']['estado'] == self::FACTURADO && strpos($this -> referer(), 'pedidos') && strpos($this -> referer(), 'facturados')) {
				# Se calcula el tiempo de Despacho en segundos.
				$fecha = new DateTime();
				$facturado = $this -> Pedido -> read('facturado', $pedido_id);
				$facturado = new DateTime($facturado['Pedido']['facturado']);
				$intervalo = $fecha -> diff($facturado);
				$tiempo_despacho = $this -> Pedido -> read('tiempo_despacho', $pedido_id);

				# Se guardan los datos del Pedido
				$this -> Pedido -> id = $pedido_id;
				$this -> Pedido -> saveField('estado', self::DESPACHADO);
				$this -> Pedido -> saveField('despachado', $fecha -> format('Y-m-d H:i:s'));
				$this -> Pedido -> saveField('tiempo_despacho', $tiempo_despacho['Pedido']['tiempo_despacho'] + $intervalo -> format('%d') * 24 * 3600 + $intervalo -> format('%h') * 3600 + $intervalo -> format('%i') * 60 + $intervalo -> format('%s'));
			}
		}
		$this -> Pedido -> recursive = 1;
		$this -> paginate = array('Pedido' => array('order' => array('finalizado' => 'DESC'), ));
		$this -> set('pedidos', $this -> paginate('Pedido', array('Pedido.estado' => self::DESPACHADO)));
	}

	function admin_add() {
		if (!empty($this -> data) && isset($this -> data['Orden'])) {
			$this -> Pedido -> create();
			if ($this -> Pedido -> save($this -> data)) {
				# actualizo los datos del Cliente
				$this -> Pedido -> Cliente -> id = $this -> data['Pedido']['cliente_id'];
				if (isset($this -> data['Pedido']['transporte_id'])) {
					$this -> Pedido -> Cliente -> saveField('transporte_id', $this -> data['Pedido']['transporte_id']);
				} else {
					$this -> Pedido -> Cliente -> saveField('transporte_id', 0);
				}
				if (isset($this -> data['Pedido']['contrarrembolso'])) {
					$this -> Pedido -> Cliente -> saveField('contrarrembolso', $this -> data['Pedido']['contrarrembolso']);
				} else {
					$this -> Pedido -> Cliente -> saveField('contrarrembolso', FALSE);
				}
				if (isset($this -> data['Pedido']['cobinpro'])) {
					$this -> Pedido -> Cliente -> saveField('cobinpro', $this -> data['Pedido']['cobinpro']);
				} else {
					$this -> Pedido -> Cliente -> saveField('cobinpro', FALSE);
				}
				if (isset($this -> data['Pedido']['prioridad'])) {
					$this -> Pedido -> Cliente -> saveField('presupuesto', $this -> data['Pedido']['prioridad']);
				} else {
					$this -> Pedido -> Cliente -> saveField('presupuesto', 0);
				}
				# inserto las ordenes
				foreach ($this -> data['Orden'] as $orden) {
					$this -> Pedido -> Orden -> create();
					$this -> Pedido -> Orden -> set(array(
						'articulo_id' => $orden['id'],
						'cantidad' => $orden['Cantidad'],
						'cantidad_original' => $orden['Cantidad'],
						'sin_cargo' => $orden['SinCargo'],
						'observaciones' => $orden['Observaciones'],
						'pedido_id' => $this -> Pedido -> id,
					));
					$this -> Pedido -> Orden -> save();
				}
				$this -> Session -> setFlash('El pedido ha sido creado');
				$this -> redirect(array('action' => 'index', ));
			} else {
				$this -> Session -> setFlash('El pedido no se ha guardado, intente nuevamente.');
			}
		}
		$condicionesArticulo = array(
			'OR' => array('NOT' => array('OR' => array(
						array("Articulo.detalle LIKE" => "FAROL%"),
						array("Articulo.detalle LIKE" => "BULONES%")
					))),
			array("Articulo.precio >" => "0")
		);
		$articulos = $this -> Pedido -> Orden -> Articulo -> find('list', array(
			'conditions' => $condicionesArticulo,
			'order' => array('Articulo.orden')
		));
		$clientes = $this -> Pedido -> Cliente -> find('list', array('order' => array('Cliente.nombre')));
		$transportes = $this -> Pedido -> Transporte -> find('list', array('order' => array('Transporte.nombre')));
		$this -> set(compact('clientes', 'articulos', 'transportes'));
	}

	function mostrador_index() {
		$this -> redirect(array('action' => 'add'));
	}
	
	function mostrador_add() {
		if (!empty($this -> data) && isset($this -> data['Orden'])) {
			$this -> Pedido -> create();
			if ($this -> Pedido -> save($this -> data)) {
				# actualizo los datos del Cliente
				$this -> Pedido -> Cliente -> id = $this -> data['Pedido']['cliente_id'];
				if (isset($this -> data['Pedido']['transporte_id'])) {
					$this -> Pedido -> Cliente -> saveField('transporte_id', $this -> data['Pedido']['transporte_id']);
				} else {
					$this -> Pedido -> Cliente -> saveField('transporte_id', 0);
				}
				if (isset($this -> data['Pedido']['contrarrembolso'])) {
					$this -> Pedido -> Cliente -> saveField('contrarrembolso', $this -> data['Pedido']['contrarrembolso']);
				} else {
					$this -> Pedido -> Cliente -> saveField('contrarrembolso', FALSE);
				}
				if (isset($this -> data['Pedido']['cobinpro'])) {
					$this -> Pedido -> Cliente -> saveField('cobinpro', $this -> data['Pedido']['cobinpro']);
				} else {
					$this -> Pedido -> Cliente -> saveField('cobinpro', FALSE);
				}
				if (isset($this -> data['Pedido']['prioridad'])) {
					$this -> Pedido -> Cliente -> saveField('prioridad', $this -> data['Pedido']['prioridad']);
				} else {
					$this -> Pedido -> Cliente -> saveField('prioridad', 0);
				}
				# inserto las ordenes
				foreach ($this -> data['Orden'] as $orden) {
					$this -> Pedido -> Orden -> create();
					$this -> Pedido -> Orden -> set(array(
						'articulo_id' => $orden['id'],
						'cantidad' => $orden['Cantidad'],
						'cantidad_original' => $orden['Cantidad'],
						'sin_cargo' => $orden['SinCargo'],
						'observaciones' => $orden['Observaciones'],
						'pedido_id' => $this -> Pedido -> id,
					));
					$this -> Pedido -> Orden -> save();
				}
				$this -> Session -> setFlash('El pedido ha sido creado');
				$this -> redirect(array('action' => 'index', ));
			} else {
				$this -> Session -> setFlash('El pedido no se ha guardado, intente nuevamente.');
			}
		}
		$condicionesArticulo = array(
			'OR' => array('NOT' => array('OR' => array(
						array("Articulo.detalle LIKE" => "FAROL%"),
						array("Articulo.detalle LIKE" => "BULONES%")
					))),
			array("Articulo.precio >" => "0")
		);
		$articulos = $this -> Pedido -> Orden -> Articulo -> find('list', array(
			'conditions' => $condicionesArticulo,
			'order' => array('Articulo.orden')
		));
		$clientes = $this -> Pedido -> Cliente -> find('list', array('order' => array('Cliente.nombre')));
		$transportes = $this -> Pedido -> Transporte -> find('list', array('order' => array('Transporte.nombre')));
		$this -> set(compact('clientes', 'articulos', 'transportes'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid pedido', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if (!isset($this -> data['Pedido']['prioridad'])) {$this -> data['Pedido']['prioridad'] = 0;
			}
			if (!isset($this -> data['Pedido']['cobinpro'])) {$this -> data['Pedido']['cobinpro'] = FALSE;
			}
			if (!isset($this -> data['Pedido']['contrarrembolso'])) {$this -> data['Pedido']['contrarrembolso'] = FALSE;
			}
			if ($this -> Pedido -> save($this -> data)) {
				# actualizo los datos del Cliente
				$this -> Pedido -> Cliente -> id = $this -> data['Pedido']['cliente_id'];
				if (isset($this -> data['Pedido']['transporte_id'])) {
					$this -> Pedido -> Cliente -> saveField('transporte_id', $this -> data['Pedido']['transporte_id']);
				} else {
					$this -> Pedido -> Cliente -> saveField('transporte_id', 0);
				}
				if (isset($this -> data['Pedido']['contrarrembolso'])) {
					$this -> Pedido -> Cliente -> saveField('contrarrembolso', $this -> data['Pedido']['contrarrembolso']);
				} else {
					$this -> Pedido -> Cliente -> saveField('contrarrembolso', FALSE);
				}
				if (isset($this -> data['Pedido']['cobinpro'])) {
					$this -> Pedido -> Cliente -> saveField('cobinpro', $this -> data['Pedido']['cobinpro']);
				} else {
					$this -> Pedido -> Cliente -> saveField('cobinpro', FALSE);
				}
				if (isset($this -> data['Pedido']['prioridad'])) {
					$this -> Pedido -> Cliente -> saveField('prioridad', $this -> data['Pedido']['prioridad']);
				} else {
					$this -> Pedido -> Cliente -> saveField('prioridad', 0);
				}

				# Me traigo todas las ordenes que tienen el id del pedido que se está modificando
				$ordenes = $this -> Pedido -> Orden -> findAllByPedidoId($id);
				$nuevas = $this -> data['Orden'];

				# Actualizo las que está creadas
				foreach ($ordenes as $orden) {
					$existe = FALSE;
					foreach ($nuevas as $index => $datos) {
						// debug($index);
						# verificación de variables
						if (!isset($datos['estado'])) {$datos['estado'] = FALSE;
						}
						if (!isset($datos['SinCargo'])) {$datos['SinCargo'] = FALSE;
						}
						if (!isset($datos['Observaciones'])) {$datos['Observaciones'] = "";
						}
						if ($orden['Orden']['articulo_id'] == $datos['id'] && $orden['Orden']['sin_cargo'] == $datos['SinCargo']) {
							$this -> Pedido -> Orden -> id = $orden['Orden']['id'];
							$this -> Pedido -> Orden -> saveField('cantidad', $datos['Cantidad']);
							$this -> Pedido -> Orden -> saveField('estado', $datos['estado']);
							$this -> Pedido -> Orden -> saveField('observaciones', $datos['Observaciones']);
							$existe = TRUE;
						}
					}
					# Se eliminan las ordenes que no existan en las ordenes que vienen nuevas.
					if (!$existe)
						$this -> Pedido -> Orden -> delete($orden['Orden']['id']);
				}

				# Se crean las órdenes que no fueron actualizadas porque no existían
				foreach ($nuevas as $index => $datos) {
					# verificación de variables
					if (!isset($datos['estado'])) {$datos['estado'] = FALSE;
					}
					$existe = $this -> Pedido -> Orden -> find('list', array('conditions' => array(
							'Orden.articulo_id' => $datos['id'],
							'Orden.estado' => $datos['estado'],
							'Orden.pedido_id' => $this -> Pedido -> id
						)));

					if (!$existe) {
						$this -> Pedido -> Orden -> create();

						# verificación de variables
						if (!isset($datos['SinCargo'])) {$datos['SinCargo'] = FALSE;
						}
						if (!isset($datos['Observaciones'])) {$datos['Observaciones'] = "";
						}

						$this -> Pedido -> Orden -> set(array(
							'articulo_id' => $datos['id'],
							'cantidad' => $datos['Cantidad'],
							'cantidad_original' => $datos['Cantidad'],
							'estado' => $datos['estado'],
							'sin_cargo' => $datos['SinCargo'],
							'observaciones' => $datos['Observaciones'],
							'pedido_id' => $this -> Pedido -> id,
						));
						$this -> Pedido -> Orden -> save();
					}
				}
				# Se vuelva a la página anterior
				$this -> redirect($this -> Session -> read('URL.redirect'));
			} else {
				$this -> Session -> setFlash(__('The pedido could not be saved. Please, try again.', true));
			}
		}
		$this -> data = $this -> Pedido -> read(null, $id);
		$condicionesArticulo = array(
			'OR' => array('NOT' => array('OR' => array(
						array("Articulo.detalle LIKE" => "FAROL%"),
						array("Articulo.detalle LIKE" => "BULONES%")
					))),
			array("Articulo.precio >" => "0")
		);
		$articulos = $this -> Pedido -> Orden -> Articulo -> find('list', array(
			'conditions' => $condicionesArticulo,
			'order' => array('Articulo.orden')
		));
		$clientes = $this -> Pedido -> Cliente -> find('list');
		$ordenes = $this -> Pedido -> Orden -> find('all', array(
			'conditions' => array('pedido_id' => $id),
			'order' => array('Articulo.orden')
		));
		$transportes = $this -> Pedido -> Transporte -> find('list', array('order' => array('Transporte.nombre')));
		$this -> set(compact('clientes', 'articulos', 'ordenes', 'transportes'));

		# Se guarda la página desde donde se viene para después de editar el Pedido, retornar a ella.
		$this -> Session -> write('URL.redirect', $this -> referer());
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash('Pedido inválido');
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Pedido -> delete($id)) {
			# Lo que se hace acá es eliminar todas las ordenes que tenía el pedido

			# Me traigo todas las ordenes que tienen el id del pedido que se está eliminando
			$ordenes = $this -> Pedido -> Orden -> findAllByPedidoId($id);
			# Elimino todas las órdenes que busqué
			foreach ($ordenes as $orden) {
				$this -> Pedido -> Orden -> delete($orden['Orden']['id']);
			}

			$this -> Session -> setFlash('El pedido fue eliminado');
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash('Ocurrió un error. El pedido no fue eliminado.');
		$this -> redirect(array('action' => 'index'));
	}

	function autocomplete() {
		# La cadena buscada en el campo autocomplete va a venir en
		# $this -> data['Pedido']['articulo']
		# con Jquery parece que viene en $this->params['url']['q']
		// $articulo = strtoupper($this -> data['Pedido']['articulo']);
		$articulo = strtoupper($this -> params['url']['q']);
		$this -> set('articulos', $this -> Pedido -> Orden -> Articulo -> find('all', array(
			'conditions' => array('Articulo.detalle LIKE' => '%' . $articulo . '%'),
			'fields' => array(
				'detalle',
				'id'
			),
			'order' => 'orden',
		)));
		$this -> layout = 'ajax';
	}

	function admin_imprimir($id = null) {
		if (!$id) {
			$this -> Session -> setFlash('Pedido inválido');
			return $this -> redirect(array('action' => 'index'));
		}
		$pedido = $this -> Pedido -> findById($id);
		# Se verifica la existencia del Pedido
		if(isset($pedido['Pedido'])) {
			$consulta = "SELECT orden_id, posicion, cantidad, cantidad_original, orden_estado, sin_cargo, id, detalle, unidad, foto, stock, observaciones, 
						array_agg(pasillo_nombre) AS pasillo_nombre, array_agg(pasillo_lado) AS pasillo_lado, 
						min(pasillo_distancia) AS pasillo_distancia, array_agg(ubicacion_altura) AS ubicacion_altura, 
						array_agg(ubicacion_posicion) AS ubicacion_posicion, array_agg(ubicacion_estado) AS ubicacion_estado 
					FROM (SELECT O.id AS orden_id, O.cantidad AS cantidad, O.cantidad_original AS cantidad_original, O.estado AS orden_estado, O.sin_cargo AS sin_cargo, O.observaciones AS observaciones, 
							A.id AS id, A.detalle AS detalle, A.unidad AS unidad, A.foto AS foto,
							A.orden AS posicion, A.stock AS stock,
							P.nombre AS pasillo_nombre, P.lado AS pasillo_lado, 
							P.distancia AS pasillo_distancia, Ub.altura AS ubicacion_altura, 
							Ub.posicion AS ubicacion_posicion, U.estado AS ubicacion_estado 
						FROM Ordenes AS O, Articulos AS A LEFT JOIN Ubicados AS U ON U.articulo_id = A.id 
							LEFT JOIN Pasillos AS P ON U.pasillo_id = P.id LEFT JOIN Ubicaciones AS Ub ON U.ubicacion_id = Ub.id
						WHERE O.pedido_id	= $id
						AND O.articulo_id 	= A.id
						ORDER BY ubicacion_estado DESC
						) AS E
					GROUP BY orden_id, posicion, cantidad, cantidad_original, orden_estado, sin_cargo, id, detalle, unidad, foto, stock, observaciones
					ORDER BY posicion";
			$ordenes = $this -> Pedido -> Orden -> query($consulta);
	
			$this -> set(compact('pedido', 'ordenes'));
			$this -> layout = 'ajax';
		} else {
			$this -> Session -> setFlash('Pedido no válido');
			return $this -> redirect(array('action' => 'index'));
		}
	}

	/**
	 * admin_actualizar: la idea de esta función es levantar el archivo AUXFACTU.DBF
	 * luego, se levantan las ordenes que pertenecen al pedido.
	 * Las ordenes del pedido están en el archivo: FACTURAS.DBF
	 */
	public function admin_actualizar() {
		if (!empty($this -> data)) {
			$aux = 'pedidos_aux.csv';
			$facturas = 'pedidos_facturas.csv';
			$uploadDir = TMP . 'uploads' . DS . 'pedido';
			$uploadAux = $uploadDir . DS . $aux;
			$uploadFacturas = $uploadDir . DS . $facturas;

			if (move_uploaded_file($this -> data['Pedido']['aux']['tmp_name'], $uploadAux) && move_uploaded_file($this -> data['Pedido']['facturas']['tmp_name'], $uploadFacturas)) {

				# se abren los archivos
				$pedidos = fopen($uploadAux, "r") or die('Error al abrir el archivo ' . $uploadAux);
				$ordenes = fopen($uploadFacturas, "r") or die('Error al abrir el archivo ' . $uploadFacturas);

				# se lee la 1° columna como encabezados
				$headerPedidos = fgetcsv($pedidos);
				$headerOrdenes = fgetcsv($ordenes);

				# se lee cada fila del archivo AUXFACTU.DBF y se crean o actualizan los pedidos
				while (($fila = fgetcsv($pedidos, 0, ";")) !== FALSE) {
					$data = array();

					$data['Pedido']['id'] = (integer) trim($fila[1]);
					$fecha = DateTime::createFromFormat('d/m/Y', trim($fila[2]));
					$data['Pedido']['created'] = $fecha -> format('Y-m-d H:i:s');
					$data['Pedido']['cliente_id'] = (integer) trim($fila[3]);
					$data['Pedido']['estado'] = 4;

					if ($data['Pedido']['cliente_id'] >= 1) {
						$this -> Pedido -> create($data);
						$this -> Pedido -> save($data);
					}
				}

				# se lee cada fila del archivo FACTURAS.DBF y se crean o actualizan las ordenes
				while (($fila = fgetcsv($ordenes, 0, ";")) !== FALSE) {
					$data = array();

					$data['Orden']['pedido_id'] = (integer) trim($fila[1]);
					$data['Orden']['articulo_id'] = (integer) trim($fila[2]);
					$data['Orden']['cantidad'] = (float) trim($fila[3]);
					$data['Orden']['estado'] = TRUE;

					if (($data['Orden']['pedido_id'] >= 1) && ($data['Orden']['articulo_id'] >= 1) && ($data['Orden']['cantidad'] > 0)) {
						$this -> Pedido -> Orden -> create($data);
						$this -> Pedido -> Orden -> save($data);
					}
				}

				fclose($pedidos);
				fclose($ordenes);
			} else {
				$this -> Session -> setFlash("Ocurrió un problema subiendo el archivo.");
			}
		}
	}

	/**
	 * admin_correo_faltantes($id): recorre el Pedido pasado como parámetro y arma un correo para informarlo al destinatario.
	 * @param id: el Pedido buscado.
	 */
	public function admin_correo_faltantes($id = null) {
		if (!$id) {
			$this -> Session -> setFlash('Pedido inválido');
			$this -> redirect(array('action' => 'index'));
		}
		App::import('Lib', 'phpMailer', array('file' => 'phpMailer' . DS . 'class.phpmailer.php'));
		App::import('Lib', 'phpMailer', array('file' => 'phpMailer' . DS . 'class.smtp.php'));
		App::import('Lib', 'contras', array('file' => 'contras' . DS . 'pedidos.correo.php'));

		$pedido = $this -> Pedido -> read('cliente_nombre', $id);

		# Se buscan las órdenes que no se enviaron por falta de Stock
		$ordenes_sin_stock = $this -> Pedido -> Orden -> find('all', array(
			'conditions' => array(
				'Orden.pedido_id' => $id,
				'Orden.estado' => FALSE
			),
			'fields' => array(
				'Orden.articulo_id',
				'Orden.articulo_detalle',
				'Orden.cantidad',
				'Orden.cantidad_original',
			),
			'recursive' => 0
		));

		# Se buscan las órdenes que fueron enviadas pero en una Cantidad menor a la pedida (posiblemente por falta de Stock)
		$ordenes_menores = $this -> Pedido -> Orden -> find('all', array(
			'conditions' => array(
				'Orden.pedido_id' => $id,
				'Orden.estado' => TRUE,
				'Orden.cantidad_original > Orden.cantidad'
			),
			'fields' => array(
				'Orden.articulo_id',
				'Orden.articulo_detalle',
				'Orden.cantidad',
				'Orden.cantidad_original',
			),
			'recursive' => 0
		));

		# Se verifique que no se envíe un correo vacío
		if ((sizeof($ordenes_menores) > 0) || (sizeof($ordenes_sin_stock) > 0)) {
			$body = $bodyAlt = '';
			$estilo_cabeceras = 'style="border-bottom: 2px solid black;"';

			if (sizeof($ordenes_sin_stock) > 0) {
				$body = "<p><b>Artículos No Enviados por Falta de Stock: </b></p>";
				$bodyAlt = 'Artículos No Enviados por Falta de Stock';
				$body .= "<br /><br />";
				$bodyAlt .= '\n\n';
				$body .= '<table>';
				$body .= '<tr>';
				$body .= "<th $estilo_cabeceras>Código</th>";
				$body .= "<th $estilo_cabeceras>Detalle</th>";
				$body .= "<th $estilo_cabeceras>Cantidad Pedida</th>";
				$bodyAlt .= 'Código | Detalle | Cantidad Pedida\n';
				$body .= '</tr>';
				foreach ($ordenes_sin_stock as $orden) {
					$body .= '<tr>';
					$body .= '<td style="text-align: center;">' . $orden['Orden']['articulo_id'] . '</td>';
					$body .= '<td>' . $orden['Orden']['articulo_detalle'] . '</td>';
					$body .= '<td style="text-align: center;">' . $orden['Orden']['cantidad_original'] . '</td>';
					$body .= '</tr>';
					$bodyAlt .= $orden['Orden']['articulo_id'] . $orden['Orden']['articulo_detalle'] . $orden['Orden']['cantidad_original'] . '\n';
				}
				$body .= '</table>';
			}
			if (sizeof($ordenes_menores) > 0) {
				if (sizeof($ordenes_sin_stock) > 0) {
					# Si ya se escribió en el correo, se traza un línea
					$body .= '<br /><br />';
					$bodyAlt .= '\n\n\n';
				}
				$body .= "<p><b>Artículos Enviados pero en una Cantidad menor a la pedida (posiblemente por falta de Stock): </b></p>";
				$bodyAlt .= 'Artículos Enviados pero en una Cantidad menor a la pedida (posiblemente por falta de Stock): ';
				$body .= "<br /><br />";
				$bodyAlt .= '\n\n';
				$body .= '<table>';
				$body .= '<tr>';
				$body .= "<th $estilo_cabeceras>Código</th>";
				$body .= "<th $estilo_cabeceras>Detalle</th>";
				$body .= "<th $estilo_cabeceras>Cantidad Enviada</th>";
				$body .= "<th $estilo_cabeceras>Cantidad Pedida</th>";
				$bodyAlt .= 'Código | Detalle | Cantidad Enviada | Cantidad Pedida\n';
				$body .= '</tr>';
				foreach ($ordenes_menores as $orden) {
					$body .= '<tr>';
					$body .= '<td style="text-align: center;">' . $orden['Orden']['articulo_id'] . '</td>';
					$body .= '<td>' . $orden['Orden']['articulo_detalle'] . '</td>';
					$body .= '<td style="text-align: center;">' . $orden['Orden']['cantidad'] . '</td>';
					$body .= '<td style="text-align: center;">' . $orden['Orden']['cantidad_original'] . '</td>';
					$body .= '</tr>';
					$bodyAlt .= $orden['Orden']['articulo_id'] . $orden['Orden']['articulo_detalle'] . $orden['Orden']['cantidad'] . $orden['Orden']['cantidad_original'] . '\n';
				}
				$body .= '</table>';
			}

			$mail = new PHPMailer();

			# la dirección del servidor, p. ej.: smtp.servidor.com
			# con SSL habilitado, el puerto 465 y demás opciones para Gmail
			$mail -> Host = "smtp.googlemail.com";
			$mail -> SMTPSecure = "ssl";
			$mail -> Port = '465';
			$mail -> SMTPKeepAlive = true;
			$mail -> Mailer = "smtp";
			$mail -> CharSet = 'utf-8';
			$mail -> IsSMTP();

			# dirección remitente, p. ej.: no-responder@miempresa.com
			$mail -> From = "general@elefe.com.ar";

			# nombre remitente, p. ej.: "Servicio de envío automático"
			$mail -> FromName = "ELEFE - Artículos Faltantes";

			# asunto
			$mail -> Subject = 'Pedido de ' . $pedido['Pedido']['cliente_nombre'];

			# si el cuerpo del mensaje es HTML
			$mail -> isHTML(TRUE);
			$mail -> MsgHTML($body);

			# cuerpo alternativo del mensaje
			$mail -> AltBody = $bodyAlt;

			# podemos hacer varios AddAdress
			$mail -> AddAddress("compras@elefe.com.ar", "Hector Prieto");

			# si el SMTP necesita autenticación
			$mail -> SMTPAuth = true;

			# credenciales usuario
			$mail -> Username = USUARIO_GENERAL;
			$mail -> Password = CONTRASENIA_GENERAL;
			$mail -> Send();
		}
	}

	public function mail() {
		App::import('Lib', 'phpMailer', array('file' => 'phpMailer' . DS . 'class.phpmailer.php'));
		App::import('Lib', 'phpMailer', array('file' => 'phpMailer' . DS . 'class.smtp.php'));
		App::import('Lib', 'contras', array('file' => 'contras' . DS . 'pedidos.correo.php'));

		$mail = new PHPMailer();

		# la dirección del servidor, p. ej.: smtp.servidor.com
		# con SSL habilitado, el puerto 465 y demás opciones para Gmail
		$mail -> Host = "smtp.googlemail.com";
		$mail -> SMTPSecure = "ssl";
		// $mail -> SMTPSecure = "tls";
		// $mail -> Port = '465';
		$mail -> Port = '465';
		$mail -> SMTPKeepAlive = true;
		$mail -> Mailer = "SMTP";
		$mail -> CharSet = 'utf-8';
		$mail -> IsSMTP(TRUE);
		// $mail -> IsMail(TRUE);
		$mail -> Timeout = 30;

		# dirección remitente, p. ej.: no-responder@miempresa.com
		$mail -> From = "general@elefe.com.ar";

		# nombre remitente, p. ej.: "Servicio de envío automático"
		$mail -> FromName = "ELEFE - Artículos Faltantes";

		# asunto
		$mail -> Subject = 'Pedido de ';

		# si el cuerpo del mensaje es HTML
		$mail -> isHTML(TRUE);
		$mail -> MsgHTML('hola');

		# cuerpo alternativo del mensaje
		$mail -> AltBody = 'hola';

		# podemos hacer varios AddAdress
		$mail -> AddAddress("aleprieto@gmail.com", "Alejandro Prieto");

		# si el SMTP necesita autenticación
		$mail -> SMTPAuth = true;

		# credenciales usuario
		$mail -> Username = USUARIO_GENERAL;
		$mail -> Password = CONTRASENIA_GENERAL;
		$mail -> SMTPDebug = 1;
		echo $mail -> Send();
		echo $mail -> ErrorInfo;
	}

	function admin_set_orden($id = null, $preparacionOrden = null) {
		if ($id && $preparacionOrden) {
			$this -> Pedido -> id = $id;
			$this -> Pedido -> saveField('preparacion_orden', $preparacionOrden);
		}
		$this -> layout = 'ajax';
	}

	function embalar($id = null) {
		if ($id) {
			$this -> set('pedido', $this -> Pedido -> read(null, $id));
			$this -> set('bultos', $this -> Pedido -> Orden -> Bulto -> find('list'));
			$this -> render('embalar_pedido');
		}
		$this -> pedido -> recursive = 0;
		$this -> set('pedidos', $this -> Pedido -> find('all', array('conditions' => array('Pedido.estado' => 2))));
	}

	function admin_presupuestar($id = null) {
		if (!$id) {
			$this -> Session -> setFlash('Pedido inválido');
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('pedido', $this -> Pedido -> read(null, $id));
		$this -> set('ordenes', $this -> Pedido -> Orden -> find('all', array('conditions' => array('Orden.pedido_id' => $id))));
		// $consulta = "SELECT orden_id, posicion, cantidad, cantidad_original, orden_estado, sin_cargo, id, detalle, unidad, foto, observaciones,
		// array_agg(pasillo_nombre) AS pasillo_nombre, array_agg(pasillo_lado) AS pasillo_lado,
		// min(pasillo_distancia) AS pasillo_distancia, array_agg(ubicacion_altura) AS ubicacion_altura,
		// array_agg(ubicacion_posicion) AS ubicacion_posicion, array_agg(ubicacion_estado) AS ubicacion_estado
		// FROM (SELECT O.id AS orden_id, O.cantidad AS cantidad, O.cantidad_original AS cantidad_original, O.estado AS orden_estado, O.sin_cargo AS sin_cargo, O.observaciones AS observaciones,
		// A.id AS id, A.detalle AS detalle, A.unidad AS unidad, A.foto AS foto,
		// A.orden AS posicion,
		// P.nombre AS pasillo_nombre, P.lado AS pasillo_lado,
		// P.distancia AS pasillo_distancia, Ub.altura AS ubicacion_altura,
		// Ub.posicion AS ubicacion_posicion, U.estado AS ubicacion_estado
		// FROM Ordenes AS O, Articulos AS A LEFT JOIN Ubicados AS U ON U.articulo_id = A.id
		// LEFT JOIN Pasillos AS P ON U.pasillo_id = P.id LEFT JOIN Ubicaciones AS Ub ON U.ubicacion_id = Ub.id
		// WHERE O.pedido_id	= $id
		// AND O.articulo_id 	= A.id
		// ORDER BY ubicacion_estado DESC
		// ) AS E
		// GROUP BY orden_id, posicion, cantidad, cantidad_original, orden_estado, sin_cargo, id, detalle, unidad, foto, observaciones
		// ORDER BY posicion";
		// $ordenes = $this -> Pedido -> Orden -> query($consulta);

		// debug($pedido);
		$this -> layout = 'ajax';
	}

	/**
	 * admin_estadisticas: realiza un gráfico de barras de los pedidos finalizados
	 */
	public function admin_estadisticas() {
		$cantidad_pedidos_mes = "SELECT anio, mes, COUNT(*) AS cantidad
					FROM (
						SELECT *,EXTRACT(MONTH FROM P.finalizado) AS mes, EXTRACT(YEAR FROM P.finalizado) AS anio
						FROM Pedidos P
						WHERE P.finalizado IS NOT NULL
					) AS R
					GROUP BY anio,mes
					ORDER BY anio, mes ASC";
		$cantidad_productos_pedido = "SELECT P.productos, COUNT(*) AS cantidad
					FROM (
						SELECT COUNT(*) AS productos
						FROM Ordenes O
						GROUP BY O.pedido_id
						ORDER BY productos ASC
					) AS P
					GROUP BY P.productos
					ORDER BY P.productos ASC";
		$promedio_productos_pedido = "SELECT OM.ordenes_anio AS anio, OM.ordenes_mes AS mes, ordenes_cantidad / pedidos_cantidad AS cantidad
					FROM (
							SELECT ordenes_anio, ordenes_mes, COUNT(*) AS ordenes_cantidad
							FROM (
								SELECT *,EXTRACT(MONTH FROM P.finalizado) AS ordenes_mes, EXTRACT(YEAR FROM P.finalizado) AS ordenes_anio
								FROM Pedidos P, Ordenes O
								WHERE P.finalizado IS NOT NULL
								AND P.id = O.pedido_id
							) AS R
							GROUP BY ordenes_anio, ordenes_mes
							ORDER BY ordenes_anio, ordenes_mes ASC
						) AS OM,
						(
							SELECT pedidos_anio, pedidos_mes, COUNT(*) AS pedidos_cantidad
							FROM (
								SELECT *,EXTRACT(MONTH FROM P.finalizado) AS pedidos_mes, EXTRACT(YEAR FROM P.finalizado) AS pedidos_anio
								FROM Pedidos P
								WHERE P.finalizado IS NOT NULL
							) AS R
							GROUP BY pedidos_anio, pedidos_mes
							ORDER BY pedidos_anio, pedidos_mes ASC
						) AS PM
					WHERE OM.ordenes_anio = PM.pedidos_anio
					AND OM.ordenes_mes = PM.pedidos_mes";
		$ventas_mensuales = "SELECT ordenes_anio AS anio, ordenes_mes AS mes, SUM(valor) AS ventas
							FROM (
								SELECT EXTRACT(MONTH FROM P.finalizado) AS ordenes_mes, EXTRACT(YEAR FROM P.finalizado) AS ordenes_anio,
									(O.cantidad * A.precio) AS valor
								FROM Pedidos P, Ordenes O, Articulos A
								WHERE P.finalizado IS NOT NULL
								AND P.id = O.pedido_id
								AND A.id = O.articulo_id
							) AS R
							GROUP BY ordenes_anio, ordenes_mes
							ORDER BY ordenes_anio, ordenes_mes ASC";
		$pedidos_mes = $this -> Pedido -> query($cantidad_pedidos_mes);
		$productos_pedido = $this -> Pedido -> query($cantidad_productos_pedido);
		$promedio_productos_pedido = $this -> Pedido -> query($promedio_productos_pedido);
		$ventas_mensuales = $this -> Pedido -> query($ventas_mensuales);
		$this -> set('pedidos_mes', $pedidos_mes);
		$this -> set('productos_pedido', $productos_pedido);
		$this -> set('promedio_productos_pedido', $promedio_productos_pedido);
		$this -> set('ventas_mensuales', $ventas_mensuales);
	}
	
	// function admin_prioridades() {
		// $prioridades = $this -> Pedido -> find('list', array('fields'=>array('Pedido.id', 'Pedido.b')));
		// foreach ($prioridades as $pedido_id => $b) {
			// $this -> Pedido -> id = $pedido_id;
			// $this -> Pedido -> saveField('prioridad', $b);
		// }
	// }

	/**
	 * admin_getPendientesCount(): Devuelve la cantidad de Pedidos que se encuentran en el estado Pendientes.
	 */
	function admin_getPendientesCount() {
		$this -> layout = 'ajax';
		return $this -> Pedido -> find('count', array('conditions' => array('Pedido.estado' => self::PENDIENTE)));
	}

	/**
	 * admin_getFinalizadosCount(): Devuelve la cantidad de Pedidos que se encuentran en el estado Finalizado.
	 */
	function admin_getFinalizadosCount() {
		$this -> layout = 'ajax';
		return $this -> Pedido -> find('count', array('conditions' => array('Pedido.estado' => self::FINALIZADO)));
	}
	
	/**
	 * admin_getControladosCount(): Devuelve la cantidad de Pedidos que se encuentran en el estado Controlado.
	 */
	function admin_getControladosCount() {
		$this -> layout = 'ajax';
		return $this -> Pedido -> find('count', array('conditions' => array('Pedido.estado' => self::CONTROLADO)));
	}
	
	/**
	 * admin_getEmbaladosCount(): Devuelve la cantidad de Pedidos que se encuentran en el estado Embalado.
	 */
	function admin_getEmbaladosCount() {
		$this -> layout = 'ajax';
		return $this -> Pedido -> find('count', array('conditions' => array('Pedido.estado' => self::EMBALADO)));
	}
	
	/**
	 * admin_getFacturadosCount(): Devuelve la cantidad de Pedidos que se encuentran en el estado Facturado.
	 */
	function admin_getFacturadosCount() {
		$this -> layout = 'ajax';
		return $this -> Pedido -> find('count', array('conditions' => array('Pedido.estado' => self::FACTURADO)));
	}
	
}
?>