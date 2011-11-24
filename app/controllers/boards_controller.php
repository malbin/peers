<?php
class BoardsController extends AppController {

	var $name = 'Boards';

	var $layout = 'boards';
	
	var $helpers = array('Format', 'Text');
	
	// @Public
	
	function index() {
		$this->view = null;
		$this->layout = null;
	
		$boards = $this->Board->getAllForUserId($this->loggedUser['User']['id']);
		foreach ($boards as $b_key => $board) {
			$rank_data = $this->Board->getSalaryRankingsForBoardId($board['Board']['id']);
			$boards[$b_key]['Board']['count'] = count($rank_data);
		}
		$user = $this->loggedUser;
		$networks = $this->User->Network->getAllForUserId($this->loggedUser['User']['id']);
		
		// hide empty networks
		foreach($networks as $key=>$network){
			if(count($network['User']) == 0){
				unset($networks[$key]);
			}
		}
		$this->set(compact('boards','user','networks'));
	}

	function view($id = null) {
		$this->view = null;
		$this->layout = null;
		
		if (!$id) {
			$this->Session->setFlash(__('Board not found', true));
			$this->cakeError('notFound');
		}
		
		$board = $this->Board->getWithId($id);
		if (empty($board) || !in_array($this->loggedUser['User']['id'], $board['MembersIds'])) {
			$this->Session->setFlash(__('Board not found', true));
			$this->cakeError('forbidden');
		}
		$rankings_salary = $this->Board->getSalaryRankingsForBoardId($id);
		$rankings_compensation = $this->Board->getCompensationRankingsForBoardId($id);
        
		$logged_user_salary_ranking = null;
		foreach($rankings_salary as $rs) {
			if ($rs['User']['id'] == $this->loggedUser['User']['id']) {
				$logged_user_salary_ranking = $rs['Ranking'];
				break;
			}
		}
        
		$logged_user_compensation_ranking = null;
		foreach($rankings_compensation as $rc) {
			if ($rc['User']['id'] == $this->loggedUser['User']['id']) {
				$logged_user_compensation_ranking = $rc['Ranking'];
				break;
			}
		}
        
		$min_required_members = Configure::read('App.MinBoardMembers');
        $board_expiry_in_days = Configure::read('App.BoardExpiryInDays');
        
        $expires_in = null;
        if (!empty($board['Board']['expiry_date'])) {
            $expires_in = ceil((strtotime($board['Board']['expiry_date']) - time()) / 86400);
            $expires_in = ($expires_in <= 0 ? 1 : $expires_in); // Just in case the scheduler's off
        }
        
        // Update DB that user has seen this board
        $now = date('Y-m-d H:i:s');
        $this->Board->BoardUpdate->updateAll(
            array('BoardUpdate.last_viewed' => "'{$now}'"),
            array(
                'BoardUpdate.board_id' => $board['Board']['id'],
                'BoardUpdate.user_id' => $this->loggedUser['User']['id']
            )
        );
        
		$this->set(compact(
				'board', 'rankings_salary', 'rankings_compensation', 
				'logged_user_salary_ranking', 'logged_user_compensation_ranking',
				'min_required_members', 'expires_in'
		));
	}

	function add() {
		if (!empty($this->data)) {
			$success = false;
			$errors = null;
			
			$invitedUsers = @$this->data['User']['User'];
						
			$this->data['Board']['user_id'] = $this->loggedUser['User']['id'];
			$this->data['User']['User'] = array($this->loggedUser['User']['id']);
			if ($this->Board->createBoard($this->data)) {
				if (!empty($invitedUsers)) foreach($invitedUsers as $userId) {
					$this->_inviteUser($this->Board->id, $userId);
				}
				$success = true;
				$this->Session->setFlash(__('Board saved', true));
			} else {
				$errors = $this->Board->invalidFields();
			}
			$this->set('form_result', array('success' => $success, 'errors' => $errors));
			if ($success) {
                $this->redirect('/dashboard');
			}
		}
		$this->paginate = array(
			'limit' => 20
		);
		$users 		= $this->paginate('User');
		$networks 	= $this->User->Network->getAllForUserId($this->loggedUser['User']['id']);
		$boards = $this->User->Board->getAllForUserId($this->loggedUser['User']['id']);
		$board_invitations = $this->User->BoardInvitation->getAllPendingForUserId($this->loggedUser['User']['id']);
		$user = $this->loggedUser['User'];
		
		
		// adds active job field for each user
		foreach ($networks as $n_key => $network) {
			foreach($network['User'] as $u_key => $network_user){
				$networks[$n_key]['User'][$u_key]['LastJob'] = $this->User->Job->getLastJobForUserId($network_user['id']);
			}
		}
        
        foreach ($users as $u_key => $someUser) {
            $users[$u_key]['User']['LastJob'] = $this->User->Job->getLastJobForUserId($someUser['User']['id']);
        }
        
		$this->set(compact('users', 'networks', 'user', 'boards'));
	}

	function invite($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Board not found', true));
			$this->cakeError('notFound');
		}
		$board = $this->Board->getWithId($id);
        $demoBoardIds = array( Configure::read('App.MaleDemoBoardId'), Configure::read('App.FemaleDemoBoardId') );
		if (empty($board) || !in_array($this->loggedUser['User']['id'], $board['MembersIds']) || in_array($board['Board']['parent_id'], $demoBoardIds)) {
			$this->Session->setFlash(__('Board not found', true));
			$this->cakeError('forbidden');
		}
		if (!empty($this->data)) {
			$usersId = $this->data['User']['User'];
			$invitedUsers = 0;
			foreach($usersId as $uid) {
				// invite only if users isn't already memeber of this board
				if (!in_array($uid, $board['MembersIds'])) {
					if ($this->_inviteUser($board['Board']['id'], $uid)) {
						++$invitedUsers;
					}
				}
			}
			$success = (0 < $invitedUsers);
			$this->set('form_result', array('success' => $success));
            $this->redirect('/dashboard');
		} else {
            $this->data = $board;
            $boardInvitations = $board['BoardInvitation'];
            $this->data['User']['User'] = Set::combine($boardInvitations, '/user_id', '/user_id');
            foreach ($this->data['User']['User'] as $invitedUserId) {
                // Check if details have already been fetched from the DB
                $invitedUserDetails = Set::extract("/User[id={$invitedUserId}]", $this->data);
                if (!$invitedUserDetails) {
                    $invitedUserDetails = $this->User->getWithId($invitedUserId);
                    $this->data['User'][] = $invitedUserDetails['User'];
                }
            }
        }
		$this->paginate = array(
				'limit' => 20
		);
		$users = $this->paginate('User');
		$networks = $this->User->Network->getAllForUserId($this->loggedUser['User']['id']);
		$boards = $this->User->Board->getAllForUserId($this->loggedUser['User']['id']);
        $user = $this->loggedUser['User'];
		
		// adds active job field for each user
		foreach ($networks as $n_key => $network) {
			foreach($network['User'] as $u_key => $network_user){
				$networks[$n_key]['User'][$u_key]['LastJob'] = $this->User->Job->getLastJobForUserId($network_user['id']);
			}
		}
        
        foreach ($users as $u_key => $someUser) {
            $users[$u_key]['User']['LastJob'] = $this->User->Job->getLastJobForUserId($someUser['User']['id']);
        }
        
		$this->set(compact('users', 'networks', 'user', 'boards'));
	}
	
	function leave() {
		$id = @$this->data['Board']['id'];
		
		if (!$id) {
			$this->Session->setFlash(__('Board not found', true));
			$this->cakeError('notFound');
		}
		$board = $this->Board->getWithId($id);
		if (empty($board) || !in_array($this->loggedUser['User']['id'], $board['MembersIds'])) {
			$this->Session->setFlash(__('Board not found', true));
			$this->cakeError('forbidden');
		}
		
		$success = false;
		$errors = null;
        
		$data['Board']['id'] = $board['Board']['id'];
		$data['User']['User'] = array_merge(array_diff($board['MembersIds'], array($this->loggedUser['User']['id'])));
        
        if ($this->User->isActiveAndSalaried($this->loggedUser['User']['id'])) {
            $boardMemberCount = $this->Board->getCountActiveAndSalariedUsers($board['Board']['id']);
            $minRequiredMembers = Configure::read('App.MinBoardMembers');
            if ($boardMemberCount == $minRequiredMembers) { // At the edge, a leaving user becomes a problem.
                $boardExpiryInDays = Configure::read('App.BoardExpiryInDays');
                $data['Board']['expiry_date'] = date('Y-m-d H:i:s', strtotime("+{$boardExpiryInDays} days"));
            }
            if ($boardMemberCount >= $minRequiredMembers) {
                $sendNotification = true;
            }
        }
        
 		$this->Board->id = $board['Board']['id'];
		if ($this->Board->save($data)) {
            if (isset($sendNotification) && $sendNotification) {
                $this->Board->BoardNotification->createNotification($board['Board']['id'], $this->loggedUser['User']['id'], BoardNotification::CAUSE_USER_LEFT);
            }
            
			$success = true;
			$this->Session->setFlash(__('Board saved', true));
		} else {
			$errors = $this->Board->invalidFields();
		}
		$this->set('form_result', array('success' => $success, 'errors' => $errors));
		$this->redirect('/boards/index', 201);
	}
    
    function search_users() {
        $search_results = null;
		$query = @$this->params['url']['query'];
		$limit = @$this->params['names']['limit'];
		
		if (empty($query)) {
			$query = @$this->params['named']['query'];
		}
		if (!is_numeric($limit) || $limit < 2 || 50 < $limit) {
			$limit = 20;
		}
        $searchConditions = array();
		if (!empty($query)) {
			$searchConditions = $this->Board->User->getSearchConditionsForQuery($query);
		}
        $users = $this->Board->User->find('all', array(
            'conditions' => $searchConditions,
            'limit' => $limit,
            'recursive' => -1
        ));
        foreach($users as &$user) {
            $user['User']['LastJob'] = $this->Board->User->Job->getLastJobForUserId($user['User']['id']);
        }
        $this->set(compact('users', 'visible'));
        $this->render('/elements/boards/board_entry');
    }
	
	// @Private
	
	function _inviteUser($boardId, $userId) {
		$user = $this->User->getWithId($userId);
		if (!empty($user)) {
			$data = array('BoardInvitation' => array(
				'inviter_id' => $this->loggedUser['User']['id'],
				'user_id' => $userId,
				'board_id' => $boardId
			));
			if ($this->Board->BoardInvitation->createBoardInvitation($data)) {
				return true;	
			}
            $er = $this->Board->BoardInvitation->validationErrors;
            // var_dump($er);
		}
		return false;
	}
	
	// @Admin
	
	function admin_index() {
		$this->Board->recursive = 0;
		$this->set('boards', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid board', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('board', $this->Board->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Board->create();
			if ($this->Board->save($this->data)) {
				$this->Session->setFlash(__('The board has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The board could not be saved. Please, try again.', true));
			}
		}
		$owners = $this->Board->Owner->find('list');
		$users = $this->Board->User->find('list');
		$this->set(compact('owners', 'users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid board', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Board->save($this->data)) {
				$this->Session->setFlash(__('The board has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The board could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Board->read(null, $id);
		}
		$owners = $this->Board->Owner->find('list');
		$users = $this->Board->User->find('list');
		$this->set(compact('owners', 'users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for board', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Board->delete($id)) {
			$this->Session->setFlash(__('Board deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Board was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
