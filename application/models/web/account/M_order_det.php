<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Order_det extends CI_Model {
	public function __construct() {
		parent::__construct();
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
	 * @param  $customer_id
	 * @return mixed
	 */
	public function get_order_with_id($id = 0, $customer_id = 0) {
		$this->db->select('order_mst.*,transaction_cart_data.id as trn_c_id,transaction_cart_data.se_data as trn_c_data');
		$this->db->from('order_mst');
		$this->db->where('order_mst.id', $id);
		$this->db->where('order_mst.customer_id', $customer_id);
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
	 * @param  $id
	 * @return mixed
	 */
	public function get_customer_data($id = 0) {
		$this->db->where('id', $id);
		return $this->db->get('customers')->row();
	}

	/**
	 * @param  $order_id
	 * @param  $customer_id
	 * @return mixed
	 */
	public function cancel_order($order_id = 0, $customer_id = 0) {
		$this->db->where('id', $order_id);
		$this->db->where('customer_id', $customer_id);
		$this->db->where("(status='0' OR status='5' OR status='6')", NULL, FALSE);
		if ($this->db->update('order_mst', array('status' => '7'))) {
			return $this->db->insert('order_status_mst', array(
				'order_id'    => $order_id,
				'status_id'   => '7',
				'status_text' => 'By Customer',
				'status'      => 'Cancel',
				'date'        => date('d-m-Y'),
				'message'     => $this->input->post('reason'),
				'time'        => date('h:i a'),
			));
		} else {
			return false;
		}

	}
	/**
	 * @param  $order_id
	 * @param  $customer_id
	 * @return mixed
	 */
	public function return_order($order_id = 0, $customer_id = 0) {
		$this->db->where('id', $order_id);
		$this->db->where('customer_id', $customer_id);
		$this->db->where("(status = 4 OR status = 16)", NULL);
		$this->db->where("order_from", 'ai');
		if ($this->db->update('order_mst', array('status' => '11'))) {
			return $this->db->insert('order_status_mst', array(
				'order_id'    => $order_id,
				'status_id'   => '11',
				'status_text' => 'By Customer',
				'status'      => 'Return Request',
				'date'        => date('d-m-Y'),
				'message'     => $this->input->post('reason'),
				'time'        => date('h:i a'),
			));
		} else {
			return false;
		}

	}
	/**
	 * @param  $order_id
	 * @param  $customer_id
	 * @param  $message
	 * @return mixed
	 */
	public function message_frm_cst($order_id = 0, $customer_id = 0, $message = "") {
		$this->db->where('id', $order_id);
		$this->db->where('customer_id', $customer_id);
		return $this->db->update('order_mst', array('order_message_by_cstm' => $message));
	}

	////////// CCavenue
	/**
	 * @param  $id
	 * @return mixed
	 */
	public function get_ccavenue_payment_data($id = 0) {
		$this->db->where('id', $id);
		return $this->db->get('ccavenue_payment_data')->row();
	}

	/**
	 * @param  $order_id
	 * @param  $status_id
	 * @param  $status_text
	 * @return mixed
	 */
	public function change_status_to($order_id = 0, $status_id = 0, $status_text = "", $message = "") {
		$this->db->where('id', $order_id);
		if ($this->db->update('order_mst', array('status' => $status_id))) {

			return $this->db->insert('order_status_mst', array(
				'order_id'    => $order_id,
				'status_id'   => $status_id,
				'status_text' => 'By Customer',
				'status'      => $status_text,
				'message'     => $message,
				'date'        => date('d-m-Y'),
				'time'        => date('h:i a'),

			));
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
	 * @param  $coulum
	 * @param  $value
	 * @param  $table
	 * @return mixed
	 */
	public function get_row($coulum, $value, $table) {
		$this->db->where($coulum, $value);
		$this->db->order_by("id", 'desc');
		return $this->db->get($table)->row();
	}

	/**
	 * @param $data
	 */
	public function insert_bank_details($data) {
		$data = array_merge($data, array(
			'date' => date('d-m-Y'),
			'time' => date('h:i a'),
		));
		if (isset($_SESSION['report']['ftq'])) {
			$data = array_merge($data, array('uni_key' => $_SESSION['report']['ftq']));
		}
		return $this->db->insert('customer_bank_det', $data);
	}

	/**
	 * @param $order_id
	 */
	public function get_bank_details($order_id) {
		return $this->db->where('order_id', $order_id)
		            ->order_by('id', 'desc')
		            ->get('customer_bank_det')->row();
	}

	/**
	 * @param $order_id
	 * @param $customer_id
	 */
	public function check_bankaccount_exist($order_id, $customer_id) {
		return $this->db->where('order_id', $order_id)->where('customer_id', $customer_id)->get('customer_bank_det')->row();
	}

	/**
	 * @param $order_id
	 * @param $customer_id
	 * @param $data
	 */
	public function update_bank_account_detail($order_id, $customer_id, $data) {
		$data = array_merge($data, array(
			'date' => date('d-m-Y'),
			'time' => date('h:i a'),
		));
		if (isset($_SESSION['report']['ftq'])) {
			$data = array_merge($data, array('uni_key' => $_SESSION['report']['ftq']));
		}
		return $this->db->where('order_id', $order_id)
		            ->where('customer_id', $customer_id)
		            ->update('customer_bank_det', $data);
	}
}