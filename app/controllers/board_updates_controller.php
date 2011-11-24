<?php
class BoardUpdatesController extends AppController {

	var $name = 'BoardUpdates';

	function admin_index() {
		$this->BoardUpdate->recursive = 0;
		$this->set('boardUpdates', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid board update', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('boardUpdate', $this->BoardUpdate->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->BoardUpdate->create();
			if ($this->BoardUpdate->save($this->data)) {
				$this->Session->setFlash(__('The board update has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The board update could not be saved. Please, try again.', true));
			}
		}
		$boards = $this->BoardUpdate->Board->find('list');
		$users = $this->BoardUpdate->User->find('list');
		$this->set(compact('boards', 'users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid board update', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->BoardUpdate->save($this->data)) {
				$this->Session->setFlash(__('The board update has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The board update could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->BoardUpdate->read(null, $id);
		}
		$boards = $this->BoardUpdate->Board->find('list');
		$users = $this->BoardUpdate->User->find('list');
		$this->set(compact('boards', 'users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for board update', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->BoardUpdate->delete($id)) {
			$this->Session->setFlash(__('Board update deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Board update was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
