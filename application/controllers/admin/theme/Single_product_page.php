<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Single_product_page extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//Do your magic here
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_templete', 'model');
	}
	public function index() {
		$data['slider_1'] = unserialize(base64_decode($this->model->get_theme_mst('sin_pro_page_slider1')->datas));
		$data['slider_2'] = unserialize(base64_decode($this->model->get_theme_mst('sin_pro_page_slider2')->datas));
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/templete/single_product_page', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer');
	}
	public function update_slider() {
		if (isset($_POST['max_product']) && isset($_POST['show_product'])) {
			$data = array('max' => $this->input->post('max_product'), 'show_product_by' => $this->input->post('show_product'));
			if ($this->input->post('show_product') == 'catalogue') {
				$data = array_merge($data, array("catalogue" => $this->input->post('catalogue_name')));
			}
			$result = $this->model->update_theme_mst($this->input->post('key'), base64_encode(serialize($data)));
			$this->output->set_content_type('application_json')
			     ->set_output(json_encode(['result' => $result]));
		}
	}
}