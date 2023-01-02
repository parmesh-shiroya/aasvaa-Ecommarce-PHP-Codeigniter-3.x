<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Pp_helper {

	function __construct() {
		$this->CI = &get_instance();
		$this->CI->load->database();
	}
	/**
	 * @param  $array
	 * @param  $key
	 * @return mixed
	 */
	function min_data_with_key($array, $key) {
		if (!is_array($array) || count($array) == 0) {
			return false;
		}

		$min      = $array[0][$key];
		$new_data = array();
		foreach ($array as $key2 => $a) {
			if ($a[$key] == $min) {

				// $new_data = array_merge($new_data, array($a));
				array_push($new_data, $a);
			} elseif ($a[$key] < $min) {
				$min      = $a[$key];
				$new_data = array($a);
			}
		}
		return $new_data;
	}
	/**
	 * @param  $array
	 * @param  $key
	 * @return mixed
	 */
	function min_with_key($array, $key) {
		if (!is_array($array) || count($array) == 0) {
			return false;
		}

		$min = $array[0][$key];
		foreach ($array as $a) {
			if ($a[$key] < $min) {
				$min = $a[$key];
			}
		}
		return $min;
	}

	/**
	 * @param $data
	 * @param $value
	 */
	function selected($data, $value) {
		if ($data == $value) {
			echo " selected ";
		}
	}

	/**
	 * @param $number
	 * @param $significance
	 */
	function ceiling($number, $significance = 1) {
		return (is_numeric($number) && is_numeric($significance)) ? (ceil($number / $significance) * $significance) : false;
	}

	function substrwords($text, $maxchar, $end = '...') {
		if (strlen($text) > $maxchar || $text == '') {
			$words  = preg_split('/\s/', $text);
			$output = '';
			$i      = 0;
			while (1) {
				$length = strlen($output) + strlen($words[$i]);
				if ($length > $maxchar) {
					break;
				} else {
					$output .= " " . $words[$i];
					++$i;
				}
			}
			$output .= $end;
		} else {
			$output = $text;
		}
		return $output;
	}
}