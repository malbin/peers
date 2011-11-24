<?php
/* Compensation Fixture generated on: 2011-06-29 18:36:11 : 1309386971 */
class CompensationFixture extends CakeTestFixture {
	var $name = 'Compensation';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'job_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'currency' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 10, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'cash' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '10,2'),
		'type' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'deferred' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '10,2'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'id_UNIQUE' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'job_id' => 1,
			'currency' => 'Lorem ip',
			'cash' => 1,
			'type' => 'Lorem ipsum dolor sit amet',
			'deferred' => 1,
			'created' => '2011-06-29 18:36:11',
			'modified' => '2011-06-29 18:36:11'
		),
	);
}
