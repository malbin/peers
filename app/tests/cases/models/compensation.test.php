<?php
/* Compensation Test cases generated on: 2011-06-29 18:36:11 : 1309386971*/
App::import('Model', 'Compensation');

class CompensationTestCase extends CakeTestCase {
	var $fixtures = array('app.compensation', 'app.job');

	function startTest() {
		$this->Compensation =& ClassRegistry::init('Compensation');
	}

	function endTest() {
		unset($this->Compensation);
		ClassRegistry::flush();
	}

}
