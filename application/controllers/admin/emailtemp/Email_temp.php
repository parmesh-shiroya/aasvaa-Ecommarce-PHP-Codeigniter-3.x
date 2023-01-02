<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Email_temp extends CI_Controller {
	function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_email_temp', 'model');
		// $this->load->library('pp_common');
	}

	public function welcome_mail() {
		$data                 = unserialize(base64_decode($this->model->get_email_data('welcome_mail_1')->email_data));
		$assets['javascript'] = array("assetes/otherassets/js/ckeditor/ckeditor.js");
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/email_temp/welcome_mail', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function welcome_mail_update() {
		if ($this->input->post('data')) {
			$value = base64_encode(serialize(array(
				'banner_img' => $this->input->post('banner_img'), 'main_content' => $this->input->post('data'))));
			$result = $this->model->update_mail_templete_data('welcome_mail_1', $value);
			$this->output->set_content_type('application/json')->set_output(json_encode(['result' => $result]));
		}
	}

	public function forgot_password_mail() {
		$data                 = unserialize(base64_decode($this->model->get_email_data('forgot_password_1')->email_data));
		$assets['javascript'] = array("assetes/otherassets/js/ckeditor/ckeditor.js");
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/email_temp/forgot_password_mail', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function forgot_password_mail_update() {
		if ($this->input->post('data')) {
			$value = base64_encode(serialize(array(
				'banner_img' => $this->input->post('banner_img'), 'main_content' => $this->input->post('data'))));
			$result = $this->model->update_mail_templete_data('forgot_password_1', $value);
			$this->output->set_content_type('application/json')->set_output(json_encode(['result' => $result]));
		}
	}

}