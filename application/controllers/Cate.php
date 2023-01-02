<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cate extends My_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('web/m_cate', 'model');

	}
	/**
	 * @param $method
	 * @param $arr
	 */
	public function _remap($method, $arr) {
		if ($method == 'header_resender') {
			$this->header_resender($method, $arr);
		} else if ($method !== 'index') {
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

		if (!empty($method)) {
			$data['category_name'] = $arr[1];
			$CI                    = &get_instance();
			$data['current_url']   = $CI->config->site_url($CI->uri->uri_string());
			if (isset($_GET['sfk']) && isset($_GET['sfv'])) {
				$this->single_filter($_GET['sfk'], $_GET['sfv'], $data['current_url']);
			}
			$max_price                = $this->model->get_max_price();
			$min_price                = $this->model->get_min_price();
			$select_max_price         = (isset($_SESSION['price_filters']['high_price'])) ? $_SESSION['price_filters']['high_price'] : $max_price;
			$select_min_price         = (isset($_SESSION['price_filters']['min_price'])) ? $_SESSION['price_filters']['min_price'] : $min_price;
			$data['select_min_price'] = $select_min_price;
			$data['select_max_price'] = $select_max_price;

			if (isset($arr[0]) && !empty($arr[0])) {
				if (isset($_SESSION['filter'])) {
					$_SESSION['filter'] = array_filter($_SESSION['filter']);
				}

				if ($method == 'm_cat') {

					if ((isset($_SESSION['filter']) && !empty($_SESSION['filter'])) || (isset($_SESSION['single_filter']) && !empty($_SESSION['single_filter']))) {
						$all_product = $this->model->get_product_by_filter('main_cat_id', $arr[0]);
					} else {
						$all_product = $this->model->get_product('main_cat_id', $arr[0]);
					}

				} else if ($method == 's_cat') {
					if ((isset($_SESSION['filter']) && !empty($_SESSION['filter'])) || (isset($_SESSION['single_filter']) && !empty($_SESSION['single_filter']))) {
						$all_product = $this->model->get_product_by_filter('sub_cat_id', $arr[0]);
					} else {
						$all_product = $this->model->get_product('sub_cat_id', $arr[0]);
					}
				}
				$fabric_array    = array();
				$celebrity_array = array();
				$occasion_array  = array();
				$color_array     = array();
				$style_array     = array();
				$work_array      = array();
				$catlog_array    = array();
				// print_r($all_product);
				$product_details     = array();
				$data['banner_link'] = $this->model->get_banner_link($arr[0]);
				if ($method == 'm_cat') {
					$product_details = $this->model->get_all_products_details_by_m_cat_id($arr[0]);
				} else if ($method == 's_cat') {
					$product_details = $this->model->get_all_products_details_by_m_sub_id($arr[0]);
				}
				foreach ($product_details as $key => $value) {
					$result_data = explode("#", $value->details);
					$data1       = array_values(array_filter($result_data));
					foreach ($data1 as $key1 => $value1) {
						if (strpos($value1, 'Fabric') !== false) {
							$element_array = explode(":", $value1);
							array_push($fabric_array, $element_array[1]);
						} else if (strpos($value1, 'Color') !== false) {
							$element_array = explode(":", $value1);
							array_push($color_array, $element_array[1]);
						} else if (strpos($value1, 'Occasion') !== false) {
							$element_array = explode(":", $value1);
							array_push($occasion_array, $element_array[1]);
						} else if (strpos($value1, 'Celebrity') !== false) {
							$element_array = explode(":", $value1);
							array_push($celebrity_array, $element_array[1]);
						} else if (strpos($value1, 'Style') !== false) {
							$element_array = explode(":", $value1);
							array_push($style_array, $element_array[1]);
						} else if (strpos($value1, 'Work') !== false) {
							$element_array = explode(":", $value1);
							array_push($work_array, $element_array[1]);
						} else if (strpos($value1, 'CatalogName') !== false) {
							$element_array = explode(":", $value1);
							array_push($catlog_array, $element_array[1]);
						}
					}
				}
				$filter_data['fabric_array']    = array_values(array_unique($fabric_array));
				$filter_data['celebrity_array'] = array_values(array_unique($celebrity_array));
				$filter_data['occasion_array']  = array_values(array_unique($occasion_array));
				$filter_data['color_array']     = array_values(array_unique($color_array));
				$filter_data['style_array']     = array_values(array_unique($style_array));
				$filter_data['work_array']      = array_values(array_unique($work_array));
				$filter_data['catalog_array']   = array_values(array_unique($catlog_array));

				// print_r($all_product);
				$data['product']           = $all_product;
				$data['filter_data']       = $filter_data;
				$data['max_price']         = $max_price;
				$data['min_price']         = $min_price;
				$data['shipp_time_filter'] = $this->model->get_shiping_time_filter();

				$assets['javascript']       = array("assetes/otherassets/js/product_box_1.js");
				$assets['css']              = array("assetes/otherassets/css/product_box_1.css");
				$assets                     = array_merge($assets, $this->pp_loader_helper->get_adm_prof_data());
				$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
				$this->load->view('web/inc/header_view', $headers);
				$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
				$breadcumbs_data['data'] = array('Home', ucwords(str_replace("-", " ", $arr[1])));
				// $this->load->view('web/product_contents/breadcumbs', $breadcumbs_data);
				$this->load->view('web/cate2', $data);
				$this->load->view('web/contents/side_nav_filter', $data);
				$this->load->view('web/contents/product_boxes/product_box_model_1');
				$this->load->view('web/contents/support_bar/support_bar1', $this->pp_loader_helper->get_adm_prof_data());
				$this->load->view('web/inc/footer_view', $assets);
			}
		}

	}

	/**
	 * @param $key
	 * @param $value
	 * @param $url
	 */
	private function single_filter($key = "", $value = "", $url = "") {
		if (empty($url)) {
			$url = site_url();
		}
		unset($_SESSION['filter']);
		$_SESSION['filter'][$key][0] = $value;
		// echo $url;
		// header("Location : " . site_url('cate/header_resender?urls=' . $url));
	}
}
