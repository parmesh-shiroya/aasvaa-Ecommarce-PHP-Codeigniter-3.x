<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_cate extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * @param  $table
	 * @param  $cat_id
	 * @return mixed
	 */
	public function get_product($table = "", $cat_id = "0") {

		$this->db->select('product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name as sub_cat_name');
		$this->db->from('product_mst');
		$this->db->where('status =', 'on');
		$this->db->where('stock !=', '0');
		$this->db->where('product_mst.' . $table, $cat_id);
		if (isset($_SESSION['price_filters']['high_price'])) {
			$this->db->where('product_mst.sell_price <= ' . round($_SESSION['price_filters']['high_price']));
		}
		if (isset($_SESSION['price_filters']['min_price'])) {
			$this->db->where('product_mst.sell_price >= ' . round($_SESSION['price_filters']['min_price']));
		}
		if (isset($_GET['cust']) && $_GET['cust'] == "phtl") {
			$this->db->order_by('sell_price', 'desc');
		}
		if (isset($_GET['cust']) && $_GET['cust'] == "plth") {
			$this->db->order_by('sell_price', 'asc');
		}if (isset($_GET['cust']) && $_GET['cust'] == "l") {
			$this->db->order_by("STR_TO_DATE(date, '%d-%m-%Y')");
		}
		$this->db->order_by('product_mst.views', 'DESC');
		$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = product_mst.main_cat_id');
		$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = product_mst.sub_cat_id');

		$result = $this->db->get();
		return $result->result();
	}

	/**
	 * @return mixed
	 */
	public function get_all_products_details() {
		$result = $this->db->get('product_details_mst');
		return $result->result();
	}
	/**
	 * @param  $m_cat_id
	 * @return mixed
	 */
	public function get_all_products_details_by_m_cat_id($m_cat_id) {
		$result = $this->db->where('m_cat_id', $m_cat_id)->get('product_details_mst');
		return $result->result();
	}
	/**
	 * @param  $s_cat_id
	 * @return mixed
	 */
	public function get_all_products_details_by_m_sub_id($s_cat_id) {
		$result = $this->db->where('sub_cat_id', $s_cat_id)->get('sub_cat_mst')->row();

		$result = $this->db->where('m_cat_id', $result->main_cat_id)->get('product_details_mst');
		return $result->result();
	}

	/**
	 * @param  $table
	 * @param  $cat_id
	 * @return mixed
	 */
	public function get_product_by_filter($table = "", $cat_id = "0") {
		$this->db->select('product_details_mst.*,product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name as sub_cat_name');
		$this->db->from('product_details_mst');
		$this->db->where('status =', 'on');
		$this->db->where('stock !=', '0');
		if (isset($_SESSION['filter']) && !empty($_SESSION['filter'])) {
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
		}

		$this->db->join('product_mst', 'product_mst.product_id = product_details_mst.product_id');
		$this->db->where('product_mst.' . $table, $cat_id);
		if (isset($_SESSION['price_filters']['high_price'])) {
			$this->db->where('product_mst.sell_price <= ' . round($_SESSION['price_filters']['high_price']));
		}
		if (isset($_SESSION['price_filters']['min_price'])) {
			$this->db->where('product_mst.sell_price >= ' . round($_SESSION['price_filters']['min_price']));
		}
		if (isset($_GET['cust']) && $_GET['cust'] == "phtl") {
			$this->db->order_by('sell_price', 'desc');
		}
		if (isset($_GET['cust']) && $_GET['cust'] == "plth") {
			$this->db->order_by('sell_price', 'asc');
		}if (isset($_GET['cust']) && $_GET['cust'] == "l") {
			$this->db->order_by("STR_TO_DATE(date, '%d-%m-%Y')");
		}
		if (isset($_SESSION['single_filter']['Shipping_time'])) {
			$shipping_time = array();
			foreach ($_SESSION['single_filter']['Shipping_time'] as $key => $value) {
				array_push($shipping_time, "'" . $value . "'");
			}
			$shipping_time = implode(',', $shipping_time);
			$this->db->where('ship_time IN (' . $shipping_time . ')');
		}
		$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = product_mst.main_cat_id');
		$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = product_mst.sub_cat_id');
		$result = $this->db->get();
		// echo $this->db->last_query();
		return $result->result();
	}

	/**
	 * @return mixed
	 */
	public function get_max_price() {
		$this->db->select_max('sell_price');
		$result = $this->db->get('product_mst')->row();
		return $result->sell_price;
	}
	/**
	 * @return mixed
	 */
	public function get_min_price() {
		$this->db->select_min('sell_price');
		$result = $this->db->get('product_mst')->row();
		return $result->sell_price;
	}

	/**
	 * @param  $cat
	 * @return mixed
	 */
	public function get_banner_link($cat = 0) {
		$data = $this->db->where('b_keys', 'main_cat_' . $cat)->get('banner_mst')->row();
		if (empty($data)) {
			return $this->db->where('b_keys', 'main_cat_0')->get('banner_mst')->row();
		} else {
			return $data;
		}
	}

	public function get_shiping_time_filter() {
		return $this->db->select('ship_time')->group_by('ship_time')->get('product_mst')->result_array();
	}
}
