<?php
/* BoardNotifications Test cases generated on: 2011-10-11 17:40:05 : 1318354805*/
App::import('Controller', 'BoardNotifications');

class TestBoardNotificationsController extends BoardNotificationsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class BoardNotificationsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.board_notification', 'app.board', 'app.user', 'app.group', 'app.auth_code', 'app.reset_code', 'app.board_invitation', 'app.job', 'app.employer', 'app.country', 'app.site_invite', 'app.compensation', 'app.network', 'app.users_network', 'app.users_board');

	function startTest() {
		$this->BoardNotifications =& new TestBoardNotificationsController();
		$this->BoardNotifications->constructClasses();
	}

	function endTest() {
		unset($this->BoardNotifications);
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
