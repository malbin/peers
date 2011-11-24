<?php
/* BoardUpdates Test cases generated on: 2011-10-15 02:44:33 : 1318646673*/
App::import('Controller', 'BoardUpdates');

class TestBoardUpdatesController extends BoardUpdatesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class BoardUpdatesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.board_update', 'app.board', 'app.user', 'app.group', 'app.auth_code', 'app.reset_code', 'app.board_invitation', 'app.board_notification', 'app.job', 'app.employer', 'app.country', 'app.site_invite', 'app.compensation', 'app.network', 'app.users_network', 'app.users_board');

	function startTest() {
		$this->BoardUpdates =& new TestBoardUpdatesController();
		$this->BoardUpdates->constructClasses();
	}

	function endTest() {
		unset($this->BoardUpdates);
		ClassRegistry::flush();
	}

	function testAdminIndex() {

	}

	function testAdminView() {

	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
