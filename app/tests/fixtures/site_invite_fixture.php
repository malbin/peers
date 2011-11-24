<?php
/* SiteInvite Fixture generated on: 2011-06-30 14:44:59 : 1309445099 */
class SiteInviteFixture extends CakeTestFixture {
	var $name = 'SiteInvite';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'country_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 3),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'id_UNIQUE' => array('column' => 'id', 'unique' => 1), 'email_INDEX' => array('column' => 'email', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'country_id' => 1,
			'email' => 'Lorem ipsum dolor sit amet',
			'name' => 'Lorem ipsum dolor sit amet',
			'status' => 1,
			'created' => '2011-06-30 14:44:59',
			'modified' => '2011-06-30 14:44:59'
		),
	);
}
