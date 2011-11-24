<?php
/* Phone Test cases generated on: 2011-06-29 18:38:11 : 1309387091*/
App::import('Model', 'Phone');

class PhoneTestCase extends CakeTestCase {
	var $fixtures = array('app.phone', 'app.user');

	function startTest() {
		$this->Phone =& ClassRegistry::init('Phone');
	}

	function endTest() {
		unset($this->Phone);
		ClassRegistry::flush();
	}

}
