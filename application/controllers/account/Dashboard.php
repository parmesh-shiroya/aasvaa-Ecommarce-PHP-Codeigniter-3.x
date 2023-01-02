<?php

/**
 *
 */
class Dashboard extends My_Controller {
	function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->customer_varified()) {
			header('location:' . site_url('account/login'));
		}
		$this->load->model('web/account/m_dashboard', 'model');

	}public function index() {
		// unset($_SESSION['customer_data']);
		// $_SESSION['currency_choose'] = 'ZAR';
		// echo $this->ccr->cc('INR', 'AED', '2000,00', 1, 1);
		// unset($_SESSION['customer_data']);
		$customer_id                = $this->session->userdata('customer_data')['customer_id'];
		$data['user_data']          = $this->model->user_data($customer_id);
		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		$this->load->view('web/account/inc/header2');
		$this->load->view('web/account/dashboard', $data);
		$this->load->view('web/account/inc/footer2');
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}
	public function logout() {
		unset($_SESSION['customer_data']);
	}

	public function check_guest_user_data() {
		if ($this->session->userdata('customer_data')['firstname'] == 'Guest User') {
			$this->output->set_content_type('application_json');
			$form_rules = array(

				array(
					'field' => 'mobile_no',
					'label' => 'Mobile No',
					'rules' => 'trim|required|min_length[10]|max_length[12]',
				),
				array(
					'field' => 'first_name',
					'label' => 'First Name',
					'rules' => 'trim|required|min_length[2]',
				),
				array(
					'field' => 'last_name',
					'label' => 'Last Name',
					'rules' => 'trim|required',
				),
			);
			$this->form_validation->set_rules($form_rules);
			if ($this->form_validation->run() == FALSE) {
				$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
			} else {
				$customer_id    = $this->session->userdata('customer_data')['customer_id'];
				$customer_email = $this->session->userdata('customer_data')['email'];
				$result         = $this->model->add_guest_customer_data($customer_id, array(
					"first_name" => $this->input->post('first_name'),
					"last_name"  => $this->input->post('last_name'),
					"login_with" => 'web',
					"mobileno"   => $this->input->post('mobile_no'),
				));
				$customer_data = array(
					'customer_id' => $customer_id,
					'firstname'   => $this->input->post('first_name'),
					'lastname'    => $this->input->post('last_name'),
					'email'       => $customer_email,
					'logged_in'   => TRUE,
				);
				$this->session->set_userdata('customer_data', $customer_data);
				$this->output->set_output(json_encode(['result' => $result]));
			}
		}
	}
}
