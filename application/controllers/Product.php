<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends My_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('web/m_product', 'model');

	}
	/**
	 * @param $method
	 * @param $arr
	 */
	public function _remap($method, $arr) {
		if ($method !== 'index') {
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

		if (sizeof($arr) == 4) {

			if (isset($arr[2])) {
				$obj = $this->model->get_product($arr[2]);
				if (empty($obj)) {
					header('Location:' . base_url());
				}
				// $customize_datas = $this->model->get_customize_data($obj->main_cat_id);
				$this->model->plus_view_to_product($arr[2]);
				if (!empty($obj->standard_size_show_in)) {
					foreach (unserialize(base64_decode($obj->standard_size_show_in)) as $key => $value) {
						$product_data['standard_sizes'][$value['name']] = $this->model->get_standard_size_chart($value['standard_row_id']);
					}
				}
				$product_data['product_data']            = $obj;
				$assets['javascript']                    = array("assetes/otherassets/js/jquery.elevatezoom.js", "assetes/otherassets/js/sticky.js", "assetes/otherassets/js/product_box_1.js");
				$assets                                  = array_merge($assets, $this->pp_loader_helper->get_adm_prof_data());
				$headers['mobile_nav_menu']              = $this->pp_loader_helper->get_mobile_nav_menu();
				$sliders['slider1']['slider_product']    = $this->model->get_slider1_product($product_data['product_data']->sub_cat_id, $product_data['product_data']->catalogue_name);
				$sliders['slider1']['slider_product_by'] = $this->model->get_product_by_home_bottom('sin_pro_page_slider1');
				$sliders['slider2']['slider_product_by'] = $this->model->get_product_by_home_bottom('sin_pro_page_slider2');
				$sliders['slider2']['slider_product']    = $this->model->get_slider2_product($product_data['product_data']->sub_cat_id, $product_data['product_data']->catalogue_name);
				$assets['css']                           = array("assetes/otherassets/css/product_box_1.css");
				$product_data['shipping_charge']         = $this->pp_loader_helper->get_shipping_charge();

				$product_data['reviews_data'] = $this->model->get_total_reviews($arr[2]);
				$this->load->view('web/inc/header_view', $headers);
				$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
				$this->load->view('web/product_contents/main_content3', $product_data);
				$this->load->view('web/product_contents/contents/product_sliders', $sliders);
				$this->load->view('web/contents/product_boxes/product_box_model_1');
				$this->load->view('web/contents/support_bar/support_bar1', $this->pp_loader_helper->get_adm_prof_data());
				$this->load->view('web/inc/footer_view', $assets);
			}
		}
	}

}

/* End of file product.php */
/* Location: ./application/controllers/product.php */
