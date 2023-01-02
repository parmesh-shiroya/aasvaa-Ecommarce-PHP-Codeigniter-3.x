<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_report extends CI_Controller {
	public function __construct() {
		parent::__construct();
		//Do your magic here
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_report', 'model');
	}
	public function index() {
		// if (!isset($_SESSION['adm']['report_data']['start_date'])) {
		// 	$_SESSION['adm']['report_data']['start_date'] = date('d-m-Y', strtotime("-30 days"));
		// 	$_SESSION['adm']['report_data']['end_date']   = date('d-m-Y');
		// }
		// if ($this->input->post('report_start_date') && $this->input->post('report_end_date')) {
		// 	$_SESSION['adm']['report_data']['start_date'] = $this->input->post('report_start_date');
		// 	$_SESSION['adm']['report_data']['end_date']   = $this->input->post('report_end_date');
		// }
		// $data['total_sale_price'] = $this->model->get_total_sales_price_by_status();

		// $data['total_sales_price_by_month']     = $this->model->get_total_sales_price_by_status('rep_order_finance.order_month', 'rep_order_finance.order_month');
		// $data['order_count_data']               = $this->model->get_all_orders_count();
		// $data['get_order_codAndPrepaid_profit'] = $this->model->get_order_codAndPrepaid_profit();

		// $data['varient_sku']  = $this->model->get_varient_skus();
		// $data['customer_WBS'] = $this->model->get_customer_WBS(10);

		// $this->load->view('admin/inc/adm_header');
		// $this->load->view('admin/inc/adm_nav_start');
		// $this->load->view('admin/report/sales_report', $data);
		// $this->load->view('admin/inc/adm_nav_end');
		// $assets['css']        = array("assetes/otherassets/css/admin_report.min.css");
		// $assets['javascript'] = array("assetes/otherassets/js/admin/admin_report.js", "assetes/otherassets/js/chart/Chart.min.js");
		// $this->load->view('admin/inc/adm_footer', $assets);
	}

	public function sales_by_month() {
		$data['title']   = "Sales by month";
		$data['data_of'] = "sales_by_month";
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/report/sales_monthly', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$assets['css']        = array("assetes/otherassets/css/admin_report.min.css");
		$assets['javascript'] = array("assetes/otherassets/js/admin/admin_report.js", "assetes/otherassets/js/chart/Chart.min.js");
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function sales_by_product() {
		$data['title']   = "Sales by Product";
		$data['data_of'] = "sales_by_product";
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/report/sales_monthly', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$assets['css']        = array("assetes/otherassets/css/admin_report.min.css");
		$assets['javascript'] = array("assetes/otherassets/js/admin/admin_report.js", "assetes/otherassets/js/chart/Chart.min.js");
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function get_all_data() {
		if ($this->input->post('get_data')) {
			$function = $this->input->post('get_data');
			if ($this->input->post('pass_data')) {
				$result = $this->model->$function($this->input->post('pass_data'));
			} else {
				$result = $this->model->$function();
			}
			$this->output->set_content_type('application_json')
			     ->set_output(json_encode($result));
		} else {
			header('Location:' . base_url('admin/report/Behavior_report'));
		}
	}

}