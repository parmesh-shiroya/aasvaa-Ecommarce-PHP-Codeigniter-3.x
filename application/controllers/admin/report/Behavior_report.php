<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Behavior_report extends CI_Controller {
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

		// $data['top_search']                 = $this->model->get_top_search(10);
		// $data['top_search_with_few_result'] = $this->model->get_top_search_with_few_result(10);
		// $data['customer_with_fill_cart']    = $this->model->get_customer_with_fill_cart(10);
		// $data['page_report']                = $this->model->get_page_report();
		// $this->load->view('admin/inc/adm_header');
		// $this->load->view('admin/inc/adm_nav_start');
		// $this->load->view('admin/report/behaviour_report', $data);
		// $this->load->view('admin/inc/adm_nav_end');
		// $assets['css']        = array("assetes/otherassets/css/admin_report.min.css");
		// $assets['javascript'] = array("assetes/otherassets/js/admin/admin_report.js", "assetes/otherassets/js/chart/Chart.min.js");
		// $this->load->view('admin/inc/adm_footer', $assets);
	}

	public function top_search_report() {
		$data['title']   = "Top Searches";
		$data['data_of'] = "get_top_search";
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/report/sales_monthly', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$assets['css']        = array("assetes/otherassets/css/admin_report.min.css");
		$assets['javascript'] = array("assetes/otherassets/js/admin/admin_report.js", "assetes/otherassets/js/chart/Chart.min.js");
		$this->load->view('admin/inc/adm_footer', $assets);
	}
	public function top_search_wzp_report() {
		$data['title']   = "Top Searches With Zero Product";
		$data['data_of'] = "get_top_search_with_zero_result";
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/report/sales_monthly', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$assets['css']        = array("assetes/otherassets/css/admin_report.min.css");
		$assets['javascript'] = array("assetes/otherassets/js/admin/admin_report.js", "assetes/otherassets/js/chart/Chart.min.js");
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	/**
	 * @param $page
	 */
	public function get_page_report_by_page() {
		if ($this->input->post('page_name')) {
			$result = $this->model->get_page_report_by_page($this->input->post('page_name'));
			$this->output->set_content_type('application_json')
			     ->set_output(json_encode($result));
		} else {
			header('Location:' . base_url('admin/report/Behavior_report'));
		}
	}
	/**
	 * @param $function
	 */
	public function get_all_data() {
		if ($this->input->post('get_data')) {
			$function = $this->input->post('get_data');
			$result   = $this->model->$function();
			$this->output->set_content_type('application_json')
			     ->set_output(json_encode($result));
		} else {
			header('Location:' . base_url('admin/report/Behavior_report'));
		}
	}
}