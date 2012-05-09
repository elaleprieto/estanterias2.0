<?php
class UbicacionesController extends AppController {
	var $name = 'Ubicaciones';
	var $helpers = array('Ajax');

	function index() {
		$this -> Ubicacion -> recursive = 0;
		$ubicaciones = $this -> Ubicacion -> find('all', array('order' => array(
					'Ubicacion.posicion' => 'asc',
					'Ubicacion.altura' => 'asc'
			)));
		$this -> set('ubicaciones', $ubicaciones);
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid ubicacion', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('ubicacion', $this -> Ubicacion -> read(null, $id));
	}

	function add() {
		if (!empty($this -> data)) {
			$this -> Ubicacion -> create();
			if ($this -> Ubicacion -> save($this -> data)) {
				$this -> Session -> setFlash(__('The ubicacion has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The ubicacion could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid ubicacion', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Ubicacion -> save($this -> data)) {
				$this -> Session -> setFlash(__('The ubicacion has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The ubicacion could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Ubicacion -> read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for ubicacion', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Ubicacion -> delete($id)) {
			$this -> Session -> setFlash(__('Ubicacion deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Ubicacion was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_index() {
		$this -> Ubicacion -> recursive = 0;
		$this -> set('ubicaciones', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid ubicacion', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('ubicacion', $this -> Ubicacion -> read(null, $id));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Ubicacion -> create();
			if ($this -> Ubicacion -> save($this -> data)) {
				$this -> Session -> setFlash(__('The ubicacion has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The ubicacion could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid ubicacion', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Ubicacion -> save($this -> data)) {
				$this -> Session -> setFlash(__('The ubicacion has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The ubicacion could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Ubicacion -> read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for ubicacion', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Ubicacion -> delete($id)) {
			$this -> Session -> setFlash(__('Ubicacion deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Ubicacion was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

}
?>