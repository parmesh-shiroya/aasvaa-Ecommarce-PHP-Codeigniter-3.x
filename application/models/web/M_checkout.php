<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_checkout extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * @param  $customer_id
	 * @return mixed
	 */
	public function get_customer_address($customer_id = 0) {
		$this->db->where('customer_id', $customer_id);
		$result = $this->db->get('customer_address_mst');
		return $result->result();
	}

	/**
	 * @param  $coupen_user
	 * @param  $coupen_id
	 * @return mixed
	 */
	public function update_coupen_data($coupen_user, $coupen_id) {
		return $this->db->where('id', $coupen_id)->update('coupen_mst', array('use_count' => $coupen_user));
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
	public function get_all_countrys() {
		return $this->db->get('countries')->result();
	}
	/**
	 * @param  $con_id
	 * @return mixed
	 */
	public function get_state_list($con_id) {
		$this->db->where('country_id', $con_id);
		return $this->db->get('states')->result_array();
	}

	/**
	 * @param  array   $data
	 * @return mixed
	 */
	public function add_session_data_to_db($data = array()) {
		$this->db->insert('transaction_cart_data', $data);
		return $this->db->insert_id();
	}

	/**
	 * @param  $trn_id
	 * @param  $time
	 * @param  $customer_id
	 * @return mixed
	 */
	public function get_trnsaction_data($trn_id = 0, $time, $customer_id) {
		$this->db->where('id', $trn_id);
		$this->db->where('time', $time);
		$this->db->where('customer_id', $customer_id);
		return $this->db->get('transaction_cart_data')->row();
	}

	/**
	 * @param  $table
	 * @param  array    $data
	 * @return mixed
	 */
	public function insert_data($table, $data = array()) {
		if ($this->db->insert($table, $data)) {
			return $this->db->insert_id();
		}
	}

	/**
	 * @param  $trn_id
	 * @param  $time
	 * @param  $customer_id
	 * @return mixed
	 */
	public function get_paypal_payment_data($trn_id = 0, $time, $customer_id) {
		$this->db->where('trn_cart_id', $trn_id);
		$this->db->where('time', $time);
		$this->db->where('customer_id', $customer_id);
		return $this->db->get('paypal_payment_data')->row();
	}
	/**
	 * @param  $trn_id
	 * @param  $time
	 * @return mixed
	 */
	public function update_status_trnsaction($trn_id = 0, $time = 0) {
		$this->db->where('id', $trn_id);
		$this->db->where('time', $time);
		return $this->db->update('transaction_cart_data', array('status' => 1));
	}

	/**
	 * @param  $tx
	 * @param  $trn_db_id
	 * @param  $paypal_id
	 * @return mixed
	 */
	public function check_order_exist($tx, $trn_db_id, $paypal_id = 0) {
		$this->db->or_where('trn_cart_id', $trn_db_id);
		// $this->db->or_where('payment_from_data_id', $tx);
		$this->db->or_where('trnscation_id', $tx);
		return $this->db->get('order_mst')->result();
	}
	/**
	 * @return mixed
	 */
	public function get_max_order_id() {
		$this->db->select_max('order_id');
		return $this->db->get('order_mst')->row();
	}

	///////////////// CC Avenue ///////////////
	/**
	 * @param  $trn_id
	 * @param  $time
	 * @param  $customer_id
	 * @return mixed
	 */
	public function get_ccavenue_payment_data($trn_id = 0, $time, $customer_id) {

		$this->db->where('trn_cart_id', $trn_id);

		$this->db->where('time', $time);

		$this->db->where('customer_id', $customer_id);

		return $this->db->get('ccavenue_payment_data')->row();

	}

	/**
	 * @param  $customer_id
	 * @return mixed
	 */
	public function delete_cart($customer_id = 0) {
		return $this->db->where('customer_id', $customer_id)->delete('new_cart');
	}

	/**
	 * @return mixed
	 */
	public function get_last_order_id() {
		return $this->db->order_by('id', 'desc')->get('order_mst')->row();
	}
}