<?php
class IvasController extends AppController {

	var $name = 'Ivas';

	function index() {
		$this->Iva->recursive = 0;
		$this->set('ivas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid iva', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('iva', $this->Iva->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Iva->create();
			if ($this->Iva->save($this->data)) {
				$this->Session->setFlash(__('The iva has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The iva could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid iva', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Iva->save($this->data)) {
				$this->Session->setFlash(__('The iva has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The iva could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Iva->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for iva', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Iva->delete($id)) {
			$this->Session->setFlash(__('Iva deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Iva was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>