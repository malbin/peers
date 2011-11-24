<?php
class CompensationsController extends AppController {

	var $name = 'Compensations';

	var $helpers = array('Format');
	
	var $uses = array('Compensation', 'Job');
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Compensation not found', true));
			$this->cakeError('notFound');
		}
		$comp = $this->Compensation->getWithId($id);
		if (empty($comp) || $comp['Job']['user_id'] != $this->loggedUser['User']['id']) {
			$this->Session->setFlash(__('Compensation not found', true));
			$this->cakeError('forbidden');
		}
		$this->set('comp', $comp);
	}

	function add($job_id = null) {
		if (!$job_id) {
			$this->Session->setFlash(__('Job not found', true));
			$this->cakeError('notFound');
		} 
		$job = $this->Job->getWithId($job_id);
		if (empty($job) || $this->loggedUser['User']['id'] != $job['Job']['user_id']) {
			$this->Session->setFlash(__('Job not found', true));
			$this->cakeError('forbidden');
		}
		if (!empty($this->data)) {
			$success = false;
			$errors = null;
			
			$this->data['Compensation']['job_id'] = $job['Job']['id'];
			if ($this->Compensation->createCompensation($this->data)) {
                if ($job['Job']['end_date'] == '0000-00-00') { // Only the current job matters
                    $this->loadModel('BoardNotification');
                    $this->BoardNotification->createNotifications($this->loggedUser, BoardNotification::CAUSE_COMPENSATION_CHANGED);
                }
                
				$success = true;
				$this->Session->setFlash(__('Compensation saved', true));
			} else {
				$errors = $this->Compensation->invalidFields();
			}
			$this->set('form_result', array('success' => $success, 'errors' => $errors));
			if ($success) {
				$this->set('compensation_id',$this->Compensation->id);
				$this->redirect('/Compensation/view/'.$this->Compensation->id, 201);
			}
		} else {
			$this->data['Compensation']['job_id'] = $job['Job']['id'];
		}
	}

	function edit($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Compensation not found', true));
			$this->cakeError('notFound');
		}
		$comp = $this->Compensation->getWithId($id);
		if (empty($comp) || $comp['Job']['user_id'] != $this->loggedUser['User']['id']) {
			$this->Session->setFlash(__('Compensation not found', true));
			$this->cakeError('forbidden');
		}
		if (!empty($this->data)) {
			$success = false;
			$errors = null;
			
			$this->data['Compensation']['id'] = $comp['Compensation']['id'];
			$this->data['Compensation']['job_id'] = $comp['Compensation']['job_id'];
			$this->Compensation->id = $comp['Compensation']['id'];
			if ($this->Compensation->save($this->data)) {
				$success = true;
				$this->Session->setFlash(__('Compensation saved', true));
			} else {
				$errors = $this->Compensation->invalidFields();
			}
			$this->set('form_result', array('success' => $success, 'errors' => $errors));
			if ($success) {
				$this->redirect('/jobs/view/'.$comp['Compensation']['job_id'], 201);
			}
		} else {
			$this->data = $comp;
		}
	}

	function delete() {
		$id = @$this->data['Compensation']['id'];
		$success = false;
		if (!$id) {
			$this->Session->setFlash(__('Compensation not found', true));
			$this->cakeError('notFound');
		}
		$comp = $this->Compensation->getWithId($id);
		if (empty($comp) || $comp['Job']['user_id'] != $this->loggedUser['User']['id']) {
			$this->Session->setFlash(__('Compensation not found', true));
			$this->cakeError('forbidden');
		}
		if ($this->Compensation->delete($id, true)) {
            if ($comp['Job']['end_date'] == '0000-00-00') { // Only the current job matters
                $this->loadModel('BoardNotification');
                $this->BoardNotification->createNotifications($this->loggedUser, BoardNotification::CAUSE_COMPENSATION_CHANGED);
            }
            
			$success = true;
			$this->Session->setFlash(__('Compensation deleted', true));			
		}
		$this->set('form_result', array('success' => $success));
		$this->redirect('/jobs/view/'.$comp['Compensation']['job_id'], 201);
	}
	
	// @Admin
	
	function admin_index() {
		$this->Compensation->recursive = 0;
		$this->set('compensations', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid compensation', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('compensation', $this->Compensation->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Compensation->create();
			if ($this->Compensation->save($this->data)) {
				$this->Session->setFlash(__('The compensation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The compensation could not be saved. Please, try again.', true));
			}
		}
		$jobs = $this->Compensation->Job->find('list');
		$this->set(compact('jobs'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid compensation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Compensation->save($this->data)) {
				$this->Session->setFlash(__('The compensation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The compensation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Compensation->read(null, $id);
		}
		$jobs = $this->Compensation->Job->find('list');
		$this->set(compact('jobs'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for compensation', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Compensation->delete($id)) {
			$this->Session->setFlash(__('Compensation deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Compensation was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
