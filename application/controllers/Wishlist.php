<?php

class Wishlist extends My_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('web/m_oth', 'model');

	}
	public function index() {
		$data = array();
		if (isset($_SESSION['product_likes'])) {

			foreach ($_SESSION['product_likes'] as $key => $value) {
				$data['products']['product_' . $value['product_id']] = $this->model->get_product($value['product_id']);
			}
		}

		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		$this->load->view('web/wishlist', $data);
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}
	public function remove_from_wish_list() {
		if ($this->input->post('wish_id')) {
			if (isset($_SESSION['product_likes']['product_id_' . $this->input->post('wish_id')])) {
				unset($_SESSION['product_likes']['product_id_' . $this->input->post('wish_id')]);
				if ($this->pp_login_varified->customer_varified()) {
					$customer_id = $this->session->userdata('customer_data')['customer_id'];

					$this->model->removeLikedb($customer_id, $this->input->post('wish_id'));
				}

				echo json_encode(['result' => true]);
			}
		} else {
			header('location:' . site_url('wishlist'));
		}

	}
}