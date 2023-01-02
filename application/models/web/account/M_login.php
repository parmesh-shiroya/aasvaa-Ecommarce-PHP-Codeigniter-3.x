<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Login extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	/**
	 * @param  array  Customer Data
	 * @return result of inser table
	 */
	public function register_customer($data = array()) {
		$data = array_merge($data, array('ip' => $_SERVER['REMOTE_ADDR'], 'date' => date('d-m-Y'), 'time' => date('h:i a'), 'month' => date('M-Y'), 'country' => $_SESSION['ip_country'], 'region' => $_SESSION['region']));
		return $this->db->insert('customers', $data);

	}
	/**
	 * @return mixed
	 */
	public function registr_customer_id() {
		return $this->db->insert_id();
	}
	/**
	 * @param  $emailid
	 * @param  $password
	 * @return full        row of table
	 */
	public function login_customer($emailid, $password) {
		if (!empty($emailid) && !empty($password)) {
			$this->db->where('email_id', $emailid);
			$this->db->where('password', $password);

			$result = $this->db->get('customers');
			return $result->row();
		}
	}

	/**
	 * @param $customer_id
	 */
	public function update_last_login_date($customer_id = 0) {
		$this->db->where('id', $customer_id);
		$this->db->update('customers', array('last_login' => date('d-m-Y')));
		$data = array(
			'customer_id' => $customer_id,
			'ip'          => $_SERVER['REMOTE_ADDR'],
			'date'        => date('d-m-Y'),
			'time'        => date('h:i a'),
			'month'       => date('M-Y'),
		);
		if (isset($_SESSION['ip_country']) && isset($_SESSION['report']['ftq']) && isset($_SESSION['region'])) {
			$data = array_merge($data, array(
				'country' => $_SESSION['ip_country'],
				'region'  => $_SESSION['region'],
				'uni_key' => $_SESSION['report']['ftq']));
		}
		$this->db->insert('rep_customer_login', $data);
	}

	/**
	 * @param  $email_id
	 * @param  $user_id
	 * @param  $login_by   'web' & 'facebook' & 'Google'
	 * @return Full        row of table
	 */
	public function check_user_exist($email_id = '', $user_id = '', $login_by = '') {
		$this->db->where('email_id', $email_id);
		$this->db->where('user_id', $user_id);
		$this->db->where('login_with', $login_by);
		$result = $this->db->get('customers');
		return $result->row();
	}

	/**
	 * @param  $email
	 * @return Full     row of table
	 */
	public function check_email_exist($email = "") {
		$this->db->where('email_id', $email);
		$result = $this->db->get('customers');
		return $result->row();
	}

	/**
	 * @param  $email_id
	 * @return insert      Id Of table
	 */
	public function register_guest_user($email_id = "") {
		$data = array('first_name' => 'Guest', 'email_id' => $email_id, 'login_with' => 'guest_login', 'last_login' => date('d-m-Y'));
		$data = array_merge($data, array('ip' => $_SERVER['REMOTE_ADDR'], 'date' => date('d-m-Y'), 'time' => date('h:i a'), 'month' => date('M-Y')));

		if (isset($_SESSION['ip_country']) && isset($_SESSION['report']['ftq']) && isset($_SESSION['region'])) {
			$data = array_merge($data, array(
				'country' => $_SESSION['ip_country'],
				'region'  => $_SESSION['region'],
				'uni_key' => $_SESSION['report']['ftq']));
		}
		$this->db->insert('customers', $data);
		return $this->db->insert_id();
	}
}
