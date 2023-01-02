<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Charges extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/product_manager/m_charges', 'model');
		// $this->load->library('pp_common');
	}
	/**
	 * @param $add_status
	 */
	function index($add_status = "") {
		$data['shipping_charges'] = $this->model->get_shipping_charges();
		$data['add_status']       = $add_status;
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/product_manager/charges', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer');
	}

	public function add_new_charge() {
		if ($this->input->post('name_inter_charge')) {

			$data = array(
				'international_charge' => $this->input->post('name_inter_charge'),
				'date'                 => date('d-m-Y'),
			);
			if (!isset($_POST['name_domestic_charge_type'])) {
				$data = array_merge($data, array('domestic_type' => "0"));
			} else {
				$data = array_merge($data, array('domestic_type' => "1"));
			}
			if (isset($_POST['name_domestic_charge'])) {
				$data = array_merge($data, array('domestic_shipping' => $this->input->post('name_domestic_charge')));
			}
			$result = $this->model->insert_new_data('shipping_charge', $data);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('result' => $result)));
		}
	}

}