<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Pp_login_varified {

	function __construct() {
		$this->CI = &get_instance();
	}
	/**
	 * @return mixed
	 */
	function customer_varified() {
		if (isset($this->CI->session->userdata('customer_data')['logged_in'])) {
			return $this->CI->session->userdata('customer_data')['logged_in'];
		}

	}

	/**
	 * @return mixed
	 */
	function admin_varified() {
		if (isset($this->CI->session->userdata('admin_login_data')['admin_logged_in'])) {
			return $this->CI->session->userdata('admin_login_data')['admin_logged_in'];
		}

	}

}
