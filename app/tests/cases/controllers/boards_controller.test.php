<?php
/* Boards Test cases generated on: 2011-07-01 20:04:24 : 1309550664*/
App::import('Controller', 'Boards');

class TestBoardsController extends BoardsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class BoardsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.board', 'app.user', 'app.group', 'app.authentication_code', 'app.board_invitation', 'app.job', 'app.employer', 'app.country', 'app.site_invite', 'app.compensation', 'app.network', 'app.users_network', 'app.users_board');

	function startTest() {
		$this->Boards =& new TestBoardsController();
		$this->Boards->constructClasses();
	}

	function endTest() {
		unset($this->Boards);
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
