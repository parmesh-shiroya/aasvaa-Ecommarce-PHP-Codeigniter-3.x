<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Web_api extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}

	/**
	 * @param  array   $data
	 * @return mixed
	 */
	public function add_customer_addresh($data = array()) {
		return $this->db->insert('customer_address_mst', $data);
	}
	/**
	 * @return mixed
	 */
	public function registr_address_id() {
		return $this->db->insert_id();
	}

	/**
	 * @param  $address_id
	 * @return mixed
	 */
	public function get_customer_address($address_id = 0) {
		$this->db->where('id', $address_id);
		$result = $this->db->get('customer_address_mst');
		return $result->row();
	}

	/**
	 * @param  $customer_id
	 * @return mixed
	 */
	public function get_user_addresss($customer_id = 0) {
		$this->db->where('customer_id', $customer_id);
		$result = $this->db->get('customer_address_mst');
		return $result->result();
	}
	/**
	 * @param  $product_id
	 * @return mixed
	 */
	public function get_product_data($product_id) {

		$this->db->select('product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name as sub_cat_name');
		$this->db->from('product_mst');
		$this->db->where('product_id', $product_id);
		$this->db->where('status =', 'on');
		$this->db->where('stock !=', '0');
		$this->db->order_by('product_mst.views', 'DESC');
		$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = product_mst.main_cat_id');
		$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = product_mst.sub_cat_id');

		$data = $this->db->get();
		return $data->row();
	}

	/**
	 * @param  array   $data
	 * @return mixed
	 */
	public function add_product_review($data = array()) {
		return $this->db->insert('product_reviews', $data);
	}
	/**
	 * @param  $table
	 * @param  array    $data
	 * @return mixed
	 */
	public function insert_data($table = "", $data = array()) {
		return $this->db->insert($table, $data);
	}

	/**
	 * @param  $coupen_id
	 * @return mixed
	 */
	public function get_coupen_data($coupen_id = 0) {
		$this->db->where('id', $coupen_id);
		return $this->db->get('coupen_mst')->row();
	}

	/**
	 * @param  $address_id
	 * @return mixed
	 */
	public function get_address_data($address_id = 0) {
		$this->db->where('id', $address_id);
		return $this->db->get('customer_address_mst')->row();
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
	 * @return mixed
	 */
	public function get_max_order_id() {
		$this->db->select_max('order_id');
		return $this->db->get('order_mst')->row();
	}

	/**
	 * @param  $email
	 * @return mixed
	 */
	public function check_email_exist($email = "00") {
		$this->db->where('email_id', $email);
		return $this->db->get('customers')->row();
	}

	/**
	 * @param  $customer_id
	 * @param  $new_password
	 * @return mixed
	 */
	public function update_password($customer_id = 0, $new_password = "00") {
		$this->db->where('id', $customer_id);
		return $this->db->update('customers', array('password' => $new_password));

	}
}
