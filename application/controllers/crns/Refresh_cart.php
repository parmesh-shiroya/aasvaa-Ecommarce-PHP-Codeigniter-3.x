<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Refresh_cart extends My_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('crons/m_crons', 'model');
	}
	public function index() {
		$cart_data = $this->model->get_all_cart_data();
		foreach ($cart_data as $cart_rows) {
			$cart_id  = $cart_rows->id;
			$new_cart = array();
			foreach (unserialize(base64_decode($cart_rows->cart)) as $key => $value) {
				print_r($value);
				$product_data = $this->model->get_product_data($value['id']);
				$value        = array_merge($value, array('price' => $product_data->sell_price));
				$value        = array_merge($value, array('image' => $product_data->pro_img));
				$value        = array_merge($value, array('sku' => $product_data->product_sku));
				$value        = array_merge($value, array('ship_charge' => $product_data->sell_price));
				$value        = array_merge($value, array('weight' => $product_data->weight));
				$value        = array_merge($value, array('inter_ship_charge' => $product_data->sell_price));
				$value        = array_merge($value, array('subtotal' => $product_data->sell_price * $value['qty']));
				$date1        = date_create($value['date']);
				$date2        = date_create(date('d-m-Y'));
				$diff         = date_diff($date1, $date2);
				$diff         = $diff->format("%a");
				if ($diff > 3) {
					$value = array_merge($value, array('adm_status' => 'off'));
				} else {
					$value = array_merge($value, array('adm_status' => 'on'));
				}
				$new_cart = array_merge($new_cart, array($key => $value));
			}
			$serialize_data = base64_encode(serialize($new_cart));
			$this->model->update_cart($cart_id, array("cart" => $serialize_data, "refresh_cart_date" => date('d-m-Y')));
		}
	}

	// $paymentDate = DateTime::createFromFormat('d-m-Y', date('d-m-Y', strtotime($paymentDate)));
	// 		//echo $paymentDate; // echos today!
	// 		$contractDateBegin = DateTime::createFromFormat('d-m-Y', date('d-m-Y', strtotime($coupen_data->valid_from)));
	// 		$contractDateEnd = DateTime::createFromFormat('d-m-Y', date('d-m-Y', strtotime($coupen_data->valid_to)));
	// 		if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd)) {
}

/* End of file refresh_cart.php */
/* Location: ./application/controllers/crns/refresh_cart.php */