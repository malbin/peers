<?php
/* AuthenticationCode Test cases generated on: 2011-06-29 18:33:45 : 1309386825*/
App::import('Model', 'AuthenticationCode');

class AuthenticationCodeTestCase extends CakeTestCase {
	var $fixtures = array('app.authentication_code');

	function startTest() {
		$this->AuthenticationCode =& ClassRegistry::init('AuthenticationCode');
	}

	function endTest() {
		unset($this->AuthenticationCode);
		ClassRegistry::flush();
	}

}
