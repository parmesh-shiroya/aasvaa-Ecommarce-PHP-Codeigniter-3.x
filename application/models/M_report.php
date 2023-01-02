<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_report extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}
	/**
	 * @param  $table
	 * @param  $data
	 * @return mixed
	 */
	public function check_exist_data($ipaddress, $mac_address, $platform) {
		return $this->db->where('ip', $ipaddress)
		            ->where('mac', $mac_address)
		            ->where('platform', $platform)
		            ->where('date', date('d-m-Y'))
		            ->get('rep_browser')->row();
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
	 * @param $uni_key
	 * @param $stay_time
	 */
	public function update_stay_time_data($uni_key, $stay_time, $customer_id = null) {
		$this->db->where('uni_key', $uni_key);
		$insert_data = array('stay_time' => $stay_time);
		if (!empty($customer_id)) {
			$insert_data = array_merge($insert_data, array('customer_id' => $customer_id));
		}
		return $this->db->update('rep_browser', $insert_data);
	}
}