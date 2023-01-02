<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class addproduct extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		// $this->load->model('admin/product_manager/addproduct_model', 'model');
		// $this->load->library('pp_common');

	}

	/**
	 * @param $add_status
	 */
	function index($add_status = "") {
		header("location:" . site_url('admin/prodman/addproduct2'));
		// $data['main_categories'] = $this->model->get_main_categories();
		// $data['default_value'] = $this->model->get_default_value();
		// $data['add_status'] = $add_status;
		// $this->load->view('admin/inc/adm_header');
		// $this->load->view('admin/inc/adm_nav_start');
		// $this->load->view('admin/product_manager/add_product_2', $data);
		// $this->load->view('admin/inc/adm_nav_end');
		// $this->load->view('admin/inc/adm_footer');
	}

	function add_product() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['name_prod_maincategory'])) {
				$this->load->library('image_lib');
				$add_status = false;
				if (isset($_POST['add_product_submit']) && !empty($_FILES['imagesFile']['name'])) {

					$filesCount  = count($_FILES['imagesFile']['name']);
					$upload_data = $this->pp_common->upload_product_image($_FILES['imagesFile'], 'uploads/pro_image/orignal/');
					for ($i = 0; $i < count($upload_data); $i++) {
						$image_paths[$i]  = 'uploads/pro_image/orignal/' . $upload_data[$i]['file_name'];
						$new_img_name[$i] = $upload_data[$i]['file_name'];
					}
					if (isset($new_img_name)) {
						$new_paths_and_size = array('uploads/pro_image/94_130/' => array(94, 130), 'uploads/pro_image/300_375/' => array(300, 375), 'uploads/pro_image/400_470/' => array(400, 470), 'uploads/pro_image/550_620/' => array(500, 620), 'uploads/pro_image/900_1200/' => array(900, 1200));
						$this->pp_common->resize_image($image_paths, $new_img_name, $new_paths_and_size);
						$add_status = $this->add_product_input($new_img_name);
					}
				}
				$this->index($add_status);
			} else {
				header("Location:" . base_url('admin/prodman/addproduct2/'));
			}
		}
	}

	/**
	 * @param  $new_img_name
	 * @return mixed
	 */
	private function add_product_input($new_img_name) {

		$db_data = array(
			"main_cat_id"                   => $this->input->post('name_prod_maincategory'),
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
			"shipping_charge"               => $this->input->post('name_prod_shippingcharge'),
			"international_shipping_charge" => $this->input->post('name_prod_intshippingcharge'),
		);
		if (isset($_POST['name_prod_CatalogName_details'])) {
			$db_data = array_merge($db_data, array('catalogue_name' => $this->input->post('name_prod_CatalogName_details')));
		}
		if ($this->input->post('name_prod_standardsize_checkbox') == "on") {
			$standard_size_keys = explode("#", $this->input->post('name_prod_standardsizenames'));
			array_pop($standard_size_keys);
			foreach ($standard_size_keys as $key => $value) {
				$standard_size[$key] = array(
					"name"            => $value,
					"standard_row_id" => $this->input->post('name_prod_standardselect_' . $value),
					"standard_price"  => $this->input->post('name_prod_standardpricebox_' . $value),
				);
			}
			$db_data = array_merge($db_data, array('standard_size_show_in' => base64_encode(serialize($standard_size))));
		}

		if ($this->input->post('name_prod_customizesize_checkbox') == "on") {
			$customize_size_keys = explode("#", $this->input->post('name_prod_customizesizenames'));
			array_pop($customize_size_keys);
			foreach ($customize_size_keys as $key => $value) {
				$customize_size[$key] = array(
					"name"             => $value,
					"customize_row_id" => $this->input->post('name_prod_customselect_' . $value),
					"customize_price"  => $this->input->post('name_prod_custompricebox_' . $value),
				);
			}
			$db_data = array_merge($db_data, array('customize_show_in' => base64_encode(serialize($customize_size))));

		}
		if (isset($_POST['name_prod_detailsnames'])) {

			$product_details_keys = explode("#", $this->input->post('name_prod_detailsnames'));
			array_pop($product_details_keys);
			$product_details2s = "";
			foreach ($product_details_keys as $key => $detail_type) {

				$product_details[$key] = array(
					"key" => $detail_type,
				);

				if (!empty($this->input->post('name_prod_' . $detail_type . '_details')) && $this->input->post('name_prod_' . $detail_type . '_details') !== "") {
					$values_keys = explode(",", $this->input->post('name_prod_' . $detail_type . '_details'));
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

			$db_data = array_merge($db_data, array('product_details' => base64_encode(serialize($product_details))));
		}
		$insert_id = $this->model->insert_product($db_data);

		return $this->model->insert_product_details($insert_id, $this->input->post('name_prod_maincategory'), $product_details2s);
	}
}
