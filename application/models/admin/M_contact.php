<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_contact extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}
	/**
	 * @param $subject
	 */
	public function get_new_contact_form_by_subject($subject) {
		return $this->db->where('subject', $subject)->get('contact_forms')->result();
	}

	/**
	 * @param  $form_id
	 * @return mixed
	 */
	public function get_single_form($form_id) {
		return $this->db->where('id', $form_id)->get('contact_forms')->row_array();
	}

	/**
	 * @param $id
	 * @param $data
	 */
	public function update_form($id, $data) {
		return $this->db->where('id', $id)->update('contact_forms', $data);
	}
}