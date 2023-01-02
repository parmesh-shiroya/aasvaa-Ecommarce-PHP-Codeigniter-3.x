<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct();
		//Do your magic here
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_home', 'model');
	}
	public function index() {

		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$data['stock']['instock']  = $this->model->total_instock_product();
		$data['stock']['outstock'] = $this->model->out_of_stock_product();
		$data['total_customer']    = $this->model->where_get('customers')->num_rows();
		$data['browser_data']      = $this->model->get_browser_data();
		$data['platform_data']     = $this->model->get_platform_data();
		$data['country_data']      = $this->model->get_country_data();
		$data['top_search']        = $this->model->get_top_search();
		$data['visitor_data']      = $this->model->get_visitor_data();
		$data['order_count_data']  = $this->model->get_all_orders_count();
		$this->load->view('admin/home', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$assets['javascript'] = array("assetes/otherassets/js/chart/Chart.min.js", "assetes/otherassets/js/admin/admin_report.js");
		$assets['css']        = array("assetes/otherassets/css/admin_report.min.css");
		$this->load->view('admin/inc/adm_footer', $assets);
	}
	public function login_log() {
		$assets['javascript'] = array("assetes/otherassets/js/jquery.dataTables.min.js");
		$assets['css']        = array("assetes/otherassets/css/jquery.dataTables.min.css");
		$data['login_log']    = $this->model->get_adm_login_logs();
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/login_log', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer', $assets);
	}
	public function logout() {
		unset($_SESSION['admin_login_data']);
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */