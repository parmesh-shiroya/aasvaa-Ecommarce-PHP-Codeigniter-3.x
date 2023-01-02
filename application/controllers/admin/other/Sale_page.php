<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sale_page extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_other', 'model');
	}
	/**
	 * @param $add_status
	 */
	public function index($add_status = "") {
		$data['add_status']  = $add_status;
		$data['offer_image'] = $this->model->get_offer_images();
		$data['offer_title'] = $this->model->get_offer_title()->datas;
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/other/sale_page', $data);
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer');
	}

	/**
	 * @param  $path
	 * @param  $new_paths_and_size
	 * @return mixed
	 */
	public function upload_banner_image($path, $new_paths_and_size) {
		$this->load->library('image_lib');
		$new_img_name = '';
		if (isset($_POST['add_banner_image_submit']) && !empty($_FILES['imagesFile']['name'])) {

			$filesCount  = count($_FILES['imagesFile']['name']);
			$upload_data = $this->pp_common->upload_product_image($_FILES['imagesFile'], $path);
			// print_r($upload_data);
			foreach ($upload_data as $key => $value) {
				$image_paths[$key]  = $path . $upload_data[$key]['file_name'];
				$new_img_name[$key] = $upload_data[$key]['file_name'];
			}
			if (!empty($new_img_name)) {
				$this->pp_common->resize_image(array_values($image_paths), array_values($new_img_name), $new_paths_and_size);
			}
		}
		// print_r($new_img_name);
		return $new_img_name;

	}

	public function offer_banner_image_update() {
		if ($this->pp_login_varified->admin_varified()) {
			$add_status = false;

			if (isset($_POST['add_banner_image_submit']) && !empty($_FILES['imagesFile']['name'])) {
				$new_paths_and_size    = array('uploads/banner/offer_image/1600_520/' => array(1600, 520));
				$new_slider_image_name = $this->upload_banner_image('uploads/banner/offer_image/original/', $new_paths_and_size);
				if (!empty($new_slider_image_name)) {
					foreach ($new_slider_image_name as $new_key => $new_value) {
						$plus1      = $new_key + 1;
						$add_status = $this->model->update_banner_2('offer_image_' . $new_key, array('b_values' => $new_value, 'link' => $this->input->post('banner_' . $plus1 . '_link')));

					}
				}
				$this->model->update_offer_page_title($this->input->post('offer_page_title'));
			}
			$this->index($add_status);
		}
	}

	public function delete_banner_image() {
		if (isset($_POST['banner_id'])) {
			$result = $this->model->delete_banner($this->input->post('banner_id'));
			$this->output->set_content_type('application_json')
			     ->set_output(json_encode(['result' => $result]));
		} else {
			header("Location : " . site_ur('admin/theme/banner_manager'));
		}
	}

}