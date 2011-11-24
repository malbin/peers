<?php
/* AuthenticationCodes Test cases generated on: 2011-07-01 20:03:49 : 1309550629*/
App::import('Controller', 'AuthenticationCodes');

class TestAuthenticationCodesController extends AuthenticationCodesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class AuthenticationCodesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.authentication_code', 'app.user', 'app.group', 'app.board_invitation', 'app.board', 'app.users_board', 'app.job', 'app.employer', 'app.country', 'app.site_invite', 'app.compensation', 'app.network', 'app.users_network');

	function startTest() {
		$this->AuthenticationCodes =& new TestAuthenticationCodesController();
		$this->AuthenticationCodes->constructClasses();
	}

	function endTest() {
		unset($this->AuthenticationCodes);
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
