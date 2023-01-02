<?php

class Home extends My_Controller {

	public function __construct() {
		parent::__construct();
		//Do your magic here
		$this->load->model('web/home_model');

	}
	public function index() {
		$data['product'] = $this->home_model->get_product_home_bottom();

		$data['product_by'] = $this->home_model->get_product_by_home_bottom();

		$home_slider['home_slider']   = $this->home_model->get_main_slide_images();
		$home_3banner['home_3banner'] = $this->home_model->get_main_home_3_banner();
		$home_2banner['home_2banner'] = $this->home_model->get_main_home_2_banner();
		$home_5banner['home_5banner'] = $this->home_model->get_banner_5_images();

		$home_2big_banner['home_2big_banner'] = $this->home_model->get_main_home_2big_banner();
		$slider_product['slider_product']     = $this->home_model->get_slider_product();
		$slider_product['slider_product_by']  = $this->home_model->get_slider_product_by_det();
		$slider_product2['slider_product']    = $this->home_model->get_slider_product2();
		$slider_product2['slider_product_by'] = $this->home_model->get_slider_product_by_det2();
		$message1['message']                  = unserialize(base64_decode($this->home_model->get_theme_data('message_1')->datas));
		$message2['message']                  = unserialize(base64_decode($this->home_model->get_theme_data('message_2')->datas));
		$service_message['service_message1']  = unserialize(base64_decode($this->home_model->get_theme_data('home_service_message1')->datas));
		$service_message['service_message2']  = unserialize(base64_decode($this->home_model->get_theme_data('home_service_message2')->datas));
		$service_message['service_message3']  = unserialize(base64_decode($this->home_model->get_theme_data('home_service_message3')->datas));
		$service_message['service_message4']  = unserialize(base64_decode($this->home_model->get_theme_data('home_service_message4')->datas));
		$service_message['service_color']     = unserialize(base64_decode($this->home_model->get_theme_data('home_service_color')->datas));
		$assets['javascript']                 = array("assetes/otherassets/js/product_box_1.js");
		$assets['css']                        = array("assetes/otherassets/css/product_box_1.css");
		$headers['mobile_nav_menu']           = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		$this->load->view('web/contents/sliders/full_width_slider', $home_slider);
		$this->load->view('web/contents/banners/5banner', $home_5banner);
		$this->load->view('web/contents/banners/big2', $home_2big_banner);

		$this->load->view('web/contents/banners/3colums', $home_3banner);
		$this->load->view('web/contents/offer_line_1', $message1);
		$this->load->view('web/contents/sliders/product_slider1', $slider_product);
		$this->load->view('web/contents/sliders/product_slider1', $slider_product2);
		$this->load->view('web/contents/banners/2colums', $home_2banner);
		$this->load->view('web/contents/offer_line_1', $message2);
		$this->load->view('web/contents/product_boxes/product_box_2', $data);
		$this->load->view('web/contents/product_boxes/product_box_model_1');
		$this->load->view('web/contents/service_message', $service_message);
		$this->load->view('web/contents/support_bar/support_bar1', $this->pp_loader_helper->get_adm_prof_data());
		$this->load->view('home');
		$this->load->view('web/inc/footer_view', $assets);
		// echo base64_encode(serialize(array("Color" => array("Hot Pink"), "Occasion" => array("Wedding", "Bridal"), "Fabric" => array("Pure Chiffon", " Georgette"), "Style" => array("Traditional Saree"), "Work" => array("Patch Border", "Embroidered"), "Shipping Time" => "7 - 9 Days", "Catalog No." => "3729")));
	}

}
