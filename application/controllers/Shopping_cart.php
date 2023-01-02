<?php

class Shopping_cart extends My_Controller {

	public function __construct() {
		parent::__construct();
		//Do your magic here
		$this->load->model('web/M_shoppingcart', 'model');

	}
	public function index() {
		if (isset($_GET['remove'])) {
			$this->cart->remove($this->input->get('remove'));
			header("Location:" . site_url('shopping_cart'));
		}
		if (!isset($_SESSION['report']['shopping_cart'])) {
			$time        = time();
			$insert_data = array('page' => 'Shopping Cart', 'uni_key' => $time);
			if ($this->pp_login_varified->customer_varified()) {
				$insert_data = array_merge($insert_data, array('customer_id' => $this->session->userdata('customer_data')['customer_id']));
			}
			if ($this->pp_common->insert_report_data($insert_data)) {
				$_SESSION['report']['shopping_cart'] = $time;
			}
		}
		$size_datas = array();

		foreach ($this->cart->contents() as $items) {

			$product_data = $this->model->get_product_data($items['id']);
			$size_datas   = array_merge($size_datas, array("product_data_" . $items['id'] => $product_data));
			if ($this->cart->has_options($items['rowid'])) {
if (!isset($this->cart->product_options($items['rowid'])['single']) || !$this->cart->product_options($items['rowid'])['single']) {

				foreach ($this->cart->product_options($items['rowid']) as $keysingle => $valuesingle) {

					if ($valuesingle[str_replace(' ', '_', $keysingle) . 'radio'] == 'standard') {
						$size_datas = array_merge($size_datas, array("standard_data_" . $items['id'] => unserialize(base64_decode($product_data->standard_size_show_in))));

					} else if ($valuesingle[str_replace(' ', '_', $keysingle) . 'radio'] == 'customize') {
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
		}
		$size_datas['countrys']      = $this->model->get_all_countrys();
		$size_datas['shipping_cart'] = $this->pp_loader_helper->get_shipping_charge();
		$headers['mobile_nav_menu']  = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		$this->load->view('web/shopping_cart/shopping_cart', $size_datas);
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());

	}

	public function all_cart_data() {
		print_r($this->cart->contents());
	}

	public function add_coupen_code() {
		if (isset($_POST['coupen_code_text'])) {
			$data = $this->model->get_coupen_data($this->input->post('coupen_code_text'));
			if (!empty($data)) {

				if ($data->area == $this->input->post('selected_country')) {
					$paymentDate = date('d-m-Y');
					$paymentDate = DateTime::createFromFormat('d-m-Y', date('d-m-Y', strtotime($paymentDate)));
					//echo $paymentDate; // echos today!
					$contractDateBegin = DateTime::createFromFormat('d-m-Y', date('d-m-Y', strtotime($data->valid_from)));
					$contractDateEnd   = DateTime::createFromFormat('d-m-Y', date('d-m-Y', strtotime($data->valid_to)));
					if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd)) {
						if ($data->use_count < $data->use_time) {
							if ($data->min_mrp_cond != NULL && $data->min_mrp_cond <= $this->cart->total()) {
								$_SESSION['cart_coupen_data'] = $data;
								echo "done";
							} else {
								echo "Sub Total is Not Enough For Use This Coupen.";
							}
						} else {
							echo "All Coupen Allready Used.";
						}
					} else {
						echo "Coupen Allready Expired.";
					}
				} else {
					echo "Coupen Not Found.";
				}
			} else {
				echo "Coupen Not Found.";
			}
		}
	}
}
