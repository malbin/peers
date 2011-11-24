<?php
/* ExchangeRates Test cases generated on: 2011-10-19 07:25:51 : 1319009151*/
App::import('Controller', 'ExchangeRates');

class TestExchangeRatesController extends ExchangeRatesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ExchangeRatesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.exchange_rate', 'app.user', 'app.group', 'app.auth_code', 'app.reset_code', 'app.board_invitation', 'app.board', 'app.board_notification', 'app.board_update', 'app.users_board', 'app.job', 'app.employer', 'app.country', 'app.site_invite', 'app.compensation', 'app.network', 'app.users_network');

	function startTest() {
		$this->ExchangeRates =& new TestExchangeRatesController();
		$this->ExchangeRates->constructClasses();
	}

	function endTest() {
		unset($this->ExchangeRates);
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
