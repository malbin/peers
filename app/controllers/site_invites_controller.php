<?php
class SiteInvitesController extends AppController {

	var $name = 'SiteInvites';

	var $components = array('Email');
	
	// @Public
	
	function index() {
		$success = false;
		$errors = null;
		if (!empty($this->data)) {
            if ($this->loggedUser) {
                $this->data['SiteInvite']['user_id'] = $this->loggedUser['User']['id'];
            }
			if ($this->SiteInvite->createSiteInvite($this->data)) {
				$this->Session->setFlash(__('The site invite has been saved', true));
				$success = true;
			} else {
				$this->Session->setFlash(__('The site invite could not be saved. Please, try again.', true));
				$errors = $this->SiteInvite->invalidFields();
			}
			$this->set('form_result', array('success' => $success, 'errors' => $errors));
			if ($success) {
				$this->redirect('/', 201);
			}
		}
		$countries = $this->SiteInvite->Country->getList();
		$this->set(compact('countries'));
	}
	
	// @Private
	
	function _sendSignupCode($name, $email, $code, $inviterName = null) {
        //$link = Router::url(array('controller' => 'users', 'action' => 'signup', 'admin' => false, '?' => array('code' => $code)), true);
	$link = FULL_BASE_URL.'/signup/?code='.$code;
        if (empty($inviterName)) {
            $template = 'signup_invite';
        } else {
            $template = 'friend_invite';
            $this->set(compact('inviterName'));
        }
		$this->set(compact('name', 'link'));
		return $this->_sendEmail(array($name, $email), __('Peers And Rivals Invite', true), $template);
	}
    
    // @Crons
    
    function cron_dispatch() {
        if (!defined('CRON_DISPATCHER')) {
            $this->cakeError('notFound');
        }
        $this->layout = false;
        $this->autoRender = false;
        $siteInvites = $this->SiteInvite->getPendingScheduledInvites();
        $totalInvites = count($siteInvites);
        $sentInvites = 0;
        foreach ($siteInvites as $siteInvite) {
            $inviterName = '';
            if (!empty($siteInvite['SiteInvite']['user_id'])) {
                $inviterName = $siteInvite['User']['first_name'] . ' ' . $siteInvite['User']['last_name'];
            }
            if ($this->_sendSignupCode($siteInvite['SiteInvite']['name'], $siteInvite['SiteInvite']['email'], $siteInvite['SiteInvite']['code'], $inviterName)) {
				$this->SiteInvite->id = $siteInvite['SiteInvite']['id'];
				$this->SiteInvite->set('status', SiteInvite::STATUS_SENT);
				$this->SiteInvite->save();
                ++$sentInvites;
			}
        }
        echo "{$sentInvites} out of {$totalInvites} invites sent.";
    }
	
	// @Admin

	function admin_send($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid site invite', true));
			$this->redirect(array('action' => 'index'));
		}
		$siteInvite = $this->SiteInvite->getWithId($id);
		if (!empty($siteInvite)) {
            $inviterName = '';
            if (!empty($siteInvite['SiteInvite']['user_id'])) {
                $inviterName = $siteInvite['User']['first_name'] . ' ' . $siteInvite['User']['last_name'];
            }
			if ($this->_sendSignupCode($siteInvite['SiteInvite']['name'], $siteInvite['SiteInvite']['email'], $siteInvite['SiteInvite']['code'], $inviterName)) {
				$this->SiteInvite->id = $siteInvite['SiteInvite']['id'];
				$this->SiteInvite->set('status', SiteInvite::STATUS_SENT);
				$this->SiteInvite->save();
			}
		}
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_index() {
		$this->SiteInvite->recursive = 0;
		$this->set('siteInvites', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid site invite', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('siteInvite', $this->SiteInvite->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->SiteInvite->create();
			if ($this->SiteInvite->save($this->data)) {
				$this->Session->setFlash(__('The site invite has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The site invite could not be saved. Please, try again.', true));
			}
		}
		$countries = $this->SiteInvite->Country->find('list');
		$this->set(compact('countries'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid site invite', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SiteInvite->save($this->data)) {
				$this->Session->setFlash(__('The site invite has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The site invite could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SiteInvite->read(null, $id);
		}
		$countries = $this->SiteInvite->Country->find('list');
		$this->set(compact('countries'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for site invite', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SiteInvite->delete($id)) {
			$this->Session->setFlash(__('Site invite deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Site invite was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
}
