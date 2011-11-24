<?php
/* AuthenticationCode Fixture generated on: 2011-06-29 18:33:45 : 1309386825 */
class AuthenticationCodeFixture extends CakeTestFixture {
	var $name = 'AuthenticationCode';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'phone_number' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'code' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'id_UNIQUE' => array('column' => 'id', 'unique' => 1), 'code_UNIQUE' => array('column' => 'code', 'unique' => 1), 'status_INDEX' => array('column' => 'status', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'phone_number' => 'Lorem ipsum dolor sit amet',
			'code' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-06-29 18:33:45',
			'modified' => '2011-06-29 18:33:45',
			'status' => 1
		),
	);
}
