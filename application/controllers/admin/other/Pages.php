<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_other', 'model');
	}
	public function tearms_and_condition() {
		$data['trm_html']     = base64_decode($this->model->get_data_from_templete_mst('terms_and_condition_html')->datas);
		$assets['javascript'] = array("assetes/otherassets/js/ckeditor/ckeditor.js");
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/other/terms_and_condition', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer', $assets);
	}
	public function tearms_and_condition_update() {
		if (isset($_POST['data'])) {
			$result = $this->model->update_tmplete_mst('terms_and_condition_html', base64_encode($this->input->post('data')));

			$this->output->set_content_type('application_json')->set_output(json_encode(['result' => $result]));
		}
	}

	public function privacy_policy() {
		$data['prnp_html']    = base64_decode($this->model->get_data_from_templete_mst('privacy_policy_html')->datas);
		$assets['javascript'] = array("assetes/otherassets/js/ckeditor/ckeditor.js");
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/other/privacy_policy', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function privacy_policy_update() {
		if (isset($_POST['data'])) {
			$result = $this->model->update_tmplete_mst('privacy_policy_html', base64_encode($this->input->post('data')));
			$this->output->set_content_type('application_json')->set_output(json_encode(['result' => $result]));
		}
	}

	public function return_policy() {
		$data['return_policy_html'] = base64_decode($this->model->get_data_from_templete_mst('return_policy_html')->datas);
		$assets['javascript']       = array("assetes/otherassets/js/ckeditor/ckeditor.js");
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/other/return_policy', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function return_policy_update() {
		if (isset($_POST['data'])) {
			$result = $this->model->update_tmplete_mst('return_policy_html', base64_encode($this->input->post('data')));
			$this->output->set_content_type('application_json')->set_output(json_encode(['result' => $result]));
		}
	}

	public function shipping_policy() {
		$data['shipping_policy_html'] = base64_decode($this->model->get_data_from_templete_mst('shipping_policy_html')->datas);
		$assets['javascript']         = array("assetes/otherassets/js/ckeditor/ckeditor.js");
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/other/shipping_policy', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function shipping_policy_update() {
		if (isset($_POST['data'])) {
			$result = $this->model->update_tmplete_mst('shipping_policy_html', base64_encode($this->input->post('data')));
			$this->output->set_content_type('application_json')->set_output(json_encode(['result' => $result]));
		}
	}

	public function about_us() {
		$data['about_us_html'] = base64_decode($this->model->get_data_from_templete_mst('about_us_html')->datas);
		$assets['javascript']  = array("assetes/otherassets/js/ckeditor/ckeditor.js");
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/other/about_us', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function about_us_update() {
		if (isset($_POST['data'])) {
			$result = $this->model->update_tmplete_mst('about_us_html', base64_encode($this->input->post('data')));
			$this->output->set_content_type('application_json')->set_output(json_encode(['result' => $result]));
		}
	}

	public function payment_option() {
		$data['payment_option_html'] = base64_decode($this->model->get_data_from_templete_mst('payment_option_html')->datas);
		$assets['javascript']        = array("assetes/otherassets/js/ckeditor/ckeditor.js");
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/other/payment_option', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function payment_option_update() {
		if (isset($_POST['data'])) {
			$result = $this->model->update_tmplete_mst('payment_option_html', base64_encode($this->input->post('data')));
			$this->output->set_content_type('application_json')->set_output(json_encode(['result' => $result]));
		}
	}

	public function size_guide() {
		$data['size_guide_html'] = base64_decode($this->model->get_data_from_templete_mst('size_guide_html')->datas);
		$assets['javascript']    = array("assetes/otherassets/js/ckeditor/ckeditor.js");
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/other/size_guide', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function size_guide_update() {
		if (isset($_POST['data'])) {
			$result = $this->model->update_tmplete_mst('size_guide_html', base64_encode($this->input->post('data')));
			$this->output->set_content_type('application_json')->set_output(json_encode(['result' => $result]));
		}
	}
}

/* End of file Pages.php */
/* Location: ./application/controllers/admin/other/Pages.php */