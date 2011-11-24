<?php

class DashboardController extends AppController {
	var $name = 'Dashboard';
	
	var $layout = 'dashboard';
	
	var $uses = array();
	
	var $helpers = array('Time','Format','Text');
	
	function index() {
        $this->User->updateLastLoggedIn($this->loggedUser['User']['id']);
        
		$jobs = $this->User->Job->getAllForUserId($this->loggedUser['User']['id']);
		$networks = $this->User->Network->getAllForUserId($this->loggedUser['User']['id']);
		
		// adds active job field for each user
		foreach ($networks as $n_key => $network) {
			foreach($network['User'] as $u_key => $network_user){
				$networks[$n_key]['User'][$u_key]['active_job'] = $this->User->Job->find('first', array( 'conditions' => array( 'user_id' => $network_user['id'] ), 'order' => 'start_date DESC', 'limit' => 1));
			}
		}
		
		$boards = $this->User->Board->getAllForUserId($this->loggedUser['User']['id']);
		foreach($boards as $b_id=>$board){
			$boards[$b_id]['ranking_salary'] = $this->User->Board->getSalaryRankingsForBoardId($board['Board']['id']);
			$boards[$b_id]['ranking_compensation'] = $this->User->Board->getCompensationRankingsForBoardId($board['Board']['id']);
		}
		$board_invitations = $this->User->BoardInvitation->getAllPendingForUserId($this->loggedUser['User']['id']);
        $countries = $this->User->Job->Country->getList();
		$user = $this->loggedUser['User'];
		$this->set(compact('jobs', 'networks', 'boards', 'board_invitations','countries','user'));
	}
	
	function admin_index() {
		
	}
}