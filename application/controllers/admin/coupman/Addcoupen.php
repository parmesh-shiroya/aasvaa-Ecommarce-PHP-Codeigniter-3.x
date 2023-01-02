<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class addcoupen extends CI_Controller {

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
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/coupen_manager/add_coupen');
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer');
	}

	function add() {
		if ($this->pp_login_varified->admin_varified()) {
			$this->output->set_content_type('application_json');
			$form_rules = array(
				array(
					'field'  => 'coup_code',
					'label'  => 'Coupen Code',
					'rules'  => 'trim|required|is_unique[coupen_mst.code]',
					'errors' => array(
						'required'  => 'You must provide a %s.',
						'is_unique' => 'This %s already exists.',
					),
				),
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
					'rules' => 'trim|required',
				),
				array(
					'field' => 'coupen_minimum_mrp',
					'label' => 'Minimum Rs Condition',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'coupen_discount_type',
					'label' => 'Discount Type',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'discount_rs',
					'label' => 'Discount (Rs/%)',
					'rules' => 'trim|required',
				),
			);
			$this->form_validation->set_rules($form_rules);
			if ($this->form_validation->run() == FALSE) {
				$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
			} else {
				$result = $this->model->add_coupen(array(
					"code"          => $this->input->post('coup_code'),
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