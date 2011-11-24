<?php
class AuthCodesController extends AppController {

	var $name = 'AuthCodes';

	var $layout = 'verify';
	
	// @Public
	function verify() {
		if (!empty($this->data)) {
			$success = false;
			$errors = null;
			$code = $this->AuthCode->getCodeForUserId($this->loggedUser['User']['id']);
			if (!empty($code) && $this->data['AuthCode']['code'] == $code['AuthCode']['code']) {
				$this->AuthCode->id = $code['AuthCode']['id'];
				$this->AuthCode->set('status', AuthCode::STATUS_ACCEPTED);
				$this->AuthCode->save();

				$this->User->id = $this->loggedUser['User']['id'];
				$this->User->set('status', User::STATUS_ACTIVE);
				$this->User->save();

				$success = true;
			} else {
				$this->Session->setFlash(__('Incorect code. Please try again.', true));
			}
			$this->set('form_result', array('success' => $success, 'errors' => $errors));
			if ($success) {
				$this->redirect('/dashboard', 201);
			}
		} 
	}
	
	// @Private
	
	
	// @Admin
	function admin_index() {
		$this->AuthCode->recursive = 0;
		$this->set('authCodes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid auth code', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('authCode', $this->AuthCode->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->AuthCode->create();
			if ($this->AuthCode->save($this->data)) {
				$this->Session->setFlash(__('The auth code has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The auth code could not be saved. Please, try again.', true));
			}
		}
		$users = $this->AuthCode->User->find('list');
		$this->set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid auth code', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AuthCode->save($this->data)) {
				$this->Session->setFlash(__('The auth code has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The auth code could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AuthCode->read(null, $id);
		}
		$users = $this->AuthCode->User->find('list');
		$this->set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for auth code', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AuthCode->delete($id)) {
			$this->Session->setFlash(__('Auth code deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Auth code was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
