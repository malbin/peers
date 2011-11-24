<?php
class EmployersController extends AppController {

	var $name = 'Employers';
    
    function autocomplete() {
        $employers = array();
        if (!empty($this->params['url']['term'])) {
            $employers = $this->Employer->getAutocomplete($this->params['url']['term']);
        }
        echo json_encode($employers);
        die;
    }

	function admin_index() {
		$this->Employer->recursive = 0;
		$this->set('employers', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid employer', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('employer', $this->Employer->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Employer->create();
			if ($this->Employer->save($this->data)) {
				$this->Session->setFlash(__('The employer has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The employer could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid employer', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Employer->save($this->data)) {
				$this->Session->setFlash(__('The employer has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The employer could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Employer->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for employer', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Employer->delete($id)) {
			$this->Session->setFlash(__('Employer deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Employer was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
