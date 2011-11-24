<?php
class JobsController extends AppController {

	var $name = 'Jobs';

	var $helpers = array('Time','Format');

	var $uses = array('Job', 'Employer');
	
	// @Public 
	
	function index() {
		$jobs = $this->Job->getAllForUserId($this->loggedUser['User']['id']);
		$this->set(compact('jobs'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Job not found', true));
			$this->cakeError('notFound');
		}
		$job = $this->Job->getWithId($id);
		if (empty($job) || $job['Job']['user_id'] != $this->loggedUser['User']['id']) {
			$this->Session->setFlash(__('Job not found', true));
			$this->cakeError('forbidden');
		}
		$this->set(compact('job'));
	}

	function add() {
		if (!empty($this->data)) {
			$success = false;
			$errors = null;
			$this->Employer->set($this->data);
 			$validEmployer = $this->Employer->validates();
 			
            $this->data['Job']['user_id'] = $this->loggedUser['User']['id'];
 			$this->Job->set($this->data);
 			$validJob = $this->Job->validates();
 			
			if ($validEmployer && $validJob) {
				$employer = $this->Employer->createEmployer($this->data);
				$this->data['Job']['employer_id'] = $employer['Employer']['id'];
				if ($this->Job->createJob($this->data)) {
                    $job = $this->Job->getWithId($this->Job->id);
                    
                    if ($job['Job']['end_date'] == '0000-00-00') { // Current job has changed
                        $this->loadModel('BoardNotification');
                        $this->BoardNotification->createNotifications($this->loggedUser, BoardNotification::CAUSE_JOB_CHANGED);
                    }
                    
					$success = true;
					$this->Session->setFlash(__('Job saved', true));
				}
			} else {
				$errors = array(
					'Job' => $this->Job->invalidFields(),
					'Employer' => $this->Employer->invalidFields()
				);
			}
			$this->set('form_result', array('success' => $success, 'errors' => $errors));
			if ($success) {
				$this->redirect(array('controller' => 'jobs', 'action' => 'view', $this->Job->id), 201);
			}
		}
		$employers = $this->Job->Employer->getList();
		$countries = $this->Job->Country->getList();
		$this->set(compact('employers', 'countries'));
	}

	
	function edit($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Job not found', true));
			$this->cakeError('notFound');
		}
		$job = $this->Job->getWithId($id);
		if (empty($job) || $this->loggedUser['User']['id'] != $job['Job']['user_id']) {
			$this->Session->setFlash(__('Job not found', true));
			$this->cakeError('forbidden');
		}
		if (!empty($this->data)) {
			$success = false;
			$errors = null;
			$this->Employer->set($this->data);
 			$validEmployer = $this->Employer->validates();
 			
 			$this->data['Job']['id'] = $job['Job']['id'];
 			$this->Job->id = $job['Job']['id'];
 			$this->Job->set($this->data);
 			$validJob = $this->Job->validates();
 			
			if ($validEmployer && $validJob) {
				$employer = $this->Employer->createEmployer($this->data);
				$this->data['Job']['user_id'] = $this->loggedUser['User']['id'];
				$this->data['Job']['employer_id'] = $employer['Employer']['id'];
				
				if ($this->Job->save($this->data)) {
					$success = true;
					$this->Session->setFlash(__('Job saved!', true));
				}
			} else {
				$errors = array(
					'Job' => $this->Job->invalidFields(),
					'Employer' => $this->Employer->invalidFields()
				);
			}
			$this->set('form_result', array('success' => $success, 'errors' => $errors));
			if ($success) {
				$this->redirect(array('controller' => 'jobs', 'action' => 'view', $job['Job']['id']), 201);
			}
		} else {
			$this->data = $job;
		}
		$employers = $this->Job->Employer->getList();
		$countries = $this->Job->Country->getList();
		$this->set(compact('employers', 'countries'));
	}
    
    function autocomplete() {
        $jobs = array();
        if (!empty($this->params['url']['term'])) {
            $jobs = $this->Job->getAutocomplete($this->params['url']['term']);
        }
        echo json_encode($jobs);
        die;
    }
    
    function location($id, $type) {
        if (!$id || !$type) {
            $this->Session->setFlash(__('Item does not exist.', true));
			$this->cakeError('notFound');
		}
        $country = $this->Job->Country->getWithId($id);
        
        switch ($country['Country']['name']) {
            case 'United Kingdom':
                $currency = 'GBP';
                $currencySymbol = '\u00A3';
                $locationMappings = array(
                    'city' => 'Town',
                    'state' => 'County',
                    'zip_code' => 'Post Code'
                );
                break;
            case 'Canada':
                $currency = 'CAD';
                $currencySymbol = '$';
                $locationMappings = array(
                    'address' => 'Street Address',
                    'city' => 'City',
                    'zip_code' => 'Post Code'
                );
                break;
            case 'United States':
                $currency = 'USD';
                $currencySymbol = '$';
                $locationMappings = array(
                    'city' => 'City',
                    'state' => 'State/Province',
                    'zip_code' => 'Zip/Postal Code'
                );
                break;
            case 'Austria':
            case 'Belgium':
            case 'Cyprus':
            case 'Estonia':
            case 'Finland':
            case 'France':
            case 'Germany':
            case 'Greece':
            case 'Ireland':
            case 'Italy':
            case 'Luxembourg':
            case 'Malta':
            case 'Netherlands':
            case 'Portugal':
            case 'Slovakia':
            case 'Slovenia':
            case 'Spain':
                $currency = 'EUR';
                $currencySymbol = '$';
                $locationMappings = array(
                    'city' => 'City',
                    'state' => 'Locality',
                    'zip_code' => 'Postal Code'
                );
                break;
            default:
                $currency = '';
                $currencySymbol = '$';
                $locationMappings = array(
                    'city' => 'City',
                    'state' => 'State/Province',
                    'zip_code' => 'Zip/Postal Code'
                );
        }
        
        $this->set(compact('currency', 'currencySymbol', 'locationMappings'));
        if ($type == 'short') {
            $this->render('/elements/dashboard/add_job_location_short');
        } else {
            $this->render('/elements/dashboard/add_job_location_long');
        }
    }

	function delete() {
		$id = @$this->data['Job']['id'];
		
		$success = false;
		if (!$id) {
			$this->Session->setFlash(__('Job not found', true));
			$this->cakeError('notFound');
		}
		$job = $this->Job->getWithId($id);
		if (empty($job) || $this->loggedUser['User']['id'] != $job['Job']['user_id']) {
			$this->Session->setFlash(__('Job not found', true));
			$this->cakeError('forbidden');
		}
		if ($this->Job->delete($id, true)) {
            if ($job['Job']['end_date'] == '0000-00-00') { // Only the current job matters
                $this->loadModel('BoardNotification');
                $this->BoardNotification->createNotifications($this->loggedUser, BoardNotification::CAUSE_JOB_CHANGED);
            }

			$success = true;
			$this->Session->setFlash(__('Job deleted', true));			
		}
		$this->set('form_result', array('success' => $success));
		$this->redirect(array('controller' => 'jobs', 'action' => 'index'), 201);
	}
	
	
	// @Admin

       //$this->data

         /*
         * Search job by using title,salary,and place as well
         * Add By Rakesh for instance,
         */
		//         function admin_searchjob($this->data) {
		//                 $jobs = $this->Job->getSearchJobs();
		// $this->set(compact('jobs'));
		//         }
	
	function admin_index() {
		$this->Job->recursive = 0;
		$this->set('jobs', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid job', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('job', $this->Job->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Job->create();
			if ($this->Job->save($this->data)) {
				$this->Session->setFlash(__('The job has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Job->User->find('list');
		$employers = $this->Job->Employer->find('list');
		$countries = $this->Job->Country->find('list');
		$this->set(compact('users', 'employers', 'countries'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid job', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Job->save($this->data)) {
				$this->Session->setFlash(__('The job has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Job->read(null, $id);
		}
		$users = $this->Job->User->find('list');
		$employers = $this->Job->Employer->find('list');
		$countries = $this->Job->Country->find('list');
		$this->set(compact('users', 'employers', 'countries'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for job', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Job->delete($id)) {
			$this->Session->setFlash(__('Job deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Job was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
