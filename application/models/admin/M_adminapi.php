<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_adminapi extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}

	/**
	 * @param  $main_cat
	 * @return mixed
	 */
	public function get_sub_cat($main_cat = 0) {
		$this->db->where("main_cat_id", $main_cat);
		$objQuery = $this->db->get('sub_cat_mst');
		return $objQuery->result_array();
	}

	/**
	 * @param  $sub_cat
	 * @return mixed
	 */
	public function get_which_prod_show_field($sub_cat = 0) {
		if ($sub_cat != 0) {
			$this->db->select('adm_which_prod_detail_show.*, sub_cat_mst.main_cat_id');
			$this->db->from('adm_which_prod_detail_show');
			$this->db->where('adm_which_prod_detail_show.main_cat_id = sub_cat_mst.main_cat_id');
			$this->db->where('adm_which_prod_detail_show.sub_cat_id', $sub_cat);
			$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = ' . $sub_cat);
		} else {
			$this->db->from('adm_which_prod_detail_show');
			$this->db->where('main_cat_id', 0);
			$this->db->where('sub_cat_id', 0);
		}
		$objQuery = $this->db->get();
		// echo $this->db->last_query();
		return $objQuery->result();
	}

	/**
	 * @param  array   $prod_det_ids
	 * @return mixed
	 */
	public function get_prod_det_field_det($prod_det_ids = array()) {

		foreach ($prod_det_ids as $key => $value) {
			$this->db->or_where('det_id', $key);
		}
		$objQuery = $this->db->get('adm_product_details_mst');
		return $objQuery->result_array();

	}

	/**
	 * @param  $table
	 * @param  $id
	 * @return mixed
	 */
	public function get_default_data($table, $id) {
		$this->db->where('dd_table', $table);
		$this->db->where('dd_table_key', $id);
		$objQuery = $this->db->get('adm_default_detail_manager');
		$data     = $objQuery->result_array();
		if (!empty($data)) {
			$this->db->like('dd_id', $data[0]['dd_id'], 'both');
			return $this->db->get('adm_default_details_mst')->result();

		}
	}

	/**
	 * @param  $column
	 * @param  $id
	 * @return mixed
	 */
	public function get_standard_size_names($column, $id) {
		$this->db->select('id,name,size_for,def_price');
		$this->db->where($column, $id);
		$objQuery = $this->db->get('adm_standard_size_charts');
		return $objQuery->result_array();
	}
	/**
	 * @param  $column
	 * @param  $id
	 * @return mixed
	 */
	public function get_customize_size_names($column, $id) {
		$this->db->select('id,name,size_for,def_price');
		$this->db->where($column, $id);
		$objQuery = $this->db->get('adm_customize_size_charts');
		return $objQuery->result_array();
	}

	/**
	 * @param  $product_id
	 * @param  $product_status
	 * @return mixed
	 */
	public function change_product_status($product_id = "0", $product_status = "on") {
		$this->db->where('product_id', $product_id);
		$data = array('status' => $product_status);
		return $this->db->update('product_mst', $data);
	}

	/**
	 * @param  $coupen_id
	 * @param  $coupen_status
	 * @return mixed
	 */
	public function change_coupen_status($coupen_id = "0", $coupen_status = "on") {
		$this->db->where('id', $coupen_id);
		$data = array('status' => $coupen_status);
		return $this->db->update('coupen_mst', $data);
	}

	/**
	 * @param  $product_id
	 * @return mixed
	 */
	public function get_product_data($product_id = 0) {
		$this->db->select('product_id,product_name,stock,product_sku,mrp,sell_price,catalogue_name');
		$this->db->where('product_id', $product_id);
		return $this->db->get('product_mst')->row_array();
	}

	/**
	 * @param  $product_id
	 * @param  $product_sku
	 * @param  array          $data
	 * @return mixed
	 */
	public function update_coupen($product_id = 0, $product_sku = 0, $data = array()) {
		$this->db->where('product_id', $product_id);
		$this->db->where('product_sku', $product_sku);
		return $this->db->update('product_mst', $data);

	}

	////////////////// Add Product 2 ///////////////

	/**
	 * @param  $sub_cat
	 * @return mixed
	 */
	public function get_which_prod_show_field_2($sub_cat = 0) {
		if ($sub_cat != 0) {
			$this->db->select('adm_which_prod_detail_show_2.*, sub_cat_mst.main_cat_id');
			$this->db->from('adm_which_prod_detail_show_2');
			$this->db->where('adm_which_prod_detail_show_2.main_cat_id = sub_cat_mst.main_cat_id');
			$this->db->where('adm_which_prod_detail_show_2.sub_cat_id', $sub_cat);
			$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = ' . $sub_cat);
		} else {
			$this->db->from('adm_which_prod_detail_show_2');
			$this->db->where('main_cat_id', 0);
			$this->db->where('sub_cat_id', 0);
		}
		$objQuery = $this->db->get();
		// echo $this->db->last_query();
		return $objQuery->result();
	}

	/**
	 * @param  array   $prod_det_ids
	 * @return mixed
	 */
	public function get_prod_det_field_det_2($prod_det_ids = array()) {

		foreach ($prod_det_ids as $key => $value) {
			$this->db->or_where('det_id', $value);
		}
		$objQuery = $this->db->get('adm_product_details_mst_2');
		return $objQuery->result_array();

	}

	/**
	 * @param  $id
	 * @return mixed
	 */
	public function get_prod_det_data_2($id = 0) {
		return $this->db->where('id', $id)->get('adm_product_detail_data_mst_2')->row_array();
	}

	/**
	 * @param  $table
	 * @param  $colume
	 * @param  $value
	 * @return mixed
	 */
	public function where_get($table, $colume = "", $value = "") {
		if (!empty($colume)) {
			$this->db->where($colume, $value);
		}
		return $this->db->get($table);
	}

	/**
	 * @return mixed
	 */
	public function get_order_status() {
		return $this->db->select('id,status,date')->get('order_mst')->result();
	}
}

/* End of file m_adminapi.php */
/* Location: ./application/models/admin/m_adminapi.php */