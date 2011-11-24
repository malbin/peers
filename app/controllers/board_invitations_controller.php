<?php
class BoardInvitationsController extends AppController {

	var $name = 'BoardInvitations';

	// @Public
	function index() {
		$this->view = null;
		$this->layout = null;
		
		$board_invitations = $this->BoardInvitation->getAllPendingForUserId($this->loggedUser['User']['id']);
		$this->set(compact('board_invitations'));
	}
	
	function view($id = null) {
		$this->view = null;
		$this->layout = null;
	
		if (!$id) {
			$this->Session->setFlash(__('Board not found', true));
			$this->cakeError('notFound');
		}
		$boardInvitation = $this->BoardInvitation->getWithId($id);
		if (empty($boardInvitation) ||
			($this->loggedUser['User']['id'] != $boardInvitation['BoardInvitation']['user_id']) ||
			BoardInvitation::STATUS_PENDING != $boardInvitation['BoardInvitation']['status']) 
		{
			$this->Session->setFlash(__('Board not found', true));
			$this->cakeError('forbidden');
		}
		$this->set('board_invitation', $boardInvitation);
	}
	
	function accept() {
		$id = @$this->data['BoardInvitation']['id'];
		$success = false;
		$errors = null;
		if (!$id) {
			$this->Session->setFlash(__('Board not found', true));
			$this->cakeError('notFound');
		}
		$boardInvitation = $this->BoardInvitation->getWithId($id);
		if (empty($boardInvitation) ||
			($this->loggedUser['User']['id'] != $boardInvitation['BoardInvitation']['user_id']) ||
			BoardInvitation::STATUS_PENDING != $boardInvitation['BoardInvitation']['status']) 
		{
			$this->Session->setFlash(__('Board not found', true));
			$this->cakeError('forbidden');
		}
		$this->BoardInvitation->id = $boardInvitation['BoardInvitation']['id'];
		$this->BoardInvitation->set('status', BoardInvitation::STATUS_ACCEPTED);
		$this->BoardInvitation->save();
		
		$boardId = $boardInvitation['BoardInvitation']['board_id'];
		$board = $this->BoardInvitation->Board->getWithId($boardId);
        if (empty($board)) {
            $this->Session->setFlash(__('Board not found', true));
            $this->cakeError('notFound');
        } elseif (in_array($boardInvitation['BoardInvitation']['user_id'], $board['MembersIds'])) {
            $success = true;
            $this->Session->setFlash(__('Already a member', true));
        } else {
			$data['Board']['id'] = $board['Board']['id'];
			$data['User']['User'] = array_merge($board['MembersIds'], array($boardInvitation['BoardInvitation']['user_id']));
            
            if ($this->User->isActiveAndSalaried($this->loggedUser['User']['id'])) {
                $boardMemberCount = $this->BoardInvitation->Board->getCountActiveAndSalariedUsers($board['Board']['id']) + 1; // +1 = New Joinee
                if ($boardMemberCount >= Configure::read('App.MinBoardMembers')) {
                    $data['Board']['expiry_date'] = null;
                    $sendNotification = true;
                }
            }
			$this->BoardInvitation->Board->id = $board['Board']['id'];
			if ($this->BoardInvitation->Board->save($data)) {
                if (isset($sendNotification) && $sendNotification) {
                    $this->Board->BoardNotification->createNotification($board['Board']['id'], $this->loggedUser['User']['id'], BoardNotification::CAUSE_USER_JOINED);
                }

				$success = true;
				$this->Session->setFlash(__('Board saved', true));
			} else {
				$errors = $this->BoardInvitation->Board->invalidFields();
			}
		}
		$this->set('form_result', array('success' => $success, 'errors' => $errors));
		$this->redirect('/boards', 201);
	}
	
	function decline() {
		$success = false;
		$errors = null;
		$id = @$this->data['BoardInvitation']['id'];
		if (!$id) {
			$this->Session->setFlash(__('Board not found', true));
			$this->cakeError('notFound');
		}
		$boardInvitation = $this->BoardInvitation->getWithId($id);
		if (empty($boardInvitation) ||
			($this->loggedUser['User']['id'] != $boardInvitation['BoardInvitation']['user_id']) ||
			BoardInvitation::STATUS_PENDING != $boardInvitation['BoardInvitation']['status']) 
		{
			$this->Session->setFlash(__('Board not found', true));
			$this->cakeError('forbidden');
		}
		$this->BoardInvitation->id = $boardInvitation['BoardInvitation']['id'];
		$this->BoardInvitation->set('status', BoardInvitation::STATUS_REJECTED);
		if ($this->BoardInvitation->save()) {
			$success = true;
		} else {
			$errors = $this->BoardInvitation->Board->invalidFields();
		}
		$this->set('form_result', array('success' => $success, 'errors' => $errors));
		$this->redirect('/board_invitations', 201);
	}

	// @Admin
	
	function admin_index() {
		$this->BoardInvitation->recursive = 0;
		$this->set('boardInvitations', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid board invitation', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('boardInvitation', $this->BoardInvitation->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->BoardInvitation->create();
			if ($this->BoardInvitation->save($this->data)) {
				$this->Session->setFlash(__('The board invitation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The board invitation could not be saved. Please, try again.', true));
			}
		}
		$inviters = $this->BoardInvitation->Inviter->find('list');
		$users = $this->BoardInvitation->User->find('list');
		$boards = $this->BoardInvitation->Board->find('list');
		$this->set(compact('inviters', 'users', 'boards'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid board invitation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->BoardInvitation->save($this->data)) {
				$this->Session->setFlash(__('The board invitation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The board invitation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->BoardInvitation->read(null, $id);
		}
		$inviters = $this->BoardInvitation->Inviter->find('list');
		$users = $this->BoardInvitation->User->find('list');
		$boards = $this->BoardInvitation->Board->find('list');
		$this->set(compact('inviters', 'users', 'boards'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for board invitation', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->BoardInvitation->delete($id)) {
			$this->Session->setFlash(__('Board invitation deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Board invitation was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
