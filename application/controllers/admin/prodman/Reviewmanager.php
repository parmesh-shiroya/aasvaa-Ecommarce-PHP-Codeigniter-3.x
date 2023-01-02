<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reviewmanager extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/product_manager/m_reviewmanager', 'model');
	}
	public function index() {
		$this->data['result'] = $this->model->get_all_reviews();
		$assets['javascript'] = array("assetes/otherassets/js/product_box_1.js", "assetes/otherassets/js/jquery.dataTables.min.js");
		$assets['css']        = array("assetes/otherassets/css/product_box_1.css", "assetes/otherassets/css/jquery.dataTables.min.css");
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/product_manager/reviewmanager', $this->data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function change_status() {
		if ($this->input->post('rev_id') && $this->input->post('status')) {
			$result = $this->model->change_status($this->input->post('rev_id'), $this->input->post('status'));
			$this->output->set_content_type('application/json')->set_output(json_encode(array('result' => $result)));
		}
	}
}

/* End of file reviewmanager.php */
/* Location: ./application/controllers/admin/prodman/reviewmanager.php */