<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_other extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}
	/**
	 * @param array $data
	 * @return mixed
	 */
	public function add_faq_question($data = array()) {
		return $this->db->insert('faq_question', $data);
	}
	/**
	 * @return mixed
	 */
	public function get_faq_questions() {
		$result = $this->db->get('faq_question');
		return $result->result();
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function delete_faq($id = 0) {
		$this->db->where('id', $id);
		return $this->db->delete('faq_question');
	}

	/**
	 * @param $id
	 * @param array $data
	 * @return mixed
	 */
	public function update_faq($id = 0, $data = array()) {
		$this->db->where('id', $id);
		return $this->db->update('faq_question', $data);
	}
	/**
	 * @param $id
	 * @return mixed
	 */
	public function get_single_faq($id = 0) {
		$this->db->where('id', $id);
		$result = $this->db->get('faq_question');
		return $result->row_array();
	}

	/**
	 * @param $name
	 * @return mixed
	 */
	public function get_data_from_templete_mst($name = '') {
		$this->db->where('name', $name);
		return $this->db->get('templete_mst')->row();
	}

	/**
	 * @param $keyname
	 * @param $datass
	 * @return mixed
	 */
	public function update_tmplete_mst($keyname = "", $datass = "") {
		$this->db->where('name', $keyname);
		return $this->db->update('templete_mst', array('datas' => $datass));
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
	public function get_offer_images() {
		for ($i = 0; $i < 5; $i++) {
			$this->db->or_where('b_keys', 'offer_image_' . $i);
		}
		return $this->db->get('banner_mst')->result();

	}

	/**
	 * @param $banner_id
	 * @return mixed
	 */
	public function delete_banner($banner_id = 0) {
		return $this->db->where('id', $banner_id)->update('banner_mst', array('b_values' => '', 'link' => ''));
	}

	/**
	 * @param $title
	 * @return mixed
	 */
	public function update_offer_page_title($title = "") {
		return $this->db->where('name', 'offer_page_title')->update('templete_mst', array('datas' => $title));
	}

	/**
	 * @return mixed
	 */
	public function get_offer_title() {
		return $this->db->where('name', 'offer_page_title')->get('templete_mst')->row();
	}
}