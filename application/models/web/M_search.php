<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_search extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	/**
	 * @param $name
	 */
	public function get_product_by_name($name = "") {
		if (!empty(trim($name))) {

			$keywords           = explode(' ', $name);
			$searchTermKeywords = array();
			foreach ($keywords as $word) {
				$searchTermKeywords[] = "( `product_mst`.`product_name` LIKE '% $word %' OR product_mst.product_details LIKE '%\"$word\"%' )";
			}
			foreach ($keywords as $word) {
				$searchTermKeywords2[] = " product_mst.product_details LIKE '%\"$word\"%'";
			}
			$this->db->select('product_mst.product_id');
			$this->db->from('product_mst');
			$this->db->where('status =', 'on');
			$this->db->where('stock !=', '0');
			$this->db->where("(" . implode(' AND ', $searchTermKeywords) . ")");
			if (isset($_GET['cust']) && $_GET['cust'] == "phtl") {
				$this->db->order_by('sell_price', 'desc');
			}
			if (isset($_GET['cust']) && $_GET['cust'] == "plth") {
				$this->db->order_by('sell_price', 'asc');
			}if (isset($_GET['cust']) && $_GET['cust'] == "l") {
				$this->db->order_by("STR_TO_DATE(date, '%d-%m-%Y')");
			}
			// $this->db->or_where("(" . implode(' AND ', $searchTermKeywords2) . ")");
			$this->db->order_by('product_mst.views', 'DESC');
			$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = product_mst.main_cat_id');
			$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = product_mst.sub_cat_id');

			$result = $this->db->get();
			// echo $this->db->last_query();
			return $result->result_array();
		}
	}

	/**
	 * @param  $name
	 * @return mixed
	 */
	public function get_product_by_category($name = "") {
		if (!empty(trim($name))) {

			$keywords           = explode(' ', $name);
			$searchTermKeywords = array();
			foreach ($keywords as $word) {

				$searchTermKeywords[] = " main_cat_mst.cat_name LIKE '%$word%'";
			}

			$this->db->select('product_mst.product_id');
			$this->db->from('product_mst');
			$this->db->where('status =', 'on');
			$this->db->where('stock !=', '0');
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
			$this->db->where('(' . implode(' OR ', $searchTermKeywords) . ')');

			$result = $this->db->get();
			return $result->result_array();
		}
	}

	public function get_product_by_sku($name) {
		if (!empty(trim($name))) {

			$this->db->select('product_mst.product_id');
			$this->db->from('product_mst');
			$this->db->where('status =', 'on');
			$this->db->where('stock !=', '0');
			$this->db->where("product_mst.product_sku LIKE '%$name%' ");

			// $this->db->or_where("(" . implode(' AND ', $searchTermKeywords2) . ")");
			$this->db->order_by('product_mst.views', 'DESC');
			$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = product_mst.main_cat_id');
			$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = product_mst.sub_cat_id');

			$result = $this->db->get();
			// echo $this->db->last_query();
			return $result->result_array();
		}
	}
	/**
	 * @param  $name
	 * @return mixed
	 */
	public function get_product_by_sub_category($name = "") {
		if (!empty(trim($name))) {

			$keywords           = explode(' ', $name);
			$searchTermKeywords = array();
			foreach ($keywords as $word) {

				$searchTermKeywords[] = " sub_cat_mst.cat_name LIKE '%$word%'";

			}

			$this->db->select('product_mst.product_id');
			$this->db->from('product_mst');
			$this->db->where('status =', 'on');
			$this->db->where('stock !=', '0');
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
			$this->db->where('(' . implode(' OR ', $searchTermKeywords) . ')');

			$result = $this->db->get();
			return $result->result_array();
		}
	}
	/**
	 * @param  array   $ids
	 * @return mixed
	 */
	public function get_product_by_ids($ids = array()) {
		if (!empty($ids)) {
			$search_ids = array();
			$order_by   = "";
			foreach ($ids as $key => $value) {
				$search_ids[] = $value['product_id'];
				$order_by .= " WHEN product_mst.product_id = " . $value['product_id'] . " THEN " . $key . " ";
			}

			$querys = "`product_mst`.*, `main_cat_mst`.`cat_name`, `sub_cat_mst`.`cat_name` as `sub_cat_name` FROM `product_mst` JOIN `main_cat_mst` ON `main_cat_mst`.`main_cat_id` = `product_mst`.`main_cat_id` JOIN `sub_cat_mst` ON `sub_cat_mst`.`sub_cat_id` = `product_mst`.`sub_cat_id` WHERE `status` = 'on' ";
			$querys .= " AND `product_mst`.`product_id` IN(" . implode(', ', $search_ids) . ")";
			$querys .= "ORDER BY CASE $order_by ELSE 5000 END";
			// $this->db->select('product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name as sub_cat_name');
			// $this->db->from('product_mst');
			// $this->db->where('status =', 'on');
			// $this->db->where_in('product_mst.product_id', $search_ids);
			$this->db->select($querys);

			// $this->db->order_by('CASE ' . $order_by . ' END', '');
			// $this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = product_mst.main_cat_id');
			// $this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = product_mst.sub_cat_id');
			$this->db->limit(0, 24);
			$result = $this->db->get();
			// echo $this->db->last_query();
			return $result;
			// $result->result();
		} else {
			return array();
		}
	}

	/**
	 * @param $search
	 * @param $length
	 */
	public function add_serch_report($search, $length) {
		$_SESSION['report']['search'] = $search;
		return $this->db->insert('rep_search', array('search' => $search, 'product_show' => $length, 'date' => date('d-m-Y'), 'time' => date('h:i a')));

	}
}
