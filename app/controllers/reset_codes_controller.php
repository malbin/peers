<?php
class ResetCodesController extends AppController {

	var $name = 'ResetCodes';

	function index() {
		if (empty($this->params['url']['code'])) {
			$this->cakeError('notFound');
		}
		$codeStr = $this->params['url']['code'];
		$code = $this->ResetCode->getResetCodeWithCode($codeStr);
		if (empty($code)) {
			$this->cakeError('forbidden');
		} 
		if (!empty($this->data)) {
			$success = false;
			$errors = null;
			$this->User->id = $code['User']['id'];
			$this->data['User']['reset_code'] = $codeStr;
			if($this->User->save($this->data)) {
				$this->ResetCode->delete($code['ResetCode']['id']);
				$this->Session->setFlash(__('Password saved!', true));
				$success = true;
			} else {
				$errors = $this->User->invalidFields();
			}
			$this->set('form_result', array('success' => $success, 'errors' => $errors));
			if ($success) {
				$this->redirect('/dashboard', 201);
			}
		}
        $this->layout = 'page';
		$this->set(compact('code'));
	}
	
	function admin_index() {
		$this->ResetCode->recursive = 0;
		$this->set('resetCodes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid reset code', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('resetCode', $this->ResetCode->read(null, $id));
	}
	
	// @Admin
	 
	function admin_add() {
		if (!empty($this->data)) {
			$this->ResetCode->create();
			if ($this->ResetCode->save($this->data)) {
				$this->Session->setFlash(__('The reset code has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reset code could not be saved. Please, try again.', true));
			}
		}
		$users = $this->ResetCode->User->find('list');
		$this->set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid reset code', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ResetCode->save($this->data)) {
				$this->Session->setFlash(__('The reset code has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reset code could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ResetCode->read(null, $id);
		}
		$users = $this->ResetCode->User->find('list');
		$this->set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for reset code', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ResetCode->delete($id)) {
			$this->Session->setFlash(__('Reset code deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Reset code was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
