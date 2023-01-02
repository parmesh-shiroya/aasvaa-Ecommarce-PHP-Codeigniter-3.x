<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Preferences extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_profile', 'model');
	}
	public function index() {
		$data['admin_id'] = $this->model->get_admin_id();
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/profile/my_preferences', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer');
	}
	public function change_password() {
		if (isset($_POST['password'])) {
			$this->output->set_content_type('application_json');
			$form_rules = array(

				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'trim|required|min_length[8]|max_length[20]',
				),
				array(
					'field' => 'con_password',
					'label' => 'Confirm Password',
					'rules' => 'trim|required|matches[password]',
				),

			);
			$this->form_validation->set_rules($form_rules);
			if ($this->form_validation->run() == FALSE) {
				$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
			} else {
				$result = $this->model->update_acc_password(array(
					"login_password" => $this->pp_hash->create($this->input->post('password')),
					"mobileno"       => $this->pp_hash->create($this->input->post('mob1')),
					"mobileno1"      => $this->pp_hash->create($this->input->post('mob2')),
					"mobileno2"      => $this->pp_hash->create($this->input->post('mob3')),
				));
				$this->output->set_output(json_encode(['result' => $result]));
			}
		}
	}

	function change_mobileno() {
		if (isset($_POST['mob1'])) {
			$this->output->set_content_type('application_json');
			$form_rules = array(
				array(
					'field' => 'mob1',
					'label' => 'Mobile no 1',
					'rules' => 'min_length[10]',
				),
				array(
					'field' => 'mob2',
					'label' => 'Mobile no 2',
					'rules' => 'min_length[10]',
				),
				array(
					'field' => 'mob3',
					'label' => 'Mobile no 3',
					'rules' => 'min_length[10]',
				),
			);
			$this->form_validation->set_rules($form_rules);
			if ($this->form_validation->run() == FALSE) {
				$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
			} else {
				$result = $this->model->update_acc_password(array(
					"mobileno"  => $this->input->post('mob1'),
					"mobileno1" => $this->input->post('mob2'),
					"mobileno2" => $this->input->post('mob3'),
				));
				$this->output->set_output(json_encode(['result' => $result]));
			}
		}
	}
}

/* End of file Preferences.php */
/* Location: ./application/controllers/admin/profile/Preferences.php */