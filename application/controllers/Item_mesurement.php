<?php

class Item_Mesurement extends My_Controller {

	public function __construct() {
		parent::__construct();
		//Do your magic here
		if (!$this->pp_login_varified->customer_varified()) {
			header('location:' . site_url('account/login'));
		}
		$this->load->model('web/M_item_mesurement', 'model');
	}
	/**
	 * @param $method
	 * @param $arr
	 */
	public function _remap($method, $arr) {
		if ($method == 'get_item_size_data') {
			$this->get_item_size_data();
		} elseif ($method !== 'index') {
			$this->index($method, $arr);
		} else {
			$this->index($method, $arr);
		}

	}
	/**
	 * @param $method
	 * @param $arr
	 */
	public function index($method, $arr) {
		if (!$this->pp_login_varified->customer_varified()) {
			header('location:' . site_url('account/login'));
		}
		if (isset($_POST['register_mesurement'])) {
		}
		if (!empty($method) && $this->cart->has_options($method)) {
			$CI                   = &get_instance();
			$data['current_url']  = $CI->config->site_url($CI->uri->uri_string());
			$data['product_data'] = $product_data = $this->model->get_product_details($this->cart->contents($method)[$method]['id']);
			$custoomize_name      = array();
			foreach ($this->cart->product_options($method) as $key => $value) {
				if ($value[$key . "radio"] == "customize") {

					array_push($custoomize_name, $key);
				}
			}
			if (!empty($product_data->customize_show_in)) {
				$customize_show_in = unserialize(base64_decode($product_data->customize_show_in));
				$customize_sizes   = array();
				foreach ($customize_show_in as $key => $value) {
					if (in_array($value['name'], $custoomize_name)) {
						$customize_sizes[$value['name']] = $this->model->get_customize_size($value['customize_row_id']);
					}
				}
				$data['customize_sizes'] = $customize_sizes;
			}
			if (isset($_SESSION['cart']) && isset($_SESSION['cart']['product_' . $method]) && isset($_SESSION['cart']['product_' . $method]['mesurement_select_data'])) {
				$data['subited_data'] = $_SESSION['cart']['product_' . $method]['mesurement_select_data'];
			}

			if (isset($_POST['register_mesurement'])) {
				$this->add_customer_mesurement($method);
			}
			$customer_id                   = $this->session->userdata('customer_data')['customer_id'];
			$data['cust_exist_mesurement'] = $this->model->get_exist_mesurement($customer_id);
			$data['method']                = $method;
			$data['product_id']            = $this->cart->contents($method)[$method]['id'];
			$headers['mobile_nav_menu']    = $this->pp_loader_helper->get_mobile_nav_menu();
			$this->load->view('web/inc/header_view', $headers);
			$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
			$this->load->view('web/item_mesurement', $data);
			$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
		}

	}

	/**
	 * @param $method
	 */
	public function add_customer_mesurement($method) {
		if (isset($_POST)) {
			$mesure_array = array();
			$customer_id  = $this->session->userdata('customer_data')['customer_id'];
			$keyss        = explode("#", $this->input->post('keysss'));
			array_pop($keyss);
			foreach ($keyss as $key => $value) {
				$update_data = array();
				foreach ($_POST as $key1 => $value1) {
					if (strpos($key1, $value) !== false) {
						$update_data = array_merge($update_data, array(str_replace($value . "#", "", $key1) => $value1));
					}
				}
				$insert_id = $this->model->add_customer_mesure_data(array("name" => $this->input->post('cus_measurement_name'),
					"for_name"                                                       => $value,
					"data"                                                           => base64_encode(serialize($update_data)),
					"customer_id"                                                    => $customer_id,
					"instruction"                                                    => $this->input->post('other_instruction')));
				$mesure_array = array_merge($mesure_array, array('id' => $insert_id));
			}
			$_SESSION['cart']['product_' . $method]['mesurement_select_data'] = $mesure_array;
			// print_r($_SESSION['cart']['product_' . $method]);
		}
	}

	public function get_item_size_data() {
		if (isset($_POST['id'])) {
			$customer_id = $this->session->userdata('customer_data')['customer_id'];
			$data        = $this->model->get_item_data($customer_id, $this->input->post('id'));
			// print_r($data);
			$this->output->set_content_type('application_json')
			     ->set_output(json_encode(array(
				     'id'          => $data->id,
				     'name'        => $data->name,
				     'for_name'    => $data->for_name,
				     'data'        => unserialize(base64_decode($data->data)),
				     'instruction' => $data->instruction,
				     'no'          => $data->no,
			     )));
		}
	}

}