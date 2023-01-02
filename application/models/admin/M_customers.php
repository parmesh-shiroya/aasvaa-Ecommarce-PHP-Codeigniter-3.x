<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_customers extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}
	/**
	 * @return mixed
	 */
	public function get_all_customers() {
		$this->db->order_by('id');
		return $this->db->get('customers')->result_array();
	}

	/**
	 * @param $customer_id
	 * @return mixed
	 */
	public function login_customer($customer_id = 0) {
		$this->db->where('id', $customer_id);
		return $this->db->get('customers')->row();
	}

}

/* End of file M_customers.php */
/* Location: ./application/models/admin/M_customers.php */