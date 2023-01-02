<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimony extends My_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('web/M_oth', 'model');
	}
	/**
	 * @param $page
	 */
	public function index($page = 0) {
		$this->load->library('pagination');
		$config['base_url']   = site_url('testimony/index');
		$config['total_rows'] = $this->model->get_total_reviews()->num_rows();
		$config['per_page']   = 10;

		$config['num_links']       = 3;
		$config['full_tag_open']   = '<ul class="pagination right">';
		$config['full_tag_close']  = '</ul>';
		$config['first_link']      = FALSE;
		$config['last_link']       = FALSE;
		$config['first_tag_open']  = '<div>';
		$config['first_tag_close'] = '</div>';
		$config['cur_tag_open']    = '<li class="active"><a>';
		$config['cur_tag_close']   = '</a></li>';
		$config['num_tag_open']    = '  <li class="waves-effect">';
		$config['num_tag_close']   = '</li>';
		$config['next_tag_open']   = ' <li class="waves-effect">';
		$config['next_link']       = '<i class="material-icons">chevron_right</i>';
		$config['next_tag_close']  = '</li>';
		$config['prev_tag_open']   = ' <li class="waves-effect">';
		$config['prev_link']       = '<i class="material-icons">chevron_left</i>';
		$config['prev_tag_close']  = '</li>';
		$this->pagination->initialize($config);

		$data['reviews']            = $this->model->get_reviews($page);
		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		$this->load->view('web/testimony', $data);
		$this->load->view('web/contents/support_bar/support_bar1', $this->pp_loader_helper->get_adm_prof_data());
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}

}

/* End of file testimony.php */
/* Location: ./application/controllers/testimony.php */
?>