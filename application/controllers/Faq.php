<?php

class Faq extends My_Controller {

	public function __construct() {
		parent::__construct();
		//Do your magic here
		$this->load->model('web/m_faq', 'model');

	}
	public function index() {
		$data['questions']          = $this->model->get_questions();
		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());

		$this->load->view('web/faq', $data);
		$this->load->view('web/contents/support_bar/support_bar1', $this->pp_loader_helper->get_adm_prof_data());
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}
}
