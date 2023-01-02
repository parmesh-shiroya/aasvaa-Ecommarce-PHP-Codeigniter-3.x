<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_detail extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_order_man', 'model');
	}

	/**s
		 * @param $order_id
	*/
	/**
	 * @param $order_id
	 */
	public function index($order_id = 0) {
		$data['order_id']  = $order_id;
		$data['order_mst'] = $this->model->get_order_with_id($order_id);
		if (empty($data['order_mst'])) {
			header('Location:' . site_url('admin'));
		}
		// foreach ($data['order_mst'] as $order_data) {
		// print_r($data['order_mst']);
		{
			if ($data['order_mst']->payment_from == 'paypal') {
				$data['paypal_data'] = $this->model->get_paypal_payment_data($data['order_mst']->payment_from_data_id);
			}
		}

		if ($data['order_mst']->payment_from == 'ccavenue') {
			$data['ccavenue_data'] = $this->model->get_ccavenue_payment_data($data['order_mst']->payment_from_data_id);
		}

		$data['customer_data'] = $this->model->get_customer_data($data['order_mst']->customer_id);
		$weight                = 0;
		foreach (unserialize(base64_decode($data['order_mst']->trn_c_data))['cart_contents'] as $key => $value) {
			if ($key != "cart_total" && $key != 'total_items') {
				$weight                                            = $weight + ($value['weight'] * $value['qty']);
				$data['single_product_data']['id_' . $value['id']] = $this->model->get_product_data_by_id($value['id']);
				if (isset($value['options'])) {
					foreach ($value['options'] as $opt_key => $opt_value) {
						if ($opt_value[$opt_key . 'radio'] == 'customize') {
							if (isset(unserialize(base64_decode($data['order_mst']->trn_c_data))['cart']['product_' . $value['rowid']]['mesurement_select_data'])) {
								// print_r(unserialize(base64_decode($data['order_mst']->trn_c_data))['cart']['product_' . $value['rowid']]['mesurement_select_data']);
								$data['customize_data']['id_' . $value['id']] = $this->model->get_product_custome_mesurement(array_values(unserialize(base64_decode($data['order_mst']->trn_c_data))['cart']['product_' . $value['rowid']]['mesurement_select_data'])[0]);
							}
						}
					}
				}
			}
		}
		$parcel_det = $this->model->get_row('order_id', $data['order_mst']->id, 'shipping_parcel_details');
		if (empty($parcel_det)) {
			$payment_method_type = 'online';
			if ($data['order_mst']->payment_from == "cod") {
				$payment_method_type = 'cod';
			}
			$to_pincode  = unserialize(base64_decode($data['order_mst']->trn_c_data))['checkout']['shipping_address']['post_code'];
			$total_items = unserialize(base64_decode($data['order_mst']->trn_c_data))['cart_contents']['total_items'];
			// }
			//
			$par_data = array(
				"order_id"       => $data['order_mst']->id,
				"order_order_id" => $data['order_mst']->order_id,
				"to_pincode"     => $to_pincode,
				"weight"         => $weight,
				"height"         => (6 * $total_items),
				"length"         => 35,
				"width"          => 30,
				"payment_mode"   => $payment_method_type,
				"total_items"    => $total_items,
				"date"           => date("d-m-Y"),
				"time"           => date('h:i a'),
			);

			$result = $this->model->insert_data('shipping_parcel_details', $par_data);
		} else {
			$par_data = array(
				"order_id"       => $parcel_det->order_id,
				"order_order_id" => $parcel_det->order_order_id,
				"to_pincode"     => $parcel_det->to_pincode,
				"weight"         => $parcel_det->weight,
				"height"         => $parcel_det->height,
				"length"         => $parcel_det->length,
				"width"          => $parcel_det->width,
				"payment_mode"   => $parcel_det->payment_mode,
				"total_items"    => $parcel_det->total_items,
				"date"           => $parcel_det->date,
				"time"           => $parcel_det->time,
			);
		}
		if ($data['order_mst']->status == 11) {
			$parcel_det = $this->model->get_row('order_id', $data['order_mst']->id, 'return_shipping_parcel_details');
			if (empty($parcel_det)) {
				$payment_method_type = 'online';
				$to_pincode          = unserialize(base64_decode($data['order_mst']->trn_c_data))['checkout']['shipping_address']['post_code'];
				$total_items         = unserialize(base64_decode($data['order_mst']->trn_c_data))['cart_contents']['total_items'];
				// }
				//
				$par_data = array(
					"order_id"       => $data['order_mst']->id,
					"order_order_id" => $data['order_mst']->order_id,
					"to_pincode"     => $to_pincode,
					"weight"         => $weight,
					"height"         => (6 * $total_items),
					"length"         => 35,
					"width"          => 30,
					"payment_mode"   => $payment_method_type,
					"total_items"    => $total_items,
					"date"           => date("d-m-Y"),
					"time"           => date('h:i a'),
				);
				$result = $this->model->insert_data('return_shipping_parcel_details', $par_data);
			} else {
				$par_data = array(
					"order_id"       => $parcel_det->order_id,
					"order_order_id" => $parcel_det->order_order_id,
					"to_pincode"     => $parcel_det->to_pincode,
					"weight"         => $parcel_det->weight,
					"height"         => $parcel_det->height,
					"length"         => $parcel_det->length,
					"width"          => $parcel_det->width,
					"payment_mode"   => $parcel_det->payment_mode,
					"total_items"    => $parcel_det->total_items,
					"date"           => $parcel_det->date,
					"time"           => $parcel_det->time,
				);
			}
		}
		if ($data['order_mst']->status == 11 || $data['order_mst']->status == 15 || $data['order_mst']->status == 12 || $data['order_mst']->status == 16 || $data['order_mst']->status == 13 || $data['order_mst']->status == 14) {
			$data['bank_detail'] = $this->model->get_bank_details($data['order_mst']->id);
		}
		$data['ship_par_data'] = $par_data;
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/order_man/order_detail2', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer');
	}

	public function change_status_to() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['status']) && isset($_POST['order_id'])) {
				$result = $this->model->change_status_to($this->input->post('order_id'), $this->input->post('status'), $this->input->post('status_text'), $this->input->post('message'));
				$this->output->set_content_type('application_json');
				$this->output->set_output(json_encode(['result' => $result]));
			}
		}
	}

	public function message() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['order_data']) && isset($_POST['message_txt_area'])) {
				$order_id = $this->pp_hash->decrypt_data($_POST['order_data']);
				$result   = $this->model->message_frm_adm($order_id, $this->input->post('message_txt_area'));
				$this->output->set_content_type('application_json')
				     ->set_output(json_encode(['result' => $result]));
			}
		}
	}
	public function get_order_status() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['order_id'])) {
				$result = $this->model->get_order_stauts($this->input->post('order_id'));
				if (empty($result)) {
					$result = $this->model->change_status_to($this->input->post('order_id'), '0', 'Placed', 'Order Placed');
					$result = $this->model->get_order_stauts($this->input->post('order_id'));
				}
				$this->output->set_content_type('application_json')
				     ->set_output(json_encode(['result' => $result]));
			}
		}
	}

	public function change_shipping_parcel() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['name_order_order_id'])) {
				$data = array(
					"order_id"       => $this->input->post('name_order_id'),
					"order_order_id" => $this->input->post('name_order_order_id'),
					"to_pincode"     => $this->input->post('name_to_pincode'),
					"weight"         => $this->input->post('name_weight'),
					"height"         => $this->input->post('name_height'),
					"length"         => $this->input->post('name_length'),
					"width"          => $this->input->post('name_width'),
					"payment_mode"   => $this->input->post('name_payment_mode'),
					"total_items"    => $this->input->post('name_total_items'),
					"date"           => date("d-m-Y"),
					"time"           => date('h:i a'),
				);
				$parcel_det = $this->model->get_row('order_id', $this->input->post('name_order_id'), 'shipping_parcel_details');
				if (empty($parcel_det)) {
					$result = $this->model->insert_data('shipping_parcel_details', $data);
				} else {
					$result = $this->model->update_data($parcel_det->id, 'shipping_parcel_details', $data);
				}

				$_SESSION['admd']['ship_par_data'] = $data;
				$this->output->set_content_type('application_json')
				     ->set_output(json_encode(['result' => $result]));
			}
		}
	}

	public function get_shipping_data_f_db() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['order_id'])) {

				$parcel_det = $this->model->get_row('order_id', $this->input->post('order_id'), 'zepo_pickup_request_data');
				if (!empty($parcel_det)) {
					$result  = true;
					$reqdata = unserialize(base64_decode($parcel_det->request_data));
					$del_c   = $parcel_det->delivery_by;
					$resdata = unserialize(base64_decode($parcel_det->response_data));
				} else {
					$result  = false;
					$reqdata = array();
					$del_c   = "";
					$resdata = array();
				}

				$this->output->set_content_type('application_json')
				     ->set_output(json_encode(['result' => $result, 'request' => $reqdata, 'response' => $resdata, 'del_c' => $del_c]));
			}
		}
	}
	public function get_zepo_courier_order_info() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['order_id'])) {

				$parcel_det = $this->model->get_row('order_id', $this->input->post('order_id'), 'zepo_courier_order_info');
				if (!empty($parcel_det)) {
					$result = true;

					$data = array(
						'id'             => $parcel_det->id,
						'order_id'       => $parcel_det->order_id,
						'order_order_id' => $parcel_det->order_order_id,
						'res_order_id'   => $parcel_det->res_order_id,
						'amount'         => $parcel_det->amount,
						'payment_mode'   => $parcel_det->payment_mode,
						'shipment_id'    => $parcel_det->shipment_id,
						'tracking_no'    => $parcel_det->tracking_no,
						'data'           => unserialize(base64_decode($parcel_det->data)),
						'date'           => $parcel_det->date,
						'time'           => $parcel_det->time,

					);
				} else {
					$result = false;
					$data   = array();
				}

				$this->output->set_content_type('application_json')
				     ->set_output(json_encode(['result' => $result, 'data' => $data]));
			}
		}
	}
	/**
	 * @param $order_id
	 */
	public function get_international_ship_price($order_id) {
		if ($this->input->post('shipping_country')) {
			$parcel_details = $this->model->get_row('order_id', $order_id, 'shipping_parcel_details');
			$to_pincode     = $parcel_details->to_pincode;
			$weight         = $parcel_details->weight;
			$height         = $parcel_details->height;
			$length         = $parcel_details->length;
			$width          = $parcel_details->width;
			$payment_mode   = $parcel_details->payment_mode;
			$total_items    = $parcel_details->total_items;
			$country_code   = $this->model->get_row('name', $this->input->post('shipping_country'), 'countries')->sortname;
			$get_zone       = "zone_" . $this->model->get_row('code', $country_code, 'zepo_init_countrys')->zone;
			$get_price      = $this->model->get_row('weight', $this->pp_helper->ceiling($weight, 0.5), 'zepo_int_price')->{$get_zone};
			$this->output->set_content_type('application_json')
			     ->set_output(json_encode(['result' => 'true', 'weight' => $this->pp_helper->ceiling($weight, 0.5), 'price' => $get_price]));
		}
	}

	/**
	 * @param $order_id
	 */
	public function shipped_international_courier() {
		if ($this->input->post('id')) {
			$order_id = $this->input->post('id');

			$parcel_details = $this->model->get_row('order_id', $order_id, 'shipping_parcel_details');

			$order_mst  = $this->model->get_order_with_id($order_id);
			$trn_c_data = unserialize(base64_decode($order_mst->trn_c_data));

			$paid_by_amt = $trn_c_data['cart_contents']['cart_total'] + $trn_c_data['newcart']['total_other_charges'];
			$remian_amt  = $paid_by_amt;
			if (isset($trn_c_data['cart_coupen_data'])) {
				if ($trn_c_data['cart_coupen_data']->discount_type == 0) {
					$title     = "Discount";
					$dis_total = $trn_c_data['cart_coupen_data']->dis_percet_rs;
				} elseif ($trn_c_data['cart_coupen_data']->discount_type == 1) {
					$title     = "Discount " . $trn_c_data['cart_coupen_data']->dis_percet_rs . "%";
					$dis_total = round(($trn_c_data['cart_contents']['cart_total'] + $trn_c_data['newcart']['total_service_charges']) * $trn_c_data['cart_coupen_data']->dis_percet_rs / 100);
				}
				$remian_amt = $paid_by_amt - $dis_total;
			}

			$data = array(
				"country_name"        => $trn_c_data['checkout']['shipping_address']['country'],
				"customer_name"       => $trn_c_data['checkout']['shipping_address']['name'],
				"address_1"           => $trn_c_data['checkout']['shipping_address']['address1'],
				"address_2"           => $trn_c_data['checkout']['shipping_address']['address2'],
				"postal_code"         => $trn_c_data['checkout']['shipping_address']['post_code'],
				"city"                => $trn_c_data['checkout']['shipping_address']['city'],
				"state"               => $trn_c_data['checkout']['shipping_address']['state'],
				"phone_no"            => $trn_c_data['checkout']['shipping_address']['mobile_no'],
				"weight_of_package"   => $parcel_details->weight,
				"invoice_value"       => $remian_amt,
				"package_type"        => 'parcel',
				"product_description" => "Clothing Product",
				"number_of_package"   => 1,
			);

///=================================== Send Mail ===========================///
			$message = $this->pp_email_templetes->register_email_1($data);
			$result2 = $mail_return = $this->pp_common->sendEmail('smtp.gmail.com', 'parmeshshiroya@gmail.com', 'International Courier Request', $message);
			if ($result2) {
				$this->model->update_data($order_id, 'order_mst', array('status' => 2));
				$this->model->insert_data('order_status_mst', array('order_id' => $order_id, 'status_id' => 2, 'status_text' => 'By Admin', 'date' => date('d-m-Y'), 'time' => date('h:i a'), 'status' => 'Ready To ship'));
				$this->model->insert_data('zepo_pickup_request_data', array('order_id' => $order_id, 'delivery_by' => 'International Courier', 'order_order_id' => $order_mst->order_id, ' 	request_data' => base64_encode(serialize(array('payment_mode' => $parcel_details->payment_mode))), 'response_data' => base64_encode(serialize(array('shipment_id' => 'Not Provided'))), 'date' => date('d-m-Y'), 'time' => date('h:i a')));
			}
			$this->output->set_output(json_encode(['result' => $result2]));
			///=================================== End Send Mail ===========================///
		}
	}
// ******************** Return Shipping Functions ////////////
	public function change_return_shipping_parcel() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['name_order_order_id'])) {
				$data = array(
					"order_id"       => $this->input->post('name_order_id'),
					"order_order_id" => $this->input->post('name_order_order_id'),
					"to_pincode"     => $this->input->post('name_to_pincode'),
					"weight"         => $this->input->post('name_weight'),
					"height"         => $this->input->post('name_height'),
					"length"         => $this->input->post('name_length'),
					"width"          => $this->input->post('name_width'),
					"payment_mode"   => 'online',
					"total_items"    => $this->input->post('name_total_items'),
					"date"           => date("d-m-Y"),
					"time"           => date('h:i a'),
				);
				$parcel_det = $this->model->get_row('order_id', $this->input->post('name_order_id'), 'return_shipping_parcel_details');
				if (empty($parcel_det)) {
					$result = $this->model->insert_data('return_shipping_parcel_details', $data);
				} else {
					$result = $this->model->update_data($parcel_det->id, 'return_shipping_parcel_details', $data);
				}

				$_SESSION['admd']['ship_par_data'] = $data;
				$this->output->set_content_type('application_json')
				     ->set_output(json_encode(['result' => $result]));
			}
		}
	}

	public function get_return_shipping_data_f_db() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['order_id'])) {

				$parcel_det = $this->model->get_row('order_id', $this->input->post('order_id'), 'zepo_pickup_return_request_data');
				if (!empty($parcel_det)) {
					$result  = true;
					$reqdata = unserialize(base64_decode($parcel_det->request_data));
					$del_c   = $parcel_det->delivery_by;
					$resdata = unserialize(base64_decode($parcel_det->response_data));
				} else {
					$result  = false;
					$reqdata = array();
					$del_c   = "";
					$resdata = array();
				}

				$this->output->set_content_type('application_json')
				     ->set_output(json_encode(['result' => $result, 'request' => $reqdata, 'response' => $resdata, 'del_c' => $del_c]));
			}
		}
	}

	public function get_zepo_return_courier_order_info() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['order_id'])) {

				$parcel_det = $this->model->get_row('order_id', $this->input->post('order_id'), 'zepo_return_courier_order_info');
				if (!empty($parcel_det)) {
					$result = true;

					$data = array(
						'id'             => $parcel_det->id,
						'order_id'       => $parcel_det->order_id,
						'order_order_id' => $parcel_det->order_order_id,
						'res_order_id'   => $parcel_det->res_order_id,
						'amount'         => $parcel_det->amount,
						'payment_mode'   => $parcel_det->payment_mode,
						'shipment_id'    => $parcel_det->shipment_id,
						'tracking_no'    => $parcel_det->tracking_no,
						'data'           => unserialize(base64_decode($parcel_det->data)),
						'date'           => $parcel_det->date,
						'time'           => $parcel_det->time,
					);
				} else {
					$result = false;
					$data   = array();
				}
				$this->output->set_content_type('application_json')
				     ->set_output(json_encode(['result' => $result, 'data' => $data]));
			}
		}
	}

	public function return_complete_status() {
		if ($this->pp_login_varified->admin_varified()) {
			if ($this->input->post('order_id')) {
				$order_id = $this->input->post('order_id');
				$data     = array(
					"status"                 => "15",
					"return_complete_date"   => date('d-m-Y'),
					"return_com_transfer_in" => $this->input->post('name_transfer_in'),
					"return_com_note"        => $this->input->post('name_note'),
					"return_com_price"       => $this->input->post('name_rs'),
				);
				echo $this->model->update_data($order_id, 'order_mst', $data);
			}
		}
	}
	/*==================================================
		========= Send Mail Functions ================
	*/
	public function send_status_mail() {
		if ($this->input->post('u_order_id') && $this->input->post('status_id')) {
			$order_id      = $this->input->post('u_order_id');
			$order_mst     = $this->model->get_order_with_id($order_id);
			$customer_data = $this->model->get_customer_data($order_mst->customer_id);
			$result        = "";
			$title         = "";
			$status        = $this->input->post('status_id');
			switch ($this->input->post('status_id')) {
			case '6':
				$title = 'Your Aasvaa Order No : ' . $order_mst->order_id . ' has been Confirmed';
				$ch    = curl_init();
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_URL, base_url('private/g_email_data/generate_order_confirm_mail/' . $order_id));
				$result = curl_exec($ch);
				curl_close($ch);
				$this->pp_common->send_order_status_message($order_id, $status);
				break;
			case '5':
				$title = 'Your Aasvaa Order No : ' . $order_mst->order_id . ' has been On Hold';
				$ch    = curl_init();
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_URL, base_url('private/g_email_data/generate_order_onhold_mail/' . $order_id));
				$result = curl_exec($ch);
				curl_close($ch);

				$this->pp_common->send_order_status_message($order_id, $status);
				break;
			case '1':
				$title = 'Your Aasvaa Order No : ' . $order_mst->order_id . ' has been On Customization';
				$ch    = curl_init();
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_URL, base_url('private/g_email_data/generate_order_customization_mail/' . $order_id));
				$result = curl_exec($ch);
				curl_close($ch);
				$this->pp_common->send_order_status_message($order_id, $status);
				break;
			case '7':
				$title = 'Your Aasvaa Order No : ' . $order_mst->order_id . ' has been Cancelled';
				$ch    = curl_init();
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_URL, base_url('private/g_email_data/generate_order_cancel_mail/' . $order_id));
				$result = curl_exec($ch);
				curl_close($ch);
				$this->pp_common->send_order_status_message($order_id, $status);
				break;

			case '12':
				$title = 'Your Aasvaa Order No : ' . $order_mst->order_id . ' Return Request Approved.';
				$ch    = curl_init();
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_URL, base_url('private/g_email_data/generate_order_return_request_approved_mail/' . $order_id));
				$result = curl_exec($ch);
				curl_close($ch);
				$this->pp_common->send_order_status_message($order_id, $status);
				break;
			case '15':
				$title = 'Your Aasvaa Order No : ' . $order_mst->order_id . ' Return Refunded.';
				$ch    = curl_init();
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_URL, base_url('private/g_email_data/generate_order_return_request_refunded_mail/' . $order_id));
				$result = curl_exec($ch);
				curl_close($ch);
				$this->pp_common->send_order_status_message($order_id, $status);
				break;
			case '16':
				$title = 'Your Aasvaa Order No : ' . $order_mst->order_id . ' Return Request Rejected.';
				$ch    = curl_init();
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_URL, base_url('private/g_email_data/generate_order_return_request_rejected_mail/' . $order_id));
				$result = curl_exec($ch);
				curl_close($ch);
				$this->pp_common->send_order_status_message($order_id, $status);
				break;

			default:
				$result = '';
				$title  = '';
				break;
			}
			$array1      = array('&#8377', '&#8364', '&#8360');
			$array2      = array('&#8377;', '&#8364;', '&#8360;');
			$result      = str_replace($array1, $array2, $result);
			$mail_return = $this->pp_common->sendEmail('forcustomer@aasvaa.com', $customer_data->email_id, $title, $result);
			$this->output->set_content_type('application_json')
			     ->set_output(json_encode(['result' => $mail_return]));
		}
	}
	/*==================================================
		========= End Send Mail Functions ================
	*/

	public function order_invoice($order_id) {

		$this->load->library('Pp_order_formater', array($order_id));

		$order_mst         = $this->model->get_order_with_id($order_id);
		$get_adm_prof_data = $this->pp_loader_helper->get_adm_prof_data();
		$trn_c_data        = unserialize(base64_decode($order_mst->trn_c_data));
//  <div style="float: right; padding:7px 10px; border:dashed #000 2px;">
		//   <span><strong>Invoice No :</strong> # CHN_PUZHAL_0120160200008633</span>
		// </div>
		$content = '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!-- TemplateBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>
<div style="width: 780px;">
<table width="780px" border="0">
  <tbody>
    <tr>
      <td style="padding: 0px 12px;">
      <div style="margin: 10px 0px 7px 0px;"><h2 style="">Retail Invoices/Bill</h2></div>



        <div style="margin:10px 0px; float:left; width: 100%;">
          <p>Warehouse Address: ' . $get_adm_prof_data['shop_add'] . '</p>
          </div>
          <div style="border-bottom: 3px solid #000000;"></div>
        </td>
    </tr>
    <tr>
      <td style="padding: 0px 10px;"><table width="100%" border="0">
        <tbody class="">
          <tr>
            <td valign="top">
            <div style="width: 233px">
             <p style="margin-top:0px"><strong>Order ID : ' . $order_mst->order_id . '</strong></p>
              <p><strong>Order Date :</strong> ' . $order_mst->date . '</p>
              <p><strong>Invoice ID :</strong> ' . $order_mst->order_id . '</p>
              </div>
		  	</td>
		  <td class="address-table">
         <div style="width: 233px">
          <p><strong>Billing Address</strong></p>
          <p>' . $trn_c_data['checkout']['billing_address']['name'] . '</p>
			 <p>' . $trn_c_data['checkout']['billing_address']['address1'] . ',' . $trn_c_data['checkout']['billing_address']['address2'] . '</p>
          <p>' . $trn_c_data['checkout']['billing_address']['city'] . '-' . $trn_c_data['checkout']['billing_address']['post_code'] . ',' . $trn_c_data['checkout']['billing_address']['state'] . '</p>
          <p>Phone: ' . $trn_c_data['checkout']['billing_address']['mobile_no'] . '</p>
			  </div>
           </td>
            <td class="address-table">
           	 <div style="width: 233px">
            	 <p><strong>Shipping Address</strong></p>
           <p>' . $trn_c_data['checkout']['shipping_address']['name'] . '</p>
			 <p>' . $trn_c_data['checkout']['shipping_address']['address1'] . ',' . $trn_c_data['checkout']['shipping_address']['address2'] . '</p>
          <p>' . $trn_c_data['checkout']['shipping_address']['city'] . '-' . $trn_c_data['checkout']['shipping_address']['post_code'] . ',' . $trn_c_data['checkout']['shipping_address']['state'] . '</p>
          <p>Phone: ' . $trn_c_data['checkout']['shipping_address']['mobile_no'] . '</p>
				</div>
            </td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td>
      <div style="border: 1px solid #000; margin: 0px 10px;"></div>
       <table style="margin: 0 10px;" class="product-table" width="100%" border="0">
        <tbody>
          <tr class="top-title">
            <td width="11%"><strong>Product</strong></td>
            <td width="45%"><strong>Title</strong></td>
            <td width="5%"><strong>Qty</strong></td>
            <td width="11%"><strong>Price(' . $this->pp_order_formater->orderCurrency() . ')</strong></td>';
		$content .= '<td width="7%"><strong>Tax(%)</strong></td><td width="7%"><strong>Tax(' . $this->pp_order_formater->orderCurrency() . ')</strong></td>';
		$content .= '<td width="11%"><strong>Total(' . $this->pp_order_formater->orderCurrency() . ')</strong></td>
          </tr>';
		foreach ($this->pp_order_formater->allProducts() as $key => $value) {

			$content .= "<tr><td>" . $value['sku'] . "</td>";
			$name = "<td>";
			$name .= $this->pp_helper->substrwords($value['name'], 50);
			$customize_charge = $this->pp_order_formater->convertRsCurrency($this->pp_order_formater->productServiceCharge($value['rowid'], true));
			$name .= ($this->pp_order_formater->productServiceCharge($value['rowid'], true) > 0) ? "<br><span style='font-size:11px;'>Stitched Charge(" . $customize_charge . ")</span>" : "";
			$name .= "</td>";
			$content .= $name;
			$content .= "<td>" . $value['qty'] . "</td>";

			$product_price = $this->pp_order_formater->productPrice($value['rowid'], ['serviceCharge', 'shippingCharge']) - $this->pp_order_formater->taxChargesRs($value['rowid']);
			$content .= "<td>" . $this->pp_order_formater->convertRsCurrency($product_price) . "</td>";
			$content .= '<td width="7%"><strong>' . $this->pp_order_formater->taxPercent($value['rowid']) . '%</strong></td><td width="7%"><strong>' . $this->pp_order_formater->convertRsCurrency($this->pp_order_formater->taxChargesRs($value['rowid'])) . '</strong></td>';

			$content .= "<td>" . $this->pp_order_formater->convertRsCurrency($this->pp_order_formater->productPrice($value['rowid'], ['serviceCharge', 'shippingCharge'])) . "</td>";
			$content .= "</tr>";
			// break;
		}

		$content .= '
        </tbody>
      </table>';
		if ($this->pp_order_formater->isCoupenUse()) {
			$content .= '<div style="border-top: 2px solid #000; width: 100%; margin-left: auto;"><div style="margin-left: auto;   margin-top: 10px; float:right ; text-align:right; font-size: 18px">Discount(' . $this->pp_order_formater->orderCurrency() . ') :- ' . $this->pp_order_formater->convertRsCurrency($this->pp_order_formater->coupenDiscountPrice()) . '</div></div>';
		}

		$content .= '<div style="border-top: 2px solid #000; width: 100%; margin-left: auto; border-bottom: 2px solid #000;"><div style="margin-left: auto;   margin-top: 10px; float:right ; text-align:right; font-size: 20px">Grand Total(' . $this->pp_order_formater->orderCurrency() . ') :- ' . $this->pp_order_formater->convertRsCurrency($this->pp_order_formater->bill_amount()) . '</div></div>
      </td>
    </tr>
  </tbody>
</table></div>
</body>
<style>
	.product-table td{
		padding: 5px 7px;
	}
	.product-table .top-title td{
		border-bottom: 1px solid #000;
	}

	.address-table p{

		margin: 0px;
	}
</style>
</html>


';

		require_once 'includes/pdf/vendor/autoload.php';
		$html2pdf = new HTML2PDF('P', 'A4', 'en');
		$html2pdf->WriteHTML($content);
		$html2pdf->Output('exemple.pdf');
	}
}

/* End of file active_order.php */
/* Location: ./application/controllers/admin/order_man/active_order.php */