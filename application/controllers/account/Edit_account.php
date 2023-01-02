<?php

class Edit_account extends My_Controller {
	function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->customer_varified()) {
			header('location:' . site_url('account/login'));
		}
		$this->load->model('web/account/m_account', 'model');
	}
	public function index() {
		$customer_id                = $this->session->userdata('customer_data')['customer_id'];
		$data['account_detail']     = $this->model->get_account_detail($customer_id);
		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		$this->load->view('web/account/inc/header2');
		$this->load->view('web/account/edit_account', $data);
		$this->load->view('web/account/inc/footer2');
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}

	public function edit() {
		$customer_id = $this->session->userdata('customer_data')['customer_id'];
		$this->output->set_content_type('application_json');
		$customer_email = $this->session->userdata('customer_data')['email'];
		$form_rules     = array(
			array(
				'field'  => 'account_mobile',
				'label'  => 'Password',
				'rules'  => 'trim|required|min_length[10]|max_length[20]',
				'errors' => array(
					'required' => 'You must provide a %s.',
				),
			),
			array(
				'field' => 'account_first_name',
				'label' => 'First Name',
				'rules' => 'trim|required|min_length[2]',
			),
			array(
				'field' => 'account_last_name',
				'label' => 'Last Name',
				'rules' => 'trim|required',
			),
		);
		if ($this->input->post('account_email_id') != $customer_email) {
			$form_rules = array_merge($form_rules, array(array(
				'field'  => 'account_email_id',
				'label'  => 'Email Id',
				'rules'  => 'trim|required|valid_email|is_unique[customers.email_id]',
				'errors' => array(
					'required'    => 'You must provide a %s.',
					'is_unique'   => 'This %s already exists.',
					'valid_email' => 'Enter Valid Email.',
				),
			)));
		} else {
			$form_rules = array_merge($form_rules, array(array(
				'field'  => 'account_email_id',
				'label'  => 'Email Id',
				'rules'  => 'trim|required|valid_email',
				'errors' => array(
					'required'    => 'You must provide a %s.',
					'is_unique'   => 'This %s already exists.',
					'valid_email' => 'Enter Valid Email.',
				),
			)));
		}

		$this->form_validation->set_rules($form_rules);
		if ($this->form_validation->run() == FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
		} else {

			$result = $this->model->update_information($customer_id, array(
				"email_id"   => $this->input->post('account_email_id'),
				"first_name" => $this->input->post('account_first_name'),
				"last_name"  => $this->input->post('account_last_name'),
				"mobileno"   => $this->input->post('account_mobile'),
				"gender"     => $this->input->post('account_gender'),
			));
			$this->output->set_output(json_encode(['result' => $result]));

			$customer_id    = $this->session->userdata('customer_data')['customer_id'];
			$customer_email = $this->session->userdata('customer_data')['email'];

			$customer_data = array(
				'customer_id' => $customer_id,
				'firstname'   => $this->input->post('account_first_name'),
				'lastname'    => $this->input->post('account_last_name'),
				'email'       => $this->input->post('account_email_id'),
				'logged_in'   => TRUE,
			);
			$this->session->set_userdata('customer_data', $customer_data);
		}
	}

}