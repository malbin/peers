<?php
/* SiteInvite Test cases generated on: 2011-06-30 14:45:00 : 1309445100*/
App::import('Model', 'SiteInvite');

class SiteInviteTestCase extends CakeTestCase {
	var $fixtures = array('app.site_invite');

	function startTest() {
		$this->SiteInvite =& ClassRegistry::init('SiteInvite');
	}

	function endTest() {
		unset($this->SiteInvite);
		ClassRegistry::flush();
	}

}
