<?php

class Contact_us extends My_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('web/m_oth', 'model');

	}
	public function index() {
		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		$this->load->view('web/contact_us2', $this->pp_loader_helper->get_adm_prof_data());
		$this->load->view('web/contents/support_bar/support_bar1', $this->pp_loader_helper->get_adm_prof_data());
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}

	public function send_message() {
		if (isset($_POST['con_name'])) {
			$this->output->set_content_type('application_json');
			$form_rules = array(
				array(
					'field' => 'con_name',
					'label' => 'Name',
					'rules' => 'trim|required|min_length[2]',
				),
				array(
					'field'  => 'subject',
					'label'  => 'Subject',
					'rules'  => 'trim|required',
					'errors' => array(
						'required' => 'Select %s.',
					),
				),
				array(
					'field'  => 'con_mobile',
					'label'  => 'Mobile No',
					'rules'  => 'trim|required|min_length[10]|max_length[12]|numeric',
					'errors' => array(
						'required' => 'You must provide a %s.',
					),
				),
				array(
					'field'  => 'con_email',
					'label'  => 'Email Id',
					'rules'  => 'trim|required|valid_email',
					'errors' => array(
						'required'    => 'You must provide a %s.',
						'valid_email' => 'Enter Valid Email.',
					),
				),
				array(
					'field' => 'description',
					'label' => 'Description',
					'rules' => 'trim|required',
				),
			);
			$this->form_validation->set_rules($form_rules);
			if ($this->form_validation->run() == FALSE) {
				$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
			} else {
				$result = $this->model->add_contact_form(array(
					"name"        => $this->input->post('con_name'),
					"email"       => $this->input->post('con_email'),
					"mobileno"    => $this->input->post('con_mobile'),
					"subject"     => $this->input->post('subject'),
					"description" => $this->input->post('description'),
					"time"        => date('h:i a'),
					"date"        => date('d-m-Y'),
				));
				$this->output->set_output(json_encode(['result' => $result]));

			}

		}
	}
}
