<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Contact extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_contact', 'model');
		// $this->load->library('pp_common');
	}

	/**
	 * @param $add_status
	 */
	function index($query_type = 0) {
		$this->data['queries'] = $this->model->get_new_contact_form_by_subject($query_type);
		$assets['javascript']  = array("assetes/otherassets/js/jquery.dataTables.min.js");
		$assets['css']         = array("assetes/otherassets/css/jquery.dataTables.min.css");
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/contactus/contact_us', $this->data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function single_form() {
		if ($this->input->post('form_id')) {
			$data = $this->model->get_single_form($this->input->post('form_id'));
			$this->output->set_content_type('application_json');
			$this->output->set_output(json_encode($data));
		}
	}

	public function replay_form() {
		if ($this->input->post('form_id') && $this->input->post('replay_txb')) {

			$form_rules = array(
				array(
					'field' => 'form_id',
					'label' => 'Form Id',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'replay_txb',
					'label' => 'Replat Text',
					'rules' => 'trim|required',
				),
			);
			$this->form_validation->set_rules($form_rules);
			if ($this->form_validation->run() == FALSE) {
				$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
			} else {
				$id   = $this->input->post('form_id');
				$data = array(
					'response' => $this->input->post('replay_txb'),
					'res_time' => date('h:i a'),
					'res_date' => date('d-m-Y'),
					'status'   => $this->input->post('status'),
				);
				$result    = $this->model->update_form($id, $data);
				$form_data = $this->model->get_single_form($id);
				if ($result) {
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_URL, base_url('private/g_email_data/contactus_replay_email/' . $id));
					$result1 = curl_exec($ch);
					curl_close($ch);
					$array1      = array('&#8377', '&#8364', '&#8360');
					$array2      = array('&#8377;', '&#8364;', '&#8360;');
					$result1     = str_replace($array1, $array2, $result1);
					$mail_return = $this->pp_common->sendEmail('forcustomer@aasvaa.com', $form_data['email'], 'Aasvaa.com Your have query regarding us.', $result1);
				}
				$this->output->set_content_type('application_json');
				$this->output->set_output(json_encode(['result' => $result]));
			}

		}
	}

	public function close_form() {
		if ($this->input->post('form_id')) {
			$id   = $this->input->post('form_id');
			$data = array(
				'res_time' => date('h:i a'),
				'res_date' => date('d-m-Y'),
				'status'   => '2',
			);
			$result = $this->model->update_form($id, $data);
			$this->output->set_content_type('application_json');
			$this->output->set_output(json_encode(['result' => $result]));
		}
	}
}

/* End of file Contact.php */
/* Location: ./application/controllers/admin/contactus/Contact.php */