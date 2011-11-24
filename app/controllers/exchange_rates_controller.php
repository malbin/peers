<?php
class ExchangeRatesController extends AppController {

	var $name = 'ExchangeRates';

	function admin_index() {
		$this->ExchangeRate->recursive = 0;
		$this->set('exchangeRates', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid exchange rate', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('exchangeRate', $this->ExchangeRate->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ExchangeRate->create();
			if ($this->ExchangeRate->save($this->data)) {
				$this->Session->setFlash(__('The exchange rate has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The exchange rate could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid exchange rate', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ExchangeRate->save($this->data)) {
				$this->Session->setFlash(__('The exchange rate has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The exchange rate could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ExchangeRate->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for exchange rate', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ExchangeRate->delete($id)) {
			$this->Session->setFlash(__('Exchange rate deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Exchange rate was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
