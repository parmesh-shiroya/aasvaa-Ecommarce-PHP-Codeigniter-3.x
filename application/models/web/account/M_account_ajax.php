<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Account_ajax extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	/**
	 * @param $customer_id
	 * @param $add_id
	 * @param array $data
	 * @return mixed
	 */
	public function update_address($customer_id = 0, $add_id = 0, $data = array()) {
		$this->db->where('id', $add_id);
		$this->db->where('customer_id', $customer_id);
		return $this->db->update('customer_address_mst', $data);
	}
	/**
	 * @param $customer_id
	 * @param array $data
	 * @return mixed
	 */
	public function update_acc_password($customer_id = 0, $data = array()) {
		$this->db->where('id', $customer_id);
		return $this->db->update('customers', $data);
	}

	/**
	 * @param $customer_id
	 * @param $newsletter
	 * @param $newsletter_sms
	 * @return mixed
	 */
	public function update_newsletter($customer_id = 0, $newsletter = 1, $newsletter_sms = 1) {
		$this->db->where('id', $customer_id);
		return $this->db->update('customers', array('newsletter' => $newsletter, 'sms_newsletter' => $newsletter_sms));
	}
}