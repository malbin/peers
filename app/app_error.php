<?php

class AppError extends ErrorHandler {
	
	
	// method not allowed (requires POST or DELETE)
	function error405($params) {	
		$this->controller->layout = 'error';
		$this->controller->header("HTTP/1.0 405 Method Not Allowed");
		$this->_outputMessage('error405');
	}
	
	
	// forbidden
	function error403($params) {
		//header("HTTP/1.0 403 Forbidden");
		$this->controller->layout = 'error';
		header('Location: '.Router::url('/', true));
		die();
		//$this->controller->header("HTTP/1.0 403 Forbidden");
		//$this->_outputMessage('error404');
	}	
	
	// not found
	function error404($params) {
		$this->controller->layout = 'error';
		parent::error404($params);
	}

	// server error
	function error500($params) {
		$this->controller->layout = 'error';
		parent::error500(params);	
	}
	
	// ALIAS
	
	function forbidden($params) {
		self::error403($params);
	}
	
	function notFound($params) {
		self::error404($params);
	}
	
	function serverError($params) {
		self::error500($params);
	}
	
	function requiresPost($params) {
		self::error405($params);
	}
	
	function requireDelete($params) {
		self::error405($params);
	}
	
	function missingController($params) {
		$this->controller->layout = 'error';
		parent::error404($params);
	}
}