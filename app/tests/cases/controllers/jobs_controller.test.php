<?php
/* Jobs Test cases generated on: 2011-07-01 20:05:26 : 1309550726*/
App::import('Controller', 'Jobs');

class TestJobsController extends JobsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class JobsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.job', 'app.user', 'app.group', 'app.authentication_code', 'app.board_invitation', 'app.board', 'app.users_board', 'app.network', 'app.users_network', 'app.employer', 'app.country', 'app.site_invite', 'app.compensation');

	function startTest() {
		$this->Jobs =& new TestJobsController();
		$this->Jobs->constructClasses();
	}

	function endTest() {
		unset($this->Jobs);
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
