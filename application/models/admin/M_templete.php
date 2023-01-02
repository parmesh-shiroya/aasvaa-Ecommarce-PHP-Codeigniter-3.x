<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_templete extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}
	/**
	 * @return mixed
	 */
	public function get_main_category() {
		$result = $this->db->get('main_cat_mst');
		return $result->result();
	}

	/**
	 * @return mixed
	 */
	public function get_sub_categorys() {
		$this->db->select('sub_cat_mst.*,main_cat_mst.cat_name as main_cat_name	');
		$this->db->from('sub_cat_mst');
		$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = sub_cat_mst.main_cat_id');
		return $this->db->get()->result();
	}

	/**
	 * @param $position
	 * @param $links
	 * @param $names
	 * @return mixed
	 */
	public function save_mobile_nav_menu($position, $links, $names) {
		$this->db->where('name', 'mobile_nav_menu');
		return $this->db->update('templete_mst', array('datas' => base64_encode(serialize(array('position' => $position, 'links' => $links, 'names' => $names)))));

	}
	/**
	 * @param $position
	 * @param $links
	 * @param $names
	 * @param $types
	 * @return mixed
	 */
	public function save_main_nav_menu($position, $links, $names, $types) {
		$this->db->where('name', 'main_nav_menu');
		return $this->db->update('templete_mst', array('datas' => base64_encode(serialize(array('position' => $position, 'links' => $links, 'names' => $names, 'types' => $types)))));

	}

	/**
	 * @param $name
	 * @param $data
	 * @return mixed
	 */
	public function update_banner($name = '', $data = '') {
		$this->db->where('name', $name);
		return $this->db->update('templete_mst', array('datas' => $data));
	}
	/**
	 * @param $name
	 * @param $data
	 * @return mixed
	 */
	public function update_theme_mst($name = '', $data = '') {
		$this->db->where('name', $name);
		return $this->db->update('templete_mst', array('datas' => $data));
	}
	/**
	 * @param $name
	 * @return mixed
	 */
	public function get_theme_mst($name) {
		return $this->db->where('name', $name)->get('templete_mst')->row();
	}

	/**
	 * @return mixed
	 */
	public function get_mobile_nav_menu() {
		$this->db->where('name', 'mobile_nav_menu');
		return $this->db->get('templete_mst')->row();
	}
	/**
	 * @return mixed
	 */
	public function get_main_nav_menu() {
		$this->db->where('name', 'main_nav_menu');
		return $this->db->get('templete_mst')->row();
	}
	/**
	 * @param $key
	 * @param $data
	 * @return mixed
	 */
	public function update_banner_2($key = "", $data) {
		$this->db->where('b_keys', $key);
		return $this->db->update('banner_mst', $data);
	}

	/**
	 * @return mixed
	 */
	public function get_main_slider_images() {
		return $this->db->or_where('b_keys', 'home_slider_0')->or_where('b_keys', 'home_slider_1')->or_where('b_keys', 'home_slider_2')->or_where('b_keys', 'home_slider_3')->or_where('b_keys', 'home_slider_4')->get('banner_mst')->result();
	}
	/**
	 * @return mixed
	 */
	public function get_banner_3_images() {
		return $this->db->or_where('b_keys', 'home_3_banner_0')->or_where('b_keys', 'home_3_banner_1')->or_where('b_keys', 'home_3_banner_2')->get('banner_mst')->result();
	}
	/**
	 * @return mixed
	 */
	public function get_banner_2_images() {
		return $this->db->or_where('b_keys', 'home_2_banner_0')->or_where('b_keys', 'home_2_banner_1')->get('banner_mst')->result();
	}
	/**
	 * @return mixed
	 */
	public function get_banner_2big_images() {
		return $this->db->or_where('b_keys', 'home_2big_banner_0')->or_where('b_keys', 'home_2big_banner_1')->get('banner_mst')->result();
	}

	/**
	 * @return mixed
	 */
	public function get_banner_5_images() {
		for ($i = 0; $i < 5; $i++) {
			$this->db->or_where('b_keys', 'home_5banner' . $i);
		}
		$this->db->order_by('id');
		return $this->db->get('banner_mst')->result();
	}

	/**
	 * @param $banner_id
	 * @return mixed
	 */
	public function delete_banner($banner_id = 0) {
		return $this->db->where('id', $banner_id)->update('banner_mst', array('b_values' => '', 'link' => ''));

	}
}