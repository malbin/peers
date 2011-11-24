<?php
/* BoardNotification Fixture generated on: 2011-10-11 17:39:47 : 1318354787 */
class BoardNotificationFixture extends CakeTestFixture {
	var $name = 'BoardNotification';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'board_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'status_INDEX' => array('column' => 'status', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'board_id' => 1,
			'created' => '2011-10-11 17:39:47',
			'modified' => '2011-10-11 17:39:47'
		),
	);
}
