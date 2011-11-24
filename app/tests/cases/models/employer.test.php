<?php
/* Employer Test cases generated on: 2011-06-30 14:44:45 : 1309445085*/
App::import('Model', 'Employer');

class EmployerTestCase extends CakeTestCase {
	var $fixtures = array('app.employer', 'app.job', 'app.user', 'app.group', 'app.board_invitation', 'app.board', 'app.users_board', 'app.network', 'app.users_network', 'app.phone', 'app.compensation');

	function startTest() {
		$this->Employer =& ClassRegistry::init('Employer');
	}

	function endTest() {
		unset($this->Employer);
		ClassRegistry::flush();
	}

}
