<?php
/* Board Test cases generated on: 2011-06-29 18:35:16 : 1309386916*/
App::import('Model', 'Board');

class BoardTestCase extends CakeTestCase {
	var $fixtures = array('app.board', 'app.user', 'app.users_board', 'app.board_invitation');

	function startTest() {
		$this->Board =& ClassRegistry::init('Board');
	}

	function endTest() {
		unset($this->Board);
		ClassRegistry::flush();
	}

}
