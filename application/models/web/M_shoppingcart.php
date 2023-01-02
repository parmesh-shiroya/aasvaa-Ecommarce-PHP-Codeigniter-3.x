<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_shoppingcart extends CI_Model {
	public function __construct() {
		parent::__construct();
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
	 * @param  $id
	 * @return mixed
	 */
	public function get_mesurement_data($id = 0) {
		$this->db->where('id', $id);
		$result = $this->db->get('customer_mesurement');
		return $result->row();
	}

	/**
	 * @param  $code
	 * @return mixed
	 */
	public function get_coupen_data($code = "") {
		$this->db->where('code', $code);
		return $this->db->get('coupen_mst')->row();
	}

	/**
	 * @return mixed
	 */
	public function get_all_countrys() {
		return $this->db->get('countries')->result();
	}

	/**
	 * @param  $table
	 * @param  array    $data
	 * @return mixed
	 */

}

/* End of file m_product.php */
/* Location: ./application/models/web/m_product.php */
