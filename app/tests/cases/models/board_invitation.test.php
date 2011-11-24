<?php
/* BoardInvitation Test cases generated on: 2011-06-29 18:34:31 : 1309386871*/
App::import('Model', 'BoardInvitation');

class BoardInvitationTestCase extends CakeTestCase {
	var $fixtures = array('app.board_invitation', 'app.user', 'app.group', 'app.board', 'app.users_board', 'app.job', 'app.employer', 'app.compensation', 'app.network', 'app.users_network', 'app.phone');

	function startTest() {
		$this->BoardInvitation =& ClassRegistry::init('BoardInvitation');
	}

	function endTest() {
		unset($this->BoardInvitation);
		ClassRegistry::flush();
	}

}
