<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_reviewmanager extends CI_Model {
	public function __construct() {
		parent::__construct();
		//Do your magic here
	}
	/**
	 * @return mixed
	 */
	public function get_all_reviews() {
		$this->db->select('product_reviews.*,customers.first_name,customers.last_name');
		$this->db->from('product_reviews');
		$this->db->order_by('product_reviews.id', 'DESC');
		$this->db->join('customers', 'customers.id = product_reviews.customer_id');
		return $this->db->get()->result_array();
	}

	/**
	 * @param $rev_id
	 * @param $status
	 */
	public function change_status($rev_id, $status) {
		return $this->db->where('id', $rev_id)->update('product_reviews', array('status' => $status));
	}
}