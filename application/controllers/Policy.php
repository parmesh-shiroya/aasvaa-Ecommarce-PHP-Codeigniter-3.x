<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class policy extends My_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('web/M_oth', 'model');
	}
	public function privacy_policy() {
		$data['privacy_policy']     = base64_decode($this->model->get_data_from_templete_mst('privacy_policy_html')->datas);
		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		$this->load->view('web/privacy_policy', $data);
		$this->load->view('web/contents/support_bar/support_bar1', $this->pp_loader_helper->get_adm_prof_data());
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}
	public function return_policy() {
		$data['return_policy_html'] = base64_decode($this->model->get_data_from_templete_mst('return_policy_html')->datas);
		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		$this->load->view('web/return_policy', $data);
		$this->load->view('web/contents/support_bar/support_bar1', $this->pp_loader_helper->get_adm_prof_data());
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}
	public function shipping_policy() {
		$data['shipping_policy_html'] = base64_decode($this->model->get_data_from_templete_mst('shipping_policy_html')->datas);
		$headers['mobile_nav_menu']   = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		$this->load->view('web/shipping_policy', $data);
		$this->load->view('web/contents/support_bar/support_bar1', $this->pp_loader_helper->get_adm_prof_data());
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}

}

/* End of file privacy_policy.php */
/* Location: ./application/controllers/privacy_policy.php */