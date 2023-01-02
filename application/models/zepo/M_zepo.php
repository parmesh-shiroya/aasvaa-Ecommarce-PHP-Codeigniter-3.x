<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_zepo extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}

	/**
	 * @param  $coulum
	 * @param  $value
	 * @param  $table
	 * @return mixed
	 */
	public function get_row($coulum, $value, $table) {
		$this->db->where($coulum, $value);
		return $this->db->get($table)->row();
	}
	/**
	 * @param  $id
	 * @return mixed
	 */
	public function get_order_with_id($id = 0) {
		$this->db->select('order_mst.*,transaction_cart_data.id as trn_c_id,transaction_cart_data.se_data as trn_c_data');
		$this->db->from('order_mst');
		$this->db->where('order_mst.id', $id);
		$this->db->order_by('order_mst.id', 'DESC');
		$this->db->join('transaction_cart_data', 'transaction_cart_data.id = order_mst.trn_cart_id');
		// $this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = order_mst.sub_cat_id');
		return $this->db->get()->row();
	}

	/**
	 * @param  $id
	 * @param  $table
	 * @param  $data
	 * @return mixed
	 */
	public function update_data($name, $id, $table, $data) {
		return $this->db->where($name, $id)->update($table, $data);
	}
	/**
	 * @param  $table
	 * @param  $data
	 * @return mixed
	 */
	public function insert_data($table, $data) {
		return $this->db->insert($table, $data);
	}

	/**
	 * @param  $colum
	 * @param  $value
	 * @param  $table
	 * @return mixed
	 */
	public function delete_row($colum, $value, $table) {
		return $this->db->where($colum, $value)->delete($table);
	}
}