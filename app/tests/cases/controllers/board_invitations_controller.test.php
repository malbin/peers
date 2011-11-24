<?php
/* BoardInvitations Test cases generated on: 2011-07-01 20:04:05 : 1309550645*/
App::import('Controller', 'BoardInvitations');

class TestBoardInvitationsController extends BoardInvitationsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class BoardInvitationsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.board_invitation', 'app.user', 'app.group', 'app.authentication_code', 'app.board', 'app.users_board', 'app.job', 'app.employer', 'app.country', 'app.site_invite', 'app.compensation', 'app.network', 'app.users_network');

	function startTest() {
		$this->BoardInvitations =& new TestBoardInvitationsController();
		$this->BoardInvitations->constructClasses();
	}

	function endTest() {
		unset($this->BoardInvitations);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

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
