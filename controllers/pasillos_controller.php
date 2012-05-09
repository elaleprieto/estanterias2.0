<?php
class PasillosController extends AppController {

	var $name = 'Pasillos';
	var $paginate = array('Pasillo' => array(
					'limit' => 25,
					'order' => array('Pasillo.distancia' => 'asc', ),
				), );

	function index() {
		$this->Pasillo->recursive = 0;
		$this->set('pasillos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid pasillo', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('pasillo', $this->Pasillo->read(null, $id));
	}

	function add() {
		if(!empty($this->data)) {
			# Seteo el nombre en minúsculas con la primer letra en mayúscula
			$this -> data['Pasillo']['nombre'] = ucfirst(strtolower($this->data['Pasillo']['nombre']));
			# Seteo el lado derecho del pasillo
			$this -> data['Pasillo']['lado'] = 'Derecho';
			# Creación del lado derecho del pasillo
			$this -> Pasillo->create();

			if($this -> Pasillo -> save($this -> data)) {
				# Si se creó el lado derecho, se setea el lado en izquierdo y se crea otro pasillo
				$this -> data['Pasillo']['lado'] = 'Izquierdo';
				$this -> Pasillo->create();
				
				if($this -> Pasillo -> save($this -> data)) {
					# Si todo ha ido bien, se avisa al usuario
					$this -> Session -> setFlash(__('Los pasillos han sido creados', true));
					$this -> redirect(array('action' => 'index'));
				} else {
					# Si no se ha podido crear el pasillo izquierdo se avisa al usuario
					$this->Session->setFlash(__('El pasillo derecho ha sido creado, pero el izquierdo no.', true));
				}	
				$this -> redirect(array('action' => 'index'));
			} else {
				# Si no se ha podido crear el pasillo derecho se avisa al usuario
				$this->Session->setFlash(__('No se han podido crear los pasillos.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid pasillo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Pasillo->save($this->data)) {
				$this->Session->setFlash(__('The pasillo has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pasillo could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Pasillo->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for pasillo', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Pasillo->delete($id)) {
			$this->Session->setFlash(__('Pasillo deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Pasillo was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>