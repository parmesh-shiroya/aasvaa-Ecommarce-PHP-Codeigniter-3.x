<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class manageproduct extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/product_manager/m_manageproduct', 'model');
		// $this->load->library('pp_common');
		$this->load->library("pagination");

	}

	/**
	 * @param $method
	 * @param $arr
	 */
	public function _remap($method, $arr) {
		if ($method == 'upload_excel_file') {
			$this->upload_excel_file();
		} else if ($method !== 'index') {
			$this->index($method, $arr);
		} else {
			$this->index($method, $arr);
		}
	}
	/**
	 * @param $method
	 * @param $arr
	 */
	function index($method, $arr) {

		$this->data['result'] = $this->model->get_all_product();
		$assets['javascript'] = array("assetes/otherassets/js/product_box_1.js", "assetes/otherassets/js/jquery.dataTables.min.js");
		$assets['css']        = array("assetes/otherassets/css/product_box_1.css", "assetes/otherassets/css/jquery.dataTables.min.css");
		$this->load->view('admin/inc/adm_header');
		$this->load->view('admin/inc/adm_nav_start');
		$this->load->view('admin/product_manager/manage_product', $this->data);
		$this->load->view('web/contents/product_boxes/product_box_model_1');
		$this->load->view('admin/inc/adm_nav_end');
		$this->load->view('admin/inc/adm_footer', $assets);
	}

	public function upload_excel_file() {

		if (isset($_FILES["imagesFile"])) {
			if ($_FILES["imagesFile"]["error"] > 0) {
				echo "Return Code: " . $_FILES["imagesFile"]["error"] . "<br />";
			} else {
				if (file_exists($_FILES["imagesFile"]["name"])) {
					unlink($_FILES["imagesFile"]["name"]);
				}
				$storagename = "desk.xlsx";
				$name        = 'uploads/stock_update/' . time() . rand(1000, 9999) . $storagename;
				move_uploaded_file($_FILES["imagesFile"]["tmp_name"], $name);
				$uploadedStatus = 1;
				$this->read_excel_data($name);
				echo "done";
			}
		} else {
			echo "File Not Selected.";
		}

	}

	private function read_excel_data($name = "") {
		if (!empty($name)) {
			$row           = 1;
			$asins_and_map = array();
			$update_data   = array();
			if (($handle = fopen($name, "r")) !== FALSE) {
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					// print_r($data);
					$num = sizeof($data);
					if (!empty($data)) {
						if ($data[0] != 'SKU' && !empty($data[0])) {
							$sku          = (!empty($data[0])) ? $data[0] : null;
							$stock        = (!empty($data[1])) ? $data[1] : null;
							$retail_price = (!empty($data[2])) ? $data[2] : null;
							$sell_price   = (!empty($data[3])) ? $data[3] : null;

							// array_push($asin_upc_map, array($sku, $stock, $retail_price, $sell_price));

							$this->model->update_product_data($sku, $stock, $retail_price, $sell_price);
						}
					}
					$row++;
				}

				// insert_data_in_db($asin_upc_map);
				fclose($handle);
			}
		}
	}

}
