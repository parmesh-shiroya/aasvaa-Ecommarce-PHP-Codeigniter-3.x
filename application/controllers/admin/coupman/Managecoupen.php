<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class managecoupen extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_coupen_manager', 'model');
		// $this->load->library('pp_common');
	}
	/**
	 * @param $add_status
	 */
	function index($add_status = "") {
		$this->data['result'] = $this->model->get_all_coupen();
		$assets['javascript'] = array("assetes/otherassets/js/product_box_1.js", "assetes/otherassets/js/jquery.dataTables.min.js");
		$assets['css']        = array("assetes/otherassets/css/product_box_1.css", "assetes/otherassets/css/jquery.dataTables.min.css");
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/coupen_manager/manage_coupen', $this->data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function get_coupen_data() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['coupen_id'])) {
				$result = $this->model->get_coupe_data($_POST['coupen_id']);
				$this->output->set_content_type('application/json')->set_output(json_encode($result));
			}
		}
	}

	public function update_coupen() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['coupen_code']) && isset($_POST['coupen_id_text'])) {
				$this->output->set_content_type('application_json');
				$form_rules = array(
					array(
						'field'  => 'coupen_area',
						'label'  => 'Coupen Area',
						'rules'  => 'trim|required',
						'errors' => array(
							'required' => 'You must provide a %s.',
						),
					),
					array(
						'field' => 'coupen_valid_to',
						'label' => 'Valid to(Date)',
						'rules' => 'trim|required',
					),
					array(
						'field' => 'coupen_valid_from',
						'label' => 'Valid from(Date)',
						'rules' => 'trim|required',
					),
					array(
						'field' => 'coupen_use_for',
						'label' => 'Use Coupen For',
						'rules' => 'trim|required|numeric',
					),
					array(
						'field' => 'coupen_minimum_mrp',
						'label' => 'Minimum Rs Condition',
						'rules' => 'trim|required|numeric',
					),
					array(
						'field' => 'coupen_discount_type',
						'label' => 'Discount Type',
						'rules' => 'trim|required',
					),
					array(
						'field' => 'discount_rs',
						'label' => 'Discount (Rs/%)',
						'rules' => 'trim|required|numeric',
					),
				);
				$this->form_validation->set_rules($form_rules);
				if ($this->form_validation->run() == FALSE) {
					$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
				} else {
					$result2        = $this->model->get_coupe_data($this->input->post('coupen_id_text'));
					$coupen_use_for = $this->input->post('coupen_use_for');
					if ($result2['use_count'] < $this->input->post('coupen_use_for')) {
						$coupen_use_for = $this->input->post('coupen_use_for');
					} else {
						$coupen_use_for = $result2['use_count'];
					}
					$result = $this->model->update_coupen($this->input->post('coupen_id_text'), $this->input->post('coupen_code'), array(
						"area"          => $this->input->post('coupen_area'),
						"valid_from"    => $this->input->post('coupen_valid_from'),
						"valid_to"      => $this->input->post('coupen_valid_to'),
						"use_time"      => $this->input->post('coupen_use_for'),
						"date"          => date('d-m-Y'),
						"discount_type" => $this->input->post('coupen_discount_type'),
						"dis_percet_rs" => $this->input->post('discount_rs'),
						"min_mrp_cond"  => $this->input->post('coupen_minimum_mrp'),
					));
					$this->output->set_output(json_encode(['result' => $result]));
				}
			}
		}
	}

}