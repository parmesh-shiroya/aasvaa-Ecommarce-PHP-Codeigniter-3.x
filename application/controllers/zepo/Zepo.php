<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zepo extends My_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('zepo/m_zepo', 'model');
		//Do your magic here
	}
	public function index() {
		$this->get_rates_by_pincode('395006', 3, 3);
	}
	/**
	 * @param $to_pincode
	 * @param $weight
	 * @param $total_items
	 * @param $payment_mode
	 */
	public function get_rates_by_pincode($to_pincode, $weight = 1, $total_items = 1, $payment_mode = "cod") {
		$request_data = array(
			"pickup_pincode"    => "395006",
			"delivery_pincode"  => $to_pincode,
			"invoice_value"     => 1,
			"payment_mode"      => $payment_mode,
			"insurance"         => "false",
			"number_of_package" => 1,
			"package_details"   => array(array(
				"package_content"   => "Description",
				"no_of_items"       => 1,
				"invoice_value"     => 1,
				"package_dimension" => array(
					"weight" => $weight,
					"height" => round((11 * $total_items)),
					"length" => 35,
					"width"  => 30,
				),
			)),
			"product_type"      => "Parcel",
		);

		$server_output = $this->request_to_zepo('users/3546/pincodeservice/rate', $request_data);

		$return_data = json_decode($server_output);
		$rates_date  = array();
		if (isset($return_data->couriers)) {

			foreach ($return_data->couriers as $key => $value) {
				foreach ($value->service_types as $key1 => $value1) {
					$rates_date = array_merge(
						$rates_date, array(array(
							"success"                => "true",
							"name"                   => $value->name,
							"courier_id"             => $value->courier_id,
							"service_id"             => $value1->service_id,
							"service_name"           => $value1->service_name,
							"expected_delivery_days" => $value1->expected_delivery_days,
							"total_charge"           => $value1->rate_breakup->total_charge,
						),
						)
					);
				}
			}

			$new_data = $this->pp_helper->min_data_with_key($rates_date, 'expected_delivery_days');
			// print_r($new_data = $this->min_with_key($new_data, 'total_charge'));
			$final_data = $this->pp_helper->min_data_with_key($new_data, 'total_charge');
			echo json_encode($final_data);

		} else if (!$return_data->success) {
			// echo "pparmeh";
			echo json_encode($return_data);
			// $google_data = $this->get_data_from_google($to_pincode);
			// echo json_encode($google_data);
			// print_r($google_data->results);
		} else {
			echo json_encode(["Error"]);
		}
		// print_r(json_encode($return_data));
	}

	/**
	 * @param $url_data
	 * @param $request_data
	 */
	private function request_to_zepo($url_data, $request_data) {
		$api_key    = "90bf0b34ae100cff1e66cd4ce3c88a07"; // ADD YOUR API KEY HERE
		$secret_key = "1f98ee3866e684d6a92097721e69140b"; // ADD YOUR SECRET KEY HERE
		$post_url   = "http://api.couriers.zepo.in/" . $url_data; // TESTING ENVIRONMENT
		// $post_url  = "http://api.couriers.zepo.in/initiateShipmentRequest"; // PRODUCTION ENVIRONMENT
		$strtoSign = "POST\n/" . $url_data;
		$strtoSign = urlencode($strtoSign);
		$my_sign   = hash_hmac("sha1", $strtoSign, $secret_key);
		$my_sign   = base64_encode($my_sign);
		$header    = "Authorization:SHIPIT" . ' ' . $api_key . ':' . $my_sign;
		$data      = json_encode($request_data);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $post_url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //Post Fields
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$headers = [
			'Accept-Encoding: gzip, deflate',
			'Accept-Language: en-US,en;q=0.5',
			'Cache-Control: no-cache',
			'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
			'X-MicrosoftAjax: Delta=true',
			$header,
			'Content-Type:application/json',
		];

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$server_output = curl_exec($ch);
		curl_close($ch);

		return $server_output;
	}
	/**
	 * @param $to_pincode
	 * @param $weight
	 * @param $height
	 * @param $length
	 * @param $width
	 * @param $payment_mode
	 * @param $total_items
	 */
	public function adm_get_rates_by_pincode($order_id) {
		if ($this->pp_login_varified->admin_varified()) {
			$parcel_details = $this->model->get_row('order_id', $order_id, 'shipping_parcel_details');

			$to_pincode   = $parcel_details->to_pincode;
			$weight       = $parcel_details->weight;
			$height       = $parcel_details->height;
			$length       = $parcel_details->length;
			$width        = $parcel_details->width;
			$payment_mode = $parcel_details->payment_mode;
			$total_items  = $parcel_details->total_items;
			$request_data = array(
				"pickup_pincode"    => "395004",
				"delivery_pincode"  => $to_pincode,
				"invoice_value"     => 1,
				"payment_mode"      => $payment_mode,
				"insurance"         => "false",
				"number_of_package" => 1,
				"package_details"   => array(array(
					"package_content"   => "Description",
					"no_of_items"       => $total_items,
					"invoice_value"     => 1,
					"package_dimension" => array(
						"weight" => $weight,
						"height" => $height,
						"length" => $length,
						"width"  => $width,
					),
				)),
				"product_type"      => "Parcel",
			);

			$server_output = $this->request_to_zepo('users/3546/pincodeservice/rate', $request_data);

			// print_r($server_output);
			$return_data = json_decode($server_output);
			$rates_date  = array();

			if (isset($return_data->couriers)) {

				foreach ($return_data->couriers as $key => $value) {
					foreach ($value->service_types as $key1 => $value1) {

						if (isset($value1->rate_breakup)) {
							$rates_date = array_merge(
								$rates_date, array(array(
									"success"                => "true",
									"name"                   => $value->name,
									"courier_id"             => $value->courier_id,
									"service_id"             => $value1->service_id,
									"service_name"           => $value1->service_name,
									"expected_delivery_days" => $value1->expected_delivery_days,
									"total_charge"           => $value1->rate_breakup->total_charge,
								),
								)
							);
						}

					}
				}

				$new_data = $this->pp_helper->min_data_with_key($rates_date, 'expected_delivery_days');
				// print_r($new_data = $this->min_with_key($new_data, 'total_charge'));
				$final_data = $this->pp_helper->min_data_with_key($new_data, 'total_charge');
				echo json_encode($final_data);
				$_SESSION['adm']['zepo_rate'] = $final_data;
			} else if (!$return_data->success) {
				// echo "pparmeh";
				echo json_encode($return_data);
				// $google_data = $this->get_data_from_google($to_pincode);
				// echo json_encode($google_data);
				// print_r($google_data->results);
			}
			// print_r(json_encode($return_data));
		}
	}
	/**
	 * @param $order_id
	 */
	public function adm_create_shipment() {
		if ($this->pp_login_varified->admin_varified() && isset($_POST['id']) && isset($_SESSION['adm']['zepo_rate'])) {

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
			$company_address = $this->pp_loader_helper->get_adm_prof_data();

			$shipment_request = array(
				"confirm_order"     => true,
				"payment_status"    => false,
				"courier_id"        => $_SESSION['adm']['zepo_rate'][0]['courier_id'],
				"service_id"        => $_SESSION['adm']['zepo_rate'][0]['service_id'],
				"service_type"      => $_SESSION['adm']['zepo_rate'][0]['service_name'],
				"payment_mode"      => $parcel_details->payment_mode,
				"order_number"      => $order_mst->order_id,
				"pickup_pincode"    => "395004",
				"delivery_pincode"  => $trn_c_data['checkout']['shipping_address']['post_code'],
				"pickup_address"    => array(
					"contact_name" => $company_address['contact_person_name'],
					"company_name" => $company_address['company_name'],
					"address1"     => substr($company_address['address1'], 0, 30),
					"address2"     => substr(substr($company_address['address1'], 30) . $company_address['address2'], 0, 30),
					"landmark"     => $company_address['add_city'],
					"city"         => $company_address['add_city'],
					"state"        => $company_address['add_state'],
					"pincode"      => $company_address['add_pincode'],
					"country"      => 'IN',
					"contact_no"   => $company_address['add_contactno'],
					"email"        => $company_address['add_email'],
				),
				"delivery_address"  => array(
					"contact_name" => $trn_c_data['checkout']['shipping_address']['name'],
					"company_name" => $trn_c_data['checkout']['shipping_address']['name'],
					"address1"     => substr($trn_c_data['checkout']['shipping_address']['address1'], 0, 30),
					"address2"     => substr(substr($trn_c_data['checkout']['shipping_address']['address1'], 30) . $trn_c_data['checkout']['shipping_address']['address2'], 0, 30),
					"landmark"     => $trn_c_data['checkout']['shipping_address']['name'],
					"city"         => $trn_c_data['checkout']['shipping_address']['city'],
					"state"        => $trn_c_data['checkout']['shipping_address']['state'],
					"pincode"      => $trn_c_data['checkout']['shipping_address']['post_code'],
					"country"      => "IN",
					"contact_no"   => $trn_c_data['checkout']['shipping_address']['mobile_no'],
					"email"        => $trn_c_data['customer_data']['email'],
				),
				"number_of_package" => 1,
				"package_details"   => array(array(
					"package_content"   => "Description",
					"no_of_items"       => $parcel_details->total_items,
					"invoice_value"     => $remian_amt,
					"package_dimension" => array(
						"weight" => $parcel_details->weight,
						"height" => $parcel_details->height,
						"length" => $parcel_details->length,
						"width"  => $parcel_details->width,
					),
				)),
			);
			$this->request_to_zepo('users/3546/pickup', $shipment_request);
			$return_data = json_decode($this->request_to_zepo('users/3546/pickup', $shipment_request));

			// echo json_encode($return_data);

			if ($return_data->success) {
				// $this->model->update_data('id', $order_id, 'order_mst', array('status' => 2));
				// $this->model->insert_data('order_status_mst', array('order_id' => $order_id, 'status_id' => 2, 'status_text' => 'By Admin', 'date' => date('d-m-Y'), 'time' => date('h:i a'), 'status' => 'Ready To ship'));
				$this->model->delete_row('order_id', $order_id, 'zepo_pickup_request_data');
				$this->model->insert_data('zepo_pickup_request_data', array('order_id' => $order_id, 'delivery_by' => $_SESSION['adm']['zepo_rate'][0]['name'], 'order_order_id' => $order_mst->order_id, ' 	request_data' => base64_encode(serialize($shipment_request)), 'response_data' => base64_encode(serialize($return_data)), 'date' => date('d-m-Y'), 'time' => date('h:i a')));

				$this->create_abandoned_order($return_data->shipment_id, $order_mst->customer_id, $order_mst->order_id);
			}

		}
	}

	/**
	 * @param $shipments_id
	 * @param $user_id
	 * @param $order_code
	 */
	private function create_abandoned_order($shipments_id, $user_id, $order_code) {
		$order_array = array(
			'shipmentIds' => [$shipments_id],
			'user_id'     => $user_id,
			'udf1'        => $order_code,
		);
		$return_data = json_decode($this->request_to_zepo('orders', $order_array));

		echo json_encode($return_data);
		if ($return_data->success) {
			$this->model->update_data('order_order_id', $order_code, 'zepo_pickup_request_data', array('res_order_id' => $return_data->order_code));
			// $this->redirect_to_payment_url();
			// echo json_encode(['order_code' => $return_data->order_code]);
		}
	}

	/**
	 * @param $order_code
	 */
	// private function redirect_to_payment_url($order_code) {
	// 	$data['order_code'] = $order_code;
	// 	$this->load->view('admin/other_content/zepo_redirect_payment', $data);
	// }
	/**
	 * @param  $pincode
	 * @return mixed
	 */
	public function get_data_from_google($pincode) {
		$url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $pincode . "&key=AIzaSyDAjHXy7M8fUMJYuh3VDwjS-5jPJf_IN34";
		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);
		curl_close($ch);
		return $obj = json_decode($result);
	}
	/**
	 * @param $data
	 */
	public function filter_country_by_google_data($data) {
		if (isset($data->result)) {

		}
	}

	public function paymentsuccess() {
		if ($this->input->get('orderCode')) {
			$data = $this->model->get_row('res_order_id', $this->input->get('courierOrderCode'), 'zepo_pickup_request_data');
			if (!empty($data)) {
				$this->model->update_data('id', $data->order_id, 'order_mst', array('status' => 2));
				$this->model->insert_data('order_status_mst', array('order_id' => $data->order_id, 'status_id' => 2, 'status_text' => 'By Admin', 'date' => date('d-m-Y'), 'time' => date('h:i a'), 'status' => 'Ready To ship', 'message' => 'Ready to Ship.'));
				$this->model->update_data('order_id', $data->order_id, 'zepo_pickup_request_data', array('payment_success' => '1'));
				$this->getCourierOrderInfo($this->input->get('courierOrderCode'), $data->order_id, $data->order_order_id);
				header('location:' . site_url('admin/order_man/order_detail/index/' . $data->order_id . '/' . $data->order_order_id));
			} else {
				$data = $this->model->get_row('res_order_id', $this->input->get('courierOrderCode'), 'zepo_pickup_return_request_data');
				if (!empty($data)) {
					$this->model->update_data('id', $data->order_id, 'order_mst', array('status' => 12));
					$this->model->insert_data('order_status_mst', array('order_id' => $data->order_id, 'status_id' => 12, 'status_text' => 'By Admin', 'date' => date('d-m-Y'), 'time' => date('h:i a'), 'status' => 'Order Return Confirmed.', 'message' => 'Return Confirmed'));
					$this->model->update_data('order_id', $data->order_id, 'zepo_pickup_return_request_data', array('payment_success' => '1'));
					$this->getCourierOrderInfo($this->input->get('courierOrderCode'), $data->order_id, $data->order_order_id, true);
					header('location:' . site_url('admin/order_man/order_detail/index/' . $data->order_id . '/' . $data->order_order_id));
				}
			}

		}
	}
	public function paymentfailure() {
		if ($this->input->get('orderCode')) {
			$data = $this->model->get_row('res_order_id', $this->input->get('orderCode'), 'zepo_pickup_request_data');
			header('location:' . site_url('admin/order_man/order_detail/index/' . $data->order_id . '/' . $data->order_order_id . '?message=' . $this->input->get('message')));
		}
	}

	/**
	 * @return mixed
	 */
	public function track_shipment_data($traking_no = "", $order_id = "", $ship_prov = "") {
		$traking_array = array(
			'Fedex'    => 1,
			'Aramex'   => 2,
			'Delivery' => 4,
			'Dotzot'   => 6,
			'Bluedart' => 8,
		);
		if (!empty($traking_no) && !empty($order_id) && !empty($ship_prov)) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, 'http://api.couriers.zepo.in/couriers/' . $traking_array[$ship_prov] . '/track/' . $traking_no);
			$result = curl_exec($ch);
			curl_close($ch);
			return $obj = json_decode($result);
		}
	}

	/**
	 * @return mixed
	 */
	public function getCourierOrderInfo($order_code, $order_id, $order_order_id, $return = false) {
//error_reporting(E_ALL);
		//ini_set('display_errors', 1);
		$url_data = "orders/" . $order_code . "?details=true";

		$api_key    = "90bf0b34ae100cff1e66cd4ce3c88a07"; // ADD YOUR API KEY HERE
		$secret_key = "1f98ee3866e684d6a92097721e69140b"; // ADD YOUR SECRET KEY HERE
		$post_url   = "http://api.couriers.zepo.in/" . $url_data; // TESTING ENVIRONMENT
		//$post_url	=	"http://api.couriers.zepo.in/initiateShipmentRequest";	// PRODUCTION ENVIRONMENT
		$strtoSign = "GET\n/" . $url_data;
		$strtoSign = urlencode($strtoSign);
		$my_sign   = hash_hmac("sha1", $strtoSign, $secret_key);
		$my_sign   = base64_encode($my_sign);
		$header    = "Authorization:SHIPIT" . ' ' . $api_key . ':' . $my_sign;
		// $data      = json_encode($request_data);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $post_url);
		//curl_setopt($ch, CURLOPT_POST, 1);

		//curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //Post Fields
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$headers = [
			'Accept-Encoding: gzip, deflate',
			'Accept-Language: en-US,en;q=0.5',
			'Cache-Control: no-cache',
			'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
			'X-MicrosoftAjax: Delta=true',
			$header,
			'Content-Type:application/json',
		];

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		curl_close($ch);

		$obj = json_decode($result);

		if ($obj->success) {
			$data = array(
				'order_id'       => $order_id,
				'order_order_id' => $order_order_id,
				'res_order_id'   => $order_code,
				'amount'         => $obj->amount,
				'payment_mode'   => $obj->paymentMode,
				'shipment_id'    => $obj->shipments[0]->shipment_id,
				'tracking_no'    => $obj->shipments[0]->shipmentPackages->tracking_number,
				'data'           => base64_encode(serialize($obj)),
				'date'           => date('d-m-Y'),
				'time'           => date('h:i a'),
			);
			if ($return) {
				$this->model->delete_row('order_id', $order_id, 'zepo_return_courier_order_info');
				$this->model->insert_data('zepo_return_courier_order_info', $data);
			} else {
				$this->model->delete_row('order_id', $order_id, 'zepo_courier_order_info');
				$this->model->insert_data('zepo_courier_order_info', $data);
			}
		}
	}

	// **********************************************************
	// ******************** Create Return Shipment ***************
	// *************************************************************//
	//
	//
	/**
	 * @param $order_id
	 */
	public function adm_get_return_rates_by_pincode($order_id) {
		if ($this->pp_login_varified->admin_varified()) {
			$parcel_details = $this->model->get_row('order_id', $order_id, 'return_shipping_parcel_details');

			$to_pincode   = $parcel_details->to_pincode;
			$weight       = $parcel_details->weight;
			$height       = $parcel_details->height;
			$length       = $parcel_details->length;
			$width        = $parcel_details->width;
			$payment_mode = $parcel_details->payment_mode;
			$total_items  = $parcel_details->total_items;
			$request_data = array(
				"pickup_pincode"    => $to_pincode,
				"delivery_pincode"  => "395004",
				"invoice_value"     => 1,
				"payment_mode"      => $payment_mode,
				"insurance"         => "false",
				"number_of_package" => 1,
				"package_details"   => array(array(
					"package_content"   => "Description",
					"no_of_items"       => $total_items,
					"invoice_value"     => 1,
					"package_dimension" => array(
						"weight" => $weight,
						"height" => $height,
						"length" => $length,
						"width"  => $width,
					),
				)),
				"product_type"      => "Parcel",
			);
			$server_output = $this->request_to_zepo('users/3546/pincodeservice/rate', $request_data);

			// print_r($server_output);
			$return_data = json_decode($server_output);
			$rates_date  = array();
			if (isset($return_data->couriers)) {

				foreach ($return_data->couriers as $key => $value) {
					foreach ($value->service_types as $key1 => $value1) {
						$rates_date = array_merge(
							$rates_date, array(array(
								"success"                => "true",
								"name"                   => $value->name,
								"courier_id"             => $value->courier_id,
								"service_id"             => $value1->service_id,
								"service_name"           => $value1->service_name,
								"expected_delivery_days" => $value1->expected_delivery_days,
								"total_charge"           => $value1->rate_breakup->total_charge,
							),
							)
						);

					}
				}

				$new_data = $this->pp_helper->min_data_with_key($rates_date, 'expected_delivery_days');
				// print_r($new_data = $this->min_with_key($new_data, 'total_charge'));
				$final_data = $this->pp_helper->min_data_with_key($new_data, 'total_charge');
				echo json_encode($final_data);
				$_SESSION['adm']['zepo_rate'] = $final_data;
			} else if (!$return_data->success) {

				echo json_encode($return_data);
				// $google_data = $this->get_data_from_google($to_pincode);
				// echo json_encode($google_data);
				// print_r($google_data->results);
			}
			// print_r(json_encode($return_data));
		}
	}
	//
	//
	public function adm_create_return_shipment() {
		// error_reporting(E_ALL);
		// ini_set('display_errors', 1);

		if ($this->pp_login_varified->admin_varified() && isset($_POST['id']) && isset($_SESSION['adm']['zepo_rate'])) {

			$order_id = $this->input->post('id');

			$parcel_details = $this->model->get_row('order_id', $order_id, 'return_shipping_parcel_details');

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
			$company_address  = $this->pp_loader_helper->get_adm_prof_data();
			$shipment_request = array(
				"confirm_order"     => true,
				"payment_status"    => false,
				"courier_id"        => $_SESSION['adm']['zepo_rate'][0]['courier_id'],
				"service_id"        => $_SESSION['adm']['zepo_rate'][0]['service_id'],
				"service_type"      => $_SESSION['adm']['zepo_rate'][0]['service_name'],
				"payment_mode"      => 'online',
				"order_number"      => $order_mst->order_id,
				"pickup_pincode"    => $trn_c_data['checkout']['shipping_address']['post_code'],
				"delivery_pincode"  => "395004",
				"pickup_address"    => array(
					"contact_name" => $trn_c_data['checkout']['shipping_address']['name'],
					"company_name" => $trn_c_data['checkout']['shipping_address']['name'],
					"address1"     => substr($trn_c_data['checkout']['shipping_address']['address1'], 0, 30),
					"address2"     => substr(substr($trn_c_data['checkout']['shipping_address']['address1'], 30) . $trn_c_data['checkout']['shipping_address']['address2'], 0, 30),
					"landmark"     => $trn_c_data['checkout']['shipping_address']['name'],
					"city"         => $trn_c_data['checkout']['shipping_address']['city'],
					"state"        => $trn_c_data['checkout']['shipping_address']['state'],
					"pincode"      => $trn_c_data['checkout']['shipping_address']['post_code'],
					"country"      => "IN",
					"contact_no"   => $trn_c_data['checkout']['shipping_address']['mobile_no'],
					"email"        => $trn_c_data['customer_data']['email'],
				),
				"delivery_address"  => array(
					"contact_name" => $company_address['contact_person_name'],
					"company_name" => $company_address['company_name'],
					"address1"     => substr($company_address['address1'], 0, 30),
					"address2"     => substr(substr($company_address['address1'], 30) . $company_address['address2'], 0, 30),
					"landmark"     => ' ',
					"city"         => $company_address['add_city'],
					"state"        => $company_address['add_state'],
					"pincode"      => $company_address['add_pincode'],
					"country"      => $company_address['add_country'],
					"contact_no"   => $company_address['add_contactno'],
					"email"        => $company_address['add_email'],
				),
				"number_of_package" => 1,
				"package_details"   => array(array(
					"package_content"   => "Description",
					"no_of_items"       => $parcel_details->total_items,
					"invoice_value"     => $remian_amt,
					"package_dimension" => array(
						"weight" => $parcel_details->weight,
						"height" => $parcel_details->height,
						"length" => $parcel_details->length,
						"width"  => $parcel_details->width,
					),
				)),
			);
			$return_data = json_decode($this->request_to_zepo('users/3546/pickup', $shipment_request));

			// echo json_encode($return_data);

			if ($return_data->success) {
				// $this->model->update_data('id', $order_id, 'order_mst', array('status' => 2));
				// $this->model->insert_data('order_status_mst', array('order_id' => $order_id, 'status_id' => 2, 'status_text' => 'By Admin', 'date' => date('d-m-Y'), 'time' => date('h:i a'), 'status' => 'Ready To ship'));
				$this->model->delete_row('order_id', $order_id, 'zepo_pickup_return_request_data');
				$this->model->insert_data('zepo_pickup_return_request_data', array('order_id' => $order_id, 'delivery_by' => $_SESSION['adm']['zepo_rate'][0]['name'], 'order_order_id' => $order_mst->order_id, ' 	request_data' => base64_encode(serialize($shipment_request)), 'response_data' => base64_encode(serialize($return_data)), 'date' => date('d-m-Y'), 'time' => date('h:i a')));

				$this->create_return_abandoned_order($return_data->shipment_id, $order_mst->customer_id, $order_mst->order_id);
			}

		}
	}

	/**
	 * @param $shipments_id
	 * @param $user_id
	 * @param $order_code
	 */
	private function create_return_abandoned_order($shipments_id, $user_id, $order_code) {
		$order_array = array(
			'shipmentIds' => [$shipments_id],
			'user_id'     => $user_id,
			'udf1'        => $order_code,
		);
		$return_data = json_decode($this->request_to_zepo('orders', $order_array));

		echo json_encode($return_data);
		if ($return_data->success) {
			$this->model->update_data('order_order_id', $order_code, 'zepo_pickup_return_request_data', array('res_order_id' => $return_data->order_code));
			// $this->redirect_to_payment_url();
			// echo json_encode(['order_code' => $return_data->order_code]);
		}
	}
}