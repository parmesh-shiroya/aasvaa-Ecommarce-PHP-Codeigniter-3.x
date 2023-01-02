<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_manageproduct extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * @return mixed
	 */
	public function total_all_product_count() {
		return $this->db->count_all("product_mst");
	}
	/**
	 * @return mixed
	 */
	public function get_all_product() {
		$this->db->select('product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name as sub_cat_name');
		$this->db->from('product_mst');

		$this->db->order_by('product_mst.product_id', 'DESC');
		$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = product_mst.main_cat_id');
		$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = product_mst.sub_cat_id');
		$result = $this->db->get();
		return $result->result_array();
	}

	public function update_product_data($sku, $stock, $retail_price, $sell_price) {
		$data = array();
		if (!empty($stock)) {
			$data = array_merge($data, ['stock' => $stock]);
		}
		if (!empty($retail_price)) {
			$data = array_merge($data, ['mrp' => $retail_price]);
		}
		if (!empty($sell_price)) {
			$data = array_merge($data, ['sell_price' => $sell_price]);
		}
		if (!empty($sku) && !empty($data)) {
			$this->db->where('product_sku', trim($sku));
			$this->db->update('product_mst', $data);
		}

	}
}

/* End of file addproduct_model.php */
/* Location: ./application/models/admin/product_model/addproduct_model.php */
?>