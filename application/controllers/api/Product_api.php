<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_api extends My_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('api/product_api_model', 'model');

	}
	public function index() {
		if (isset($_POST['method'])) {
			$this->$_POST['method']();
		}
	}

	private function singleproduct() {
		if (isset($_POST['product_id']) && isset($_POST['method'])) {
			$data = $this->model->get_product_single($_POST['product_id']);

			$data[0] = array_merge($data[0], array("product_details" => unserialize($data[0]['product_details'])));
			if (!empty($data[0]['mrp'])) {
				$data[0] = array_merge($data[0], array("mrp" => $this->ccr->cc('INR', $_SESSION['currency_choose'], $data[0]['mrp'])));
			}

			$data[0] = array_merge($data[0], array("sell_price" => $this->ccr->cc('INR', $_SESSION['currency_choose'], $data[0]['sell_price'])));
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
			$this->model->add_quick_product_view($_POST['product_id']);
		}
	}

	private function like_product() {
		if (isset($_POST['product_id']) && isset($_POST['method'])) {
			if ($this->pp_login_varified->customer_varified()) {
				$customer_id = $this->session->userdata('customer_data')['customer_id'];
				$this->model->product_like($customer_id, $_POST['product_id']);
				echo "1";
			} else {
				$_SESSION['product_likes']['product_id_' . $_POST['product_id']] = array('product_id' => $_POST['product_id']);
				echo "1";
			}
		}
	}
	private function remove_like_product() {
		if (isset($_POST['product_id']) && isset($_POST['method'])) {
			if ($this->pp_login_varified->customer_varified()) {
				$customer_id = $this->session->userdata('customer_data')['customer_id'];
				$this->model->remove_product_like($customer_id, $_POST['product_id']);

				echo "1";
			} else {
				if (isset($_SESSION['product_likes']['product_id_' . $_POST['product_id']])) {
					unset($_SESSION['product_likes']['product_id_' . $_POST['product_id']]);
				}
				echo "1";
			}
		}
	}

	private function get_like_product() {
		if (isset($_POST['method'])) {
			if ($this->pp_login_varified->customer_varified()) {
				$customer_id = $this->session->userdata('customer_data')['customer_id'];
				$result      = $this->model->get_like_products($customer_id);
				if (!empty($result)) {
					unset($_SESSION['product_likes']);
					foreach ($result as $key => $value) {
						$_SESSION['product_likes']['product_id_' . $value->product_id] = array('product_id' => $value->product_id);
					}
					$this->output->set_content_type('application/json')->set_output(json_encode($this->session->userdata('product_likes')));
				}
			} else {
				if (isset($_SESSION['product_likes'])) {
					$this->output->set_content_type('application/json')->set_output(json_encode($this->session->userdata('product_likes')));
				}
			}
		}
	}

}

/* End of file products_api.php */
/* Location: ./application/controllers/api/products_api.php */
