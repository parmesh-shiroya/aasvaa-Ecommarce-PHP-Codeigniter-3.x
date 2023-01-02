<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Account extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	/**
	 * @param  $cust_id
	 * @return mixed
	 */
	public function get_account_detail($cust_id = 0) {
		$this->db->where('id', $cust_id);
		$result = $this->db->get('customers');
		return $result->row();
	}

	/**
	 * @param  $customer_id
	 * @param  array          $data
	 * @return mixed
	 */
	public function update_information($customer_id = 0, $data = array()) {
		$this->db->where('id', $customer_id);
		return $this->db->update('customers', $data);
	}

	/**
	 * @param  $customer_id
	 * @return mixed
	 */
	public function get_account_address($customer_id = 0) {
		$this->db->where('customer_id', $customer_id);
		$result = $this->db->get('customer_address_mst');
		return $result->result();
	}
	/**
	 * @param  $customer_id
	 * @param  $add_id
	 * @return mixed
	 */
	public function delete_address($customer_id = 0, $add_id = 0) {
		$this->db->where('customer_id', $customer_id);
		$this->db->where('id', $add_id);
		return $this->db->delete('customer_address_mst');
	}
	/**
	 * @param  $customer_id
	 * @param  $add_id
	 * @return mixed
	 */
	public function get_address($customer_id = 0, $add_id = 0) {
		$this->db->where('customer_id', $customer_id);
		$this->db->where('id', $add_id);
		$result = $this->db->get('customer_address_mst');
		return $result->row();
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
	 * @param  $customer_id
	 * @return mixed
	 */
	public function get_all_customer_mesurement($customer_id = 0) {
		$this->db->where('customer_id', $customer_id);
		return $this->db->get('customer_mesurement')->result();
	}

	/**
	 * @param  $customer_id
	 * @return mixed
	 */
	public function get_all_customer_orders($customer_id) {
		$this->db->select('order_mst.*,transaction_cart_data.id as trn_c_id,transaction_cart_data.se_data as trn_c_data');
		$this->db->from('order_mst');
		$this->db->where('order_mst.customer_id', $customer_id);
		$this->db->order_by('order_mst.id', 'DESC');
		$this->db->join('transaction_cart_data', 'transaction_cart_data.id = order_mst.trn_cart_id');
		return $this->db->get()->result();
	}

	/**
	 * @param  $id
	 * @return mixed
	 */
	public function get_paypal_payment_data($id = 0) {
		$this->db->where('id', $id);
		return $this->db->get('paypal_payment_data')->row();
	}

	/**
	 * @param  $customer_id
	 * @return mixed
	 */
	public function get_custome_wishlist($customer_id = 0) {
		return $this->db->where('customer_id', $customer_id)->get('product_like_mst')->result();
	}

	/**
	 * @param  $product_id
	 * @return mixed
	 */
	public function get_product($product_id = 0) {
		$this->db->select('product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name as sub_cat_name');
		$this->db->from('product_mst');
		$this->db->where('status', 'on');
		$this->db->where('stock !=', '0');
		$this->db->where('product_mst.product_id', $product_id);
		$this->db->order_by('product_mst.views', 'DESC');
		$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = product_mst.main_cat_id');
		$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = product_mst.sub_cat_id');
		return $this->db->get()->row();
	}

	/**
	 * @param  $customer_id
	 * @param  $wish_id
	 * @return mixed
	 */
	public function remove_from_wish_list($customer_id = 0, $wish_id = 0) {
		return $this->db->where('customer_id', $customer_id)->where('id', $wish_id)->delete('product_like_mst');
	}
	/**
	 * @param  $id
	 * @return mixed
	 */
	public function get_ccavenue_payment_data($id = 0) {
		$this->db->where('id', $id);
		return $this->db->get('ccavenue_payment_data')->row();
	}

	public function get_all_customer_reviews($customer_id = 0) {
		return $this->db->select('product_reviews.*,product_mst.product_name,product_mst.product_id,product_mst.product_sku,product_mst.pro_img')
		            ->where('customer_id', $customer_id)
		            ->order_by('product_reviews.id', 'DESC')
		            ->where('product_mst.status', 'on')
		            ->where('product_mst.stock !=', '0')
		            ->from('product_reviews')
		            ->join('product_mst', 'product_mst.product_id = product_reviews.prod_id')
		            ->get()->result();
	}
}
