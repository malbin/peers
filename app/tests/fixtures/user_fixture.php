<?php
/* User Fixture generated on: 2011-06-29 18:38:45 : 1309387125 */
class UserFixture extends CakeTestFixture {
	var $name = 'User';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'first_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'last_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'birthdate' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'gender' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 3),
		'timezone' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'language' => array('type' => 'string', 'null' => false, 'default' => 'ENG', 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'avatar_url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'privacy_email' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'privacy_search' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'currency' => array('type' => 'string', 'null' => false, 'default' => 'USD', 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'group_id' => 1,
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'first_name' => 'Lorem ipsum dolor sit amet',
			'last_name' => 'Lorem ipsum dolor sit amet',
			'birthdate' => '2011-06-29',
			'gender' => 1,
			'timezone' => 1,
			'language' => 'Lorem ipsum dolor sit amet',
			'avatar_url' => 'Lorem ipsum dolor sit amet',
			'privacy_email' => 1,
			'privacy_search' => 1,
			'currency' => 'Lorem ipsum dolor sit amet',
			'status' => 1,
			'created' => '2011-06-29 18:38:45',
			'modified' => '2011-06-29 18:38:45'
		),
	);
}
