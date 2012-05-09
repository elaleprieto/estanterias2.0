<?php
class LocalidadesController extends AppController {

	var $name = 'Localidades';

	function index() {
		$this -> Localidad -> recursive = 0;
		$this -> set('localidades', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid localidad', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('localidad', $this -> Localidad -> read(null, $id));
	}

	function add() {
		if (!empty($this -> data)) {
			$this -> Localidad -> create();
			if ($this -> Localidad -> save($this -> data)) {
				$this -> Session -> setFlash(__('The localidad has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The localidad could not be saved. Please, try again.', true));
			}
		}
		$provincias = $this -> Localidad -> Provincia -> find('list');
		$this -> set(compact('provincias'));
	}

	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid localidad', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Localidad -> save($this -> data)) {
				$this -> Session -> setFlash(__('The localidad has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The localidad could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Localidad -> read(null, $id);
		}
		$provincias = $this -> Localidad -> Provincia -> find('list');
		$this -> set(compact('provincias'));
	}

	function delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for localidad', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Localidad -> delete($id)) {
			$this -> Session -> setFlash(__('Localidad deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Localidad was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	public function actualizar() {
		if (!empty($this -> data)) {
			$nombreArchivo = 'localidades.csv';
			$uploaddir = TMP . '/uploads/localidad/';
			$uploadfile = $uploaddir . $nombreArchivo;

			if (move_uploaded_file($this -> data['Localidad']['archivo']['tmp_name'], $uploadfile)) {
				# se llama al modelo
				if ($this -> Localidad -> actualizar($nombreArchivo)) {
					$this -> Session -> setFlash("Localidades actualizadas.");
				} else {
					$this -> Session -> setFlash(__("No se actualizó ninguna localidad porque no se encontraron diferencias.", true));
				}
			} else {
				$this -> Session -> setFlash("Ocurrió un problema subiendo el archivo.");
			}
		}
	}

}
?>