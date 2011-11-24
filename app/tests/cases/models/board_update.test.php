<?php
/* BoardUpdate Test cases generated on: 2011-10-15 02:44:16 : 1318646656*/
App::import('Model', 'BoardUpdate');

class BoardUpdateTestCase extends CakeTestCase {
	var $fixtures = array('app.board_update', 'app.board', 'app.user', 'app.group', 'app.auth_code', 'app.reset_code', 'app.board_invitation', 'app.board_notification', 'app.job', 'app.employer', 'app.country', 'app.site_invite', 'app.compensation', 'app.network', 'app.users_network', 'app.users_board');

	function startTest() {
		$this->BoardUpdate =& ClassRegistry::init('BoardUpdate');
	}

	function endTest() {
		unset($this->BoardUpdate);
		ClassRegistry::flush();
	}

}
