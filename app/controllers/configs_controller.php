<?php

class ConfigsController extends AppController {
	var $name = 'Configs';
	
	function admin_index() {
		if (!empty($this->params['form']['config'])) {
			$data = array();
			foreach($this->params['form']['config'] as $key => $value) {
				$this->Config->id = $key;
				$this->Config->saveField('value', $value);
			}
			
		}
		$configs = $this->Config->find('all');
		$this->set('configs', $configs);
	}
	
}