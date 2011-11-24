<?php
/* Countries Test cases generated on: 2011-10-19 07:24:11 : 1319009051*/
App::import('Controller', 'Countries');

class TestCountriesController extends CountriesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CountriesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.country', 'app.job', 'app.user', 'app.group', 'app.auth_code', 'app.reset_code', 'app.board_invitation', 'app.board', 'app.board_notification', 'app.board_update', 'app.users_board', 'app.network', 'app.users_network', 'app.employer', 'app.compensation', 'app.site_invite');

	function startTest() {
		$this->Countries =& new TestCountriesController();
		$this->Countries->constructClasses();
	}

	function endTest() {
		unset($this->Countries);
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
