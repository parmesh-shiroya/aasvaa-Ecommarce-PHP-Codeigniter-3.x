<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_manager extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_order_man', 'model');
		//Do your magic here
	}
	public function index() {
		$data['order_mst'] = $this->model->get_order_by_status_array(array(0, 1, 2, 3, 4, 5, 6, 8, 16));
		foreach ($data['order_mst'] as $order_data) {
			$data['customer_' . $order_data->customer_id] = $this->model->get_customer_data($order_data->customer_id);
			if ($order_data->payment_from == 'paypal') {
				$data['paypal_data']['or_' . $order_data->id] = $this->model->get_paypal_payment_data($order_data->payment_from_data_id);
			} else if ($order_data->payment_from == 'ccavenue') {
				$data['ccavenue_data']['or_' . $order_data->id] = $this->model->get_ccavenue_payment_data($order_data->payment_from_data_id);
			}
		}
		$data['cart_mst'] = $this->model->get_all_cart_data();
		foreach ($data['cart_mst'] as $rows) {

			$data['customer_' . $rows->customer_id] = $this->model->get_customer_data($rows->customer_id);
			foreach (unserialize(base64_decode($rows->cart)) as $key => $value) {
				if (isset($value['adm_status']) && $value['adm_status'] == 'on') {
					$data['product_' . $value['id']] = $this->model->get_product_data_by_id($value['id']);
				}
			}
		}
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/order_man/man_order2', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer');
	}

	public function cancel_orders() {

		$data['order_mst'] = $this->model->get_order_by_status('7');
		foreach ($data['order_mst'] as $order_data) {
			$data['customer_' . $order_data->customer_id] = $this->model->get_customer_data($order_data->customer_id);
			if ($order_data->payment_from == 'paypal') {
				$data['paypal_data']['or_' . $order_data->id] = $this->model->get_paypal_payment_data($order_data->payment_from_data_id);
			}
		}
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/order_man/cancel_orders', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer');
	}

	public function upcoming_orders() {

		$data['cart_mst'] = $this->model->get_all_cart_data();
		foreach ($data['cart_mst'] as $rows) {

			$data['customer_' . $rows->customer_id] = $this->model->get_customer_data($rows->customer_id);
			foreach (unserialize(base64_decode($rows->cart)) as $key => $value) {
				if (isset($value['adm_status']) && $value['adm_status'] == 'on') {
					$data['product_' . $value['id']] = $this->model->get_product_data_by_id($value['id']);
				}
			}
		}
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/order_man/upcoming_orders', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer');
	}

	public function return_order() {
		$data['order_mst'] = $this->model->get_order_by_status_array(array(9, 11, 12, 13, 14, 15));
		foreach ($data['order_mst'] as $order_data) {
			$data['customer_' . $order_data->customer_id] = $this->model->get_customer_data($order_data->customer_id);
			if ($order_data->payment_from == 'paypal') {
				$data['paypal_data']['or_' . $order_data->id] = $this->model->get_paypal_payment_data($order_data->payment_from_data_id);
			} else if ($order_data->payment_from == 'ccavenue') {
				$data['ccavenue_data']['or_' . $order_data->id] = $this->model->get_ccavenue_payment_data($order_data->payment_from_data_id);
			}
		}
		$data['cart_mst'] = $this->model->get_all_cart_data();
		foreach ($data['cart_mst'] as $rows) {

			$data['customer_' . $rows->customer_id] = $this->model->get_customer_data($rows->customer_id);
			foreach (unserialize(base64_decode($rows->cart)) as $key => $value) {
				if (isset($value['adm_status']) && $value['adm_status'] == 'on') {
					$data['product_' . $value['id']] = $this->model->get_product_data_by_id($value['id']);
				}
			}
		}
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/order_man/man_return_order', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer');
	}
}