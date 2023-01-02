<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_charges extends CI_Model {
	public function __construct() {
		parent::__construct();
		//Do your magic here
	}

	/**
	 * @return mixed
	 */
	public function get_shipping_charges() {
		return $this->db->order_by('id', 'desc')->get('shipping_charge')->row();
	}

	/**
	 * @param $table
	 * @param $data
	 * @return mixed
	 */
	public function insert_new_data($table, $data) {
		return $this->db->insert($table, $data);
	}

}