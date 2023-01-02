<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_test extends CI_Model {

	public function __construct() {
		parent::__construct();
		//Do your magic here
	}

	/**
	 * @return mixed
	 */
	public function get_size_chart() {
		$this->db->where('id', '2');
		return $this->db->get('adm_customize_size_charts')->row();
	}

	/**
	 * @return mixed
	 */
	public function get_datas() {
		$this->db->select('sub_cat_mst.*,main_cat_mst.cat_name as main_cat_name');
		$this->db->from('sub_cat_mst');
		$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = sub_cat_mst.main_cat_id');
		// $this->db->join('product_mst', 'product_mst.sub_cat_id = sub_cat_mst.sub_cat_id AND product_mst.main_cat_id = main_cat_mst.main_cat_id ');

		return $this->db->get()->result();
	}

	public function test() {
		$result = $this->db->where('pro_key', 'shop_add')->get('adm_profile')->row_array();
		// print_r($result['pro_value']);
	}
}

/* End of file m_test.php */
/* Location: ./application/models/admin/m_test.php */