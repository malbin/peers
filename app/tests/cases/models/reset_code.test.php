<?php
/* ResetCode Test cases generated on: 2011-07-11 21:21:43 : 1310419303*/
App::import('Model', 'ResetCode');

class ResetCodeTestCase extends CakeTestCase {
	var $fixtures = array('app.reset_code', 'app.user', 'app.group', 'app.auth_code', 'app.board_invitation', 'app.board', 'app.users_board', 'app.job', 'app.employer', 'app.country', 'app.site_invite', 'app.compensation', 'app.network', 'app.users_network');

	function startTest() {
		$this->ResetCode =& ClassRegistry::init('ResetCode');
	}

	function endTest() {
		unset($this->ResetCode);
		ClassRegistry::flush();
	}

}
