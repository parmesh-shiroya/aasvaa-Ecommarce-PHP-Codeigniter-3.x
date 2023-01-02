<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Coupen_manager extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}

	/**
	 * @param array $data
	 * @return mixed
	 */
	public function add_coupen($data = array()) {
		return $this->db->insert('coupen_mst', $data);
	}
	/**
	 * @return mixed
	 */
	public function get_all_coupen() {
		$result = $this->db->get('coupen_mst');
		return $result->result_array();
	}

	/**
	 * @param $coupen_id
	 * @return mixed
	 */
	public function get_coupe_data($coupen_id = 0) {
		$this->db->where('id', $coupen_id);
		return $this->db->get('coupen_mst')->row_array();
	}

	/**
	 * @param $id
	 * @param $coupen_code
	 * @param array $data
	 * @return mixed
	 */
	public function update_coupen($id = 0, $coupen_code = 0, $data = array()) {
		$this->db->where('id', $id);
		$this->db->where('code', $coupen_code);
		return $this->db->update('coupen_mst', $data);
	}
}