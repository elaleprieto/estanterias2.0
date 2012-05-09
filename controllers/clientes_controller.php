<?php
class ClientesController extends AppController {

	var $name = 'Clientes';
	var $helpers = array(
		'Ajax',
		'Paginator',
		'Time',
		'Javascript',
		'Js' => array('Jquery')
	);

	function admin_index() {
		$this -> Cliente -> recursive = 0;
		$this -> set('clientes', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid cliente', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('cliente', $this -> Cliente -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Cliente -> create();
			if ($this -> Cliente -> save($this -> data)) {
				$this -> Session -> setFlash(__('The cliente has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The cliente could not be saved. Please, try again.', true));
			}
		}
		$localidades = $this -> Cliente -> Localidad -> find('list');
		$ivas = $this -> Cliente -> Iva -> find('list');
		$this -> set(compact('localidades', 'ivas'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid cliente', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Cliente -> save($this -> data)) {
				$this -> Session -> setFlash(__('The cliente has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The cliente could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Cliente -> read(null, $id);
		}
		$localidades = $this -> Cliente -> Localidad -> find('list');
		$ivas = $this -> Cliente -> Iva -> find('list');
		$transportes = $this -> Cliente -> Transporte -> find('list');
		$this -> set(compact('localidades', 'ivas', 'transportes'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for cliente', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Cliente -> delete($id)) {
			$this -> Session -> setFlash(__('Cliente deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Cliente was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	public function admin_actualizar() {
		if (!empty($this -> data)) {
			$nombreArchivo = 'clientes.csv';
			$uploaddir = TMP . '/uploads/cliente/';
			$uploadfile = $uploaddir . $nombreArchivo;

			if (move_uploaded_file($this -> data['Cliente']['archivo']['tmp_name'], $uploadfile)) {
				# se llama al modelo
				if ($this -> Cliente -> actualizar($nombreArchivo)) {
					$this -> Session -> setFlash("Clientes actualizados.");
				} else {
					$this -> Session -> setFlash(__("No se actualizó ningun cliente porque no se encontraron diferencias.", true));
				}
			} else {
				$this -> Session -> setFlash("Ocurrió un problema subiendo el archivo.");
			}
		}
	}

	public function admin_etiquetas($cliente_id = null) {
		if (!empty($this -> data)) {
			$this -> layout = 'ajax';
			$this -> render('admin_etiquetas_imprimir');
		}
		if (!$cliente_id) {
			$cliente_id = 0;
		}
		$this -> Cliente -> recursive = 0;
		$clientes = $this -> Cliente -> find('list', array('order' => 'Cliente.nombre'));
		$this -> set(compact('clientes', 'cliente_id'));
	}

	public function get_direccion($id = null) {
		$this -> layout = 'ajax';
		if ($id) {
			$this -> set('cliente', $this -> Cliente -> findById($id));
			$this -> render("/elements/get_direccion");
		}
	}

	public function get_localidad($id = null) {
		$this -> layout = 'ajax';
		if ($id) {
			$this -> set('cliente', $this -> Cliente -> findById($id));
			$this -> render("/elements/get_localidad");
		}
	}

	public function get_provincia($id = null) {
		$this -> layout = 'ajax';
		if ($id) {
			$cliente = $this -> Cliente -> findById($id);
			$this -> set('cliente', $this -> Cliente -> Localidad -> Provincia -> findById($cliente['Localidad']['provincia_id']));
			$this -> render("/elements/get_provincia");
		}
	}

	public function get_cliente($id = null) {
		$this -> layout = 'ajax';
		if ($id) {
			$cliente = $this -> Cliente -> findById($id);
			$localidad = $this -> Cliente -> Localidad -> findById($cliente['Cliente']['localidad_id']);
			$this -> set(compact('cliente', 'localidad'));
		}
	}

	/**
	 * admin_buscar(): despliega la pantalla de búsqueda.
	 */
	public function admin_buscar() {

	}

	/**
	 * get_buscados(): realiza la búsqueda de articulos.
	 * Es usado por admin_buscar() para hacer la búsqueda desde una petición Ajax de buscar().
	 */
	public function admin_get_buscados() {
		$this -> layout = 'ajax';
		if (!empty($this -> data)) {
			$cadena = explode(' ', mb_strtoupper($this -> data['Cliente']['cliente'], 'utf-8'));
			$consulta = "SELECT  c.id AS id, c.nombre AS nombre, direccion, cuit, bonificacion, l.nombre AS localidad, p.nombre AS provincia, i.categoria AS iva
						FROM clientes AS c, Ivas AS I, Localidades AS L, Provincias AS P
						WHERE 1=1
						AND c.iva_id = i.id
						AND c.localidad_id = l.id
						AND l.provincia_id = p.id ";
			foreach ($cadena as $palabra) {
				$consulta .= "AND c.nombre LIKE '%" . $palabra . "%'";
			}
			$consulta .= "ORDER BY c.nombre";
			$this -> set('clientes', $this -> Cliente -> query($consulta));
		}
	}

}
?>