<?php
/* Compensations Test cases generated on: 2011-07-01 20:04:35 : 1309550675*/
App::import('Controller', 'Compensations');

class TestCompensationsController extends CompensationsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CompensationsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.compensation', 'app.job', 'app.user', 'app.group', 'app.authentication_code', 'app.board_invitation', 'app.board', 'app.users_board', 'app.network', 'app.users_network', 'app.employer', 'app.country', 'app.site_invite');

	function startTest() {
		$this->Compensations =& new TestCompensationsController();
		$this->Compensations->constructClasses();
	}

	function endTest() {
		unset($this->Compensations);
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
