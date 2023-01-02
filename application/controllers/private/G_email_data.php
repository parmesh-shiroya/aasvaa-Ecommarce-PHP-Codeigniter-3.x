<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class G_email_data extends My_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('private/m_private', 'model');
	}
	/**
	 * @param $order_id
	 */
	public function generate_order_place_mail($order_id = 0) {
		$data['order_mst']     = $this->model->get_order_with_id($order_id);
		$data['customer_data'] = $this->model->get_row('id', $data['order_mst']->customer_id, 'customers');
		$this->load->view('web/private/order_place_mail', $data);
	}
	/**
	 * @param $order_id
	 */
	public function generate_order_confirm_mail($order_id = 0) {
		$data['order_mst']     = $this->model->get_order_with_id($order_id);
		$data['customer_data'] = $this->model->get_row('id', $data['order_mst']->customer_id, 'customers');
		$this->load->view('web/private/order_confirm_mail', $data);
	}

	/**
	 * @param $order_id
	 */
	public function generate_order_onhold_mail($order_id = 0) {
		$data['order_mst']     = $this->model->get_order_with_id($order_id);
		$data['customer_data'] = $this->model->get_row('id', $data['order_mst']->customer_id, 'customers');
		$this->load->view('web/private/order_onhold_mail', $data);
	}

	/**
	 * @param $order_id
	 */
	public function generate_order_customization_mail($order_id = 0) {
		$data['order_mst']     = $this->model->get_order_with_id($order_id);
		$data['customer_data'] = $this->model->get_row('id', $data['order_mst']->customer_id, 'customers');
		$this->load->view('web/private/order_customization_mail', $data);
	}
	/**
	 * @param $order_id
	 */
	public function generate_order_cancel_mail($order_id = 0) {
		$data['order_mst']     = $this->model->get_order_with_id($order_id);
		$data['customer_data'] = $this->model->get_row('id', $data['order_mst']->customer_id, 'customers');
		$data['order_status']  = $this->model->get_order_cancel_status($order_id);
		$this->load->view('web/private/order_cancel_mail', $data);
	}
	/**
	 * @param $order_id
	 */
	public function generate_order_shipped_mail($order_id = 0) {
		$data['order_mst']     = $this->model->get_order_with_id($order_id);
		$data['customer_data'] = $this->model->get_row('id', $data['order_mst']->customer_id, 'customers');
		$this->load->view('web/private/order_shipped_mail', $data);
	}

	/**
	 * @param $order_id
	 */
	public function generate_order_delivered_mail($order_id = 0) {
		$data['order_mst']     = $this->model->get_order_with_id($order_id);
		$data['customer_data'] = $this->model->get_row('id', $data['order_mst']->customer_id, 'customers');
		$this->load->view('web/private/order_delivered_mail', $data);
	}
	/**
	 * @param $order_id
	 */
	public function generate_order_return_request_approved_mail($order_id = 0) {
		$data['order_mst']     = $this->model->get_order_with_id($order_id);
		$data['customer_data'] = $this->model->get_row('id', $data['order_mst']->customer_id, 'customers');
		$this->load->view('web/private/order_return_request_approved_mail', $data);
	}
	/**
	 * @param $order_id
	 */
	public function generate_order_return_request_rejected_mail($order_id = 0) {
		$data['order_mst']     = $this->model->get_order_with_id($order_id);
		$data['customer_data'] = $this->model->get_row('id', $data['order_mst']->customer_id, 'customers');
		$data['order_status']  = $this->model->get_order_request_rejected_status($order_id);
		$this->load->view('web/private/order_return_request_rejected_mail', $data);
	}

	/**
	 * @param $order_id
	 */
	public function generate_order_return_request_mail($order_id = 0) {
		$data['order_mst']     = $this->model->get_order_with_id($order_id);
		$data['customer_data'] = $this->model->get_row('id', $data['order_mst']->customer_id, 'customers');
		$this->load->view('web/private/order_return_request_mail', $data);
	}

	public function generate_order_return_request_refunded_mail($order_id) {
		$data['order_mst']     = $this->model->get_order_with_id($order_id);
		$data['customer_data'] = $this->model->get_row('id', $data['order_mst']->customer_id, 'customers');
		$this->load->view('web/private/order_return_request_refunded_mail', $data);
	}

	/**
	 * @param $contact_form_id
	 */
	public function contactus_replay_email($contact_form_id) {
		$data['form_data'] = $this->model->get_row('id', $contact_form_id, 'contact_forms');
		$this->load->view('web/private/contactus_replay_mail', $data);
	}

}