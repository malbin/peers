<?php
/* ExchangeRate Test cases generated on: 2011-10-19 07:25:34 : 1319009134*/
App::import('Model', 'ExchangeRate');

class ExchangeRateTestCase extends CakeTestCase {
	var $fixtures = array('app.exchange_rate');

	function startTest() {
		$this->ExchangeRate =& ClassRegistry::init('ExchangeRate');
	}

	function endTest() {
		unset($this->ExchangeRate);
		ClassRegistry::flush();
	}

}
