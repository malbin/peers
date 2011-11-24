<?php

class MessengerComponent extends Object {
	var $name = 'Messenger';
	
	var $twilioClient;
	var $twilioCallerId;
	
	function initialize(&$controller, $settings = array()) {
		$this->controller =& $controller;
		
		App::import('Vendor', 'TwilioRest', array('file' =>'twilioRest'.DS.'Twilio.php'));
		$accountSid = Configure::read('TwilioMsgr.accountSid');
		$authToken = Configure::read('TwilioMsgr.authToken');
		$this->twilioCallerId = Configure::read('TwilioMsgr.callerId');
		$this->enableSMS = Configure::read('TwilioMsgr.enabled');
		$this->twilioClient = new Services_Twilio($accountSid, $authToken);
	}
	
	function sendSMS($to, $message) {
		if (!$this->enableSMS) {
			return false;
		}
		if (!is_array($to)) {
			$to = array($to);
		}
		$result = array();
		foreach($to as $number) {
			try {
				$sms = $this->twilioClient->account->sms_messages->create($this->twilioCallerId, $number, $message);
				$result[$number] = $sms->id;
			} catch (Exception $e) {
				$this->log($e->getMessage());
			}
		}
		return $result;
	}
}