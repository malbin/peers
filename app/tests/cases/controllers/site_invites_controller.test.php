<?php
/* SiteInvites Test cases generated on: 2011-07-01 20:05:52 : 1309550752*/
App::import('Controller', 'SiteInvites');

class TestSiteInvitesController extends SiteInvitesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SiteInvitesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.site_invite', 'app.country', 'app.job', 'app.user', 'app.group', 'app.authentication_code', 'app.board_invitation', 'app.board', 'app.users_board', 'app.network', 'app.users_network', 'app.employer', 'app.compensation');

	function startTest() {
		$this->SiteInvites =& new TestSiteInvitesController();
		$this->SiteInvites->constructClasses();
	}

	function endTest() {
		unset($this->SiteInvites);
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
