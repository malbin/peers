<?php

class AppModel extends Model {

	function getWithId($id) {
		return $this->find('first', array(
			'conditions' => array(
				$this->name.'.id' => $id
			)
		));
	}
	
	function getList() {
		return $this->find('list');
	}
	
	//  Cache disabled for development, @TC
	// function find($conditions = null, $fields = array(), $order = null, $recursive = null) {
	//     	$data = $this->_readCache($fields);
	//     	if (false === $data) {
	//     		$data = parent::find($conditions, $fields, $order, $recursive);
	//     		$this->_writeCache($fields, $data);
	//     	}
	//  		return $data;
	//     }
    
    function query($query, $fields = array()) {
    	$data = $this->_readCache($fields);
    	if (false === $data) {
    		$data = parent::query($query);
    		$this->_writeCache($fields, $data);
    	}
    	return $data;
    }
    
    function _readCache($fields) {
    	$data = false;
    	if (!empty($fields['cache'])) {
  			$cacheConfig = null;
  			// check if we have specified a custom config, e.g. different expiry time
	  		if (!empty($fields['cacheConfig'])) {
	      		$cacheConfig = $fields['cacheConfig'];
	  		}
	  		$cacheName = $this->name . '-' . $fields['cache'];
		    $data = Cache::read($cacheName, $cacheConfig);
     	}
     	return $data;
    }
    
    function _writeCache($fields, $data) {
    	if (!empty($fields['cache'])) {
  			$cacheConfig = null;
  			// check if we have specified a custom config, e.g. different expiry time
	  		if (!empty($fields['cacheConfig'])) {
	      		$cacheConfig = $fields['cacheConfig'];
	  		}
	  		$cacheName = $this->name . '-' . $fields['cache'];
	     	Cache::write($cacheName, $data, $cacheConfig);
     	}
    }
    
    function _deleteCache($fields) {
    	foreach($fields as $field) {
	  		$cacheName = $this->name . '-' . $field;
	     	Cache::delete($cacheName);
    	}
    }
    
}