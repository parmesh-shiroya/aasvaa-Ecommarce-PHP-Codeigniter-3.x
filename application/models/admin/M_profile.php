<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_profile extends CI_Model {
	public function __construct() {
		parent::__construct();
		//Do your magic here
	}
	/**
	 * @param $keys
	 * @param $values
	 */
	public function update_profile($keys, $values) {
		foreach ($keys as $key => $value) {
			$this->db->where('pro_key', $value);
			$this->db->update('adm_profile', array('pro_value' => $values[$value]));
		}
		return true;
	}

	/**
	 * @param $key
	 * @return mixed
	 */
	public function get_profile_data($key = "") {
		$this->db->where('pro_key', $key);
		return $this->db->get('adm_profile')->row();
	}

	/**
	 * @return mixed
	 */
	public function get_admin_id() {
		$this->db->where('id', 1);
		return $this->db->get('admin_mst')->row();
	}

	/**
	 * @param $data
	 * @return mixed
	 */
	public function update_acc_password($data) {
		return $this->db->where('id', 1)->update('admin_mst', $data);
	}

	/**
	 * @param $count
	 * @param $coupen_id
	 * @return mixed
	 */
	public function update_coupen_data($count, $coupen_id = 0) {
		return $this->db->where('id', $coupen_id)->update('coupen_mst', array('use_count' => $count));
	}
}

/* End of file M_profile.php */
/* Location: ./application/models/admin/M_profile.php */