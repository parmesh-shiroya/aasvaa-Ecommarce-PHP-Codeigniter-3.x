<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Single_order_report extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_report', 'model');
	}
	public function index() {
		$data['transaction_data'] = null;
		if ($this->input->post('name_prod_sku')) {
			$data['transaction_data'] = $this->get_transaction_data($this->input->post('name_prod_sku'));
		}
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/report/single_order_report', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer');
	}

	public function get_transaction_data($order_id = "") {
		if (!empty($order_id)) {
			$transaction_details = $this->model->get_single_order_trn_data($order_id);
			if (!empty($transaction_details)) {
				return $transaction_details;
			} else {
				return null;
			}

		}
	}

}