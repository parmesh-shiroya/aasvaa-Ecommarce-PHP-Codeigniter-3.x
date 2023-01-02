<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_manager extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//Do your magic here
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_templete', 'model');
	}
	public function index() {
		$data['top_message_1']        = unserialize(base64_decode($this->model->get_theme_mst('top_message_1')->datas));
		$data['message_1']            = unserialize(base64_decode($this->model->get_theme_mst('message_1')->datas));
		$data['message_2']            = unserialize(base64_decode($this->model->get_theme_mst('message_2')->datas));
		$data['home_product_slider']  = unserialize(base64_decode($this->model->get_theme_mst('home_product_slider')->datas));
		$data['home_product_slider2'] = unserialize(base64_decode($this->model->get_theme_mst('home_product_slider2')->datas));
		$data['home_other_product']   = unserialize(base64_decode($this->model->get_theme_mst('home_bottom_product')->datas));
		$data['service_message1']     = unserialize(base64_decode($this->model->get_theme_mst('home_service_message1')->datas));
		$data['service_message2']     = unserialize(base64_decode($this->model->get_theme_mst('home_service_message2')->datas));
		$data['service_message3']     = unserialize(base64_decode($this->model->get_theme_mst('home_service_message3')->datas));
		$data['service_message4']     = unserialize(base64_decode($this->model->get_theme_mst('home_service_message4')->datas));
		$data['service_color']        = unserialize(base64_decode($this->model->get_theme_mst('home_service_color')->datas));
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/templete/home_manager', $data);

		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer');
	}

	public function update_message() {
		if (isset($_POST['message_1'])) {
			$data0  = base64_encode(serialize(array('message' => $this->input->post('top_message_1'))));
			$result = $this->model->update_theme_mst('top_message_1', $data0);
			$data1  = base64_encode(serialize(array('title' => $this->input->post('message_title_1'), 'message' => $this->input->post('message_1'))));
			// if (empty($this->input->post('message_1')) && empty($this->input->post('message_title_1'))) {
			// 	$data1 = "";
			// }
			$result = $this->model->update_theme_mst('message_1', $data1);
			$data2  = base64_encode(serialize(array('title' => $this->input->post('message_title_2'), 'message' => $this->input->post('message_2'))));
			$result = $this->model->update_theme_mst('message_2', $data2);
			$this->output->set_content_type('application_json')
			     ->set_output(json_encode(['result' => $result]));
		} else {
			header("Location : " . base_url() . 'admin/theme/home_manager');
		}
	}

	public function update_slider() {
		if (isset($_POST['max_product']) && isset($_POST['show_product'])) {
			$data = array('max' => $this->input->post('max_product'), 'show_product_by' => $this->input->post('show_product'));
			if ($this->input->post('show_product') == 'catalogue') {
				$data = array_merge($data, array("catalogue" => $this->input->post('catalogue_name')));
			}
			$result = $this->model->update_theme_mst('home_product_slider', base64_encode(serialize($data)));
			$this->output->set_content_type('application_json')
			     ->set_output(json_encode(['result' => $result]));
		}
	}
	public function update_slider2() {
		if (isset($_POST['max_product']) && isset($_POST['show_product'])) {
			$data = array('max' => $this->input->post('max_product'), 'show_product_by' => $this->input->post('show_product'));
			if ($this->input->post('show_product') == 'catalogue') {
				$data = array_merge($data, array("catalogue" => $this->input->post('catalogue_name')));
			}
			$result = $this->model->update_theme_mst('home_product_slider2', base64_encode(serialize($data)));
			$this->output->set_content_type('application_json')
			     ->set_output(json_encode(['result' => $result]));
		}
	}

	public function update_home_bot_product() {
		if (isset($_POST['max_product']) && isset($_POST['show_product'])) {
			$data = array('max' => $this->input->post('max_product'), 'show_product_by' => $this->input->post('show_product'));
			if ($this->input->post('show_product') == 'catalogue') {
				$data = array_merge($data, array("catalogue" => $this->input->post('catalogue_name')));
			}
			$result = $this->model->update_theme_mst('home_bottom_product', base64_encode(serialize($data)));
			$this->output->set_content_type('application_json')
			     ->set_output(json_encode(['result' => $result]));
		}
	}

	/**
	 * @param  $path
	 * @param  $new_paths_and_size
	 * @return mixed
	 */
	public function upload_banner_image($path, $new_paths_and_size) {
		$this->load->library('image_lib');
		$new_img_name = '';
		if (isset($_POST['update_service_message']) && !empty($_FILES['imagesFile']['name'])) {

			$filesCount  = count($_FILES['imagesFile']['name']);
			$upload_data = $this->pp_common->upload_product_image($_FILES['imagesFile'], $path);
			// print_r($upload_data);
			foreach ($upload_data as $key => $value) {
				$image_paths[$key]  = $path . $upload_data[$key]['file_name'];
				$new_img_name[$key] = $upload_data[$key]['file_name'];
			}
			if (isset($new_img_name) && isset($image_paths)) {

				$this->pp_common->resize_image(array_values($image_paths), array_values($new_img_name), $new_paths_and_size);
			}
		}
		// print_r($new_img_name);
		return $new_img_name;

	}

	public function update_service_message() {
		if ($this->pp_login_varified->admin_varified()) {
			$add_status = false;
			if (isset($_POST['update_service_message']) && !empty($_FILES['imagesFile']['name'])) {
				$new_paths_and_size    = array('uploads/banner/service_message/120_120/' => array(120, 120));
				$new_slider_image_name = $this->upload_banner_image('uploads/banner/service_message/ori/', $new_paths_and_size);
				if (!empty($new_slider_image_name)) {
					foreach ($new_slider_image_name as $new_key => $new_value) {
						$plus1  = $new_key + 1;
						$data   = array('img' => $new_value, 'title' => $this->input->post('title_' . $new_key), 'message' => $this->input->post('message_' . $new_key));
						$result = $this->model->update_theme_mst('home_service_message' . $plus1, base64_encode(serialize($data)));
					}
				}

			}
			if (isset($_POST['update_service_message'])) {
				for ($i = 0; $i < 4; $i++) {
					$plus  = $i + 1;
					$key   = 'home_service_message' . $plus;
					$data  = unserialize(base64_decode($this->model->get_theme_mst($key)->datas));
					$data2 = array_merge($data, array(
						'title'   => $this->input->post('title_' . $i),
						'message' => $this->input->post('message_' . $i),
					));
					$result = $this->model->update_theme_mst('home_service_message' . $plus, base64_encode(serialize($data2)));
				}
				$data3 = array(
					"in_container" => $this->input->post('in_container'),
					"bg"           => $this->input->post('service_bg'),
					"title"        => $this->input->post('service_title'),
					"message"      => $this->input->post('service_message'),
				);
				$result = $this->model->update_theme_mst('home_service_color', base64_encode(serialize($data3)));
			}
			$this->index($add_status);
		}
	}

}

/* End of file home.php */
/* Location: ./application/controllers/admin/theme/home.php */
