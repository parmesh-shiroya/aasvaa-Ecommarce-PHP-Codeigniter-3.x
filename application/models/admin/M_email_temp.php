<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_email_temp extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}
	/**
	 * @param  $key
	 * @param  $value
	 * @return mixed
	 */
	public function update_mail_templete_data($key, $value) {
		return $this->db->where('email_name', $key)->update('email_templete_data', array('email_data' => $value));
	}

	/**
	 * @param $name
	 * @return mixed
	 */
	public function get_email_data($name) {
		return $this->db->where('email_name', $name)->get('email_templete_data')->row();
	}
}