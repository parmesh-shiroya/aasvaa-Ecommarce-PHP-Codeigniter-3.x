<?php
class My_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->header = $this->pp_loader_helper->get_top_message();
		$this->my_index();
	}

	public function my_index() {
		if (!isset($_SESSION['ip_country'])) {
			$_SESSION['ip_country'] = $this->my_get_country_by_ip();
		}
		if (!isset($_SESSION['currency_choose'])) {
			$con_cur   = $this->my_get_currency_by_con_code($this->my_get_country_by_ip());
			$currencys = array('USD', 'INR', 'EUR', 'GBP', 'AUD', 'CAD', 'SGD', 'NZD', 'FJD', 'ZAR', 'MYR', 'AED', 'MUR', 'LKR');
			if (!empty($con_cur) && is_array($con_cur)) {
				foreach ($con_cur as $key => $value) {
					if (in_array($value, $currencys)) {
						$_SESSION['currency_choose'] = $value;
						break;
					} else {
						$_SESSION['currency_choose'] = "USD";
					}
				}
			} else {
				$_SESSION['currency_choose'] = "USD";
			}
		}
	}

	/**
	 * @return mixed
	 */
	public function my_get_country_by_ip() {
		$ip = $_SERVER['REMOTE_ADDR'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, 'http://ipinfo.io/' . $ip . '/json');
		$result = curl_exec($ch);
		curl_close($ch);
		if ($ip != "::1" && isset(json_decode($result)->country)) {
			$_SESSION['region'] = json_decode($result)->region;
			return $country     = json_decode($result)->country;
		} else {
			$_SESSION['region'] = "Other";
			return "IN";

		}
	}

	/**
	 * @param  $country_code
	 * @return mixed
	 */
	public function my_get_currency_by_con_code($country_code = "US") {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, 'https://restcountries.eu/rest/v1/alpha?codes=' . $country_code);
		$result = curl_exec($ch);
		curl_close($ch);
		if (isset(json_decode($result)[0]->currencies)) {
			$country = json_decode($result)[0]->currencies;
			return $country;
		} else {
			return 'USD';
		}

	}

}