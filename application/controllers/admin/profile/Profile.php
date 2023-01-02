<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __construct() {
		parent::__construct();
		//Do your magic here
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_profile', 'model');
	}
	public function index() {
		// $get_data = array('shop_add', 'mobile_no', 'customer_support_email');
		// foreach ($get_data as $key => $value) {
		// 	$prof_data[$value] = $this->model->get_profile_data($value)->pro_value;
		// }
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/profile/profile', $this->pp_loader_helper->get_adm_prof_data());
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer');
	}

	public function prof_data() {
		if ($this->pp_login_varified->admin_varified()) {

			if (isset($_POST['contact_person_name']) && isset($_POST['company_name'])) {

				$this->output->set_content_type('application_json');
				$form_rules = array(
					array(
						'field'  => 'contact_person_name',
						'label'  => 'Name',
						'rules'  => 'trim|required|min_length[2]',
						'errors' => array(
							'required' => 'You must provide a %s.',
						),
					),
					array(
						'field'  => 'company_name',
						'label'  => 'Company Name',
						'rules'  => 'trim|required|min_length[5]',
						'errors' => array(
							'required' => 'You must provide a %s.',
						),
					),
					array(
						'field'  => 'address1',
						'label'  => 'Address',
						'rules'  => 'trim|required|min_length[2]',
						'errors' => array(
							'required' => 'You must provide a %s.',
						),
					),
					array(
						'field'  => 'address2',
						'label'  => 'Address',
						'rules'  => 'trim|required|min_length[2]',
						'errors' => array(
							'required' => 'You must provide a %s.',
						),
					),
					array(
						'field'  => 'add_city',
						'label'  => 'City',
						'rules'  => 'trim|required|min_length[2]',
						'errors' => array(
							'required' => 'You must provide a %s.',
						),
					),
					array(
						'field'  => 'add_state',
						'label'  => 'State',
						'rules'  => 'trim|required|min_length[2]',
						'errors' => array(
							'required' => 'You must provide a %s.',
						),
					),
					array(
						'field'  => 'add_pincode',
						'label'  => 'Pincode',
						'rules'  => 'trim|required|numeric|min_length[6]',
						'errors' => array(
							'required' => 'You must provide a %s.',
						),
					),
					array(
						'field'  => 'add_country',
						'label'  => 'Country',
						'rules'  => 'trim|required|min_length[4]',
						'errors' => array(
							'required' => 'You must provide a %s.',
						),
					),
					array(
						'field' => 'add_contactno',
						'label' => 'Contact No',
						'rules' => 'trim|required|numeric|min_length[10]',
					),
					array(
						'field'  => 'add_email',
						'label'  => 'Email Id',
						'rules'  => 'trim|required|valid_email',
						'errors' => array(
							'required'    => 'You must provide a %s.',
							'valid_email' => 'Enter Valid Email.',
						),
					),
				);
				$keys   = array();
				$values = array();
				foreach ($_POST as $key => $value) {
					$keys   = array_merge($keys, array($key));
					$values = array_merge($values, array($key => $value));
				}
				$keys         = array_merge($keys, array('shop_add', 'mobile_no', 'customer_support_email'));
				$shop_address = $this->input->post('address1') . ', ' . $this->input->post('address2') . ', ' . $this->input->post('add_city') . '-' . $this->input->post('add_pincode') . ', ' . $this->input->post('add_state') . ', ' . $this->input->post('add_country');
				$values       = array_merge($values, array('shop_add' => $shop_address), array('mobile_no' => $this->input->post('add_contactno')), array('customer_support_email' => $this->input->post('add_email')));
				$this->form_validation->set_rules($form_rules);
				if ($this->form_validation->run() == FALSE) {
					$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
				} else {
					$result = $this->model->update_profile($keys, $values);
					$this->output->set_output(json_encode(['result' => $result]));
				}
			}
		}
	}

}

/* End of file profile.php */
/* Location: ./application/controllers/admin/profile/profile.php */