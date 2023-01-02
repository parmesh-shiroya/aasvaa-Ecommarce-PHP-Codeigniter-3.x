<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_successorder extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * @param $customer_id
	 * @param $order_id
	 * @return mixed
	 */
	public function check_order_exist($customer_id = 1, $order_id = 1) {

		// echo "1";
		$this->db->where('order_id', $order_id);
		$this->db->where('customer_id', $customer_id);
		return $this->db->get('order_mst')->row();

	}
}