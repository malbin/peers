<?php
/* Networks Test cases generated on: 2011-07-01 20:05:41 : 1309550741*/
App::import('Controller', 'Networks');

class TestNetworksController extends NetworksController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class NetworksControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.network', 'app.user', 'app.group', 'app.authentication_code', 'app.board_invitation', 'app.board', 'app.users_board', 'app.job', 'app.employer', 'app.country', 'app.site_invite', 'app.compensation', 'app.users_network');

	function startTest() {
		$this->Networks =& new TestNetworksController();
		$this->Networks->constructClasses();
	}

	function endTest() {
		unset($this->Networks);
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
