<?php
class ExchangeRate extends AppModel {
	var $name = 'ExchangeRate';
	var $displayField = 'currency_code';
	var $validate = array(
		'currency_code' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field is required.',
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'This currency code already exists.',
			),
		),
		'value_usd' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'Please enter a valid decimal.',
			),
		),
	);
    
    function convertToUSD($salary = 0, $currencyCode = 'USD') {
        $exchange = $this->findByCurrencyCode($currencyCode);
        if ($exchange) {
            return $salary * $exchange['ExchangeRate']['value_usd'];
        }
        return $salary;
    }
    
    function convertFromUSD($salary = 0, $currencyCode = 'USD') {
        $exchange = $this->findByCurrencyCode($currencyCode);
        if ($exchange) {
            if (empty($exchange['ExchangeRate']['value_usd'])) {
                return 0;
            }
            return $salary / $exchange['ExchangeRate']['value_usd'];
        }
        return $salary;
    }
}
