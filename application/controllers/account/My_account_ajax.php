<?php

class My_account_ajax extends My_Controller {
	function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->customer_varified()) {
			header('location:' . site_url('account/login'));
		}
		$this->load->model('web/account/m_account_ajax', 'model');
	}

	public function edit_address_ajax() {
		if (isset($_POST['address_first_name'])) {
			$customer_id = $this->session->userdata('customer_data')['customer_id'];
			$this->output->set_content_type('application_json');
			$form_rules = array(

				array(
					'field' => 'address_mobileno',
					'label' => 'Mobile No',
					'rules' => 'trim|required|min_length[10]|max_length[12]',
				),
				array(
					'field' => 'address_postcode',
					'label' => 'Post Code',
					'rules' => 'trim|required|min_length[2]',
				),
				array(
					'field' => 'address_city',
					'label' => 'City',
					'rules' => 'trim|required|min_length[2]',
				),
				array(
					'field' => 'address_1',
					'label' => 'Address',
					'rules' => 'trim|required|min_length[10]',
				),
				array(
					'field' => 'address_first_name',
					'label' => 'Name',
					'rules' => 'trim|required|min_length[2]',
				),
			);
			$this->form_validation->set_rules($form_rules);
			if ($this->form_validation->run() == FALSE) {
				$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
			} else {
				$result = $this->model->update_address($customer_id, $this->input->post('address_id'), array(
					"address1"  => $this->input->post('address_1'),
					"name"      => $this->input->post('address_first_name'),
					"address2"  => $this->input->post('address_2'),
					"city"      => $this->input->post('address_city'),
					"post_code" => $this->input->post('address_postcode'),
					"mobile_no" => $this->input->post('address_mobileno'),
					"country"   => $this->input->post('address_country'),
					"state"     => $this->input->post('address_state'),
				));
				$this->output->set_output(json_encode(['result' => $result]));
			}
		}
	}

	public function change_password() {
		if (isset($_POST['acc_password'])) {
			$customer_id = $this->session->userdata('customer_data')['customer_id'];
			$this->output->set_content_type('application_json');
			$form_rules = array(

				array(
					'field' => 'acc_password',
					'label' => 'Password',
					'rules' => 'trim|required|min_length[8]|max_length[20]',
				),
				array(
					'field' => 'acc_con_password',
					'label' => 'Confirm Password',
					'rules' => 'trim|required|matches[acc_password]',
				),
			);
			$this->form_validation->set_rules($form_rules);
			if ($this->form_validation->run() == FALSE) {
				$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
			} else {
				$result = $this->model->update_acc_password($customer_id, array(
					"password" => $this->pp_hash->create($this->input->post('acc_password')),
				));
				$this->output->set_output(json_encode(['result' => $result]));
			}
		}
	}

	public function update_newsletter() {
		if (isset($_POST['newsletter'])) {
			$this->output->set_content_type('application_json');
			$customer_id = $this->session->userdata('customer_data')['customer_id'];
			$result      = $this->model->update_newsletter($customer_id, $this->input->post('newsletter'), $this->input->post('newsletter_sms'));
			$this->output->set_output(json_encode(['result' => $result]));
		}
	}

	public function delete_review_ratings() {
		if (isset($_POST['review_id'])) {
			if ($this->pp_login_varified->customer_varified()) {
				$customer_id = $this->session->userdata('customer_data')['customer_id'];
				$this->model->delete_review($customer_id, $_POST['review_id']);
				echo "done";
			}
		}
	}

}