<?php
class BoardNotificationsController extends AppController {

	var $name = 'BoardNotifications';
    
    function cron_notify() {
        if (!defined('CRON_DISPATCHER')) {
            $this->cakeError('notFound');
        }
        $this->layout = false;
        $this->autoRender = false;
        
        $belowMinimumReports = $this->BoardNotification->getBelowMinimumReports();
        $pendingReports = $this->BoardNotification->getPendingReports();
        $minRequiredMembers = Configure::read('App.MinBoardMembers');
        
        $i = 0;
        foreach ($belowMinimumReports as $belowMinimumReport) {
            $boardId = $belowMinimumReport['Board']['id'];
            $boardName = $belowMinimumReport['Board']['name'];
            $userName = $belowMinimumReport['User']['first_name'] . ' ' . $belowMinimumReport['User']['last_name'];
            $userEmail = $belowMinimumReport['User']['email'];
            $this->set(compact('boardId', 'boardName', 'userName'));
            if ($this->_sendEmail(array($userName, $userEmail), "Peers And Rivals: Your Board Has Dropped Below {$minRequiredMembers} Members!", array('below_minimum', 'alert'))) {
                ++$i;
            }
        }
        $count = count($belowMinimumReports);
        echo "{$i} / {$count} Expiry Notices sent.\r\n";
        
        $i = 0;
        foreach ($pendingReports as $pendingReport) {
            $reportCount = $pendingReport[0]['report_count'];
            $userName = $pendingReport['User']['first_name'] . ' ' . $pendingReport['User']['last_name'];
            $userEmail = $pendingReport['User']['email'];
            $this->set(compact('reportCount', 'userName'));
            if ($this->_sendEmail(array($userName, $userEmail), "Peers And Rivals: {$reportCount} New " . __n('Report', 'Reports', $reportCount, true), 'new_reports')) {
                ++$i;
            }
        }
        $count = count($pendingReports);
        echo "{$i} / {$count} Reports sent.\r\n";
    }

	function admin_index() {
		$this->BoardNotification->recursive = 0;
		$this->set('boardNotifications', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid board notification', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('boardNotification', $this->BoardNotification->read(null, $id));
	}
        
	function admin_add() {
		if (!empty($this->data)) {
			$this->BoardNotification->create();
			if ($this->BoardNotification->save($this->data)) {
				$this->Session->setFlash(__('The board notification has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The board notification could not be saved. Please, try again.', true));
			}
		}
		$boards = $this->BoardNotification->Board->find('list');
		$this->set(compact('boards'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid board notification', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->BoardNotification->save($this->data)) {
				$this->Session->setFlash(__('The board notification has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The board notification could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->BoardNotification->read(null, $id);
		}
		$boards = $this->BoardNotification->Board->find('list');
		$this->set(compact('boards'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for board notification', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->BoardNotification->delete($id)) {
			$this->Session->setFlash(__('Board notification deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Board notification was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
