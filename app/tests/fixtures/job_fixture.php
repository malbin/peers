<?php
/* Job Fixture generated on: 2011-06-29 18:36:53 : 1309387013 */
class JobFixture extends CakeTestFixture {
	var $name = 'Job';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'employer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'department' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'salary' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '10,2'),
		'currency' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 10, 'collate' => 'utf8_general_ci', 'comment' => 'USD, GBP, EUR, PLN...', 'charset' => 'utf8'),
		'start_date' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'end_date' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'id_UNIQUE' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'employer_id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'department' => 'Lorem ipsum dolor sit amet',
			'salary' => 1,
			'currency' => 'Lorem ip',
			'start_date' => '2011-06-29',
			'end_date' => '2011-06-29',
			'created' => '2011-06-29 18:36:53',
			'modified' => '2011-06-29 18:36:53'
		),
	);
}
