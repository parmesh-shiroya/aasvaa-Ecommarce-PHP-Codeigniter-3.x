<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_manager extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_templete', 'model');
	}
	/**
	 * @param $add_status
	 */
	public function index($add_status = "") {
		$data['add_status']    = $add_status;
		$data['slider_banner'] = $this->model->get_main_slider_images();
		$data['banner_3']      = $this->model->get_banner_3_images();
		$data['banner_2']      = $this->model->get_banner_2_images();
		$data['banner_2big']   = $this->model->get_banner_2big_images();
		$data['banner_5']      = $this->model->get_banner_5_images();
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/templete/banner_manager', $data);
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
			if (isset($new_img_name)) {

				$this->pp_common->resize_image(array_values($image_paths), array_values($new_img_name), $new_paths_and_size);
			}
		}
		// print_r($new_img_name);
		return $new_img_name;

	}
	public function home_slider_image_update() {
		if ($this->pp_login_varified->admin_varified()) {
			$add_status = false;
			if (isset($_POST['add_banner_image_submit']) && !empty($_FILES['imagesFile']['name'])) {
				# code...

				$new_paths_and_size    = array('uploads/banner/1600_520/' => array(1600, 520));
				$new_slider_image_name = $this->upload_banner_image('uploads/banner/home_slider/', $new_paths_and_size);

				foreach ($new_slider_image_name as $new_key => $new_value) {
					$plus1      = $new_key + 1;
					$add_status = $this->model->update_banner_2('home_slider_' . $new_key, array('b_values' => $new_value, 'link' => $this->input->post('banner_' . $plus1 . '_link')));
				}
			}
			$this->index($add_status);
		}
	}
	public function home_3banner_image_update() {
		if ($this->pp_login_varified->admin_varified()) {
			$add_status = false;
			if (isset($_POST['add_banner_image_submit']) && !empty($_FILES['imagesFile']['name'])) {
				# code...
				$new_paths_and_size    = array('uploads/banner/3banner/366_141/' => array(366, 141));
				$new_slider_image_name = $this->upload_banner_image('uploads/banner/3banner/ori/', $new_paths_and_size);
				foreach ($new_slider_image_name as $new_key => $new_value) {
					$plus1      = $new_key + 1;
					$add_status = $this->model->update_banner_2('home_3_banner_' . $new_key, array('b_values' => $new_value, 'link' => $this->input->post('banner_' . $plus1 . '_link')));
				}
			}
			$this->index($add_status);
		}
	}

	public function home_2banner_image_update() {
		if ($this->pp_login_varified->admin_varified()) {
			$add_status = false;
			if (isset($_POST['add_banner_image_submit']) && !empty($_FILES['imagesFile']['name'])) {
				$new_paths_and_size    = array('uploads/banner/2banner/574_150/' => array(574, 150));
				$new_slider_image_name = $this->upload_banner_image('uploads/banner/2banner/ori/', $new_paths_and_size);

				foreach ($new_slider_image_name as $new_key => $new_value) {
					$plus1      = $new_key + 1;
					$add_status = $this->model->update_banner_2('home_2_banner_' . $new_key, array('b_values' => $new_value, 'link' => $this->input->post('banner_' . $plus1 . '_link')));
				}
			}
			$this->index($add_status);
		}
	}

	public function home_2big_banner_image_update() {
		if ($this->pp_login_varified->admin_varified()) {
			$add_status = false;
			if (isset($_POST['add_banner_image_submit']) && !empty($_FILES['imagesFile']['name'])) {
				$new_paths_and_size    = array('uploads/banner/2bigbanner/950_550/' => array(950, 550));
				$new_slider_image_name = $this->upload_banner_image('uploads/banner/2bigbanner/ori/', $new_paths_and_size);

				foreach ($new_slider_image_name as $new_key => $new_value) {
					$plus1      = $new_key + 1;
					$add_status = $this->model->update_banner_2('home_2big_banner_' . $new_key, array('b_values' => $new_value, 'link' => $this->input->post('banner_' . $plus1 . '_link')));
				}
			}
			$this->index($add_status);
		}
	}
	public function home_5_banner_image_update() {
		if ($this->pp_login_varified->admin_varified()) {
			$add_status = false;
			if (isset($_POST['add_banner_image_submit']) && !empty($_FILES['imagesFile']['name'])) {
				$new_paths_and_size    = array('uploads/banner/5banner/400_0/' => array(400, 0), 'uploads/banner/5banner/800_0/' => array(800, 0));
				$new_slider_image_name = $this->upload_banner_image('uploads/banner/5banner/ori/', $new_paths_and_size);

				foreach ($new_slider_image_name as $new_key => $new_value) {
					$plus1      = $new_key + 1;
					$add_status = $this->model->update_banner_2('home_5banner' . $new_key, array('b_values' => $new_value, 'link' => $this->input->post('banner_' . $plus1 . '_link')));
				}
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