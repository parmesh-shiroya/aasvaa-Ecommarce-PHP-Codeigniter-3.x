<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}
	/**
	 * @return mixed
	 */
	public function get_adm_login_logs() {
		return $this->db->get('adm_login_log')->result();
	}

	/**
	 * @return mixed
	 */
	public function total_instock_product() {
		return $this->db->where('stock !=', '0')->get('product_mst')->num_rows();
	}
	/**
	 * @return mixed
	 */
	public function out_of_stock_product() {
		return $this->db->where('stock', '0')->get('product_mst')->num_rows();
	}
	/**
	 * @param  $table
	 * @param  $columen
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
	public function get_browser_data() {
		return $this->db->select('browser, count(browser) as total')
		            ->group_by('browser')
		            ->order_by('count(platform)', 'desc')
		            ->get('rep_browser')->result();
	}
	/**
	 * @return mixed
	 */
	public function get_platform_data() {
		return $this->db->select('platform, count(platform) as total')
		            ->group_by('platform')
		            ->order_by('count(platform)', 'desc')
		            ->get('rep_browser')->result();
	}

	/**
	 * @return mixed
	 */
	public function get_country_data() {
		return $this->db->select('rep_browser.country, count(rep_browser.country) as total,countries.name as country_name')
		            ->group_by('rep_browser.country')
		            ->order_by('count(rep_browser.country)', 'desc')
		            ->limit(5)
		            ->join('countries', 'countries.sortname = rep_browser.country')
		            ->get('rep_browser')->result();
	}

	/**
	 * @return mixed
	 */
	public function get_top_search() {
		return $this->db->select('search, count(search) as total')
		            ->group_by('search')
		            ->order_by('count(search)', 'desc')
		            ->limit(6)
		            ->get('rep_search')->result();
	}

	/**
	 * @return mixed
	 */
	public function get_visitor_data() {
		return $this->db->select('date, count(date) as total')
		            ->group_by('date')
		            ->order_by('id', 'desc')
		            ->limit(10)
		            ->get('rep_browser')->result_array();
	}

	/**
	 * @return mixed
	 */
	public function get_all_orders_count() {
		return $this->db->select('status, count(status) as total')
		            ->group_by('status')
		            ->order_by('id', 'desc')
		            ->get('order_mst')->result();
	}
}