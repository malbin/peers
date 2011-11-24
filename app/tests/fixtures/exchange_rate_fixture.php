<?php
/* ExchangeRate Fixture generated on: 2011-10-19 07:25:34 : 1319009134 */
class ExchangeRateFixture extends CakeTestFixture {
	var $name = 'ExchangeRate';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'currency_code' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'unique', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'value_usd' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '10,2'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'currency_code' => array('column' => 'currency_code', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'currency_code' => 'Lorem ips',
			'value_usd' => 1
		),
	);
}
