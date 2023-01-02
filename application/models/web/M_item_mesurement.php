<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_item_mesurement extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}

	/**
	 * @param  $product_id
	 * @return mixed
	 */
	public function get_product_details($product_id = 0) {
		$this->db->select('product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name as sub_cat_name');
		$this->db->from('product_mst');
		$this->db->where('status =', 'on');
		$this->db->where('stock !=', '0');
		$this->db->where('product_id', $product_id);
		$this->db->order_by('product_mst.views', 'DESC');
		$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = product_mst.main_cat_id');
		$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = product_mst.sub_cat_id');
		$result = $this->db->get();
		return $result->row();
	}
	/**
	 * @param  $customize_row_id
	 * @return mixed
	 */
	public function get_customize_size($customize_row_id = 0) {
		$this->db->where('id', $customize_row_id);
		$result = $this->db->get('adm_customize_size_charts');
		return $result->row();
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
	 * @param  $id
	 * @return mixed
	 */
	public function get_item_data($customer_id = "", $id = "") {
		$this->db->where('customer_id', $customer_id);
		$this->db->where('id', $id);
		return $this->db->get('customer_mesurement')->row();
	}

	/**
	 * @param  $customer_id
	 * @return mixed
	 */
	public function get_exist_mesurement($customer_id = 0) {
		// $this->db->select('name');
		$this->db->where('customer_id', $customer_id);
		$this->db->group_by('name');
		return $this->db->get('customer_mesurement')->result();
	}

}