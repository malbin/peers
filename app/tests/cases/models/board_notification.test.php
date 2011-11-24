<?php
/* BoardNotification Test cases generated on: 2011-10-11 17:39:47 : 1318354787*/
App::import('Model', 'BoardNotification');

class BoardNotificationTestCase extends CakeTestCase {
	var $fixtures = array('app.board_notification', 'app.board', 'app.user', 'app.group', 'app.auth_code', 'app.reset_code', 'app.board_invitation', 'app.job', 'app.employer', 'app.country', 'app.site_invite', 'app.compensation', 'app.network', 'app.users_network', 'app.users_board');

	function startTest() {
		$this->BoardNotification =& ClassRegistry::init('BoardNotification');
	}

	function endTest() {
		unset($this->BoardNotification);
		ClassRegistry::flush();
	}

}
