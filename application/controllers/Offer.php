<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Offer extends My_Controller {
	public function __construct() {
		parent::__construct();
		//Do your magic here
		$this->load->model('web/M_oth', 'model');
	}
	public function index() {
		$data['offer_title']        = $this->model->get_data_from_templete_mst('offer_page_title')->datas;
		$data['offer_images']       = $this->model->get_offer_images();
		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		$this->load->view('web/offer', $data);
		$this->load->view('web/contents/support_bar/support_bar1', $this->pp_loader_helper->get_adm_prof_data());
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}

}

/* End of file terms_and_conditions.php */
/* Location: ./application/controllers/terms_and_conditions.php */