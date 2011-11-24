<?php
/* Job Test cases generated on: 2011-06-29 18:36:53 : 1309387013*/
App::import('Model', 'Job');

class JobTestCase extends CakeTestCase {
	var $fixtures = array('app.job', 'app.user', 'app.employer', 'app.compensation');

	function startTest() {
		$this->Job =& ClassRegistry::init('Job');
	}

	function endTest() {
		unset($this->Job);
		ClassRegistry::flush();
	}

}
