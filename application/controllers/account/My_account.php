<?php

class My_account extends My_Controller {
	function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->customer_varified()) {
			header('location:' . site_url('account/login'));
		}
		$this->load->model('web/account/m_account', 'model');
	}
	public function index() {
		header('location:' . site_url('account/dashboard'));

	}
	public function my_wish_list() {
		$customer_id       = $this->session->userdata('customer_data')['customer_id'];
		$data['like_data'] = $this->model->get_custome_wishlist($customer_id);
		if (isset($_SESSION['product_likes'])) {

			foreach ($_SESSION['product_likes'] as $key => $value) {
				$data['product_' . $value['product_id']] = $this->model->get_product($value['product_id']);
			}}

		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		$this->load->view('web/account/inc/header2');
		$this->load->view('web/account/wishlist', $data);
		$this->load->view('web/account/inc/footer2');
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}

	public function remove_from_wish_list() {
		if (isset($_POST['wish_id'])) {
			$customer_id = $this->session->userdata('customer_data')['customer_id'];
			$result      = $this->model->remove_from_wish_list($customer_id, $this->input->post('wish_id'));
			$this->output->set_content_type('application_json')->set_output(json_encode(['result' => $result]));
		} else {
			header("Location : " . site_url('account/my_account/my_wish_list'));
		}
	}
	public function password() {
		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		$this->load->view('web/account/inc/header2');
		$this->load->view('web/account/password');
		$this->load->view('web/account/inc/footer2');
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}

	public function newsletter() {
		$customer_id                = $this->session->userdata('customer_data')['customer_id'];
		$data['account']            = $this->model->get_account_detail($customer_id);
		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());

		$this->load->view('web/account/inc/header2');
		$this->load->view('web/account/newsletter', $data);
		$this->load->view('web/account/inc/footer2');
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}

	public function address_book() {
		$customer_id                = $this->session->userdata('customer_data')['customer_id'];
		$data['addresses']          = $this->model->get_account_address($customer_id);
		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());

		$this->load->view('web/account/inc/header2');
		$this->load->view('web/account/address_book', $data);
		$this->load->view('web/account/inc/footer2');
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}
	public function delete_add() {
		if (isset($_POST['add_id'])) {
			$this->output->set_content_type('application_json');
			$customer_id = $this->session->userdata('customer_data')['customer_id'];
			$result      = $this->model->delete_address($customer_id, $_POST['add_id']);
			$this->output->set_output(json_encode(['result' => $result]));
		}
	}
	/**
	 * @param $add_id
	 */
	public function edit_address($add_id = 0) {
		if ($add_id != 0) {
			$customer_id                = $this->session->userdata('customer_data')['customer_id'];
			$data['address']            = $this->model->get_address($customer_id, $add_id);
			$data['countrys']           = $this->model->get_all_countrys();
			$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
			$this->load->view('web/inc/header_view', $headers);
			$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
			$this->load->view('web/account/inc/header2');
			$this->load->view('web/account/edit_address', $data);
			$this->load->view('web/account/inc/footer2');
			$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
		}
	}

	public function mana_mesurement() {
		$customer_id                = $this->session->userdata('customer_data')['customer_id'];
		$data['mesurements']        = $this->model->get_all_customer_mesurement($customer_id);
		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		$this->load->view('web/account/inc/header2');
		$this->load->view('web/account/mana_mesurement', $data);
		$this->load->view('web/account/inc/footer2');
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}

	public function order_history() {
		$customer_id       = $this->session->userdata('customer_data')['customer_id'];
		$data['order_mst'] = $this->model->get_all_customer_orders($customer_id);
		foreach ($data['order_mst'] as $order_data) {
			if ($order_data->payment_from == 'paypal') {
				$data['paypal_data']['or_' . $order_data->id] = $this->model->get_paypal_payment_data($order_data->payment_from_data_id);
			}
			if ($order_data->payment_from == 'ccavenue') {
				$data['ccavenue_data']['or_' . $order_data->id] = $this->model->get_ccavenue_payment_data($order_data->payment_from_data_id);
			}
		}
		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		$this->load->view('web/account/inc/header2');
		$this->load->view('web/account/order_history2', $data);
		$this->load->view('web/account/inc/footer2');
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}

	public function review_ratings() {
		$customer_id                = $this->session->userdata('customer_data')['customer_id'];
		$data['my_reviews']         = $this->model->get_all_customer_reviews($customer_id);
		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		$this->load->view('web/account/inc/header2');
		$this->load->view('web/account/review_ratings', $data);
		$this->load->view('web/account/inc/footer2');
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());
	}

}