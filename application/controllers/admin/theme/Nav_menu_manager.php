<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nav_menu_manager extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_templete', 'model');
	}
	public function index() {
		$data['mobile_nav_menu'] = unserialize(base64_decode($this->model->get_mobile_nav_menu()->datas));
		// print_r(unserialize(base64_decode($data['mobile_nav_menu']->datas)));
		$data['main_cate']    = $this->model->get_main_category();
		$data['sub_cate']     = $this->model->get_sub_categorys();
		$assets['javascript'] = array("assetes/otherassets/js/jquery.nestable.js");
		$assets['css']        = array("assetes/otherassets/css/nestable.css");
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/templete/nav_menu_manager', $data);

		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function save_mobile_nav_menu() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['positions'])) {
				echo $this->model->save_mobile_nav_menu($this->input->post('positions'), $this->input->post('links'), $this->input->post('names'));
			}
		}
	}

	public function main_menu() {
		$data['main_nav_menu'] = unserialize(base64_decode($this->model->get_main_nav_menu()->datas));
		$data['main_cate']     = $this->model->get_main_category();
		$data['sub_cate']      = $this->model->get_sub_categorys();
		$assets['javascript']  = array("assetes/otherassets/js/jquery.nestable.js");
		$assets['css']         = array("assetes/otherassets/css/nestable.css");
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/templete/main_menu', $data);

		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function save_main_nav_menu() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['positions'])) {
				echo $this->model->save_main_nav_menu($this->input->post('positions'), $this->input->post('links'), $this->input->post('names'), $this->input->post('types'));
			}
		}
	}

}