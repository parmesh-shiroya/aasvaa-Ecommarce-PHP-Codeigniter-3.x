<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//Do your magic here
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_test', 'model');
	}
	public function index() {

		$size_chart = $this->model->get_size_chart();
		echo "<pre>";
		print_r(unserialize(base64_decode($size_chart->fields)));
		// $this->model->test();

		// $assets['css'] = array("assetes/otherassets/css/product_box_1.css", "assetes/otherassets/css/jquery.dataTables.min.css");
		// $assets['javascript'] = array("assetes/otherassets/js/ckeditor/ckeditor.js");
		// $data['data']         = $this->model->get_datas();
		// $data['row']          = $this->model->get_size_chart();
		// $this->load->view('admin/inc/adm_header');
		// $this->load->view('admin/inc/adm_nav_start');
		// $this->load->view("admin/templete/home", $data);
		// $this->load->view('admin/inc/adm_nav_end');
		// $this->load->view('admin/inc/adm_footer', $assets);
	}

	public function get_blouse_customize_image_data() {
		// Hrer Gerate Blouse Image data base64 data copy that and pase into database custom size chart > image_fiels of blouse
		$fron_neck        = glob('uploads/size_chart_img/front_patern/*');
		$back_neck        = glob('uploads/size_chart_img/back_pertern/*');
		$slive_style      = glob('uploads/size_chart_img/slive_style/*');
		$front_neck_array = array();
		echo "<pre>";
		foreach ($fron_neck as $key) {
			// print_r($key);
			$name = str_replace('uploads/size_chart_img/front_patern/', '', $key);
			$name = substr($name, strpos($name, '-'));
			$name = substr($name, 0, strpos($name, '.'));
			$name = ltrim($name, '-');
			// print_r(array(ucfirst($name) => base_url() . $key));
			$front_neck_array = array_merge($front_neck_array, [ucfirst($name) => base_url() . $key]);
		}
		$back_neck_array = array();
		foreach ($back_neck as $key) {
			// print_r($key);
			$name = str_replace('uploads/size_chart_img/front_patern/', '', $key);
			$name = substr($name, strpos($name, '-'));
			$name = substr($name, 0, strpos($name, '.'));
			$name = ltrim($name, '-');
			// print_r(array(ucfirst($name) => base_url() . $key));
			$back_neck_array = array_merge($back_neck_array, [ucfirst($name) => base_url() . $key]);
		}
		$silver_neck_array = array();
		foreach ($slive_style as $key) {
			// print_r($key);
			$name = str_replace('uploads/size_chart_img/front_patern/', '', $key);
			$name = substr($name, strpos($name, '-'));
			$name = substr($name, 0, strpos($name, '.'));
			$name = ltrim($name, '-');
			// print_r(array(ucfirst($name) => base_url() . $key));
			$silver_neck_array = array_merge($silver_neck_array, [ucfirst($name) => base_url() . $key]);
		}

		$full_array = [
			'Front Neck Style*'  => $front_neck_array,
			'Back Neck Style*'   => $back_neck_array,
			'Silver Neck Style*' => $silver_neck_array,
		];
		print_r($full_array);

		foreach ($full_array as $key => $value) {
			echo '"' . $key . '"=>[<br>';
			foreach ($value as $key1 => $value1) {
				echo '"' . $key1 . '"=>"' . $value1 . '",<br>';
			}

			echo '],<br>';
		}
		// echo base64_encode(serialize($full_array));
	}

}

/* End of file home.php */
/* Location: ./application/controllers/admin/theme/home.php */
