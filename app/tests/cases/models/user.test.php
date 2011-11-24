<?php
/* User Test cases generated on: 2011-06-29 18:38:45 : 1309387125*/
App::import('Model', 'User');

class UserTestCase extends CakeTestCase {
	var $fixtures = array('app.user', 'app.group', 'app.board_invitation', 'app.board', 'app.users_board', 'app.job', 'app.employer', 'app.compensation', 'app.network', 'app.users_network', 'app.phone');

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function endTest() {
		unset($this->User);
		ClassRegistry::flush();
	}

}
