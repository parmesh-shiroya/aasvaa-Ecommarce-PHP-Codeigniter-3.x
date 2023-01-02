<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
/*
Alessandro Minoccheri
V 1.1.0
09-04-2014
https://github.com/AlessandroMinoccheri
 */
class Ccr {
	public function __construct() {
	}
	/**
	 * @param  $fromCurrency
	 * @param  $toCurrency
	 * @param  $amount
	 * @param  $saveIntoDb
	 * @param  $hourDifference
	 * @param  $twoDecimal
	 * @return mixed
	 */
	private function convert($fromCurrency, $toCurrency, $amount, $saveIntoDb = 1, $hourDifference = 1, $twoDecimal = 1) {
		if ($fromCurrency != $toCurrency) {
			$CI   = &get_instance();
			$rate = 0;
			if ($fromCurrency == "PDS") {
				$fromCurrency = "GBP";
			}
			if ($saveIntoDb == 1) {
				$this->_checkIfExistTable();
				$CI->db->select('*');
				$CI->db->from('currency_converter');
				$CI->db->where('from', $fromCurrency);
				$CI->db->where('to', $toCurrency);
				$query = $CI->db->get();
				$find  = 0;
				foreach ($query->result() as $row) {
					$find        = 1;
					$lastUpdated = $row->modified;
					$now         = date('Y-m-d H:i:s');
					$dStart      = new DateTime($now);
					$dEnd        = new DateTime($lastUpdated);
					$diff        = $dStart->diff($dEnd);
					if (((int) $diff->y >= 1) || ((int) $diff->m >= 1) || ((int) $diff->d >= 1) || ((int) $diff->h >= $hourDifference) || ((double) $row->rates == 0)) {
						$rate = $this->_getRates($fromCurrency, $toCurrency);
						$data = array(
							'from'     => $fromCurrency,
							'to'       => $toCurrency,
							'rates'    => $rate,
							'modified' => date('Y-m-d H:i:s'),
						);
						$CI->db->where('id', $row->id);
						$CI->db->update('currency_converter', $data);
					} else {
						$rate = $row->rates;
					}
				}
				if ($find == 0) {
					$rate = $this->_getRates($fromCurrency, $toCurrency);
					$data = array(
						'from'     => $fromCurrency,
						'to'       => $toCurrency,
						'rates'    => $rate,
						'created'  => date('Y-m-d H:i:s'),
						'modified' => date('Y-m-d H:i:s'),
					);
					$CI->db->insert('currency_converter', $data);
				}
				$value = (double) $rate * (double) $amount;
				if ($twoDecimal == 1) {
					return number_format((double) $value, 2, '.', '');
				} else {
					return $value;
				}

			} else {
				$rate  = $this->_getRates($fromCurrency, $toCurrency);
				$value = (double) $rate * (double) $amount;
				if ($twoDecimal == 1) {
					return number_format((double) $value, 2, '.', '');
				} else {
					return $value;
				}

			}
		} else {
			if ($twoDecimal == 1) {
				return number_format((double) $amount, 2, '.', '');
			} else {
				return $amount;
			}

		}
	}
	/**
	 * @param $amount
	 */
	private function convert_into_two_decimal($amount) {
		return number_format((double) $value, 2, '.', '');
	}
	/**
	 * @param  $fromCurrency
	 * @param  $toCurrency
	 * @param  $amount
	 * @param  $saveIntoDb
	 * @param  $hourDifference
	 * @param  $twoDecimal
	 * @return mixed
	 */
	public function cc2($fromCurrency, $toCurrency, $amount, $saveIntoDb = 1, $hourDifference = 1, $twoDecimal = 1) {
		return $this->convert($fromCurrency, $toCurrency, $amount, $saveIntoDb, $hourDifference, $twoDecimal);
	}
	/**
	 * @param  $fromCurrency
	 * @param  $toCurrency
	 * @param  $amount
	 * @param  $saveIntoDb
	 * @param  $hourDifference
	 * @param  $twoDecimal
	 * @return mixed
	 */
	public function cc($fromCurrency, $toCurrency, $amount, $saveIntoDb = 1, $hourDifference = 1, $twoDecimal = 1) {
		$con_amount = $this->convert($fromCurrency, $toCurrency, $amount, $saveIntoDb, $hourDifference, $twoDecimal);
		switch ($toCurrency) {
		case 'USD':
			$fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
			return $fmt->formatCurrency($con_amount, "USD");
			break;
		case 'INR':
			$fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
			return $fmt->formatCurrency($con_amount, "INR");
			break;
		case 'EUR':
			$fmt = new NumberFormatter('en_150', NumberFormatter::CURRENCY);
			return $fmt->formatCurrency($con_amount, "EUR");
			break;
		case 'GBP':
			$fmt = new NumberFormatter('en_IO', NumberFormatter::CURRENCY);
			return $fmt->formatCurrency($con_amount, "GBP");
			break;
		case 'AUD':
			$fmt = new NumberFormatter('en_AU', NumberFormatter::CURRENCY);
			return $fmt->formatCurrency($con_amount, "AUD");
			break;
		case 'CAD':
			$fmt = new NumberFormatter('en_CA', NumberFormatter::CURRENCY);
			return $fmt->formatCurrency($con_amount, "CAD");
			break;
		case 'SGD':
			$fmt = new NumberFormatter('en_SG', NumberFormatter::CURRENCY);
			return $fmt->formatCurrency($con_amount, "SGD");
			break;
		case 'NZD':
			$fmt = new NumberFormatter('en_NZ', NumberFormatter::CURRENCY);
			return $fmt->formatCurrency($con_amount, "NZD");
			break;
		case 'FJD':
			$fmt = new NumberFormatter('en_FJ', NumberFormatter::CURRENCY);
			return $fmt->formatCurrency($con_amount, "FJD");
			break;
		case 'ZAR':
			$fmt = new NumberFormatter('en_ZA', NumberFormatter::CURRENCY);
			return $fmt->formatCurrency($con_amount, "ZAR");
			break;
		case 'MYR':
			$fmt = new NumberFormatter('en_MY', NumberFormatter::CURRENCY);
			return $fmt->formatCurrency($con_amount, "MYR");
			break;
		case 'AED':
			$fmt = new NumberFormatter('en_AE', NumberFormatter::CURRENCY);
			return $fmt->formatCurrency($con_amount, "AED");
			break;
		case 'MUR':
			$fmt = new NumberFormatter('en_MU', NumberFormatter::CURRENCY);
			return $fmt->formatCurrency($con_amount, "MUR");
			break;
		case 'LKR':
			$fmt = new NumberFormatter('ta_LK', NumberFormatter::CURRENCY);
			return $fmt->formatCurrency($con_amount, "LKR");
			break;
		default:
			$fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
			return $fmt->formatCurrency($con_amount, "INR");
			break;
		}

	}

	/**
	 * @return mixed
	 */
	public function get_all_country_currency() {
		$currencys = array('USD', 'INR', 'EUR', 'GBP', 'AUD', 'CAD', 'SGD', 'NZD', 'FJD', 'ZAR', 'MYR', 'AED', 'MUR', 'LKR');
		foreach ($currencys as $key => $value) {
			$currencys_value[$value] = $this->convert('INR', $value, '1', 0, 1, 0);
		}
		return $currencys_value;
	}
	/**
	 * @param  $currency_choose
	 * @return mixed
	 */
	public function get_country_currency_symbol($currency_choose = "all") {
		$currencys_symbol = array(
			'USD' => '$',
			'INR' => '&#8377',
			'EUR' => '&#8364',
			'GBP' => '&#x00A3;',
			'AUD' => '$',
			'CAD' => '$',
			'SGD' => '$',
			'NZD' => '$',
			'FJD' => '$',
			'ZAR' => 'R',
			'MYR' => 'RM',
			'AED' => 'AED',
			'MUR' => '&#8360',
			'LKR' => '&#8360');
		if ($currency_choose != "all") {
			return $currencys_symbol[$currency_choose];

		} else {
			return $currencys_symbol;
		}

	}

	/**
	 * @param $fromCurrency
	 * @param $toCurrency
	 */
	private function _getRates($fromCurrency, $toCurrency) {
		$url    = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=' . $fromCurrency . $toCurrency . '=X';
		$handle = @fopen($url, 'r');
		if ($handle) {
			$result = fgets($handle, 4096);
			fclose($handle);
		}
		if (isset($result)) {
			$allData = explode(',', $result); /* Get all the contents to an array */
			$rate    = $allData[1];
		} else {
			$rate = $this->currencyConverter($fromCurrency, $toCurrency);
		}
		return ($rate);
	}
	/**
	 * @param  $currency_from
	 * @param  $currency_to
	 * @return mixed
	 */
	private function currencyConverter($currency_from, $currency_to) {
		$yql_base_url  = "http://query.yahooapis.com/v1/public/yql";
		$yql_query     = 'select * from yahoo.finance.xchange where pair in ("' . $currency_from . $currency_to . '")';
		$yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
		$yql_query_url .= "&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
		$yql_session = curl_init($yql_query_url);
		curl_setopt($yql_session, CURLOPT_RETURNTRANSFER, true);
		$yqlexec         = curl_exec($yql_session);
		$yql_json        = json_decode($yqlexec, true);
		$currency_output = $yql_json['query']['results']['rate']['Rate'];
		return $currency_output;
	}
	private function _checkIfExistTable() {
		$CI = &get_instance();
		if ($CI->db->table_exists('currency_converter')) {
			return (true);
		} else {
			$CI->load->dbforge();
			$CI->dbforge->add_field(array(
				'id'       => array(
					'type'           => 'INT',
					'constraint'     => 11,
					'unsigned'       => TRUE,
					'auto_increment' => TRUE,
				),
				'from'     => array(
					'type'       => 'VARCHAR',
					'constraint' => '5',
					'null'       => FALSE,
				),
				'to'       => array(
					'type'       => 'VARCHAR',
					'constraint' => '5',
					'null'       => FALSE,
				),
				'rates'    => array(
					'type'       => 'VARCHAR',
					'constraint' => '10',
					'null'       => FALSE,
				),
				'created'  => array(
					'type' => 'DATETIME',
				),
				'modified' => array(
					'type' => 'DATETIME',
				),
			));
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('currency_converter', TRUE);
		}
	}

	/**
	 * @param $old_c_price
	 * @param $ruppes
	 */
	public function cfa($old_c_price, $ruppes, $currency_choose = '', $symbol = true) {
		if (empty($currency_choose)) {
			$currency_choose = $_SESSION['currency_choose'];
		}
		$return_data = number_format((float) $old_c_price[$currency_choose] * round($ruppes), 2, '.', '');
		if ($symbol) {
			$return_data = $this->get_country_currency_symbol($currency_choose) . ' ' . number_format((float) $old_c_price[$currency_choose] * round($ruppes), 2, '.', '');
		}
		return $return_data;
	}

}
?>