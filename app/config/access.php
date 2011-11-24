<?php
/**
 * Access Permissions config:
 * To allow access to certain action add entry in format:
 *   'controller' => array('action')
 *
 */
    // Unauthorized users
	Configure::write('Access.PublicPages', array(
		'home'                  => array('index', 'validation'),
		'users'                 => array('login', 'logout', 'signup', 'forgot_password', 'admin_login'),
		'site_invites'          => array('index', 'cron_dispatch'),
		'reset_codes'           => array('index'),
        'pages'                 => array('display'),
        'jobs'                  => array('autocomplete', 'location'),
        'employers'             => array('autocomplete'),
        'board_notifications'   => array('cron_notify')
	));
    
    // Disallow logged-in users
    Configure::write('Access.PublicPagesOnly', array(
        'home' => array('index'),
        'users' => array('signup', 'forgot_password')
    ));
    
    // Authorized users but not verified
	Configure::write('Access.PrivatePagesUnverified', array(
		'auth_codes' => array('verify'),
		'users' => array('update_phone', 'resend_auth_code')
	));
	
/**
 * All other pages are private
 */ 
	