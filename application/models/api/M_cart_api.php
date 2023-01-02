<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Cart_api extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}

	/**
	 * @param  $product_id
	 * @return mixed
	 */
	public function get_product_data($product_id = 0) {
		$this->db->where('status', 'on');
		$this->db->where('product_id', $product_id);
		$this->db->where('stock !=', '0');
		$result = $this->db->get('product_mst');
		return $result->row();
	}
	/**
	 * @param  array   $data
	 * @return mixed
	 */
	public function insert_cart_in_db($data = array()) {
		$this->db->insert('customer_cart_mst', $data);
		return $this->db->insert_id();
	}

	/**
	 * @param $id
	 * @param $stock
	 */
	public function update_stock_cart_in_db($id, $stock) {
		$data = array('required_stock' => $stock);
		$this->db->where('id', $id);
		$this->db->update('customer_cart_mst', $data);
	}

	/**
	 * @param $cart_id
	 */
	public function delete_from_cart($cart_id) {
		$this->db->where('id', $cart_id);
		$this->db->delete('customer_cart_mst');
	}

	/**
	 * @param  $customer_id
	 * @return mixed
	 */
	public function get_customer_cart_data_from_db($customer_id) {
		$this->db->where('customer_id', $customer_id);
		$result = $this->db->get('customer_cart_mst');
		return $result->result_array();

	}

	/**
	 * @param  $customer_id
	 * @param  $product_id
	 * @return mixed
	 */
	public function check_procut_in_cart_exist($customer_id, $product_id) {
		$this->db->where('customer_id', $customer_id);
		$this->db->where('product_id', $product_id);
		$result = $this->db->get('customer_cart_mst');
		return $result->result_array();
	}

	/**
	 * @param  $customer_id
	 * @return mixed
	 */
	public function check_cart_exist_indb($customer_id = 0) {
		$this->db->where('customer_id', $customer_id);
		$result = $this->db->get('new_cart');
		return $result->row();
	}

	/**
	 * @param  $customer_id
	 * @param  array          $data
	 * @return mixed
	 */
	public function update_db_cart($customer_id = 0, $data = array()) {
		$this->db->where('customer_id', $customer_id);
		return $this->db->update('new_cart', $data);
	}
	/**
	 * @param array $data
	 */
	public function insert_cart_db($data = array()) {
		$this->db->insert('new_cart', $data);
	}
	/**
	 * @param  array   $data
	 * @return mixed
	 */
	public function add_customer_mesure_data($data = array()) {
		$this->db->insert('customer_mesurement', $data);
		return $this->db->insert_id();
	}

	/**
	 * @param  $customer_id
	 * @param  $name
	 * @return mixed
	 */
	public function check_mesurement_exist_or_not($customer_id = "", $name = "") {
		$this->db->where('customer_id', $customer_id);
		$this->db->where('name', $name);
		// $this->db->where('data', $data);
		return $this->db->get('customer_mesurement')->row();
	}

	/**
	 * @param  $customer_id
	 * @param  $name
	 * @param  $data
	 * @return mixed
	 */
	public function check_mesurement_exist_or_not2($customer_id = "", $name = "", $data = "") {
		$this->db->where('customer_id', $customer_id);
		$this->db->where('name', $name);
		$this->db->where('data', $data);
		return $this->db->get('customer_mesurement')->row();
	}

	/**
	 * @param  $customer_id
	 * @param  $name
	 * @return mixed
	 */
	public function get_last_same_name($customer_id = 0, $name = "") {
		$this->db->select_max('no');
		$this->db->where('customer_id', $customer_id);
		$this->db->where('name', $name);
		return $this->db->get('customer_mesurement')->row();
	}
}
