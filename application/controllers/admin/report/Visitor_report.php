<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitor_report extends CI_Controller {
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

		// $data['date_visitor']     = $this->model->get_dateWisevisitors();
		// $data['mtsc']             = $this->model->get_mostTimeSpendCustomer(10);
		// $data['browser_data']     = $this->model->get_browser_data();
		// $data['platform_data']    = $this->model->get_platform_data();
		// $data['country_data']     = $this->model->get_country_data();
		// $data['most_visited_ips'] = $this->model->most_visited_ips(8);
		// $this->load->view('admin/inc/adm_header');
		// $this->load->view('admin/inc/adm_nav_start');
		// $this->load->view('admin/report/visitor_report', $data);
		// $this->load->view('admin/inc/adm_nav_end');
		// $assets['css']        = array("assetes/otherassets/css/admin_report.min.css");
		// $assets['javascript'] = array("assetes/otherassets/js/admin/admin_report.js", "assetes/otherassets/js/chart/Chart.min.js");
		// $this->load->view('admin/inc/adm_footer', $assets);
	}
	public function visitor_over_time() {
		$data['title']   = "Visitor over time";
		$data['data_of'] = "visitor_over_time";
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/report/sales_monthly', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$assets['css']        = array("assetes/otherassets/css/admin_report.min.css");
		$assets['javascript'] = array("assetes/otherassets/js/admin/admin_report.js", "assetes/otherassets/js/chart/Chart.min.js");
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function visitor_by_country() {
		$data['title']   = "Visitors By Location";
		$data['data_of'] = "visitors_by_location";
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/report/sales_monthly', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$assets['css']        = array("assetes/otherassets/css/admin_report.min.css");
		$assets['javascript'] = array("assetes/otherassets/js/admin/admin_report.js", "assetes/otherassets/js/chart/Chart.min.js");
		$this->load->view('admin/inc/adm_footer', $assets);
	}
	/////////////// Ajax Data ////////////////////
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