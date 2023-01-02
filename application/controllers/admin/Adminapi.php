<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Adminapi extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_adminapi', 'model');

	}
	public function index() {
		if (isset($_POST['method'])) {
			$this->$_POST['method']();
		}
	}

	private function get_sub_cat() {
		if (isset($_POST['main_cat_id']) && isset($_POST['method'])) {
			$data = $this->model->get_sub_cat($_POST['main_cat_id']);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
	private function get_details_field() {
		if (isset($_POST['sub_cat_id']) && isset($_POST['method'])) {
			$data = $this->model->get_which_prod_show_field($_POST['sub_cat_id']);
			if (empty($data)) {
				$data = $this->model->get_which_prod_show_field(0);
			}
			foreach ($data as $val) {
				$prod_det_ids = unserialize($val->prod_det_ids);
			}
			$data2 = $this->model->get_prod_det_field_det($prod_det_ids);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('prod_det_id' => $prod_det_ids, 'fielddata' => $data2)));
		}
	}
	private function get_default_desc_by_cat() {
		if (isset($_POST['by']) && isset($_POST['method']) && isset($_POST['main_cat_id'])) {
			$table = "";
			if ($_POST['by'] == 'main_cat') {
				$table = "main_cat_mst";
			} elseif ($_POST['by'] == 'sub_cat') {
				$table = "sub_cat_mst";
			}
			$data = $this->model->get_default_data($table, $_POST['main_cat_id']);
			if (!empty($data)) {
				$data2 = array();
				foreach ($data as $val) {
					$data2 = array_merge(array($val->d_key => $val->d_value), $data2);
				}
				$this->output->set_content_type('application/json')->set_output(json_encode($data2));
			}
		}
	}

	private function get_standard_size_names() {
		if (isset($_POST['by']) && isset($_POST['method']) && isset($_POST['cat_id'])) {
			$column = "";
			if ($_POST['by'] == "main_cat") {
				$column = "main_cat_id";
			} else if ($_POST['by'] == "sub_cat") {
				$column = "sub_cat_id";
			}
			$data  = $this->model->get_standard_size_names($column, $_POST['cat_id']);
			$data2 = array();
			if (!empty($data)) {
				foreach ($data as $key => $value) {
					if (isset($data2[$value['size_for']])) {
						array_push($data2[$value['size_for']], array('id' => $value['id'], 'name' => $value['name'], 'price' => $value['def_price']));
					} else {
						$data2[$value['size_for']] = array(array('id' => $value['id'], 'name' => $value['name'], 'price' => $value['def_price']));
					}
				}

			}
			$this->output->set_content_type('application/json')->set_output(json_encode($data2));
		}
	}

	private function get_customize_size_names() {
		if (isset($_POST['by']) && isset($_POST['method']) && isset($_POST['cat_id'])) {
			$column = "";
			if ($_POST['by'] == "main_cat") {
				$column = "main_cat_id";
			} else if ($_POST['by'] == "sub_cat") {
				$column = "sub_cat_id";
			}
			$data  = $this->model->get_customize_size_names($column, $_POST['cat_id']);
			$data2 = array();
			if (!empty($data)) {
				foreach ($data as $key => $value) {
					if (isset($data2[$value['size_for']])) {
						array_push($data2[$value['size_for']], array('id' => $value['id'], 'name' => $value['name'], 'price' => $value['def_price']));
					} else {
						$data2[$value['size_for']] = array(array('id' => $value['id'], 'name' => $value['name'], 'price' => $value['def_price']));
					}
				}

			}
			$this->output->set_content_type('application/json')->set_output(json_encode($data2));
		}
	}

	public function upload_image_with_ajax() {

		$this->load->library('image_lib');
		if (!empty($_FILES['imagesFile']['name'])) {

			$filesCount   = count($_FILES['imagesFile']['name']);
			$upload_data  = $this->pp_common->upload_product_image($_FILES['imagesFile'], 'uploads/pro_image/orignal/');
			$upload_data  = array_values($upload_data);
			$new_img_name = array();
			for ($i = 0; $i < count($upload_data); $i++) {
				$image_paths[$i]  = 'uploads/pro_image/orignal/' . $upload_data[$i]['file_name'];
				$new_img_name[$i] = $upload_data[$i]['file_name'];

			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array("response" => "done", "image_names" => $new_img_name)));
			$new_paths_and_size = array('uploads/pro_image/94_130/' => array(94, 130), 'uploads/pro_image/300_375/' => array(273, 375), 'uploads/pro_image/400_470/' => array(343, 470), 'uploads/pro_image/550_620/' => array(452, 620), 'uploads/pro_image/900_1200/' => array(874, 1200));
			if (isset($image_paths)) {
				$this->pp_common->resize_image($image_paths, $new_img_name, $new_paths_and_size, FALSE);
			}

		}

	}

	public function upload_banner_image_with_ajax() {

		$this->load->library('image_lib');
		if (!empty($_FILES['imagesFile']['name'])) {

			$filesCount   = count($_FILES['imagesFile']['name']);
			$upload_data  = $this->pp_common->upload_product_image($_FILES['imagesFile'], 'uploads/banner/deal_offer/ori/');
			$upload_data  = array_values($upload_data);
			$new_img_name = array();
			for ($i = 0; $i < count($upload_data); $i++) {
				$image_paths[$i]  = 'uploads/banner/deal_offer/ori/' . $upload_data[$i]['file_name'];
				$new_img_name[$i] = $upload_data[$i]['file_name'];

			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array("response" => "done", "image_names" => $new_img_name)));
			$new_paths_and_size = array('uploads/banner/deal_offer/1600_500/' => array(1600, 500));
			if (isset($image_paths)) {
				$this->pp_common->resize_image($image_paths, $new_img_name, $new_paths_and_size);
			}

		}

	}
	public function upload_main_cat_banner_image_with_ajax() {

		$this->load->library('image_lib');
		if (!empty($_FILES['imagesFile']['name'])) {
			$filesCount   = count($_FILES['imagesFile']['name']);
			$upload_data  = $this->pp_common->upload_product_image($_FILES['imagesFile'], 'uploads/banner/main_cat_banner/ori/');
			$upload_data  = array_values($upload_data);
			$new_img_name = array();
			for ($i = 0; $i < count($upload_data); $i++) {
				$image_paths[$i]  = 'uploads/banner/main_cat_banner/ori/' . $upload_data[$i]['file_name'];
				$new_img_name[$i] = $upload_data[$i]['file_name'];

			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array("response" => "done", "image_names" => $new_img_name)));
			$new_paths_and_size = array('uploads/banner/main_cat_banner/1300_250/' => array(1300, 250));
			if (isset($image_paths)) {
				$this->pp_common->resize_image($image_paths, $new_img_name, $new_paths_and_size);
			}
		}

	}

	public function upload_email_banner_image_with_ajax() {

		$this->load->library('image_lib');
		if (!empty($_FILES['imagesFile']['name'])) {
			$filesCount   = count($_FILES['imagesFile']['name']);
			$upload_data  = $this->pp_common->upload_product_image($_FILES['imagesFile'], 'uploads/banner/email_banner/ori/');
			$upload_data  = array_values($upload_data);
			$new_img_name = array();
			for ($i = 0; $i < count($upload_data); $i++) {
				$image_paths[$i]  = 'uploads/banner/email_banner/ori/' . $upload_data[$i]['file_name'];
				$new_img_name[$i] = $upload_data[$i]['file_name'];

			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array("response" => "done", "image_names" => $new_img_name)));
			$new_paths_and_size = array('uploads/banner/email_banner/small/' => array(600, 274));
			if (isset($image_paths)) {
				$this->pp_common->resize_image($image_paths, $new_img_name, $new_paths_and_size);
			}
		}

	}

	public function change_product_status() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['product_id']) && isset($_POST['method']) && isset($_POST['product_status'])) {
				echo $this->model->change_product_status($_POST['product_id'], $_POST['product_status']);

			}
		}
	}
	public function change_coupen_status() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['coupen_id']) && isset($_POST['method']) && isset($_POST['coupen_status'])) {
				echo $this->model->change_coupen_status($_POST['coupen_id'], $_POST['coupen_status']);

			}
		}
	}

	private function get_product_data() {
		if (isset($_POST['product_ids'])) {
			$data = $this->model->get_product_data($this->input->post('product_ids'));
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function update_product() {
		if ($this->pp_login_varified->admin_varified()) {
			if (isset($_POST['product_sku']) && isset($_POST['product_id'])) {
				$this->output->set_content_type('application_json');
				$form_rules = array(
					array(
						'field'  => 'product_sku',
						'label'  => 'Product SKU',
						'rules'  => 'trim|required',
						'errors' => array(
							'required' => 'You must provide a %s.',
						),
					),
					array(
						'field' => 'product_name',
						'label' => 'Product Name',
						'rules' => 'trim|required',
					),
					array(
						'field' => 'product_stock',
						'label' => 'Stock',
						'rules' => 'trim|required',
					),
					array(
						'field' => 'product_catalogue',
						'label' => 'Cataloge Name',
						'rules' => 'trim|required',
					),
					array(
						'field' => 'product_mrp',
						'label' => 'Mrp',
						'rules' => 'trim|greater_than[product_sell_price]',
					),
					array(
						'field' => 'product_sell_price',
						'label' => 'Sell Price',
						'rules' => 'trim|required|less_than[product_mrp]',
					),
				);
				$this->form_validation->set_rules($form_rules);
				if ($this->form_validation->run() == FALSE) {
					$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
				} else {
					$result = $this->model->update_coupen($this->input->post('product_id'), $this->input->post('product_sku'), array(
						"product_name"   => $this->input->post('product_name'),
						"stock"          => $this->input->post('product_stock'),
						"mrp"            => $this->input->post('product_mrp'),
						"sell_price"     => $this->input->post('product_sell_price'),
						"catalogue_name" => $this->input->post('product_catalogue'),
					));
					$this->output->set_output(json_encode(['result' => $result]));
				}
			}
		}
	}

	// ====================================== Add Product 2 ================================ //
	private function get_details_field_2() {
		if (isset($_POST['sub_cat_id']) && isset($_POST['method'])) {
			$data = $this->model->get_which_prod_show_field_2($_POST['sub_cat_id']);
			if (empty($data)) {
				$data = $this->model->get_which_prod_show_field_2(0);
			}
			foreach ($data as $val) {
				$prod_det_ids = unserialize($val->prod_det_ids);
			}
			$data2      = $this->model->get_prod_det_field_det_2($prod_det_ids);
			$print_data = array();
			foreach ($data2 as $key => $value) {
				$data3 = array();
				if (!empty($value['det_data_id'])) {
					$data3 = $this->model->get_prod_det_data_2($value['det_data_id']);
					$value = array_merge($value, array("datas" => unserialize(base64_decode($data3['datas']))));
				} else {
					$value = array_merge($value, array("datas" => array()));
				}

				$print_data = array_merge($print_data, array($value));
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('prod_det_id' => $prod_det_ids, 'fielddata' => $print_data)));
		}
	}

	//==================  Dashbord Api =====================//
	public function get_order_data() {
		$result = $this->model->get_order_status();
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
}

/* End of file products_api.php */
/* Location: ./application/controllers/api/products_api.php */
