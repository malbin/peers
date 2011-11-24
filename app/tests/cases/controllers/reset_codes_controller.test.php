<?php
/* ResetCodes Test cases generated on: 2011-07-11 21:22:48 : 1310419368*/
App::import('Controller', 'ResetCodes');

class TestResetCodesController extends ResetCodesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ResetCodesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.reset_code', 'app.user', 'app.group', 'app.auth_code', 'app.board_invitation', 'app.board', 'app.users_board', 'app.job', 'app.employer', 'app.country', 'app.site_invite', 'app.compensation', 'app.network', 'app.users_network');

	function startTest() {
		$this->ResetCodes =& new TestResetCodesController();
		$this->ResetCodes->constructClasses();
	}

	function endTest() {
		unset($this->ResetCodes);
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
