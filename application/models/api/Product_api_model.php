<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_api_model extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}
	/**
	 * @param  $prod_id
	 * @return mixed
	 */
	public function get_product_single($prod_id = 0) {
		$this->db->select('product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name');
		$this->db->from('product_mst');
		$this->db->where('status =', 'on');
		$this->db->where('product_id', $prod_id);
		$this->db->order_by('product_mst.likes', 'DESC');
		$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = product_mst.main_cat_id');
		$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = product_mst.sub_cat_id');

		$objQuery = $this->db->get();

		return $objQuery->result_array();

	}

	/**
	 * @param $cust_id
	 * @param $prod_id
	 */
	public function product_like($cust_id, $prod_id) {
		$this->db->set('likes', 'likes+1', FALSE);
		$this->db->where('product_id', $prod_id);
		$this->db->where('status', 'on');
		$this->db->update('product_mst');
		$this->db->insert('product_like_mst', array('customer_id' => $cust_id, 'product_id' => $prod_id, 'date' => date('d-m-Y')));
	}
	/**
	 * @param $cust_id
	 * @param $prod_id
	 */
	public function remove_product_like($cust_id, $prod_id) {
		$this->db->set('likes', 'likes-1', FALSE);
		$this->db->where('product_id', $prod_id);
		$this->db->where('status', 'on');
		$this->db->update('product_mst');
		$this->db->where('customer_id', $cust_id);
		$this->db->where('product_id', $prod_id);
		$this->db->delete('product_like_mst');
	}
	/**
	 * @param  $customer_id
	 * @return mixed
	 */
	public function get_like_products($customer_id = 0) {
		$this->db->where('customer_id', $customer_id);
		$result = $this->db->get('product_like_mst');
		return $result->result();
	}

	/**
	 * @param $prod_id
	 */
	public function add_quick_product_view($prod_id = 0) {
		$customer_id = NULL;
		if ($this->pp_login_varified->customer_varified()) {
			$customer_id = $this->session->userdata('customer_data')['customer_id'];
		}
		$data = array(
			'product_id'  => $prod_id,
			'customer_id' => $customer_id,
			'quick_view'  => '1',
			'date'        => date('d-m-Y'),
			'ip'          => $_SERVER['REMOTE_ADDR'],
			'time'        => date('h:i a'),
			'month'       => date('M-Y'),
		);
		if (isset($_SESSION['ip_country']) && isset($_SESSION['report']['ftq']) && isset($_SESSION['region'])) {
			$data = array_merge($data, array(
				'country' => $_SESSION['ip_country'],
				'region'  => $_SESSION['region'],
				'uni_key' => $_SESSION['report']['ftq']));
		}
		$check_data = '';
		if (isset($_SESSION['report']['ftq'])) {
			$check_data = $this->db->where('product_id', $prod_id)->where('uni_key', $_SESSION['report']['ftq'])->where('date', date('d-m-Y'))->get('rep_product_view')->row();
		}
		if (empty($check_data)) {
			$this->db->insert('rep_product_view', $data);
		} else {
			$new_quick_view = $check_data->quick_view + 1;
			$data           = array_merge($data, array('quick_view' => $new_quick_view));
			$this->db->where('product_id', $prod_id)->where('uni_key', $_SESSION['report']['ftq'])->where('date', date('d-m-Y'))->update('rep_product_view', $data);
		}
	}
}

/* End of file product_api_model.php */
/* Location: ./application/models/api/product_api_model.php */
