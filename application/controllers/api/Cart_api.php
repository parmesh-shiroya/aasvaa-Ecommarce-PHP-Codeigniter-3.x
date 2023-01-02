<?php

/**
 *
 */
class Cart_api extends My_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('api/m_cart_api', 'model');
		date_default_timezone_set('Asia/Kolkata');
	}
	public function index() {
		if (isset($_POST['method'])) {
			$this->$_POST['method']();
		}
	}
	private function add_to_cart() {

		if (isset($_POST['product_id']) && isset($_POST['method'])) {
			$customer_cart_id = "0";
			/////////// Get Product Id ////////
			$data = $this->model->get_product_data($_POST['product_id']);
			if (!empty($data)) {
				////// Set Require Stock ///////

				if (isset($_POST['require_stock']) && $_POST['require_stock'] <= 0) {
					$_POST['require_stock'] = 1;
				}
				$require_stock = (!isset($_POST['require_stock'])) ? 1 : $_POST['require_stock'];
				if (!isset($_POST['for_refresh'])) {

					$require_stock = (isset($_SESSION['cart']['product_' . $data->product_id])) ? $_SESSION['cart']['product_' . $data->product_id]['require_stock'] + $require_stock : $require_stock;

					///// Add Or Update Cart Data To Database /////////

					if ($this->pp_login_varified->customer_varified()) {
						$customer_id    = $this->session->userdata('customer_data')['customer_id'];
						$check_if_exist = $this->model->check_procut_in_cart_exist($customer_id, $data->product_id);
						if (empty($check_if_exist)) {
							if (!isset($_SESSION['cart']['product_' . $data->product_id])) {

								$data_insert = array(
									'customer_id'    => $customer_id,
									'product_id'     => $data->product_id,
									'required_stock' => $require_stock,
									'date'           => date('d-m-Y'),

								);
								if (isset($_SESSION['single_cart_data']['product_id_' . $data->product_id])) {
									$data_insert = array_merge($data_insert, array('single_data' => base64_encode(serialize($_SESSION['single_cart_data']['product_id_' . $data->product_id]))));
								}
								$customer_cart_id = $this->model->insert_cart_in_db($data_insert);

							} else {
								if ($_SESSION['cart']['product_' . $data->product_id]['customer_cart_id'] == 0) {
									$data_insert = array(
										'customer_id'    => $customer_id,
										'product_id'     => $data->product_id,
										'required_stock' => $require_stock,
										'date'           => date('d-m-Y'),
									);
									$customer_cart_id = $this->model->insert_cart_in_db($data_insert);
								} else {
									$customer_cart_id = $_SESSION['cart']['product_' . $data->product_id]['customer_cart_id'];
									$this->model->update_stock_cart_in_db($customer_cart_id, $require_stock);
								}
							}
						}
					}
				}
				////// Add Data To Session ///////
				$session_data = array(
					'product_id'        => $data->product_id,
					'customer_cart_id'  => $customer_cart_id,
					'name'              => $data->product_name,
					'image'             => $data->pro_img,
					'require_stock'     => $require_stock,
					'sell_price'        => $data->sell_price,
					'ship_charge'       => $data->shipping_charge,
					'inter_ship_charge' => $data->international_shipping_charge,
				);
				if (isset($_POST['cart_id'])) {
					$session_data = array_merge($session_data, array('customer_cart_id' => $_POST['cart_id']));
				}
				$_SESSION['cart']['product_' . $data->product_id] = $session_data;

// $this->session->unset_userdata('cart');
				echo 1;
			}
		}
	}
	private function remove_from_cart() {
		if (isset($_POST['product_id']) && isset($_POST['method'])) {
			echo $cart_id = $_SESSION['cart']['product_' . $_POST['product_id']]['customer_cart_id'];
			if ($this->pp_login_varified->customer_varified()) {
				if ($cart_id != 0) {
					$this->model->delete_from_cart($cart_id);
				}
			}
			unset($_SESSION['cart']['product_' . $_POST['product_id']]);
			unset($_SESSION['single_cart_data']['product_id_' . $_POST['product_id']]);
		}
	}
	private function get_cart_data() {
		if (isset($_POST['method']) && isset($_SESSION['cart'])) {
			$this->output->set_content_type('application/json')->set_output(json_encode(array("size" => sizeof($_SESSION['cart']), "datas" => $this->session->userdata('cart'))));
		}
	}
	private function get_cart_data_from_db() {
		if ($this->pp_login_varified->customer_varified()) {

			$customer_id = $this->session->userdata('customer_data')['customer_id'];
			$cart_data   = $this->model->get_customer_cart_data_from_db($customer_id);
			$this->output->set_content_type('application/json')->set_output(json_encode($cart_data));
		}
	}
	public function add_to_cart_single_product() {

		$_SESSION['single_cart_data']['product_id_' . $this->input->post('product_id')][$this->input->post('form_for')] = $_POST;
		$this->output->set_content_type('application/json')->set_output(json_encode($_SESSION['single_cart_data']['product_id_' . $this->input->post('product_id')]));

	}

	private function add_data_to_single_session() {
		if (isset($_POST['method']) && isset($_POST['single_data']) && !empty($_POST['single_data'])) {
			$_SESSION['single_cart_data']['product_id_' . $_POST['produc_id']] = unserialize(base64_decode($_POST['single_data']));
			print_r($_SESSION['single_cart_data']['product_id_' . $_POST['produc_id']]);
		}
	}

	public function set_mesurement_data_to_cart() {
		if ($this->pp_login_varified->customer_varified()) {
			$mesure_array = array();
			$customer_id  = $this->session->userdata('customer_data')['customer_id'];
			$keyss        = explode("#", $this->input->post('keysss'));
			array_pop($keyss);
			$error = 0;
			foreach ($keyss as $key => $value) {
				$update_data = array();
				foreach ($_POST as $key1 => $value1) {
					if (strpos($key1, $value) !== false) {
						$update_data = array_merge($update_data, array(str_replace($value . "#", "", $key1) => $value1));
					}
				}
				$return = $this->model->check_mesurement_exist_or_not($customer_id, $this->input->post('cus_measurement_name'), $value);
				if (empty($return)) {
					$insert_id = $this->model->add_customer_mesure_data(array("name" => $this->input->post('cus_measurement_name'),
						"for_name"                                                       => $value,
						"data"                                                           => base64_encode(serialize($update_data)),
						"customer_id"                                                    => $customer_id,
						"instruction"                                                    => $this->input->post('other_instruction')));
					$mesure_array = array_merge($mesure_array, array($value => $insert_id));
				} else {
					$error = 1;
					// $insert_id = $return->id;
				}

			}
			if ($error == 0) {
				$method                                                           = $this->input->post('method');
				$_SESSION['cart']['product_' . $method]['mesurement_select_data'] = $mesure_array;
				echo "done";
			} else {
				echo "error";
			}

		}
	}

	public function set_mesurement_data_to_cart_2() {
		if ($this->pp_login_varified->customer_varified()) {
			$mesure_array = array();
			$customer_id  = $this->session->userdata('customer_data')['customer_id'];
			$keyss        = explode("#", $this->input->post('keysss'));
			array_pop($keyss);
			$error       = 0;
			$update_data = array();
			foreach ($keyss as $key => $value) {

				foreach ($_POST as $key1 => $value1) {
					if (strpos($key1, $value) !== false) {
						$update_data = array_merge($update_data, array($key1 => $value1));
					}
				}
				// $return = $this->model->check_mesurement_exist_or_not($customer_id, $this->input->post('cus_measurement_name'), $value);
				// if (empty($return)) {

				// } else {
				// $error = 1;
				// $insert_id = $return->id;
				// }

			}
			$return1 = $this->model->check_mesurement_exist_or_not2($customer_id, $this->input->post('cus_measurement_name'), base64_encode(serialize($update_data)));
			if (empty($return1)) {

				$return = $this->model->check_mesurement_exist_or_not($customer_id, $this->input->post('cus_measurement_name'));
				if (empty($return)) {
					$insert_id = $this->model->add_customer_mesure_data(array("name" => $this->input->post('cus_measurement_name'),
						"for_name"                                                       => $this->input->post('keysss'),
						"data"                                                           => base64_encode(serialize($update_data)),
						"customer_id"                                                    => $customer_id,
						"instruction"                                                    => $this->input->post('other_instruction')));

				} else {
					// $error = 1;
					$new_no    = $this->model->get_last_same_name($customer_id, $this->input->post('cus_measurement_name'))->no + 1;
					$insert_id = $this->model->add_customer_mesure_data(array("name" => $this->input->post('cus_measurement_name'),
						"for_name"                                                       => $this->input->post('keysss'),
						"data"                                                           => base64_encode(serialize($update_data)),
						"customer_id"                                                    => $customer_id,
						"instruction"                                                    => $this->input->post('other_instruction'),
						'no'                                                             => $new_no,
					));
				}
			} else {
				$insert_id = $return1->id;
			}
			$mesure_array = array_merge($mesure_array, array($value => $insert_id));
			if ($error == 0) {
				$method                                                           = $this->input->post('method');
				$_SESSION['cart']['product_' . $method]['mesurement_select_data'] = $mesure_array;
				echo "done";
			} else {
				echo "error";
			}

		}
	}
	//////===============================================////////////
	//////==================== New Cart ===================////////////
	//////===============================================////////////
	private function add_to_cart2() {
		if (isset($_POST['product_id']) && isset($_POST['method'])) {
			$customer_cart_id = "0";
			$shipping_charges = $this->pp_loader_helper->get_shipping_charge();
			$dom_charges      = 0;
			if ($shipping_charges->domestic_type == 0 && $shipping_charges->domestic_shipping != 0) {
				$dom_charges = $shipping_charges->domestic_shipping;
			}
			/////////// Get Product Id ////////
			$require_stock = (!isset($_POST['require_stock'])) ? 1 : $_POST['require_stock'];
			$data          = $this->model->get_product_data($_POST['product_id']);
			if (!empty($data)) {
				$data1 = array(
					'id'                => $data->product_id,
					'sku'               => $data->product_sku,
					'qty'               => $require_stock,
					'price'             => $data->sell_price,
					'name'              => preg_replace("/[^a-zA-Z0-9\s]/", " ", $data->product_name),
					'image'             => $data->pro_img,
					'weight'            => $data->weight,
					'ship_charge'       => $dom_charges,
					'inter_ship_charge' => $shipping_charges->international_charge,
					'date'              => date('d-m-Y'),
					'adm_status'        => 'on',
				);
				if (isset($_POST['single']) && $_POST['single'] == 'true') {
					$data1 = array_merge($data1, array('options' => array('single' => 'true')));
				}
				$row_id = $this->cart->insert($data1);

				if ($this->pp_login_varified->customer_varified() && $this->cart->total_items() != 0) {
					$customer_id = $this->session->userdata('customer_data')['customer_id'];
					$result      = $this->model->check_cart_exist_indb($customer_id);
					if (!empty($result)) {
						$this->model->update_db_cart($customer_id, array('cart' => base64_encode(serialize($this->cart->contents())), 'insert_date' => date('d-m-Y'), 'total_product' => $this->cart->total_items()));
					} else {
						$this->model->insert_cart_db(array('customer_id' => $customer_id, 'cart' => base64_encode(serialize($this->cart->contents())), 'insert_date' => date('d-m-Y'), 'total_product' => $this->cart->total_items()));
					}
				}
				$this->output->set_content_type('application/json')->set_output(json_encode(array('result' => "1", "cart_row_id" => $row_id)));
			}

		}
	}

	public function get_cart_ci() {
		$conetent               = $this->cart->contents();
		$total_shipping_charges = 0;
		$total_charges          = 0;
		foreach ($conetent as $key => $value) {
			$total_price = $value['subtotal'];
			if (isset($value['options'])) {
				foreach ($value['options'] as $key1 => $value1) {
					if (isset($value1['service_price'])) {
						$total_price = $total_price + ($value1['service_price'] * $value['qty']);
					}

				}
			}

			if ($_SESSION['ip_country'] != "IN") {
				// $total_price = $total_price + ($value['inter_ship_charge'] * $value['qty']);
				$total_shipping_charges = $total_shipping_charges + ($value['inter_ship_charge'] * $value['qty']);
			} else {
				$shipping_charge = $this->pp_loader_helper->get_shipping_charge();
				if ($_SESSION['ip_country'] == "IN" && $shipping_charge->domestic_type == "0") {
					// $total_price = $total_price + ($shipping_charge->domestic_shipping * $value['qty']);
					$total_shipping_charges = $total_shipping_charges + ($shipping_charge->domestic_shipping * $value['qty']);
				}

			}
			$total_charges = $total_charges + $total_price;
			$value         = array_merge($value, array('total_price' => $this->ccr->cc('INR', $_SESSION['currency_choose'], $total_price)));
			$conetent      = array_merge($conetent, array($key => $value));
		}
		$total_charges = $total_charges + $total_shipping_charges;
		$this->output->set_content_type('application/json')->set_output(json_encode(array("size" => $this->cart->total_items(), "shipping_charges" => $this->ccr->cc('INR', $_SESSION['currency_choose'], $total_shipping_charges), "total_price" => $this->ccr->cc('INR', $_SESSION['currency_choose'], $total_charges), "datas" => $conetent)));
		// print_r($this->cart->product_options());
		// print_r($this->cart->product_options('19ca14e7ea6328a42e0eb13d585e4c22'));
	}

	public function remove_from_cart_ci() {
		if (isset($_POST['product_id']) && isset($_POST['method'])) {
			// $cart_id = $_SESSION['cart']['product_' . $_POST['product_id']]['customer_cart_id'];
			// if ($this->pp_login_varified->customer_varified()) {
			// 	if ($cart_id != 0) {
			// 		$this->model->delete_from_cart($cart_id);
			// 	}
			// }
			$this->cart->remove($_POST['product_id']);
			if ($this->pp_login_varified->customer_varified()) {
				$customer_id = $this->session->userdata('customer_data')['customer_id'];
				$result      = $this->model->check_cart_exist_indb($customer_id);
				if (!empty($result)) {
					$this->model->update_db_cart($customer_id, array('cart' => base64_encode(serialize($this->cart->contents()))));
				} else {
					$this->model->insert_cart_db(array('customer_id' => $customer_id, 'cart' => base64_encode(serialize($this->cart->contents())), 'insert_date' => date('d-m-Y'), 'total_product' => $this->cart->total_items()));
				}
			}
			// unset($_SESSION['cart']['product_' . $_POST['product_id']]);
			// unset($_SESSION['single_cart_data']['product_id_' . $_POST['product_id']]);
		}
	}

	public function refresh_cart_datas() {

		foreach ($this->cart->contents() as $key => $items) {

			if (isset($items['options'])) {
				$options = $this->cart->product_options($items['rowid']);
				foreach ($this->cart->product_options($items['rowid']) as $keysingle => $valuesingle) {
					if (!isset($valuesingle['service_price'])) {
						$product_data = $this->model->get_product_data($items['id']);
						if ($valuesingle[$keysingle . 'radio'] == 'standard') {
							$standard_data = unserialize(base64_decode($product_data->standard_size_show_in));
							foreach ($standard_data as $key1 => $value1) {

								if ($value1['name'] == $keysingle) {

									$valuesingle = array_merge($valuesingle, array('service_price' => $value1['standard_price']));
								}
							}
						} else if ($valuesingle[$keysingle . 'radio'] == 'customize') {
							$customize_data = unserialize(base64_decode($product_data->customize_show_in));
							foreach ($customize_data as $key1 => $value1) {
								if ($value1['name'] == $keysingle) {
									$valuesingle = array_merge($valuesingle, array('service_price' => $value1['customize_price']));
								}
							}

						}
						$options = array_merge($options, array($keysingle => $valuesingle));
					}

				}
				// echo json_encode($options);
				$data1 = array(
					'rowid'   => $items['rowid'],
					'options' => $options,
				);
				$this->cart->update($data1);
			}

		}
	}

	public function add_to_cart_single_product_ci() {
		// $_SESSION['single_cart_data']['product_id_' . $this->input->post('product_id')][$this->input->post('form_for')] = $_POST;
		if (isset($_POST['cart_row_id'])) {
			if ($this->cart->has_options($this->input->post('cart_row_id'))) {
				if (isset($this->cart->product_options($this->input->post('cart_row_id'))['single']) && $this->cart->product_options($this->input->post('cart_row_id'))['single'] == 'true') {
					$post_data = $_POST;
					unset($post_data['cart_row_id']);
					$option = array($this->input->post('form_for') => $post_data);
				} else {
					$post_data = $_POST;
					unset($post_data['cart_row_id']);
					$option = array_merge($this->cart->product_options($this->input->post('cart_row_id')), array($this->input->post('form_for') => $post_data));
				}
			}
			if (isset($option)) {

				$data1 = array(
					'rowid'   => $this->input->post('cart_row_id'),
					'options' => $option,
				);
				echo $this->cart->update($data1);
			}
			$this->refresh_cart_datas();
			if ($this->pp_login_varified->customer_varified() && $this->cart->total_items() != 0) {
				$customer_id = $this->session->userdata('customer_data')['customer_id'];
				$result      = $this->model->check_cart_exist_indb($customer_id);
				if (!empty($result)) {
					$this->model->update_db_cart($customer_id, array('cart' => base64_encode(serialize($this->cart->contents())), 'insert_date' => date('d-m-Y'), 'total_product' => $this->cart->total_items()));
				} else {
					$this->model->insert_cart_db(array('customer_id' => $customer_id, 'cart' => base64_encode(serialize($this->cart->contents())), 'insert_date' => date('d-m-Y'), 'total_product' => $this->cart->total_items()));
				}
			}
		}

		// $this->output->set_content_type('application/json')->set_output(json_encode($_SESSION['single_cart_data']['product_id_' . $this->input->post('product_id')]));
	}

	public function get_cart_data_from_db_ci() {
		if ($this->pp_login_varified->customer_varified()) {

			$customer_id = $this->session->userdata('customer_data')['customer_id'];
			$cart_data   = $this->model->check_cart_exist_indb($customer_id);
			print_r($cart_data);
			if (!empty($cart_data)) {
				// $this->cart->destroy();
			}
			// $this->output->set_content_type('application/json')->set_output(json_encode(unserialize(base64_decode($cart_data->cart))));
			foreach (unserialize(base64_decode($cart_data->cart)) as $key => $value) {
				print_r($value);
				$data             = $this->model->get_product_data($value['id']);
				$shipping_charges = $this->pp_loader_helper->get_shipping_charge();
				$prob             = 0;
				$dom_charges      = 0;
				if ($shipping_charges->domestic_type == 0 && $shipping_charges->domestic_shipping != 0) {
					$dom_charges = $shipping_charges->domestic_shipping;
				}

				foreach ($this->cart->contents() as $key) {
					if ($key['id'] == $data->product_id) {
						$prob = 1;
					}
				}
				if (!empty($data) && $prob == 0) {
					$data1 = array(
						'id'                => $data->product_id,
						'qty'               => $value['qty'],
						'sku'               => $data->product_sku,
						'price'             => $data->sell_price,
						'name'              => preg_replace("/[^a-zA-Z0-9\s]/", "", $data->product_name),
						'image'             => $data->pro_img,
						'weight'            => $data->weight,
						'ship_charge'       => $dom_charges,
						'inter_ship_charge' => $shipping_charges->international_charge,
						'date'              => date('d-m-Y'),
						'adm_status'        => 'on',
					);
					if (isset($value['options'])) {
						$data1 = array_merge($data1, array('options' => $value['options']));
					}
					if (isset($value['date'])) {
						$data1 = array_merge($data1, array('date' => $value['date']));
					}
					if (isset($value['adm_status'])) {
						$data1 = array_merge($data1, array('adm_status' => $value['adm_status']));
					}
					$row_id = $this->cart->insert($data1);
				}
			}
			if ($this->pp_login_varified->customer_varified() && $this->cart->total_items() != 0) {
				$customer_id = $this->session->userdata('customer_data')['customer_id'];
				$result      = $this->model->check_cart_exist_indb($customer_id);
				if (!empty($result)) {
					$this->model->update_db_cart($customer_id, array('cart' => base64_encode(serialize($this->cart->contents())), 'insert_date' => date('d-m-Y'), 'total_product' => $this->cart->total_items()));
				} else {
					$this->model->insert_cart_db(array('customer_id' => $customer_id, 'cart' => base64_encode(serialize($this->cart->contents())), 'insert_date' => date('d-m-Y'), 'total_product' => $this->cart->total_items()));
				}
			}
		}
	}

	private function update_cart_qty() {
		if (isset($_POST['rowids']) && isset($_POST['qty'])) {
			$data = array(
				'rowid' => $this->input->post('rowids'),
				'qty'   => $this->input->post('qty'),
			);
			echo $this->cart->update($data);
		}
	}
}
?>
