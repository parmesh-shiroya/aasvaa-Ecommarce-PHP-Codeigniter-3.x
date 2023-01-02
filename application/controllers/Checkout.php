<?php

class Checkout extends My_Controller {

	public function __construct() {
		parent::__construct();
		//Do your magic here
		if (!$this->pp_login_varified->customer_varified()) {
			header('location:' . site_url('account/login'));
		}
		$this->load->model('web/m_checkout', 'model');
	}

	public function index() {
		// echo FCPATH;
		// $this->recheck_full_cart();
		$this->custom_size_checker();
		if (!isset($_SESSION['report']['checkout'])) {
			if (isset($_SESSION['report']['shopping_cart'])) {
				$this->pp_common->delete_report_data('Shopping Cart', $_SESSION['report']['shopping_cart']);
			}
			$time        = time();
			$insert_data = array('page' => 'Checkout', 'uni_key' => $time);
			if ($this->pp_login_varified->customer_varified()) {
				$insert_data = array_merge($insert_data, array('customer_id' => $this->session->userdata('customer_data')['customer_id']));
			}
			if ($this->pp_common->insert_report_data($insert_data)) {
				$_SESSION['report']['checkout'] = $time;
			}
		}
		// print_r($_SESSION);
		$data['countrys']           = $this->model->get_all_countrys();
		$customer_id                = $this->session->userdata('customer_data')['customer_id'];
		$data['customer_address']   = $this->model->get_customer_address($customer_id);
		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());

		$this->load->view('web/checkout', $data);

		$this->load->view('web/contents/support_bar/support_bar1', $this->pp_loader_helper->get_adm_prof_data());

		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());

	}
	public function show_session() {
		echo "<pre>";
		print_r($_SESSION);
	}
	public function check_cart_data() {

		$size_datas = array();

		foreach ($_SESSION['cart'] as $key => $value) {

			$product_data = $this->model->get_product_data($value['product_id']);

			$size_datas = array_merge($size_datas, array("product_data_" . $value['product_id'] => $product_data));

			if (isset($_SESSION['single_cart_data']['product_id_' . $value['product_id']])) {

				foreach ($_SESSION['single_cart_data']['product_id_' . $value['product_id']] as $keysingle => $valuesingle) {

					if ($valuesingle[$keysingle . 'radio'] == 'standard') {

						$size_datas = array_merge($size_datas, array("standard_data_" . $value['product_id'] => unserialize(base64_decode($product_data->standard_size_show_in))));

					} else if ($valuesingle[$keysingle . 'radio'] == 'customize') {

						$size_datas = array_merge($size_datas, array("customize_data_" . $value['product_id'] => unserialize(base64_decode($product_data->customize_show_in))));
					}

				}

			}

		}
		echo json_encode($size_datas);
	}
	private function custom_size_checker() {
		foreach ($this->cart->contents() as $items) {
			if (isset($items['options'])) {
				foreach ($this->cart->product_options($items['rowid']) as $keysingle => $valuesingle) {
					if ($valuesingle[$keysingle . 'radio'] == 'customize') {
						$this->check_customize_size_given($items['rowid'], $valuesingle['customize_names']);
					}
				}
			}
		}
	}
	/**
	 * @param $row_id
	 * @param $customize_name
	 */
	private function check_customize_size_given($row_id = 0, $customize_name = "") {
		if (isset($_SESSION['cart']) && isset($_SESSION['cart']['product_' . $row_id]) && isset($_SESSION['cart']['product_' . $row_id]['mesurement_select_data'])) {

		} else {
			header("Location:" . site_url('item_mesurement/' . $row_id));
		}
	}
	/**
	 * @param $shipping_charges
	 * @param $total_weight
	 * @param $payment
	 */
	private function get_dom_shipp_charge($shipping_charges, $total_weight, $payment = "cod") {
		$dom_charges = 0;
		if ($shipping_charges->domestic_type == 0 && $shipping_charges->domestic_shipping != 0) {
			$dom_charges = $shipping_charges->domestic_shipping;
		}
		if ($_SESSION['checkout']['shipping_address']['country'] == "india" && $shipping_charges->domestic_type == 1) {
			$pincode     = $_SESSION['checkout']['shipping_address']['post_code'];
			$total_items = $this->cart->total_items();
			$url         = base_url('zepo/zepo/get_rates_by_pincode/' . $pincode . "/" . $total_weight . "/" . $total_items . "/" . $payment);
			$ch          = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, $url);
			$result = curl_exec($ch);
			curl_close($ch);
			$obj                              = json_decode($result);
			$_SESSION['zepo_shipping_charge'] = $obj;
			if ($obj[0]->success) {
				$dom_charges = round($obj[0]->total_charge / $total_items);
			} else {
				$dom_charges = 250;
			}
		}
		$this->update_ship_price_data($dom_charges);
	}

	/**
	 * @param $dom_charges
	 */
	private function update_ship_price_data($dom_charges) {
		foreach ($this->cart->contents() as $items) {
			$data = array("rowid" => $items['rowid'], "ship_charge" => $dom_charges);
			$this->cart->update($data);
			if ($_SESSION['checkout']['shipping_address']['country'] == 'india') {
				$_SESSION['newcart']['shipping_charge'][$items['rowid']] = $dom_charges;
			}
		}
	}
	/**
	 * @return mixed
	 */
	private function recheck_full_cart() {
		$this->custom_size_checker();
		$this->refresh_checkout_address();
		$shipping_charges = $this->pp_loader_helper->get_shipping_charge();
		$total_weight     = 0;
		$dom_charges      = 0;
		if ($shipping_charges->domestic_type == 0 && $shipping_charges->domestic_shipping != 0) {
			$dom_charges = $shipping_charges->domestic_shipping;
		}
		foreach ($this->cart->contents() as $items) {

			$data = $this->model->get_product_data($items['id']);

			// print_r($items);
			if (!empty($data)) {
				$total_weight = $total_weight + ($data->weight * $items['qty']);
				$data1        = array(
					'id'                => $data->product_id,
					'qty'               => $items['qty'],
					'price'             => $data->sell_price,
					'name'              => $data->product_name,
					'weight'            => $data->weight,
					'image'             => $data->pro_img,
					'ship_charge'       => $dom_charges,
					'rowid'             => $items['rowid'],
					'inter_ship_charge' => $shipping_charges->international_charge,
				);

				if (isset($items['options'])) {

					$data1 = array_merge($data1, array('options' => $items['options']));

					$service_prices = 0;

					foreach ($this->cart->product_options($items['rowid']) as $keysingle => $valuesingle) {

						if ($valuesingle[$keysingle . 'radio'] == 'standard') {

							foreach (unserialize(base64_decode($data->standard_size_show_in)) as $key => $value) {

								if ($value['name'] == $keysingle) {

									$service_prices = $service_prices + $value['standard_price'];

								}

							}

							// $price = "";

						} elseif ($valuesingle[$keysingle . 'radio'] == 'customize') {

							foreach (unserialize(base64_decode($data->customize_show_in)) as $key => $value) {

								if ($value['name'] == $keysingle) {

									$service_prices = $service_prices + $value['customize_price'];

								}

							}

							// $this->check_customize_size_given($items['rowid'], $valuesingle['customize_names']);

						}

					}

					$_SESSION['newcart']['services_expenses'][$items['rowid']] = $service_prices;

				}

				if ($_SESSION['checkout']['shipping_address']['country'] != 'india') {

					$_SESSION['newcart']['shipping_charge'][$items['rowid']] = $shipping_charges->international_charge;

				} else {

					$_SESSION['newcart']['shipping_charge'][$items['rowid']] = $dom_charges;

				}

				$this->cart->update($data1);
			} else {
				$this->cart->remove($items['rowid']);
			}
		}
		///// TODO Which Payment Selected //////
		if ($_SESSION['checkout']['shipping_address']['country'] == "india" && $shipping_charges->domestic_type == 1) {
			if ($_SESSION['checkout']['payment_method']['payment_option'] != "cod_payment") {
				$this->get_dom_shipp_charge($shipping_charges, $total_weight, $payment = "prepaid");
			} else if ($_SESSION['checkout']['payment_method']['payment_option'] == "cod_payment") {
				$this->get_dom_shipp_charge($shipping_charges, $total_weight, $payment = "cod");
			}
		}
		if ($this->pp_login_varified->customer_varified() && $this->cart->total_items() != 0) {
			$customer_id = $this->session->userdata('customer_data')['customer_id'];
			$result      = $this->model->check_cart_exist_indb($customer_id);
			if (!empty($result)) {
				$this->model->update_db_cart($customer_id, array('cart' => base64_encode(serialize($this->cart->contents()))));
			} else {
				$this->model->insert_cart_db(array('customer_id' => $customer_id, 'cart' => base64_encode(serialize($this->cart->contents()))));
			}
		}
		$total_other_charges    = 0;
		$total_service_charges  = 0;
		$total_shipping_charges = 0;
		if (isset($_SESSION['newcart']['services_expenses'])) {
			# code...
			foreach ($_SESSION['newcart']['services_expenses'] as $key => $value) {
				$total_service_charges = $total_service_charges + ($value * $this->cart->get_item($key)['qty']);
			}
		}
		if (isset($_SESSION['newcart']['shipping_charge'])) {
			foreach ($_SESSION['newcart']['shipping_charge'] as $key => $value) {
				$total_shipping_charges = $total_shipping_charges + ($value * $this->cart->get_item($key)['qty']);
			}
		}
		$total_other_charges = $total_shipping_charges + $total_service_charges;
		// echo $total_other_charges;
		$_SESSION['newcart']['total_service_charges']  = $total_service_charges;
		$_SESSION['newcart']['total_shipping_charges'] = $total_shipping_charges;
		$_SESSION['newcart']['total_other_charges']    = $total_other_charges;
		// echo $this->cart->total() + $total_other_charges;
		if (isset($_SESSION['cart_coupen_data'])) {
			$coupen_data = $this->model->get_coupen_data($_SESSION['cart_coupen_data']->id);
			if (($coupen_data->area == "india" && $_SESSION['checkout']['shipping_address']['country'] == "india") || ($coupen_data->area == "other_country" && $_SESSION['checkout']['shipping_address']['country'] != "india") || $coupen_data->area == "all_country") {
				$paymentDate = date('d-m-Y');
				$paymentDate = DateTime::createFromFormat('d-m-Y', date('d-m-Y', strtotime($paymentDate)));
				//echo $paymentDate; // echos today!
				$contractDateBegin = DateTime::createFromFormat('d-m-Y', date('d-m-Y', strtotime($coupen_data->valid_from)));
				$contractDateEnd   = DateTime::createFromFormat('d-m-Y', date('d-m-Y', strtotime($coupen_data->valid_to)));
				if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd)) {

					if ($coupen_data->use_count < $coupen_data->use_time) {

						if ($coupen_data->min_mrp_cond != NULL && $coupen_data->min_mrp_cond <= $this->cart->total()) {

							$_SESSION['cart_coupen_data'] = $coupen_data;

						} else {

							unset($_SESSION['cart_coupen_data']);

						}

					} else {

						unset($_SESSION['cart_coupen_data']);

					}

				} else {

					unset($_SESSION['cart_coupen_data']);

				}

			} else {

				unset($_SESSION['cart_coupen_data']);

			}

		}
		$_SESSION['currency']        = $this->ccr->get_all_country_currency();
		$_SESSION['currency_symbol'] = $this->ccr->get_country_currency_symbol();
		$_SESSION['usd_price']       = $_SESSION['currency']['USD'];
		$_SESSION['time']            = time();
		$db_array                    = array(

			"se_data" => base64_encode(serialize($_SESSION)),

			"status" => '0',
			"time"   => $_SESSION['time'],

			"customer_id" => $this->session->userdata('customer_data')['customer_id'],

		);

		return $this->model->add_session_data_to_db($db_array);

	}

	private function refresh_checkout_address() {

		if (isset($_SESSION['checkout']['billing_address'])) {

			$address_data = $this->model->get_address_data($_SESSION['checkout']['billing_address']['address_id']);

			$_SESSION['checkout']['billing_address'] = array(

				'address_id' => $address_data->id,

				"address1" => $address_data->address1,

				"name" => $address_data->name,

				"address2" => $address_data->address2,

				"city" => $address_data->city,

				"post_code" => $address_data->post_code,

				"mobile_no" => $address_data->mobile_no,

				"country" => $address_data->country,

				"state" => $address_data->state,

			);

		} else {
			header("Location:" . base_url("checkout"));
		}

		if (isset($_SESSION['checkout']['shipping_address'])) {

			$address_data = $this->model->get_address_data($_SESSION['checkout']['shipping_address']['address_id']);

			$_SESSION['checkout']['shipping_address'] = array(

				'address_id' => $address_data->id,

				"address1" => $address_data->address1,

				"name" => $address_data->name,

				"address2" => $address_data->address2,

				"city" => $address_data->city,

				"post_code" => $address_data->post_code,

				"mobile_no" => $address_data->mobile_no,

				"country" => $address_data->country,

				"state" => $address_data->state,

			);

		} else {
			header("Location:" . base_url("checkout"));
		}

	}

	public function state_list() {

		if (isset($_POST['ids'])) {

			$data = $this->model->get_state_list($this->input->post('ids'));

			$this->output->set_content_type('application_json');

			$this->output->set_output(json_encode($data));

		}

	}
	/**
	 * @return mixed
	 */
	public function get_usd_price() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, 'http://api.fixer.io/latest?base=INR');
		$result = curl_exec($ch);
		curl_close($ch);
		return $obj = json_decode($result);
		// print_r($obj->rates->USD);
		// $data = $obj;
	}
	public function paypal_payment() {
		if (!isset($_SESSION['report']['payapl'])) {
			if (isset($_SESSION['report']['checkout_final'])) {
				$this->pp_common->delete_report_data('Checkout Final', $_SESSION['report']['checkout_final']);
			}
			$time        = time();
			$insert_data = array('page' => 'Payapl', 'uni_key' => $time);
			if ($this->pp_login_varified->customer_varified()) {
				$insert_data = array_merge($insert_data, array('customer_id' => $this->session->userdata('customer_data')['customer_id']));
			}
			if ($this->pp_common->insert_report_data($insert_data)) {
				$_SESSION['report']['payapl'] = $time;
			}
		}
		$db_insert_id = $this->recheck_full_cart();

		if (isset($_SESSION['newcart'])) {

			$data = $this->get_usd_price();

			// print_r($data);

			// $this->load->view('web/contents/other_content/paypal_form', $data);

			$paypal_data = array();

			$paypal_data['cmd'] = "_cart";

			$paypal_data['upload'] = "1";

			// aasvaaservices-facilitator@yahoo.com

			// aasvaaservices-buyer@yahoo.com
			// aasvaaservices-facilitator@gmail.com

			$paypal_data['business'] = "aasvaaservices@gmail.com";

			$a = 1;

			foreach ($this->cart->contents() as $items) {

				$service_charge = 0;

				$shoping_charge = 0;

				if (isset($_SESSION['newcart']['services_expenses'][$items['rowid']])) {

					$service_charge = $_SESSION['newcart']['services_expenses'][$items['rowid']];

				}

				if (isset($_SESSION['newcart']['shipping_charge'][$items['rowid']])) {

					$shoping_charge = $_SESSION['newcart']['shipping_charge'][$items['rowid']];

				}

				$item_value = ($items['price'] + $shoping_charge + $service_charge) * $_SESSION['currency']['USD'];

				$paypal_data['item_name_' . $a] = $items['name'];

				$paypal_data['item_number_' . $a] = $items['id'];

				$paypal_data['amount_' . $a] = bcdiv($item_value, 1, 2);

				$paypal_data['quantity_' . $a] = $items['qty'];

				// $paypal_data['weight_' . $a] = "1";

				$a++;

			}

			$paypal_data['currency_code'] = "USD";

			$paypal_data['first_name'] = $_SESSION['checkout']['billing_address']['name'];

			$paypal_data['last_name'] = "";

			$paypal_data['address1'] = $_SESSION['checkout']['billing_address']['address1'];

			$paypal_data['address2'] = $_SESSION['checkout']['billing_address']['address2'];

			$paypal_data['city'] = $_SESSION['checkout']['billing_address']['city'];

			$paypal_data['zip'] = $_SESSION['checkout']['billing_address']['post_code'];

			$paypal_data['country'] = $_SESSION['checkout']['billing_address']['country'];

			$paypal_data['address_override'] = "0";

			$paypal_data['email'] = $this->session->userdata('customer_data')['email'];

			// $paypal_data['invoice'] = "";

			if (isset($_SESSION['cart_coupen_data'])) {

				if ($_SESSION['cart_coupen_data']->discount_type == 0) {
					$paypal_data['discount_amount_cart'] = bcdiv($_SESSION['cart_coupen_data']->dis_percet_rs * $_SESSION['currency']['USD'], 1, 2);
				} elseif ($_SESSION['cart_coupen_data']->discount_type == 1) {
					$paypal_data['discount_rate_cart'] = $_SESSION['cart_coupen_data']->dis_percet_rs;
				}
			}

			$paypal_data['lc']      = "en";
			$paypal_data['invoice'] = time();
			$paypal_data['rm']      = "2";

			$paypal_data['no_note'] = "1";

			$paypal_data['charset'] = "utf-8";

			$paypal_data['return'] = site_url("checkout/order_success/$db_insert_id");

			$paypal_data['notify_url'] = "";

			$paypal_data['cancel_return'] = site_url("checkout");

			$paypal_data['paymentaction'] = "authorization";

			$paypal_data['custom'] = base64_encode(serialize(array("trnsaction_db_id" => $db_insert_id, "ti" => $_SESSION['time'])));

			$query_string       = http_build_query($paypal_data);
			$paypal_insert_data = array(
				"trn_cart_id" => $db_insert_id,
				"datas"       => base64_encode(serialize($paypal_data)),
				"payment_url" => $query_string,
				"customer_id" => $this->session->userdata('customer_data')['customer_id'],
				"time"        => $_SESSION['time'],
			);
			// print_r($paypal_data);
			$this->model->insert_data('paypal_payment_data', $paypal_insert_data);
			header('Location: https://www.paypal.com/cgi-bin/webscr?' . $query_string);
			// discount_amount
		}
	}

	/**
	 * @param $arr
	 */
	public function order_success($arr = 0) {

		if ($arr != 0 && isset($_GET['tx']) && isset($_GET['st']) && isset($_GET['amt']) && isset($_GET['cc']) && isset($_GET['cm'])) {

			$custome_data = unserialize(base64_decode($_GET['cm']));

			$order_id = $this->add_order_data($custome_data['trnsaction_db_id'], $custome_data['ti'], $_GET['tx']);

			if ($order_id == 'error') {
				if (isset($_SESSION['report']['payapl'])) {
					$this->pp_common->delete_report_data('Payapl', $_SESSION['report']['payapl']);
				}
				$time        = time();
				$insert_data = array('page' => 'Success Order (Error)', 'uni_key' => $time, 'other_data' => 'Paypal');
				if ($this->pp_login_varified->customer_varified()) {
					$insert_data = array_merge($insert_data, array('customer_id' => $this->session->userdata('customer_data')['customer_id']));
				}
				if ($this->pp_common->insert_report_data($insert_data)) {
					$_SESSION['report']['success_order_error'] = $time;
				}

				header("Location:" . site_url('success_order/index/0/Something Wrong'));
			} else {
				if (isset($_SESSION['report']['payapl'])) {
					$this->pp_common->delete_report_data('Payapl', $_SESSION['report']['payapl']);
				}
				$time        = time();
				$insert_data = array('page' => 'Success Order.', 'uni_key' => $time, 'other_data' => 'Paypal');
				if ($this->pp_login_varified->customer_varified()) {
					$insert_data = array_merge($insert_data, array('customer_id' => $this->session->userdata('customer_data')['customer_id']));
				}
				if ($this->pp_common->insert_report_data($insert_data)) {
					$_SESSION['report']['success_order_error'] = $time;
				}
				header("Location:" . site_url('success_order/index/' . $order_id . '/Success'));
			}

			// $headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
			// $this->load->view('web/inc/header_view', $headers);
			// $this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
			// $this->load->view('web/order_success', $data);
			// $this->load->view('web/contents/support_bar/support_bar1', $this->pp_loader_helper->get_adm_prof_data());
			// $this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
		}
	}

	/**
	 * @param  $trnsaction_db_id
	 * @param  $time
	 * @param  $tx
	 * @return mixed
	 */
	private function add_order_data($trnsaction_db_id = 0, $time = 0, $tx = "00") {
		if ($trnsaction_db_id != 0) {
			$customer_id         = $this->session->userdata('customer_data')['customer_id'];
			$trn_data            = $this->model->get_trnsaction_data($trnsaction_db_id, $time, $customer_id);
			$paypal_payment_data = $this->model->get_paypal_payment_data($trnsaction_db_id, $time, $customer_id);

			if (!empty($trn_data) && !empty($paypal_payment_data)) {

				$order_data = array(
					'order_id'             => $this->get_new_order_id(),
					'trn_cart_id'          => $trnsaction_db_id,
					'payment_from'         => "paypal",
					'payment_from_data_id' => $paypal_payment_data->id,
					'trnscation_id'        => $tx,
					'customer_id'          => $customer_id,
					'trn_return_data'      => base64_encode(serialize(array("post" => $_POST, "get" => $_GET))),
					'date'                 => date('d-m-Y'),
					'time'                 => date('h:i:s a'),
					'last_status_date'     => date('d-m-Y'),
					'order_from'           => $this->get_orderfrom(),
				);
				$this->unset_sessions();
				$result = $this->model->check_order_exist($tx, $trnsaction_db_id, $paypal_payment_data->id);
				if (empty($result)) {

					$this->model->update_status_trnsaction($trnsaction_db_id, $time);
					if (isset($_SESSION['cart_coupen_data'])) {
						$this->model->update_coupen_data(($_SESSION['cart_coupen_data']->use_count + 1), $_SESSION['cart_coupen_data']->id);
					}
					$order_unique_id = $this->model->insert_data('order_mst', $order_data);
					$this->send_order_detail_email($order_unique_id, $order_data['order_id']);
					return $order_data['order_id'];

				} else {
					return "error";
				}
			}

		}
	}

	////////////////// CCavenue Submit /////////////////////
	public function payby_ccavenue() {
		if (!isset($_SESSION['report']['ccavenue'])) {
			if (isset($_SESSION['report']['checkout_final'])) {
				$this->pp_common->delete_report_data('Checkout Final', $_SESSION['report']['checkout_final']);
			}
			$time        = time();
			$insert_data = array('page' => 'CCAvenue', 'uni_key' => $time);
			if ($this->pp_login_varified->customer_varified()) {
				$insert_data = array_merge($insert_data, array('customer_id' => $this->session->userdata('customer_data')['customer_id']));
			}
			if ($this->pp_common->insert_report_data($insert_data)) {
				$_SESSION['report']['ccavenue'] = $time;
			}
		}
		$db_insert_id = $this->recheck_full_cart();
		if (isset($_SESSION['newcart'])) {
			$customer_id    = $this->session->userdata('customer_data')['customer_id'];
			$customer_email = $this->session->userdata('customer_data')['email'];
			$form_data      = array(
				'tid'                 => time(),
				'merchant_id'         => "114979",
				'order_id'            => $this->model->get_max_order_id()->order_id + 1,
				'amount'              => $this->cart->total() + $_SESSION['newcart']['total_other_charges'],
				'currency'            => 'INR',
				'redirect_url'        => site_url('checkout/order_success_cc/' . $db_insert_id),
				'cancel_url'          => site_url('checkout/'),
				'language'            => "EN",
				'billing_name'        => $_SESSION['checkout']['billing_address']['name'],
				'billing_address'     => $_SESSION['checkout']['billing_address']['address1'],
				'billing_city'        => $_SESSION['checkout']['billing_address']['city'],
				'billing_state'       => $_SESSION['checkout']['billing_address']['state'],
				'billing_zip'         => $_SESSION['checkout']['billing_address']['post_code'],
				'billing_country'     => ucfirst($_SESSION['checkout']['billing_address']['country']),
				'billing_tel'         => $_SESSION['checkout']['billing_address']['mobile_no'],
				'billing_email'       => $customer_email,
				'delivery_name'       => $_SESSION['checkout']['shipping_address']['name'],
				'delivery_address'    => $_SESSION['checkout']['shipping_address']['address1'],
				'delivery_city'       => $_SESSION['checkout']['shipping_address']['city'],
				'delivery_state'      => $_SESSION['checkout']['shipping_address']['state'],
				'delivery_zip'        => $_SESSION['checkout']['shipping_address']['post_code'],
				'delivery_country'    => ucfirst($_SESSION['checkout']['shipping_address']['country']),
				'delivery_tel'        => $_SESSION['checkout']['shipping_address']['mobile_no'],
				'merchant_param1'     => base64_encode(serialize(array("trnsaction_db_id" => $db_insert_id))),
				'merchant_param2'     => base64_encode(serialize(array("ti" => $_SESSION['time']))),
				'merchant_param3'     => "",
				'merchant_param4'     => "",
				'merchant_param5'     => "",
				'promo_code'          => "",
				// 'promo_code' => (isset($_SESSION['cart_coupen_data'])) ? $_SESSION['cart_coupen_data']->code : '',
				'customer_identifier' => $customer_id . '@' . $customer_email,
			);
			if (isset($_SESSION['cart_coupen_data'])) {
				if ($_SESSION['cart_coupen_data']->discount_type == 0) {

					$discount_amount              = $_SESSION['cart_coupen_data']->dis_percet_rs;
					$form_data['amount']          = ($this->cart->total() + $_SESSION['newcart']['total_service_charges']) - $discount_amount;
					$form_data['merchant_param4'] = base64_encode(serialize(array("discount_amount_cart" => $discount_amount)));
				} elseif ($_SESSION['cart_coupen_data']->discount_type == 1) {
					$discount_amount              = $_SESSION['cart_coupen_data']->dis_percet_rs;
					$form_data['amount']          = round(($this->cart->total() + $_SESSION['newcart']['total_service_charges']) - (($this->cart->total() + $_SESSION['newcart']['total_service_charges']) * $discount_amount) / 100);
					$form_data['merchant_param4'] = base64_encode(serialize(array("discount_rate_cart" => $discount_amount)));
				}
			}
			include 'includes/Crypto.php';
			$merchant_data = '';
			$working_key   = 'A47E5B7621B23C91B709BCB4CD4DF0B3'; //Shared by CCAVENUES
			$access_code   = 'AVBW67DK81BC98WBCB'; //Shared by CCAVENUES
			foreach ($form_data as $key => $value) {
				$merchant_data .= $key . '=' . $value . '&';
			}
			$encrypted_data         = encrypt($merchant_data, $working_key); // Method for encrypting the data.
			$data['encrypted_data'] = $encrypted_data;
			$data['access_code']    = $access_code;
			$ccavenue_insert_data   = array(
				"trn_cart_id" => $db_insert_id,
				"datas"       => base64_encode(serialize($form_data)),
				"customer_id" => $this->session->userdata('customer_data')['customer_id'],
				"time"        => $_SESSION['time'],
			);
			$this->model->insert_data('ccavenue_payment_data', $ccavenue_insert_data);

			$this->load->view('web/contents/other_content/cc_avenue_form', $data);
		}
	}

	/**
	 * @param $arr
	 */
	public function order_success_cc($arr = 0) {

		include 'includes/Crypto.php';
		$working_key = 'A47E5B7621B23C91B709BCB4CD4DF0B3'; //Shared by CCAVENUES

		$explode_data = explode('&', decrypt($_POST['encResp'], $working_key));
		$information  = array();
		for ($i = 0; $i < sizeof($explode_data); $i++) {
			$datas       = explode('=', $explode_data[$i]);
			$information = array_merge($information, array($datas[0] => $datas[1]));
		}

		$_POST['encResp_dcr'] = $information;

		if ($arr != 0 && isset($_POST['encResp_dcr']['tracking_id']) && isset($_POST['encResp_dcr']['bank_ref_no']) && $_POST['encResp_dcr']['order_status'] == "Success") {
			$custome_data['trnsaction_db_id'] = unserialize(base64_decode($_POST['encResp_dcr']['merchant_param1']))['trnsaction_db_id'];
			$custome_data['ti']               = unserialize(base64_decode($_POST['encResp_dcr']['merchant_param2']))['ti'];
			$order_id                         = $this->add_order_data_cc($custome_data['trnsaction_db_id'], $custome_data['ti'], $_POST['encResp_dcr']['tracking_id']);

			if ($order_id == 'error') {
				if (isset($_SESSION['report']['ccavenue'])) {
					$this->pp_common->delete_report_data('CCAvenue', $_SESSION['report']['ccavenue']);
				}
				$time        = time();
				$insert_data = array('page' => 'Success Order (Error)', 'uni_key' => $time, 'other_data' => 'CCAvenue');
				if ($this->pp_login_varified->customer_varified()) {
					$insert_data = array_merge($insert_data, array('customer_id' => $this->session->userdata('customer_data')['customer_id']));
				}
				if ($this->pp_common->insert_report_data($insert_data)) {
					$_SESSION['report']['success_order_error'] = $time;
				}
				header("Location:" . site_url('success_order/index/0/Something Wrong'));
			} else {
				if (isset($_SESSION['report']['ccavenue'])) {
					$this->pp_common->delete_report_data('CCAvenue', $_SESSION['report']['ccavenue']);
				}
				$time        = time();
				$insert_data = array('page' => 'Success Order.', 'uni_key' => $time, 'other_data' => 'CCAvenue');
				if ($this->pp_login_varified->customer_varified()) {
					$insert_data = array_merge($insert_data, array('customer_id' => $this->session->userdata('customer_data')['customer_id']));
				}
				if ($this->pp_common->insert_report_data($insert_data)) {
					$_SESSION['report']['success_order_error'] = $time;
				}
				header("Location:" . site_url('success_order/index/' . $order_id . '/Success'));
			}

			// $headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
			// $this->load->view('web/inc/header_view', $headers);
			// $this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
			// $this->load->view('web/order_success', $data);
			// $this->load->view('web/contents/support_bar/support_bar1', $this->pp_loader_helper->get_adm_prof_data());
			// $this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());

		} else {

			header("Location:" . site_url('success_order/index/0/Something Wrong'));
		}
	}

	/**
	 * @param  $trnsaction_db_id
	 * @param  $time
	 * @param  $tx
	 * @return mixed
	 */
	private function add_order_data_cc($trnsaction_db_id = 0, $time = 0, $tx = "00") {
		if ($trnsaction_db_id != 0) {
			$customer_id           = $this->session->userdata('customer_data')['customer_id'];
			$trn_data              = $this->model->get_trnsaction_data($trnsaction_db_id, $time, $customer_id);
			$ccavenue_payment_data = $this->model->get_ccavenue_payment_data($trnsaction_db_id, $time, $customer_id);
			if (!empty($trn_data) && !empty($ccavenue_payment_data)) {

				$order_data = array(
					'order_id'             => $this->get_new_order_id(),
					'trn_cart_id'          => $trnsaction_db_id,
					'payment_from'         => "ccavenue",
					'payment_from_data_id' => $ccavenue_payment_data->id,
					'trnscation_id'        => $tx,
					'customer_id'          => $customer_id,
					'trn_return_data'      => base64_encode(serialize(array("post" => $_POST, "get" => $_GET))),
					'date'                 => date('d-m-Y'),
					'time'                 => date('h:i:s a'),
					'last_status_date'     => date('d-m-Y'),
					'order_from'           => $this->get_orderfrom(),
				);
				$this->unset_sessions();
				$result = $this->model->check_order_exist($tx, $trnsaction_db_id, $ccavenue_payment_data->id);
				if (empty($result)) {
					$this->model->update_status_trnsaction($trnsaction_db_id, $time);
					if (isset($_SESSION['cart_coupen_data'])) {
						$this->model->update_coupen_data(($_SESSION['cart_coupen_data']->use_count + 1), $_SESSION['cart_coupen_data']->id);
					}
					$order_unique_id = $this->model->insert_data('order_mst', $order_data);
					$this->send_order_detail_email($order_unique_id, $order_data['order_id']);
					return $order_data['order_id'];
				} else {
					return "error";
				}
			}
		}
	}

	private function unset_sessions() {
		$customer_id = $this->session->userdata('customer_data')['customer_id'];
		unset($_SESSION['cart_contents']);
		unset($_SESSION['cart']);
		unset($_SESSION['checkout']);
		unset($_SESSION['newcart']);
		unset($_SESSION['cart_coupen_data']);
		$this->model->delete_cart($customer_id);
	}

	/**
	 * @param $message
	 */
	public function codverified($message = "") {

		// if (isset($_SESSION['newcart'])) {
		if (isset($_POST['num_otp'])) {
			$this->varified_otp();
		} else {
			if (!isset($_POST['num_mobile'])) {

				if (!isset($_SESSION['report']['codvarified'])) {
					if (isset($_SESSION['report']['checkout_final'])) {
						$this->pp_common->delete_report_data('Checkout Final', $_SESSION['report']['checkout_final']);
					}
					$time        = time();
					$insert_data = array('page' => 'Cod Verify', 'uni_key' => $time);
					if ($this->pp_login_varified->customer_varified()) {
						$insert_data = array_merge($insert_data, array('customer_id' => $this->session->userdata('customer_data')['customer_id']));
					}
					if ($this->pp_common->insert_report_data($insert_data)) {
						$_SESSION['report']['codvarified'] = $time;
					}
				}

				$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
				$data['message']            = $message;
				$this->load->view('web/inc/header_view', $headers);
				$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
				$this->load->view('web/others/cod_mob_verified', $data);
				$this->load->view('web/contents/support_bar/support_bar1', $this->pp_loader_helper->get_adm_prof_data());
				$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
				// }
			} else {
				$this->send_otp();
			}
		}
	}
	private function varified_otp() {
		if (isset($_SESSION['newcart']) && isset($_SESSION['otp_data']['otp_otp'])) {
			if ($_SESSION['otp_data']['otp_otp'] == $this->input->post('num_otp')) {
				$db_insert_id = $this->recheck_full_cart();
				// header('Location:' . site_url('checkout/codorder_success/' . $db_insert_id . "/" . $_SESSION['time']));
				$this->codorder_success($db_insert_id, $_SESSION['time']);
			} else {
				unset($_SESSION['otp_data']['otp_otp']);
				unset($_SESSION['CREATED']);
				header("Location:" . site_url('checkout/codverified/wrong_otp'));
			}
		}
	}
	private function send_otp() {
		if (isset($_SESSION['newcart'])) {
			$a                                 = mt_rand(1000, 9999);
			$_SESSION['otp_data']['mobile_no'] = $this->input->post('num_mobile');

			if (!isset($_SESSION['otp_data']['otp_otp'])) {
				$_SESSION['otp_data']['otp_otp'] = $a;
			}
			$msg = "aasvaa.com \n Enter OTP For Complete Order Process, \nOTP is " . $_SESSION['otp_data']['otp_otp'] . ".";
			$msg = $_SESSION['otp_data']['otp_otp'] . ' is the one Time Password(OTP) is verify your cash on delivery order on Aasvaa.com.';
			if (!isset($_SESSION['CREATED'])) {
				$_SESSION['CREATED'] = time();
				$return_data         = $this->pp_common->send_sms($_SESSION['otp_data']['mobile_no'], $msg);
				if (isset($return_data->status)) {

					$this->output->set_content_type('application_json')
					     ->set_output(json_encode(["status" => $return_data->status]));
				}
			} else if (time() - $_SESSION['CREATED'] > 30) {
				$return_data         = $this->pp_common->send_sms($_SESSION['otp_data']['mobile_no'], $msg);
				$_SESSION['CREATED'] = time();
				$this->output->set_content_type('application_json')
				     ->set_output(json_encode(["status" => $return_data->status]));
			} else {
				$this->output->set_content_type('application_json')
				     ->set_output(json_encode(["status" => 'wait']));
			}
		}
	}

	/**
	 * @param $arr
	 * @param $time
	 */
	private function codorder_success($arr = 0, $time = 0) {
		if ($arr != 0 && $time != 0) {
			$order_id = $this->cod_add_order_data($arr, $time);
			if ($order_id == 'error') {
				if (isset($_SESSION['report']['codvarified'])) {
					$this->pp_common->delete_report_data('Cod Verify', $_SESSION['report']['codvarified']);
				}
				$time        = time();
				$insert_data = array('page' => 'Success Order (Error)', 'uni_key' => $time, 'other_data' => 'COD');
				if ($this->pp_login_varified->customer_varified()) {
					$insert_data = array_merge($insert_data, array('customer_id' => $this->session->userdata('customer_data')['customer_id']));
				}
				if ($this->pp_common->insert_report_data($insert_data)) {
					$_SESSION['report']['success_order_error'] = $time;
				}
				header("Location:" . site_url('success_order/index/0/Something Wrong'));
			} else {
				if (isset($_SESSION['report']['codvarified'])) {
					$this->pp_common->delete_report_data('Cod Verify', $_SESSION['report']['codvarified']);
				}
				$time        = time();
				$insert_data = array('page' => 'Success Order.', 'uni_key' => $time, 'other_data' => 'COD');
				if ($this->pp_login_varified->customer_varified()) {
					$insert_data = array_merge($insert_data, array('customer_id' => $this->session->userdata('customer_data')['customer_id']));
				}
				if ($this->pp_common->insert_report_data($insert_data)) {
					$_SESSION['report']['success_order_error'] = $time;
				}
				header("Location:" . site_url('success_order/index/' . $order_id . '/Success'));
			}
		}
	}

	/**
	 * @param  $trnsaction_db_id
	 * @param  $time
	 * @return mixed
	 */
	private function cod_add_order_data($trnsaction_db_id = 0, $time = 0) {
		if ($trnsaction_db_id != 0) {
			$customer_id = $this->session->userdata('customer_data')['customer_id'];
			$trn_data    = $this->model->get_trnsaction_data($trnsaction_db_id, $time, $customer_id);
			$_POST       = $_SESSION['otp_data'];
			if (!empty($trn_data)) {

				$order_data = array(
					'order_id'         => $this->get_new_order_id(),
					'trn_cart_id'      => $trnsaction_db_id,
					'payment_from'     => "cod",
					// 'payment_from_data_id' => $paypal_payment_data->id,
					'trnscation_id'    => $trn_data->time,
					'customer_id'      => $customer_id,
					'trn_return_data'  => base64_encode(serialize(array("post" => $_POST, "get" => $_GET))),
					'date'             => date('d-m-Y'),
					'time'             => date('h:i:s a'),
					'last_status_date' => date('d-m-Y'),
					'order_from'       => $this->get_orderfrom(),
				);
				$this->unset_sessions();
				$result = $this->model->check_order_exist($trn_data->time, $trnsaction_db_id);
				if (empty($result)) {

					$this->model->update_status_trnsaction($trnsaction_db_id, $time);
					if (isset($_SESSION['cart_coupen_data'])) {
						$this->model->update_coupen_data(($_SESSION['cart_coupen_data']->use_count + 1), $_SESSION['cart_coupen_data']->id);
					}
					$order_unique_id = $this->model->insert_data('order_mst', $order_data);
					$this->send_order_detail_email($order_unique_id, $order_data['order_id']);
					return $order_data['order_id'];
				} else {
					return "error";
				}
			}
		}
	}

	/**
	 * @return mixed
	 */
	private function get_new_order_id() {
		$type = "AF";
		if ($_SESSION['checkout']['shipping_address']['country'] == 'india') {
			$type = "AI";
		}
		$data         = $this->model->get_last_order_id();
		$order_no     = (substr($data->order_id, -6) + 1);
		$new_order_id = trim($type . date('m') . date('y') . sprintf("%'.06d\n", $order_no));
		return $new_order_id;
	}

	/**
	 * @return mixed
	 */
	private function get_orderfrom() {
		$type = "af";
		if ($_SESSION['checkout']['shipping_address']['country'] == 'india') {
			$type = "ai";
		}
		return $type;

	}

	/**
	 * @param $order_id
	 */
	private function send_order_detail_email($order_id = 0, $order_no = '', $email_id = '') {
		if (empty($email_id)) {
			$email_id = $this->session->userdata('customer_data')['email'];
		}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, base_url('private/g_email_data/generate_order_place_mail/' . $order_id));
		$result = curl_exec($ch);
		curl_close($ch);
		$array1      = array('&#8377', '&#8364', '&#8360');
		$array2      = array('&#8377;', '&#8364;', '&#8360;');
		$result      = str_replace($array1, $array2, $result);
		$mail_return = $this->pp_common->sendEmail('forcustomer@aasvaa.com', $email_id, 'Your Aasvaa Order No : ' . $order_no . ' has been placed', $result);
		$this->pp_common->send_order_status_message($order_id, '0');
	}

}
