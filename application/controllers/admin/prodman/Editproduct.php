<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Editproduct extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/product_manager/addproduct_model_2', 'model');
		// $this->load->library('pp_common');
	}

	/**
	 * @param $product_id
	 * @param $add_status
	 */
	function index($product_id = 0, $add_status = "") {
		$data['pro_det']         = $this->model->get_product_by_id($product_id);
		$data['main_categories'] = $this->model->get_main_categories();
		$data['sub_categories']  = $this->model->get_sub_category($data['pro_det']->main_cat_id);
		$data['default_value']   = $this->model->get_default_value();
		$data['add_status']      = $add_status;
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/product_manager/edit_product', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer');
	}

	/**
	 * @param $product_id
	 */
	function update_product($product_id = 0) {
		if ($this->pp_login_varified->admin_varified()) {
			$images = array();
			if (!empty($_POST['images'])) {
				$images = explode('#', $_POST['images']);
				array_pop($images);
			}
			$add_status = $this->add_product_input($product_id, $images);
			$this->index($product_id, $add_status);
		}
	}

	/**
	 * @param  $product_id
	 * @param  $new_img_name
	 * @return mixed
	 */
	private function add_product_input($product_id, $new_img_name) {
		$db_data = array(
			"main_cat_id"                   => $this->input->post('name_prod_maincategory'),
			'catalogue_name'                => $this->input->post('name_catalog_name'),
			"sub_cat_id"                    => $this->input->post('name_prod_subcategory'),
			"product_name"                  => $this->input->post('name_prod_name'),
			"stock"                         => $this->input->post('name_prod_stock'),
			"product_desc"                  => $this->input->post('name_prod_description'),
			"product_sku"                   => $this->input->post('name_prod_sku'),
			"pro_img"                       => $new_img_name[0],
			"pro_imgs"                      => serialize($new_img_name),
			"mrp"                           => $this->input->post('name_prod_retailprice'),
			"sell_price"                    => $this->input->post('name_prod_sellingprice'),
			"ship_time"                     => $this->input->post('name_prod_shippingtime'),
			"cust_ship_time"                => $this->input->post('name_prod_shippingtime'),
			"know_product"                  => $this->input->post('name_prod_knowyourproduct'),
			"product_faq"                   => $this->input->post('name_prod_productfaq'),
			"status"                        => $this->input->post('name_prod_product_status_checkbox'),
			"date"                          => date('d-m-Y'),
			"weight"                        => $this->input->post('name_prod_weight'),
			"shipping_charge"               => $this->input->post('name_prod_shippingcharge'),
			"international_shipping_charge" => $this->input->post('name_prod_intshippingcharge'),
		);
		// if ($this->input->post('name_prod_standardsize_checkbox') == "on") {
		// 	$standard_size_keys = explode("#", $this->input->post('name_prod_standardsizenames'));
		// 	array_pop($standard_size_keys);
		// 	foreach ($standard_size_keys as $key => $value) {
		// 		$standard_size[$key] = array(
		// 			"name" => $value,
		// 			"standard_row_id" => $this->input->post('name_prod_standardselect_' . $value),
		// 			"standard_price" => $this->input->post('name_prod_standardpricebox_' . $value),
		// 		);
		// 	}
		// 	$db_data = array_merge($db_data, array('standard_size_show_in' => base64_encode(serialize($standard_size))));
		// }

		// if ($this->input->post('name_prod_customizesize_checkbox') == "on") {
		// 	$customize_size_keys = explode("#", $this->input->post('name_prod_customizesizenames'));
		// 	array_pop($customize_size_keys);
		// 	foreach ($customize_size_keys as $key => $value) {
		// 		$customize_size[$key] = array(
		// 			"name" => $value,
		// 			"customize_row_id" => $this->input->post('name_prod_customselect_' . $value),
		// 			"customize_price" => $this->input->post('name_prod_custompricebox_' . $value),
		// 		);
		// 	}
		// 	$db_data = array_merge($db_data, array('customize_show_in' => base64_encode(serialize($customize_size))));

		// }
		if (isset($_POST['name_prod_detailsnames'])) {

			$product_details_keys = explode("#", $this->input->post('name_prod_detailsnames'));
			array_pop($product_details_keys);
			$product_details2s = "";
			foreach ($product_details_keys as $key => $detail_type) {

				$product_details[$key] = array(
					"key" => $detail_type,
				);

				if (!empty($this->input->post('name_prod_' . $detail_type . '_details')) && $this->input->post('name_prod_' . $detail_type . '_details') !== "") {
					$values_keys = $_POST['name_prod_' . $detail_type . '_details'];
					$value       = array();
					foreach ($values_keys as $keyss => $valuess) {
						if (!empty(trim($valuess))) {
							$value = array_merge($value, array(trim($valuess)));
							$product_details2s .= "#" . $detail_type . ":" . trim($valuess) . "#";
						}
					}
					$product_details[$key] = array_merge($product_details[$key], array('value' => $value));
				}
			}

			$db_data = array_merge($db_data, array('product_details' => serialize($product_details)));
		}
		// echo "<pre>";

		// print_r($_POST);

		// print_r($db_data);
		// print_r($product_details2s);
		// echo "</pre>";
		$insert_id = $this->model->update_product($product_id, $db_data);

		return $this->model->update_product_details($product_id, $this->input->post('name_prod_maincategory'), $product_details2s);
	}

	public function add_detail_values() {
		if (isset($_POST['det_value']) && isset($_POST['value'])) {
			$detail_data = $this->model->get_detail_data($this->input->post('value'));
			$detail_data = unserialize(base64_decode($detail_data->datas));
			array_push($detail_data, ucwords($this->input->post('det_value')));
			$detail_data = array_unique($detail_data);
			$result      = $this->model->update_detail_data($this->input->post('value'), array('datas' => base64_encode(serialize($detail_data)), "size" => sizeof($detail_data)));
			$this->output->set_content_type('application/json')->set_output(json_encode(array("result" => $result)));
		}
	}
}