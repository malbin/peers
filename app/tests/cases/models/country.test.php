<?php
/* Country Test cases generated on: 2011-10-19 07:23:42 : 1319009022*/
App::import('Model', 'Country');

class CountryTestCase extends CakeTestCase {
	var $fixtures = array('app.country', 'app.job', 'app.user', 'app.group', 'app.auth_code', 'app.reset_code', 'app.board_invitation', 'app.board', 'app.board_notification', 'app.board_update', 'app.users_board', 'app.network', 'app.users_network', 'app.employer', 'app.compensation', 'app.site_invite');

	function startTest() {
		$this->Country =& ClassRegistry::init('Country');
	}

	function endTest() {
		unset($this->Country);
		ClassRegistry::flush();
	}

}
