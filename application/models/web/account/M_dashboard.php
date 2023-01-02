<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Dashboard extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * @param $customer_data
	 * @return mixed
	 */
	public function user_data($customer_data = 0) {
		$this->db->where('id', $customer_data);
		$result = $this->db->get('customers');
		return $result->row();
	}

	/**
	 * @param $customer_id
	 * @param $data
	 * @return mixed
	 */
	public function add_guest_customer_data($customer_id, $data) {
		return $this->db->where('id', $customer_id)->update('customers', $data);
	}

}
