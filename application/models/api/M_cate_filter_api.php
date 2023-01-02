<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Cate_filter_api extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}

	/**
	 * @return mixed
	 */
	public function get_product_by_filter() {
		$this->db->select('product_details_mst.*,product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name as sub_cat_name');
		$this->db->from('product_details_mst');
		foreach ($_SESSION['filter'] as $key => $value) {
			$keyword = "";
			foreach ($value as $key1 => $value1) {
				$keyword .= "product_details_mst.details LIKE '%#$key:$value1#%'";

				if ($key1 != (sizeof($value) - 1)) {
					$keyword .= " OR ";
				}
			}
			$this->db->where("(" . $keyword . ")");
		}
		$this->db->join('product_mst', 'product_mst.product_id = product_details_mst.product_id');
		$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = product_mst.main_cat_id');
		$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = product_mst.sub_cat_id');
		$result = $this->db->get();
		$this->db->last_query();
		return $result->result();
	}
}
