<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Refresh_order_data extends My_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('crons/m_crons', 'model');
	}
	public function index() {
		$order_data = $this->model->get_new_orders();
		foreach ($order_data as $orders) {
			$trn_c_data = unserialize(base64_decode($orders->trn_c_data));
			// echo "<pre>";
			// print_r($trn_c_data);
			foreach ($trn_c_data['cart_contents'] as $key => $value) {
				if ($key != "cart_total" && $key != "total_items") {
					$product_data = $this->model->get_product_data($value['id']);
					$old_date     = DateTime::createFromFormat('d-m-Y', $orders->date);
					$old_date->format('M-Y');
					$data = array(
						"row_id"         => $value['rowid'],
						"trn_c_id"       => $orders->trn_c_id,
						"order_id"       => $orders->id,
						"order_order_id" => $orders->order_id,
						"customer_id"    => $trn_c_data['customer_data']['customer_id'],
						"customer_email" => $trn_c_data['customer_data']['email'],
						"product_id"     => $value['id'],
						"main_cat"       => $product_data->cat_name,
						"sub_cat"        => $product_data->sub_cat_name,
						"pro_name"       => $value['name'],
						"qty"            => $value['qty'],
						"pro_desc"       => $product_data->product_desc,
						"pro_sku"        => $value['sku'],
						"pro_img"        => $value['image'],
						"mrp"            => $product_data->mrp,
						"sell_price"     => $value['price'],
						"ship_time"      => $product_data->ship_time,
						"ship_charge"    => $value['ship_charge'],
						"inter_ship"     => $value['inter_ship_charge'],
						"standard_size"  => $product_data->standard_size_show_in,
						"customize_size" => $product_data->customize_show_in,
						"pro_details"    => $product_data->product_details,
						"know_product"   => $product_data->know_product,
						"product_faq"    => $product_data->product_faq,
						"catalogue_name" => $product_data->catalogue_name,
						"order_date"     => $orders->date,
						"order_month"    => $old_date->format('M-Y'),
						"weight"         => $value['weight'],
						'date'           => date('d-m-Y'),
						'time'           => date('h:i:s a'),
					);
					if (isset($trn_c_data['newcart']['services_expenses'][$value['rowid']])) {
						$data = array_merge($data, array('customize_price' => $trn_c_data['newcart']['services_expenses'][$value['rowid']]));
					}
					if (isset($trn_c_data['newcart']['shipping_charge'][$value['rowid']])) {
						$data = array_merge($data, array('shipping_charge' => $trn_c_data['newcart']['shipping_charge'][$value['rowid']]));
					}

					if (isset($trn_c_data['cart_coupen_data'])) {
						if ($trn_c_data['cart_coupen_data']->discount_type == 0) {
							$dis_total = $trn_c_data['cart_coupen_data']->dis_percet_rs;
						} elseif ($trn_c_data['cart_coupen_data']->discount_type == 1) {
							$dis_total = round(($trn_c_data['cart_contents']['cart_total'] + $trn_c_data['newcart']['total_service_charges']) * $trn_c_data['cart_coupen_data']->dis_percet_rs / 100);
						}
						$a_discount = round($dis_total / $trn_c_data['cart_contents']['total_items']);
						$data       = array_merge($data, array('discount_price' => $a_discount));
					}

					$this->model->insert_data('order_product_data', $data);
				}
			}
			$this->model->update_data('id', $orders->id, 'order_mst', array('order_data_seprate' => '1'));
		}
	}

	public function RefreshFinanceReportOfOrders() {
		$order_data = $this->model->getOrdersForFinaceReport();
		foreach ($order_data as $orders) {
			$a_product_price = $a_service_charge = $a_shipping_charge = $a_net_total = $a_discount = $a_bill_amount = $a_recived = $a_total_products = $a_remain_amount = 0;
			if ($orders->payment_from == 'paypal') {
				$paypal_data = $this->model->get_paypal_payment_data($orders->payment_from_data_id);
			}
			if ($orders->payment_from == 'ccavenue') {
				$ccavenue_data = unserialize(base64_decode($this->model->get_ccavenue_payment_data($orders->payment_from_data_id)->datas));
			}
			$order_trn_data        = unserialize(base64_decode($orders->trn_c_data));
			$order_trn_return_data = unserialize(base64_decode($orders->trn_return_data));
			$a_total_products      = $paid_by_amt      = $order_trn_data['cart_contents']['total_items'];
			$a_product_price       = $paid_by_amt       = $order_trn_data['cart_contents']['cart_total'];
			$remian_amt            = $paid_by_amt;
			$a_service_charge      = $service_amt      = $order_trn_data['newcart']['total_service_charges'];
			$remian_amt            = $remian_amt + $service_amt;
			$a_shipping_charge     = $shipping_charge_amt     = $order_trn_data['newcart']['total_shipping_charges'];
			$a_net_total           = $remian_amt           = $remian_amt + $shipping_charge_amt;
			if (isset($order_trn_data['cart_coupen_data'])) {
				if ($order_trn_data['cart_coupen_data']->discount_type == 0) {
					$dis_total = $order_trn_data['cart_coupen_data']->dis_percet_rs;
				} elseif ($order_trn_data['cart_coupen_data']->discount_type == 1) {
					$dis_total = round(($order_trn_data['cart_contents']['cart_total'] + $order_trn_data['newcart']['total_service_charges']) * $order_trn_data['cart_coupen_data']->dis_percet_rs / 100);
				}
				$a_discount = $dis_total;
				$remian_amt = $remian_amt - $dis_total;
			}
			$a_bill_amount = $remian_amt;
			if ($orders->payment_from == 'paypal') {
				$a_recived = $paid_by_amt = round((1 / $order_trn_data['currency']['USD']) * $order_trn_return_data['get']['amt']);

				$remian_amt = $remian_amt - $paid_by_amt;
			} else if ($orders->payment_from == 'ccavenue') {
				$a_recived  = $paid_by_amt  = $ccavenue_data['amount'];
				$remian_amt = $remian_amt - $paid_by_amt;
			}
			$a_remain_amount = $remian_amt;

			$old_date = DateTime::createFromFormat('d-m-Y', $orders->date);
			$old_date->format('M-Y');

			$insert_data = array(
				"order_id"        => $orders->id,
				"order_order_id"  => $orders->order_id,
				"order_date"      => $orders->date,
				"order_month"     => $old_date->format('M-Y'),
				"payment_from"    => $orders->payment_from,
				"customer_id"     => $orders->customer_id,
				"total_products"  => $a_total_products,
				"product_price"   => $a_product_price,
				"service_charge"  => $a_service_charge,
				"shipping_charge" => $a_shipping_charge,
				"net_total"       => $a_net_total,
				"discount"        => $a_discount,
				"bill_amount"     => $a_bill_amount,
				"recived"         => $a_recived,
				"remain_amount"   => $a_remain_amount,
				"date"            => date('d-m-Y'),
				"time"            => date('h:i a'),
			);
			echo "<pre>";
			print_r($insert_data);
			echo "</pre>";
			$check_data = $this->model->get_row('order_id', $orders->id, 'rep_order_finance');
			if (empty($check_data)) {
				if ($this->model->insert_data('rep_order_finance', $insert_data)) {
					$this->model->update_data('id', $orders->id, 'order_mst', array('order_finance_seprate' => 1));
				}
			}

		}
	}
}