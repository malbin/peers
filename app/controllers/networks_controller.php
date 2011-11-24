<?php
class NetworksController extends AppController {

	var $name = 'Networks';

	function index() {
		$networks = $this->Network->getAllForUserId($this->loggedUser['User']['id']);
		$this->set(compact('networks'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Network not found', true));
			$this->cakeError('notFound');
		}
		$network = $this->Network->getWithId($id);
		
			foreach($network['User'] as $u_key => $network_user){
				$network['User'][$u_key]['active_job'] = $this->User->Job->find('first', array( 'conditions' => array( 'user_id' => $network_user['id'] ), 'order' => 'start_date DESC', 'limit' => 1));
			}
		
		if (empty($network) || $network['Network']['user_id'] != $this->loggedUser['User']['id']) {
			$this->Session->setFlash(__('Network not found', true));
			$this->cakeError('forbidden');
		}
		$this->set(compact('network'));
	}

	function add() {
		if (!empty($this->data)) {
			$success = false;
			$errors = null;
			
			$this->data['Network']['user_id'] = $this->loggedUser['User']['id'];
			if ($this->Network->createNetwork($this->data)) {
				$success = true;
				$this->Session->setFlash(__('Network saved', true));
			} else {
				$errors = $this->Network->invalidFields();
			}
			$this->set('form_result', array('success' => $success, 'errors' => $errors));
			if ($success) {
				$this->redirect('/networks/view/'.$this->Network->id, 201);
			}
		}
		$this->paginate = array(
				'limit' => 20
		);
		$users = $this->paginate('User');
		$this->set(compact('users'));
	}
	
	function create() {
	}
	
	function edit($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Network not found', true));
			$this->cakeError('notFound');
		}
		$network = $this->Network->getWithId($id);
		if (empty($network) || $network['Network']['user_id'] != $this->loggedUser['User']['id']) {
			$this->Session->setFlash(__('Network not found', true));
			$this->cakeError('forbidden');
		}
		if (!empty($this->data)) {
			$success = false;
			$errors = null;
			
			$this->data['Network']['id'] = $network['Network']['id'];
            $this->data['Network']['user_id'] = $this->loggedUser['User']['id'];
 			$this->Network->id = $network['Network']['id'];
			if ($this->Network->save($this->data)) {
				$success = true;
				$this->Session->setFlash(__('Network saved', true));
			} else {
				$errors = $this->Network->invalidFields();
			}
			$this->set('form_result', array('success' => $success, 'errors' => $errors));
			if ($success) {
				$this->redirect('/networks/view/'.$network['Network']['id'], 201);
			}
		} else {
			$this->data = $network;
		}
		$this->paginate = array(
				'limit' => 20
		);
		$users = $this->paginate('User');
		$this->set(compact('users'));
	}

	function delete() {
		$id = @$this->data['Network']['id'];
		
		$success = false;
		if (!$id) {
			$this->Session->setFlash(__('Network not found', true));
			$this->cakeError('notFound');
		}
		$network = $this->Network->getWithId($id);
		if (empty($network) || $network['Network']['user_id'] != $this->loggedUser['User']['id']) {
			$this->Session->setFlash(__('Network not found', true));
			$this->cakeError('forbidden');
		}
		if ($this->Network->delete($id, true)) {
			$success = true;
			$this->Session->setFlash(__('Network deleted', true));			
		}
		$this->set('form_result', array('success' => $success));
		$this->redirect('/networks/index', 201);
	}
	
	function delete_member() {
		$id = @$this->data['Network']['id'];
		$user_id = @$this->data['User']['id'];
		
		if (!$id || !$user_id) {
			$this->Session->setFlash(__('Network not found', true));
			$this->cakeError('notFound');
		}
		$network = $this->Network->getWithId($id);
		if (empty($network) || $network['Network']['user_id'] != $this->loggedUser['User']['id']) {
			$this->Session->setFlash(__('Network not found', true));
			$this->cakeError('forbidden');
		}
		
		$success = false;
		$errors = null;
	
		$data['Network']['id'] = $network['Network']['id'];
		$data['User']['User'] = array_merge(array_diff($network['MembersIds'], array($user_id)));
 		$this->Network->id = $network['Network']['id'];
		if ($this->Network->save($data)) {
			$success = true;
			$this->Session->setFlash(__('Network saved', true));
		} else {
			$errors = $this->Network->invalidFields();
		}
		$this->set('form_result', array('success' => $success, 'errors' => $errors));
		$this->redirect('/networks/view/'.$network['Network']['id'], 201);
	}
	
	// @Admin
	
	function admin_index() {
		$this->Network->recursive = 0;
		$this->set('networks', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid network', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('network', $this->Network->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Network->create();
			if ($this->Network->save($this->data)) {
				$this->Session->setFlash(__('The network has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The network could not be saved. Please, try again.', true));
			}
		}
		$owners = $this->Network->Owner->find('list');
		$users = $this->Network->User->find('list');
		$this->set(compact('owners', 'users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid network', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Network->save($this->data)) {
				$this->Session->setFlash(__('The network has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The network could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Network->read(null, $id);
		}
		$owners = $this->Network->Owner->find('list');
		$users = $this->Network->User->find('list');
		$this->set(compact('owners', 'users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for network', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Network->delete($id)) {
			$this->Session->setFlash(__('Network deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Network was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
