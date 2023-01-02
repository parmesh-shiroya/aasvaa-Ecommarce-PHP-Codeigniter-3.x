<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance_report extends CI_Controller {
	public function __construct() {
		parent::__construct();
		//Do your magic here
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_report', 'model');
	}
	public function index() {
		if (!isset($_SESSION['adm']['report_data']['start_date'])) {
			$_SESSION['adm']['report_data']['start_date'] = date('d-m-Y', strtotime("-30 days"));
			$_SESSION['adm']['report_data']['end_date']   = date('d-m-Y');
		}
		if ($this->input->post('report_start_date') && $this->input->post('report_end_date')) {
			$_SESSION['adm']['report_data']['start_date'] = $this->input->post('report_start_date');
			$_SESSION['adm']['report_data']['end_date']   = $this->input->post('report_end_date');
		}
		$data = array();
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/report/finance_report', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$assets['css']        = array("assetes/otherassets/css/admin_report.min.css");
		$assets['javascript'] = array("assetes/otherassets/js/admin/admin_report.js", "assetes/otherassets/js/chart/Chart.min.js");
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function transaction_report() {
		$data['title']   = "Transaction Report";
		$data['data_of'] = "get_transaction_report";
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/report/sales_monthly', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$assets['css']        = array("assetes/otherassets/css/admin_report.min.css");
		$assets['javascript'] = array("assetes/otherassets/js/admin/admin_report.js", "assetes/otherassets/js/chart/Chart.min.js");
		$this->load->view('admin/inc/adm_footer', $assets);
	}

}