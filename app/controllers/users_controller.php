<?php
class UsersController extends AppController {

	var $name = 'Users';
	
	var $uses = array('User', 'Employer', 'Job', );
	
	var $components = array('Messenger', 'Email');
	
	// @Public
	function index() {
		$this->layout = 'homepage';
	}
	
	function edit() {
		if (!empty($this->data)) {
			$success = false;
			$errors = null;
			$this->User->id = $this->loggedUser['User']['id'];
			if ($this->User->save($this->data)) {
				$success = true;
				$this->_reloadLoggedUser();
				$this->Session->setFlash(__('Profile saved', true));
			} else {
				$errors = $this->User->invalidFields();
			}
			$this->set('form_result', array('success' => $success, 'errors' => $errors));
			if ($success) {
				$this->redirect('/index', 201);
			}
		}
		if (empty($this->data)) {
			$this->data = $this->loggedUser;
		}
	}
	
	function update_phone() {
		if (!empty($this->data['User']['phone'])) {
			$success = false;
			$errors = null;

			$save = array('User' => array(
				'id' => $this->loggedUser['User']['id'],
				'phone' => $this->data['User']['phone']
			));
			$this->User->id = $this->loggedUser['User']['id'];
			if ($this->User->save($save)) {
				$success = true;
				$this->_reloadLoggedUser();
			} else {
				$errors = array('User' => $this->User->invalidFields());
			}
			$this->set('form_result', array('success' => $success, 'errors' => $errors));
		}
	}
	
	function login() {
		if (!empty($this->data)) {
			$success = false;
			$errors = null;
			$email = $this->data['User']['email'];
			$password = $this->data['User']['password'];
			$user = $this->User->getUserWithEmailAndPassword($email, $password);
			if (!empty($user)) {
				$success = true;
				$this->Session->write('user_id', $user['User']['id']);
                if ($this->data['User']['remember_me']) {
                    $rememberMe = array(
                        'id' => $user['User']['id'],
                        'token' => $this->User->createRememberMeToken(md5($this->data['User']['password'])) // For security, don't store password hash directly in cookie
                    );
                    $this->Cookie->write('remember_me', $rememberMe);
                }
			} else {
				$this->Session->setFlash(__('Incorect login or password.', true));
				$this->layout = 'homepage';
				unset($this->data['User']['password']);
				$login = 'failed';
			}
			$this->set('form_result', array('success' => $success, 'errors' => $errors));
			if ($success) {
				$this->redirect('/dashboard', 201);
			} else {
                $this->layout = 'homepage';
                unset($this->data['User']['password']);
            }
		}
	}
	
	function logout() {
		$this->Session->destroy();
        $this->Cookie->delete('remember_me');
		$this->redirect('/', 201);
	}
		
	function signup() {
		$signupWithCode = Configure::read('App.SignupWithCode');
		
		$code = @$this->params['url']['code'];
		if ($signupWithCode) {
			if (empty($code)) {
				$this->cakeError('forbidden');
			}
			$this->loadModel('SiteInvite');
			$siteInvite = $this->SiteInvite->getSiteInviteWithCode($code);
			if (empty($siteInvite) || !in_array($siteInvite['SiteInvite']['status'], array(SiteInvite::STATUS_SENT))) {
				$this->cakeError('forbidden');
			}
		}
		if (!empty($this->data)) {
			$success = false;
			$errors = null;
			
			$this->data['User']['birthdate'] = $this->data['User']['birthdate']['year'].'-01-01';
			
			$this->Employer->set($this->data);
 			$validEmployer = $this->Employer->validates();
			
 			$this->Job->set($this->data);
 			$validJob = $this->Job->validates();
 			
 			$this->User->set($this->data);
 			$validUser = $this->User->validates();
 			
			if ($validEmployer && $validJob && $validUser && $this->User->createUser($this->data)) {
				$employer = $this->Employer->createEmployer($this->data);
				
				$this->data['Job']['user_id'] = $this->User->id;
				$this->data['Job']['employer_id'] = $employer['Employer']['id'];
				$this->Job->createJob($this->data);
				
				$this->Session->write('user_id', $this->User->id);
				$this->_reloadLoggedUser();
				
				$this->_sendAuthCode($this->loggedUser);
				
				if ($signupWithCode) {
					$this->SiteInvite->id = $siteInvite['SiteInvite']['id'];
					$this->SiteInvite->set('status', SiteInvite::STATUS_ACCEPTED);
					$this->SiteInvite->save();
				}
				
				$this->_createDemoBoardForUser($this->User->id, $this->data['User']['gender']);
				$success = true;
			} else {
				$errors = array(
					'User' => $this->User->invalidFields(),
					'Employer' => $this->Employer->invalidFields(),
					'Job' => $this->Job->invalidFields()
				);
			}
			$this->set('form_result', array('success' => $success, 'errors' => $errors));
			if ($success) {
				$this->redirect('/verify', 201);
			}
		}
		
		$this->layout = 'signup';
        $countries = $this->User->Job->Country->getList();
		$this->set(compact('code', 'countries'));
	}
	
	function resend_auth_code() {	
		$this->_sendAuthCode($this->loggedUser);
		$this->redirect('/verify', 201);
	}
	
	function forgot_password() {
		if (!empty($this->data)) {
			$success = false;
			$errors = null;
			$user = $this->User->getUserWithEmail($this->data['User']['email']);
			if (!empty($user)) {
				$code = $this->User->ResetCode->getCodeForUserId($user['User']['id']);
				$this->_sendResetCode($user, $code);
				$this->Session->setFlash(__('Reset code sent! Please check your email.',  true));
				$success = true;
			} else {
                $this->User->invalidate('email', __('Given email does not exists in our database!', true));
				$errors = $this->User->invalidFields();
			}
			$this->set('form_result', array('success' => $success, 'errors' => $errors));
		}
	}

	function search() {
		$search_results = null;
		$query = @$this->params['url']['query'];
		$limit = @$this->params['names']['limit'];
		
		if (empty($query)) {
			$query = @$this->params['named']['query'];
		}
		if (!is_numeric($limit) || $limit < 2 || 50 < $limit) {
			$limit = 20;
		}
		if (!empty($query)) {
			$searchConditions = $this->User->getSearchConditionsForQuery($query);
			$this->paginate = array(
				'conditions' => $searchConditions,
				'limit' => $limit
			);
			$search_results = $this->paginate('User');
			foreach($search_results as &$user) {
				$user['LastJob'] = $this->Job->getLastJobForUserId($user['User']['id']);
			}
		}
        if ($this->RequestHandler->isAjax()) {
            echo json_encode($search_results);
            $this->autoRender = false;
        } else {
            $this->set(compact('search_results', 'query'));
        }
	}
	
	function network_search() {
		$search_results = null;
		$query = @$this->params['url']['query'];
		$limit = @$this->params['names']['limit'];
		
		if (empty($query)) {
			$query = @$this->params['named']['query'];
		}
		if (!is_numeric($limit) || $limit < 2 || 50 < $limit) {
			$limit = 20;
		}
		if (!empty($query)) {
			$searchConditions = $this->User->getSearchConditionsForQuery($query);
			$this->paginate = array(
				'conditions' => $searchConditions,
				'limit' => $limit
			);
			$search_results = $this->paginate('User');
			foreach($search_results as &$user) {
				$user['LastJob'] = $this->Job->getLastJobForUserId($user['User']['id']);
			}
		}	

		// print_r($search_results);
		$data = array();
		foreach ($search_results as $key => $result) {
			$user_data = new StdClass();
			$user_data->id = $result['User']['id'];
			$user_data->name = $result['User']['first_name'].' '.$result['User']['last_name'];
			$user_data->job = $result['User']['last_job_title'];
			$user_data->company = $result['User']['last_employer_name'];
			$user_data->location = '';
			if($result['LastJob']['Job']['city'] != '' && $result['LastJob']['Job']['state']!= ''){
				$user_data->location = $result['LastJob']['Job']['city'].', '.$result['LastJob']['Job']['state'];
			}

			$data[]=$user_data;
		}
		// echo json_encode($data);

		$this->set(compact('data'));

	}	
	
	// @Private
	
	function _createDemoBoardForUser($userId, $gender) {
		if ('Female' == $gender) {
			$demoBoardId = Configure::read('App.FemaleDemoBoardId');	
		} else {
			$demoBoardId = Configure::read('App.MaleDemoBoardId');
		}
		if ($demoBoardId < 1) {
			return;
		} 
		$board = $this->User->Board->getWithId($demoBoardId);
		if (!empty($board) && !in_array($userId, $board['MembersIds'])) {
			$data['Board']['user_id'] = $userId;
            $data['Board']['parent_id'] = $demoBoardId;
			$data['Board']['name'] = $board['Board']['name'];
			$data['User']['User'] = array_merge($board['MembersIds'], array($userId));
			$this->User->Board->createBoard($data);
		}
	}
	
	function _sendResetCode($user, $code) {
        $link = Router::url(array('controller' => 'reset_codes', 'action' => 'index', '?' => array('code' => $code['ResetCode']['code'])), true);
        $this->set(compact('user', 'link'));
        $name = $user['User']['first_name'] . ' ' . $user['User']['last_name'];
        $email = $user['User']['email'];
        return $this->_sendEmail(array($name, $email), __('Peers And Rivals Reset Password', true), 'reset_password');
	}
	
	function _sendAuthCode($user) {
		$code = $this->User->AuthCode->getCodeForUserId($user['User']['id']);
		if (!empty($code)) {
			$this->User->AuthCode->id = $code['AuthCode']['id'];
		} else {
			$this->User->AuthCode->create();
		}
		$codeStr = mt_rand(1000, 9999);
		$data = array( 'AuthCode' => array(
			'user_id' => $user['User']['id'],
			'code' => $codeStr
		));
		if ($this->User->AuthCode->save($data)) {
			$message = "PeersAndRivals: Enter this verification code to finish registration: $codeStr";
			$this->Messenger->sendSMS($user['User']['phone'], $message);
		}
	}
				
	
	// @Admin
	function admin_login() {
		if (!empty($this->data)) {
			$email = $this->data['User']['email'];
			$password = $this->data['User']['password'];
			$user = $this->User->getUserWithEmailAndPassword($email, $password);
			if (!empty($user)) {
				$this->Session->write('user_id', $user['User']['id']);
				$this->redirect('/admin');
				return;
			} else {
				$this->Session->setFlash(__('Incorect login or password', true));
			}
		}	
	}
	
	function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		$groups = $this->User->Group->find('list');
		$boardMemberships = $this->User->BoardMembership->find('list');
		$networkMemberships = $this->User->NetworkMembership->find('list');
		$this->set(compact('groups', 'boardMemberships', 'networkMemberships'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$groups = $this->User->Group->find('list');
		$boardMemberships = $this->User->BoardMembership->find('list');
		$networkMemberships = $this->User->NetworkMembership->find('list');
		$this->set(compact('groups', 'boardMemberships', 'networkMemberships'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

}
