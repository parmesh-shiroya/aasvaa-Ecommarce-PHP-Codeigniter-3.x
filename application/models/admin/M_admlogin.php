<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admlogin extends CI_Model {
	public function __construct() {
		parent::__construct();
		//Do your magic here
	}

	/**
	 * @param  $email
	 * @param  $password
	 * @return mixed
	 */
	public function login_admin($password = "") {
		// $this->db->where('login_email_id', $email);
		$this->db->where('login_password', $password);
		return $this->db->get('admin_mst')->row();
	}
	/**
	 * @param  $data
	 * @return mixed
	 */
	public function add_login_data_to_log($data) {
		return $this->db->insert('adm_login_log', $data);
	}

	public function update_adm_password($new_password) {
		return $this->db->where('id', '1')->update('admin_mst', array("login_password" => $new_password));
	}

	public function getadmininfo() {
		return $this->db->where('id', '1')->get('admin_mst')->row();
	}
}

/* End of file M_admlogin.php */
/* Location: ./application/models/admin/M_admlogin.php */