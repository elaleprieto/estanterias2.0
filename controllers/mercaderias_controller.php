<?php
class MercaderiasController extends AppController {

	var $name = 'Mercaderias';
	var $helpers = array('Time');
	var $paginate = array('Mercaderia' => array(
			'limit' => 25,
			'order' => array('Mercaderia.created' => 'desc', )
		));

	function admin_index() {
		$this->Mercaderia->recursive = 0;
		$this->set('mercaderias', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid mercaderia', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('mercaderia', $this->Mercaderia->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Mercaderia->create();
			if ($this->Mercaderia->save($this->data)) {
				$this->Session->setFlash(__('The mercaderia has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mercaderia could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid mercaderia', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Mercaderia->save($this->data)) {
				$this->Session->setFlash(__('The mercaderia has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mercaderia could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Mercaderia->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for mercaderia', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Mercaderia->delete($id)) {
			$this->Session->setFlash(__('Mercaderia deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Mercaderia was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>