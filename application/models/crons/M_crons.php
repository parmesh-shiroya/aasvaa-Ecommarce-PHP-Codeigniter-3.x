<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_crons extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}

	/**
	 * @return mixed
	 */
	public function get_all_cart_data() {
		return $this->db->get('new_cart')->result();
	}

	// public function get_product_data($prod_id = 0) {
	// 	return $this->db->where('product_id', $prod_id)->get('product_mst')->row();
	// }
	/**
	 * @param  $cart_id
	 * @param  array      $data
	 * @return mixed
	 */
	public function update_cart($cart_id = 0, $data = array()) {
		return $this->db->where('id', $cart_id)->update('new_cart', $data);
	}

	/**
	 * @return mixed
	 */
	public function get_new_orders() {
		$this->db->select('order_mst.*,transaction_cart_data.id as trn_c_id,transaction_cart_data.se_data as trn_c_data');
		$this->db->from('order_mst');
		$this->db->where('order_data_seprate', '0');
		$this->db->join('transaction_cart_data', 'transaction_cart_data.id = order_mst.trn_cart_id');
		return $this->db->get()->result();
	}

	/**
	 * @param  $product_id
	 * @return mixed
	 */
	public function get_product_data($product_id) {
		$this->db->select('product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name as sub_cat_name');
		$this->db->from('product_mst');
		$this->db->where('product_mst.product_id', $product_id);
		$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = product_mst.main_cat_id');
		$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = product_mst.sub_cat_id');
		return $this->db->get()->row();
	}
	/**
	 * @param  $table
	 * @param  $data
	 * @return mixed
	 */
	public function insert_data($table, $data) {
		return $this->db->insert($table, $data);
	}
	/**
	 * @param  $key
	 * @param  $value
	 * @param  $table
	 * @param  $data
	 * @return mixed
	 */
	public function update_data($key, $value, $table, $data) {
		return $this->db->where($key, $value)->update($table, $data);
	}

	/**
	 * @param $status
	 */
	public function get_trackable_orders() {
		$this->db->select('order_mst.*,zepo_pickup_request_data.delivery_by,zepo_courier_order_info.tracking_no,zepo_courier_order_info.last_status_length');
		$this->db->from('order_mst');
		$this->db->where('(status = 2 OR status = 3 OR status = 8 OR status = 9) ', NULL, false);

		$this->db->join('zepo_pickup_request_data', 'zepo_pickup_request_data.order_id = order_mst.id');
		$this->db->join('zepo_courier_order_info', 'zepo_courier_order_info.order_id = order_mst.id');
		$this->db->limit(5);
		return $this->db->get()->result();
	}
	/**
	 * @return mixed
	 */
	public function get_return_trackable_orders() {
		$this->db->select('order_mst.*,zepo_pickup_return_request_data.delivery_by,zepo_return_courier_order_info.tracking_no,zepo_return_courier_order_info.last_status_length');
		$this->db->from('order_mst');
		$this->db->where('(status = 12 OR status = 13 OR status = 18) ', NULL, false);

		$this->db->join('zepo_pickup_return_request_data', 'zepo_pickup_return_request_data.order_id = order_mst.id');
		$this->db->join('zepo_return_courier_order_info', 'zepo_return_courier_order_info.order_id = order_mst.id');
		$this->db->limit(5);
		return $this->db->get()->result();
	}

	/**
	 * @param  $order_id
	 * @param  $status
	 * @param  $time_stamp
	 * @return mixed
	 */
	public function get_tracking_data($order_id, $status, $time_stamp) {
		return $this->db->where('order_id', $order_id)
		            ->where('status_id', $status)
		            ->where('timestamp', $time_stamp)
		            ->get('order_status_mst')
		            ->row();

	}

	/**
	 * @param  $coulum
	 * @param  $value
	 * @param  $table
	 * @return mixed
	 */
	public function get_row($coulum, $value, $table, $order_by = '') {
		$this->db->where($coulum, $value);
		if (!empty($order_by)) {
			$this->db->order_by($order_by, 'DESC');
		}
		return $this->db->get($table)->row();
	}

	/**
	 * @param $order_id
	 */
	public function get_order_cancel_status($order_id) {
		return $this->db->where('order_id', $order_id)
		            ->where('status_id', '7')
		            ->order_by('id', 'DESC')
		            ->get('order_status_mst')
		            ->row();
	}
	/**
	 * @param  $id
	 * @return mixed
	 */
	public function get_order_with_id($id = 0) {
		$this->db->select('order_mst.*,transaction_cart_data.id as trn_c_id,transaction_cart_data.se_data as trn_c_data');
		$this->db->from('order_mst');
		$this->db->where('order_mst.id', $id);
		$this->db->order_by('order_mst.id', 'DESC');
		$this->db->join('transaction_cart_data', 'transaction_cart_data.id = order_mst.trn_cart_id');
		// $this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = order_mst.sub_cat_id');
		return $this->db->get()->row();
	}

	/**
	 * @param  $colum
	 * @param  $value
	 * @param  $table
	 * @return mixed
	 */
	public function delete_row($colum, $value, $table) {
		return $this->db->where($colum, $value)->delete($table);
	}
	/**
	 * @param  $id
	 * @return mixed
	 */
	public function get_customer_data($id = 0) {
		$this->db->where('id', $id);
		return $this->db->get('customers')->row();
	}

	///======================================================
	///================== For Finance Report ==============
	///=====================================================
	/**
	 * @return mixed
	 */
	public function getOrdersForFinaceReport() {
		$this->db->select('order_mst.*,transaction_cart_data.id as trn_c_id,transaction_cart_data.se_data as trn_c_data');
		$this->db->from('order_mst');
		$this->db->where('order_finance_seprate', '0');
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
	 * @param  $id
	 * @return mixed
	 */
	public function get_ccavenue_payment_data($id = 0) {
		$this->db->where('id', $id);
		return $this->db->get('ccavenue_payment_data')->row();
	}
}