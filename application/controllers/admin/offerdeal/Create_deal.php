<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Create_deal extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_offer_deal', 'model');
		// $this->load->library('pp_common');
	}

	/**
	 * @param $add_status
	 */
	function index($add_status = "") {
		$assets['javascript'] = array("assetes/otherassets/js/product_box_1.js", "assetes/otherassets/js/jquery.dataTables.min.js");
		$assets['css']        = array("assetes/otherassets/css/product_box_1.css", "assetes/otherassets/css/jquery.dataTables.min.css");
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/offer_deal/createdeal');
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function add_offer() {
		if (isset($_POST['add_offer_submit'])) {
			print_r($_POST);
		} else {
			header("Location:" . site_url('admin/offerdeal/create_deal'));
		}
	}
}