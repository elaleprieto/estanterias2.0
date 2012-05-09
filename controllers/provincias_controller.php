<?php
class ProvinciasController extends AppController {

	var $name = 'Provincias';

	function index() {
		$this -> Provincia -> recursive = 0;
		$this -> set('provincias', $this -> paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid provincia', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('provincia', $this -> Provincia -> read(null, $id));
	}

	function add() {
		if (!empty($this -> data)) {
			$this -> Provincia -> create();
			if ($this -> Provincia -> save($this -> data)) {
				$this -> Session -> setFlash(__('The provincia has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The provincia could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid provincia', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Provincia -> save($this -> data)) {
				$this -> Session -> setFlash(__('The provincia has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The provincia could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Provincia -> read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for provincia', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Provincia -> delete($id)) {
			$this -> Session -> setFlash(__('Provincia deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Provincia was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	public function actualizar() {
		if (!empty($this -> data)) {
			$nombreArchivo = 'provincias.csv';
			$uploaddir = TMP . '/uploads/provincia/';
			$uploadfile = $uploaddir . $nombreArchivo;

			if (move_uploaded_file($this -> data['Provincia']['archivo']['tmp_name'], $uploadfile)) {
				# se llama al modelo
				if ($this -> Provincia -> actualizar($nombreArchivo)) {
					$this -> Session -> setFlash("Provincias actualizadas.");
				} else {
					$this -> Session -> setFlash(__("No se actualizó ninguna provincia porque no se encontraron diferencias.", true));
				}
			} else {
				$this -> Session -> setFlash("Ocurrió un problema subiendo el archivo.");
			}
		}
	}

}
?>