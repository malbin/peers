<?php
/* BoardInvitation Fixture generated on: 2011-06-29 18:34:31 : 1309386871 */
class BoardInvitationFixture extends CakeTestFixture {
	var $name = 'BoardInvitation';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'board_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'status' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'id_UNIQUE' => array('column' => 'id', 'unique' => 1), 'status_INDEX' => array('column' => 'status', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'board_id' => 1,
			'status' => 1,
			'created' => '2011-06-29 18:34:31',
			'modified' => '2011-06-29 18:34:31'
		),
	);
}
