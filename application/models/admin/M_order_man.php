<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_order_man extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}

	/**
	 * @return mixed
	 */
	public function get_all_orders() {
		$this->db->select('order_mst.*,transaction_cart_data.id as trn_c_id,transaction_cart_data.se_data as trn_c_data');
		$this->db->from('order_mst');
		$this->db->order_by('order_mst.id', 'DESC');
		$this->db->join('transaction_cart_data', 'transaction_cart_data.id = order_mst.trn_cart_id');
		// $this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = order_mst.sub_cat_id');
		return $this->db->get()->result();
	}

	/**
	 * @param  $order_status
	 * @return mixed
	 */
	public function get_order_by_status($order_status = 99) {

		$this->db->select('order_mst.*,transaction_cart_data.id as trn_c_id,transaction_cart_data.se_data as trn_c_data');
		$this->db->from('order_mst');
		$this->db->where('order_mst.status', $order_status);
		$this->db->order_by('order_mst.id', 'DESC');
		$this->db->join('transaction_cart_data', 'transaction_cart_data.id = order_mst.trn_cart_id');
		// $this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = order_mst.sub_cat_id');
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
	 * @param  $id
	 * @return mixed
	 */
	public function get_product_data_by_id($id = 0) {

		$this->db->select('product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name as sub_cat_name');
		$this->db->from('product_mst');
		$this->db->where('product_id', $id);
		$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = product_mst.main_cat_id');
		$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = product_mst.sub_cat_id');
		return $this->db->get()->row();
	}

	/**
	 * @param  $id
	 * @return mixed
	 */
	public function get_product_custome_mesurement($id = 0) {
		$this->db->where('id', $id);
		return $this->db->get('customer_mesurement')->row();
	}

	/**
	 * @param  $order_id
	 * @param  $status_id
	 * @return mixed
	 */
	public function change_status_to($order_id = 0, $status_id = 0, $status_text = "", $message = "") {
		$this->db->where('id', $order_id);
		if ($this->db->update('order_mst', array('status' => $status_id))) {
			$order_status_mst = $this->db->where('order_id', $order_id)->order_by("id", "DESC")->get('order_status_mst')->row();
			if (!empty($order_status_mst)) {
				if ($order_status_mst->status_id != $status_id) {
					return $this->db->insert('order_status_mst', array(
						'order_id'    => $order_id,
						'status_id'   => $status_id,
						'status_text' => 'By Aasvaa',
						'status'      => $status_text,
						'date'        => date('d-m-Y'),
						'message'     => $message,
						'time'        => date('h:i a'),
					));
				} else {
					return false;
				}
			} else {
				return $this->db->insert('order_status_mst', array(
					'order_id'    => $order_id,
					'status_id'   => $status_id,
					'status_text' => 'By Aasvaa',
					'status'      => $status_text,
					'date'        => date('d-m-Y'),
					'message'     => $message,
					'time'        => date('h:i a'),
				));
			}
		}
	}

	/**
	 * @param  $order_id
	 * @return mixed
	 */
	public function get_order_stauts($order_id = 0) {
		$this->db->where('order_id', $order_id);
		$this->db->order_by("id");
		return $this->db->get('order_status_mst')->result();
	}

	/**
	 * @param  $id
	 * @return mixed
	 */
	public function get_customer_data($id = 0) {
		$this->db->where('id', $id);
		return $this->db->get('customers')->row();
	}

	/**
	 * @param  $order_id
	 * @param  $message
	 * @return mixed
	 */
	public function message_frm_adm($order_id = 0, $message = "") {
		$this->db->where('id', $order_id);
		return $this->db->update('order_mst', array('order_message_by_adm' => $message));
	}

	/**
	 * @return mixed
	 */
	public function get_all_cart_data() {
		return $this->db->get('new_cart')->result();
	}

	/**
	 * @param array $status
	 */
	public function get_order_by_status_array($status = array()) {

		$this->db->select('order_mst.*,transaction_cart_data.id as trn_c_id,transaction_cart_data.se_data as trn_c_data');
		$this->db->from('order_mst');
		foreach ($status as $key => $value) {
			$this->db->or_where('order_mst.status', $value);
		}
		$this->db->order_by('order_mst.id', 'DESC');
		$this->db->join('transaction_cart_data', 'transaction_cart_data.id = order_mst.trn_cart_id');
		// $this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = order_mst.sub_cat_id');
		return $this->db->get()->result();
	}
	/**
	 * @param $coulum
	 * @param $value
	 */
	public function get_row($coulum, $value, $table) {
		$this->db->where($coulum, $value);
		$this->db->order_by("id", 'desc');
		return $this->db->get($table)->row();
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
	 * @param $id
	 * @param $table
	 * @param $data
	 */
	public function update_data($id, $table, $data) {
		return $this->db->where('id', $id)->update($table, $data);
	}

	/**
	 * @param $order_id
	 * @return mixed
	 */
	public function get_bank_details($order_id) {
		return $this->db->where('order_id', $order_id)
		            ->order_by('id', 'desc')
		            ->get('customer_bank_det')->row();
	}
}