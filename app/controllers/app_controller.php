<?php

class AppController extends Controller {
	
	var $components = array(
        'Session', 'RequestHandler', 'Email',
        'Cookie' => array(
            'name' => 'PNR',
            'time' => '365 Days'
        ),
    );
	
	var $loggedUser = null;
	
	var $uses = array('User');
	
	var $layout = 'dashboard';
	
	var $noLayout = false;		// if true: render only content
	var $isAjax = false;		// if true: render only content
	var $outputType = 'html';	// output types: html, json
	var $adminRoute = false;	
	
	var $view = 'Theme';
	
	// @Callback
	function beforeFilter() {
		parent::beforeFilter();
		$this->_reloadConfig();
		
		$this->isAjax = $this->RequestHandler->isAjax() || ('true' == @$this->params['url']['ajax']);
		$this->noLayout = ('true' == @$this->params['url']['no_layout']);
		$this->outputType = @$this->params['url']['output'];
		$this->adminRoute = ('admin' == @$this->params['prefix']);
		
		$this->_reloadLoggedUser();
		$this->_checkPermissions();
	}
	
	function beforeRender() {
		parent::beforeRender();
		
		// Set this to 0 to enable json output for restricted pages.
		$hide_json = 1;
		
		$this->theme = "peers";
		if ('network_search' != $this->params['action']) { 
			$this->set('logged_user', $this->loggedUser);
		}
		if ($this->isAjax || $this->noLayout) {
			$this->layout = null;
		} elseif ($this->adminRoute) {
			$this->layout = 'admin';
		}
		
		if ('json' ==  $this->outputType) {
			// Check if this is a restricted function
			$controller = strtolower($this->params['controller']);
			$action = strtolower($this->params['action']);
			if (((($controller == 'dashboard') && ($action == 'index'))||
			    (($controller == 'home') && ($action == 'index'))
			   )&& ($hide_json == 1)){
			echo 'Invalid Request';
			}
			else {
			echo json_encode($this->viewVars);
			}
			die();
		}
		$this->_prepareEnumFields();
  	}
  	
  	// @Overide
	function redirect($url, $status = null, $exit = true) {
		if (201 == $status && !$this->isAjax) {
			$status = 200;
		}
		$this->set('redirect', Router::url($url));
		if ('json' !=  $this->outputType) {
  			parent::redirect($url, $status, $exit);
		}
  	}
  	

  	// @Public
	function validation() {
  		$validation = array();
  		if (!empty($this->data)) {
  			$data = $this->data;
  			foreach($data as $modelName => $modelValues) {
  				$model = ClassRegistry::init($modelName);
  				$model->set(array($modelName => $modelValues));
				$valid = $model->validates();
				if (!$valid) {	
					$errors = $model->invalidFields();
				} else {
					$errors = null;
				}
				$validation[$modelName] = array('valid' => $valid, 'errors' => $errors);
  			}
  		}
  		$this->set(compact('validation'));
  	}
  	
  	// @Private
  	function _reloadLoggedUser() {
  		$user_id = $this->Session->read('user_id');
        if (!$user_id) {
            if ($rememberMeCookie = $this->Cookie->read('remember_me')) {
                if ($this->User->isValidRememberMeCookie($rememberMeCookie)) {
                    $user_id = $rememberMeCookie['id'];
                } else {
                    $this->Cookie->delete('remember_me');
                }
            }
        }
  		if ($user_id) {
  			$this->loggedUser = $this->User->getWithId($user_id);
  		}
  	}
  		
  	function _checkPermissions() {
  		$controller = strtolower($this->params['controller']);
  		$action = strtolower($this->params['action']);
  		
  		$logged = !empty($this->loggedUser);
  		$publicPages = Configure::read('Access.PublicPages');
        $publicPagesOnly = Configure::read('Access.PublicPagesOnly');
  		$privateUnverifiedPages = array_merge_recursive($publicPages, Configure::read('Access.PrivatePagesUnverified'));
  		
  		if (!$logged) {
	  		
	  		if (!isset($publicPages[$controller])) {
	  			$this->cakeError('forbidden');
			}
			if (!in_array($action, $publicPages[$controller])) {
				$this->cakeError('forbidden');
			}
  		} else {
  			$verified = ('active' == $this->loggedUser['User']['status']);
  			$isAdmin = (2 == $this->loggedUser['User']['group_id']);
  			if ($verified) {
  				if ($this->adminRoute && !$isAdmin) {
	  				$this->cakeError('forbidden');
	  			}
  			} else {
  				if (!isset($privateUnverifiedPages[$controller]) || !in_array($action, $privateUnverifiedPages[$controller])) {
					$this->redirect('/verify');
				}
  			}
            if (isset($publicPagesOnly[$controller]) && in_array($action, $publicPagesOnly[$controller])) {
                $this->redirect('/dashboard');
            }
        }
  	}
  	
  	// extracting enum fields values
  	function _prepareEnumFields() {
  		foreach($this->modelNames as $model) { 
			foreach($this->$model->_schema as $var => $field) { 
		        if(strpos($field['type'], 'enum') === FALSE) {
		        	continue;	
		        } 
		        preg_match_all("/\'([^\']+)\'/", $field['type'], $strEnum); 
		        if(is_array($strEnum[1])) { 
		          $varName = Inflector::camelize(Inflector::pluralize($var)); 
		          $varName[0] = strtolower($varName[0]); 
		          $this->set($varName, array_combine($strEnum[1], $strEnum[1])); 
		        } 
      		} 
	    } 
  	}
  	
  	function _reloadConfig() {
  		$this->loadModel('Config');
  		$options = $this->Config->find('all');
  		if (!empty($options)) foreach($options as $option) {
  			Configure::write($option['Config']['key'], $option['Config']['value']); 
  		}
  	}
  	
    /**
     * @param mixed $to If it's an array, the first element should indicate the name; second should be the email address.
     * @param string $subject
     * @param string $template If it's an array, the first element is the name of the template; second is the layout
     * @param array $attachments
     * @return <type>
     */
    function _sendEmail($to, $subject, $template, $attachments = null) {
        $siteEmail = Configure::read('App.Email');
        $this->Email->reset(); // Need to call this in for loop
        
        // Sends to either "NAME <EMAIL>" or "EMAIL <EMAIL>"
        // Note: Some SMTP servers do not accept the second format (no special characters '@' outside the angle brackets '< >')
        $name = $to;
        if (is_array($to)) {
            $name = $to[0];
            $to = $to[1];
        }
        $this->Email->to = "{$name} <{$to}>";
        
        $this->Email->subject = $subject;
        $this->Email->replyTo = $siteEmail;
        $this->Email->from = $siteEmail;
        
        if (is_array($template)) {
            $this->Email->template = $template[0];
            $this->Email->layout = $template[1];
        } else {
            $this->Email->template = $template;
            $this->Email->layout = 'default';
        }
        
        $this->Email->sendAs = 'both';
        if ($attachments) {
            $this->Email->attachments = $attachments;
        }
        // Uncomment and fill out to enable SMTP:
//        $this->Email->smtpOptions = array(
//            'port' => '25',
//            'timeout' => '30',
//            'host' => '',
//            'username' => '',
//            'password' => ''
//        );
//        $this->Email->delivery = 'smtp';
        $this->Email->send();
        if ($this->Email->smtpError) {
            $this->log($this->Email->smtpError);
            return false;
        }
        return true;
    }
	
}