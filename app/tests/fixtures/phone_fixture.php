<?php
/* Phone Fixture generated on: 2011-06-29 18:38:11 : 1309387091 */
class PhoneFixture extends CakeTestFixture {
	var $name = 'Phone';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'is_primary' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'number' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'id_UNIQUE' => array('column' => 'id', 'unique' => 1), 'number_INDEX' => array('column' => 'number', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'is_primary' => 1,
			'number' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-06-29 18:38:11',
			'modified' => '2011-06-29 18:38:11'
		),
	);
}
