<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Addproduct_model_2 extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}
	/**
	 * @param $product_id
	 * @return mixed
	 */
	public function get_product_by_id($product_id = 0) {
		return $this->db->where('product_id', $product_id)->get('product_mst')->row();
	}
	/**
	 * @return mixed
	 */
	public function get_main_categories() {
		$objQuery = $this->db->get('main_cat_mst');
		return $objQuery->result();
	}
	/**
	 * @param $main_cat_id
	 * @return mixed
	 */
	public function get_sub_category($main_cat_id = 0) {
		return $this->db->where('main_cat_id', $main_cat_id)->get('sub_cat_mst')->result();
	}
	/**
	 * @param array $data
	 * @return mixed
	 */
	public function insert($data = array()) {
		$insert = $this->db->insert_batch('files', $data);
		return $insert ? true : false;
	}
	/**
	 * @return mixed
	 */
	public function get_default_value() {
		$this->db->where('dd_key', 'add_product');
		$objQuery = $this->db->get('adm_default_detail_manager');
		$data     = $objQuery->result_array();
		if (!empty($data)) {

			$this->db->like('dd_id', $data[0]['dd_id'], 'both');
			$data2 = $this->db->get('adm_default_details_mst')->result();
			if (!empty($data2)) {

				$data3 = array();
				foreach ($data2 as $val) {
					$data3 = array_merge(array($val->d_key => $val->d_value), $data3);
				}
				return $data3;
			}
		}
	}

	/**
	 * @param $data
	 * @return mixed
	 */
	public function insert_product($data) {
		if (!empty($data)) {
			$this->db->insert('product_mst', $data);
			return $this->db->insert_id();
		}
	}
	/**
	 * @param $product_id
	 * @param $m_cat_id
	 * @param $details
	 */
	public function insert_product_details($product_id, $m_cat_id, $details) {

		if (!empty($details) && !empty($product_id)) {

			$data = array('product_id' => $product_id, 'm_cat_id' => $m_cat_id, 'details' => $details);
			$this->db->insert('product_details_mst', $data);
			return true;

		}
		return false;
	}

	/**
	 * @param $product_id
	 * @param array $data
	 */
	public function update_product($product_id = 0, $data = array()) {
		$this->db->where('product_id', $product_id)->update('product_mst', $data);
	}

	/**
	 * @param $product_id
	 * @param $m_cat_id
	 * @param $details
	 */
	public function update_product_details($product_id, $m_cat_id, $details) {

		if (!empty($details) && !empty($product_id)) {
			$this->db->where('product_id', $product_id);
			$data = array('m_cat_id' => $m_cat_id, 'details' => $details);
			$this->db->update('product_details_mst', $data);
			return true;

		}
		return false;
	}
	/**
	 * @param $id
	 * @return mixed
	 */
	public function get_detail_data($id = 0) {
		return $this->db->where('id', $id)->get('adm_product_detail_data_mst_2')->row();
	}

	/**
	 * @param $id
	 * @param array $data
	 * @return mixed
	 */
	public function update_detail_data($id = 0, $data = array()) {
		return $this->db->where('id', $id)->update('adm_product_detail_data_mst_2', $data);
	}
}

/* End of file addproduct_model.php */
/* Location: ./application/models/admin/product_model/addproduct_model.php */
?>