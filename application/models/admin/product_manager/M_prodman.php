<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_prodman extends CI_Model {
	public function __construct() {
		parent::__construct();
		//Do your magic here
	}
	/**
	 * @param  array   $data
	 * @return mixed
	 */
	public function add_main_cate($data = array()) {
		return $this->db->insert('main_cat_mst', $data);
	}
	/**
	 * @param  array   $data
	 * @return mixed
	 */
	public function add_sub_cate($data = array()) {
		return $this->db->insert('sub_cat_mst', $data);
	}
	/**
	 * @return mixed
	 */
	public function get_all_main_cats() {
		return $this->db->get('main_cat_mst')->result_array();
	}

	/**
	 * @return mixed
	 */
	public function get_main_cat_imgs() {
		$data = $this->get_all_main_cats();
		$this->db->or_where('b_keys', 'main_cat_0');
		foreach ($data as $key => $value) {

			$this->db->or_where('b_keys', 'main_cat_' . $value['main_cat_id']);
		}
		return $this->db->get('banner_mst')->result();
	}
	// public function get_datas() {
	// 	$this->db->select('sub_cat_mst.*,main_cat_mst.cat_name as main_cat_name');
	// 	$this->db->from('sub_cat_mst');
	// 	$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = sub_cat_mst.main_cat_id');
	// 	// $this->db->join('product_mst', 'product_mst.sub_cat_id = sub_cat_mst.sub_cat_id AND product_mst.main_cat_id = main_cat_mst.main_cat_id ');

	// 	return $this->db->get()->result();
	// }
	/**
	 * @param  $table
	 * @return mixed
	 */
	public function get_datas($table = "") {

		return $this->db->get($table)->result();
	}

	/**
	 * @param  $main_cat_id
	 * @param  $imgs
	 * @return mixed
	 */
	public function insert_banner_data($main_cat_id, $imgs) {
		if (empty($this->db->where('b_keys', 'main_cat_' . $main_cat_id)->get('banner_mst')->row())) {
			return $this->db->insert('banner_mst', array('b_keys' => 'main_cat_' . $main_cat_id, 'b_values' => $imgs));
		} else {
			$this->db->where('b_keys', 'main_cat_' . $main_cat_id);
			return $this->db->update('banner_mst', array('b_keys' => 'main_cat_' . $main_cat_id, 'b_values' => $imgs));
		}
	}

	/**
	 * @param $main_cat_id
	 * @param $sub_cat_name
	 */
	public function get_sub_category($main_cat_id, $sub_cat_name) {
		return $this->db->where('main_cat_id', $main_cat_id)->where('cat_name', $sub_cat_name)->get('sub_cat_mst')->row();
	}
}

/* End of file m_prodman.php */
/* Location: ./application/models/admin/product_manager/m_prodman.php */