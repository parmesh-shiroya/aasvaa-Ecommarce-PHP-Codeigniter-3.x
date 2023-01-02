<?php
/**
 *  Login Class
 */
class Login extends My_Controller {
	function __construct() {
		parent::__construct();
		if ($this->pp_login_varified->customer_varified()) {
			header('location:' . site_url('account/dashboard'));
		}
		$this->load->model('web/account/m_login', 'model');
	}
	public function index() {
		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		$this->load->view('web/account/login');
		$this->load->view('web/contents/support_bar/support_bar1', $this->pp_loader_helper->get_adm_prof_data());
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}

	public function forgot_password() {
		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		$this->load->view('web/account/forgot_password');
		$this->load->view('web/contents/support_bar/support_bar1', $this->pp_loader_helper->get_adm_prof_data());
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}
	public function logout() {
		unset($_SESSION['customer_data']);
		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		$this->load->view('web/account/login');
		$this->load->view('web/contents/support_bar/support_bar1', $this->pp_loader_helper->get_adm_prof_data());
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}
	public function register() {
		$this->output->set_content_type('application_json');
		$form_rules = array(
			array(
				'field'  => 'register_email',
				'label'  => 'Email Id',
				'rules'  => 'trim|required|valid_email|is_unique[customers.email_id]',
				'errors' => array(
					'required'    => 'You must provide a %s.',
					'is_unique'   => 'This %s already exists.',
					'valid_email' => 'Enter Valid Email.',
				),
			),
			array(
				'field'  => 'register_password',
				'label'  => 'Password',
				'rules'  => 'trim|required|min_length[8]|max_length[20]',
				'errors' => array(
					'required' => 'You must provide a %s.',
				),
			),
			array(
				'field' => 'register_first_name',
				'label' => 'First Name',
				'rules' => 'trim|required|min_length[2]',
			),
			array(
				'field' => 'register_last_name',
				'label' => 'Last Name',
				'rules' => 'trim|required',
			),
		);
		$this->form_validation->set_rules($form_rules);
		if ($this->form_validation->run() == FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
		} else {
			$result = $this->model->register_customer(array(
				"first_name" => $this->input->post('register_first_name'),
				"last_name"  => $this->input->post('register_last_name'),
				"email_id"   => $this->input->post('register_email'),
				"gender"     => $this->input->post('register_gender'),
				"password"   => $this->pp_hash->create($this->input->post('register_password')),
			));
			if ($result == true) {
				$customer_id   = $this->model->registr_customer_id();
				$customer_data = array(
					'customer_id' => $customer_id,
					'firstname'   => $this->input->post('register_first_name'),
					'lastname'    => $this->input->post('register_last_name'),
					'email'       => $this->input->post('register_email'),
					'logged_in'   => TRUE,
				);

				///=================================== Send Mail ===========================///
				$message     = $this->pp_email_templetes->register_email_1(array('customer_name' => ucfirst($this->input->post('register_first_name'))));
				$mail_return = $this->pp_common->sendEmail('forcustomer@aasvaa.com', $this->input->post('register_email'), 'Welocome To Aasvaa Fashion.', $message);

				///=================================== End Send Mail ===========================///
				$this->model->update_last_login_date($customer_id);
				$this->session->set_userdata('customer_data', $customer_data);
			}
			$this->output->set_output(json_encode(['result' => $result, 'sc' => $mail_return]));
		}
	}

	public function login_with_google() {
		$this->output->set_content_type('application_json');
		$data = $this->model->check_user_exist($this->input->post('email_address'), $this->input->post('user_ids'), 'google');
		if (!empty($data)) {
			$customer_data = array(
				'customer_id' => $data->id,
				'firstname'   => $this->input->post('first_name'),
				'lastname'    => '',
				'email'       => $this->input->post('email_address'),
				'img_url'     => $this->input->post('image_link'),
				'logged_in'   => TRUE,
			);
			$this->session->set_userdata('customer_data', $customer_data);
			$this->output->set_output(json_encode(['result' => 'true']));
		} else {
			if (empty($this->model->check_email_exist($this->input->post('email_address')))) {
				$result = $this->model->register_customer(array(
					"first_name" => $this->input->post('first_name'),
					"login_with" => 'google',
					"email_id"   => $this->input->post('email_address'),
					"user_id"    => $this->input->post('user_ids'),
					"image_link" => $this->input->post('image_links'),
				));
				if ($result == true) {
					$customer_id   = $this->model->registr_customer_id();
					$customer_data = array(
						'customer_id' => $customer_id,
						'firstname'   => $this->input->post('first_name'),
						'lastname'    => '',
						'email'       => $this->input->post('email_address'),
						'img_url'     => $this->input->post('image_link'),
						'logged_in'   => TRUE,
					);
					///=================================== Send Mail ===========================///
					$message     = $this->pp_email_templetes->register_email_1(array('customer_name' => ucfirst($this->input->post('first_name'))));
					$mail_return = $this->pp_common->sendEmail('forcustomer@aasvaa.com', $this->input->post('email_address'), 'Welocome To Aasvaa Fashion.', $message);
					///=================================== End Send Mail ===========================///
					$this->model->update_last_login_date($customer_id);
					$this->session->set_userdata('customer_data', $customer_data);
				}
				$this->output->set_output(json_encode(['result' => $result]));
			} else {
				$this->output->set_output(json_encode(['result' => 'Email Already Use.']));
			}
		}
	}

	public function login_with_facebooks() {

		// $this->output->set_content_type('application_json');
		$data = $this->model->check_user_exist($this->input->post('email_address'), $this->input->post('user_ids'), 'facebook');
		if (!empty($data)) {
			$customer_data = array(
				'customer_id' => $data->id,
				'firstname'   => $this->input->post('first_name'),
				'lastname'    => '',
				'email'       => $this->input->post('email_address'),
				'img_url'     => $this->input->post('image_link'),
				'logged_in'   => TRUE,
			);
			$this->session->set_userdata('customer_data', $customer_data);
			$this->output->set_output(json_encode(['result' => 'true']));
		} else {
			if (empty($this->model->check_email_exist($this->input->post('email_address')))) {
				$result = $this->model->register_customer(array(
					"first_name" => $this->input->post('first_name'),
					"login_with" => 'facebook',
					"email_id"   => $this->input->post('email_address'),
					"user_id"    => $this->input->post('user_ids'),
					"image_link" => $this->input->post('image_links'),
				));

				if ($result == true) {
					$customer_id   = $this->model->registr_customer_id();
					$customer_data = array(
						'customer_id' => $customer_id,
						'firstname'   => $this->input->post('first_name'),
						'lastname'    => '',
						'email'       => $this->input->post('email_address'),
						'img_url'     => $this->input->post('image_link'),
						'logged_in'   => TRUE,
					);
					///=================================== Send Mail ===========================///
					$message     = $this->pp_email_templetes->register_email_1(array('customer_name' => ucfirst($this->input->post('first_name'))));
					$mail_return = $this->pp_common->sendEmail('forcustomer@aasvaa.com', $this->input->post('email_address'), 'Welocome To Aasvaa Fashion.', $message);
					///=================================== End Send Mail ===========================///
					$this->model->update_last_login_date($customer_id);
					$this->session->set_userdata('customer_data', $customer_data);
				}
				$this->output->set_output(json_encode(['result' => $result]));
			} else {
				$this->output->set_output(json_encode(['result' => 'Email Already Use.']));
			}
		}
	}

	public function login() {
		$this->output->set_content_type('application_json');
		$form_rules = array(
			array(
				'field'  => 'login_email',
				'label'  => 'Email Id',
				'rules'  => 'trim|required|valid_email',
				'errors' => array(
					'required'    => 'You must provide a %s.',
					'valid_email' => 'Enter Valid Email.',
				),
			),
			array(
				'field'  => 'login_password',
				'label'  => 'Password',
				'rules'  => 'trim|required|min_length[8]|max_length[20]',
				'errors' => array(
					'required' => 'You must provide a %s.',
				),
			),
		);
		$this->form_validation->set_rules($form_rules);
		if ($this->form_validation->run() == FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
		} else {
			$result = $this->model->login_customer($this->input->post('login_email'), $this->pp_hash->create($this->input->post('login_password')
			));
			if (!empty($result)) {
				$customer_data = array(
					'customer_id' => $result->id,
					'firstname'   => $result->first_name,
					'lastname'    => $result->last_name,
					'email'       => $result->email_id,
					'logged_in'   => TRUE,
				);
				$this->model->update_last_login_date($result->id);
				$this->session->set_userdata('customer_data', $customer_data);
				$this->output->set_output(json_encode(['result' => true]));

			} else {

				$this->output->set_output(json_encode(['result' => "2"]));
			}
		}
	}

	public function guest_login() {

		$form_rules = array(
			array(
				'field'  => 'guest_login_email',
				'label'  => 'Email Id',
				'rules'  => 'trim|required|valid_email|is_unique[customers.email_id]',
				'errors' => array(
					'required'    => 'You must provide a %s.',
					'is_unique'   => 'This %s already exists. Login with this Email id.',
					'valid_email' => 'Enter Valid Email.',
				),
			),
		);
		$this->form_validation->set_rules($form_rules);
		if ($this->form_validation->run() == FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
		} else {
			$result = $this->model->register_guest_user($this->input->post('guest_login_email'));
			if (!empty($result)) {
				$customer_data = array(
					'customer_id' => $result,
					'firstname'   => 'Guest User',
					'lastname'    => '',
					'email'       => $this->input->post('guest_login_email'),
					'logged_in'   => TRUE,
				);
				$this->session->set_userdata('customer_data', $customer_data);
				$this->output->set_output(json_encode(['result' => true]));

			} else {
				// $this->output->set_output(json_encode(['result' => "2"]));
			}
		}
	}
}
?>
