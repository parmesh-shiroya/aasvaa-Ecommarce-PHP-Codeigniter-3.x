<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Man_customers extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_customers', 'model');
		//Do your magic here
	}
	public function index() {
		$this->data['customers'] = $this->model->get_all_customers();
		$assets['javascript']    = array("assetes/otherassets/js/jquery.dataTables.min.js");
		$assets['css']           = array("assetes/otherassets/css/jquery.dataTables.min.css");
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/customers/man_customers', $this->data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function login_customer() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['cust_ids'])) {

				$result = $this->model->login_customer($this->input->post('cust_ids'));

				if (!empty($result)) {
					$customer_data = array(
						'customer_id' => $result->id,
						'firstname'   => $result->first_name,
						'lastname'    => $result->last_name,
						'email'       => $result->email_id,
						'logged_in'   => TRUE,
					);
					$this->session->set_userdata('customer_data', $customer_data);
					$this->output->set_output(json_encode(['result' => true]));

				} else {

					$this->output->set_output(json_encode(['result' => "2"]));
				}
			}
		}
	}

}

/* End of file man_customers.php */
/* Location: ./application/controllers/admin/customers/man_customers.php */