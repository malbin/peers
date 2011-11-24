<?php
/* BoardUpdate Fixture generated on: 2011-10-15 02:44:16 : 1318646656 */
class BoardUpdateFixture extends CakeTestFixture {
	var $name = 'BoardUpdate';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'board_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'last_viewed' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'board_id' => 1,
			'user_id' => 1,
			'last_viewed' => '2011-10-15 02:44:16',
			'created' => '2011-10-15 02:44:16',
			'modified' => '2011-10-15 02:44:16'
		),
	);
}
