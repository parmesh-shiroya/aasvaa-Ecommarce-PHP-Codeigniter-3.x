<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Active_order extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_order_man', 'model');
	}
	public function index() {
		$data['order_mst'] = $this->model->get_all_orders();
		foreach ($data['order_mst'] as $order_data) {
			if ($order_data->payment_from == 'paypal') {
				$data['paypal_data']['or_' . $order_data->id] = $this->model->get_paypal_payment_data($order_data->payment_from_data_id);
			}
		}
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/order_man/active_order', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer');
	}

}

/* End of file active_order.php */
/* Location: ./application/controllers/admin/order_man/active_order.php */