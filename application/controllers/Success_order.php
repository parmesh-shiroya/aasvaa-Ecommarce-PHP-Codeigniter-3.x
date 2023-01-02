<?php

class Success_order extends My_Controller {

	public function __construct() {

		parent::__construct();
		//Do your magic here
		if (!$this->pp_login_varified->customer_varified()) {
			header('location:' . site_url('account/login'));
		}
		$this->load->model('web/m_successorder', 'model');

	}
	/**
	 * @param $order_id
	 * @param $message
	 */
	public function index($order_id = 0, $message = "") {
		$customer_id = $this->session->userdata('customer_data')['customer_id'];
		if ($order_id !== 0) {
			$re_data = $this->model->check_order_exist($customer_id, $order_id);
		}

		$data['order_id']           = $order_id;
		$data['message']            = $message;
		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		if (!empty($re_data)) {
			$this->load->view('web/order_success', $data);
		}

		$this->load->view('web/contents/support_bar/support_bar1', $this->pp_loader_helper->get_adm_prof_data());
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}
}