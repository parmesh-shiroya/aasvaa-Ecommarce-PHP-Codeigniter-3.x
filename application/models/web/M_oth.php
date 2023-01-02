<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_oth extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	/**
	 * @param  $name
	 * @return mixed
	 */
	public function get_data_from_templete_mst($name = '') {
		$this->db->where('name', $name);
		return $this->db->get('templete_mst')->row();
	}

	/**
	 * @return mixed
	 */
	public function get_offer_images() {
		for ($i = 0; $i < 5; $i++) {
			$this->db->or_where('b_keys', 'offer_image_' . $i);
		}
		return $this->db->get('banner_mst')->result();
	}

	/**
	 * @param array $data
	 */
	public function add_contact_form($data = array()) {
		return $this->db->insert('contact_forms', $data);
	}

	/**
	 * @param  $page
	 * @return mixed
	 */
	public function get_total_reviews() {
		return $this->db->where('status', '1')->order_by('id', 'desc')->get('product_reviews');
	}
	/**
	 * @return mixed
	 */
	public function get_reviews($page) {
		$this->db->select('product_reviews.*,customers.first_name,customers.last_name,customers.region');
		$this->db->from('product_reviews');
		$this->db->where('product_reviews.status', '1');
		$this->db->order_by('product_reviews.id', 'DESC');
		$this->db->join('customers', 'customers.id = product_reviews.customer_id');
		$this->db->order_by('id', 'desc');
		$this->db->limit(10, $page);
		return $this->db->get()->result();
	}

	/**
	 * @param  $product_id
	 * @return mixed
	 */
	public function get_product($product_id = 0) {
		$this->db->select('product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name as sub_cat_name');
		$this->db->from('product_mst');
		$this->db->where('status', 'on');
		$this->db->where('stock !=', '0');
		$this->db->where('product_mst.product_id', $product_id);
		$this->db->order_by('product_mst.views', 'DESC');
		$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = product_mst.main_cat_id');
		$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = product_mst.sub_cat_id');
		return $this->db->get()->row();
	}

	public function removeLikedb($customer_id, $product_id) {
		$this->db->where('customer_id', $customer_id)
		     ->where('product_id', $product_id)
		     ->delete('product_like_mst');
	}
}