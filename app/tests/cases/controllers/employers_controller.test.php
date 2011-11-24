<?php
/* Employers Test cases generated on: 2011-07-01 20:05:10 : 1309550710*/
App::import('Controller', 'Employers');

class TestEmployersController extends EmployersController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class EmployersControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.employer', 'app.job', 'app.user', 'app.group', 'app.authentication_code', 'app.board_invitation', 'app.board', 'app.users_board', 'app.network', 'app.users_network', 'app.country', 'app.site_invite', 'app.compensation');

	function startTest() {
		$this->Employers =& new TestEmployersController();
		$this->Employers->constructClasses();
	}

	function endTest() {
		unset($this->Employers);
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
