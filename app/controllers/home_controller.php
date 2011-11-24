<?php

class HomeController extends AppController {
	
	var $name='Home';
	
	var $layout = 'homepage';
	
	var $uses = array('User', 'SiteInvite');
	
	function index() {
		$countries = $this->SiteInvite->Country->getSmsList();
		$this->set(compact('countries'));
	}
	
}