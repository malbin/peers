<?php
/* Network Test cases generated on: 2011-06-29 18:37:54 : 1309387074*/
App::import('Model', 'Network');

class NetworkTestCase extends CakeTestCase {
	var $fixtures = array('app.network', 'app.user', 'app.users_network');

	function startTest() {
		$this->Network =& ClassRegistry::init('Network');
	}

	function endTest() {
		unset($this->Network);
		ClassRegistry::flush();
	}

}
