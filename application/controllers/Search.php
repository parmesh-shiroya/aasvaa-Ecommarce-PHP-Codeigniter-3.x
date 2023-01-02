<?php

class Search extends My_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('web/m_search', 'model');

	}
	public function index() {
		if (isset($_GET['filter_name'])) {
			$CI                  = &get_instance();
			$data['current_url'] = $CI->config->site_url($CI->uri->uri_string()) . "?filter_name=" . $_GET['filter_name'];

			$name         = trim($this->input->get('filter_name'));
			$data['name'] = $name;
			$result1      = $this->model->get_product_by_name($name);

			$result2 = $this->model->get_product_by_category($name);

			$result3 = $this->model->get_product_by_sub_category($name);

			$results = array_unique(array_merge($result1, $result2, $result3), SORT_REGULAR);

			if (empty($results)) {
				$results = $this->model->get_product_by_sku($name);
			}

			if (!isset($_SESSION['report']) || !isset($_SESSION['report']['search']) || $_SESSION['report']['search'] != $name) {
				$this->model->add_serch_report($name, sizeof($results));
			}

			$product                    = $this->model->get_product_by_ids($results);
			$data['product']            = $product;
			$assets['javascript']       = array("assetes/otherassets/js/product_box_1.js");
			$assets['css']              = array("assetes/otherassets/css/product_box_1.css");
			$assets                     = array_merge($assets, $this->pp_loader_helper->get_adm_prof_data());
			$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
			$this->load->view('web/inc/header_view', $headers);
			$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());

			$this->load->view('web/search', $data);
			$this->load->view('web/contents/product_boxes/product_box_model_1');
			$this->load->view('web/contents/support_bar/support_bar1', $this->pp_loader_helper->get_adm_prof_data());
			$this->load->view('web/inc/footer_view', $assets);
		}
	}

}
