<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pp_order_formater {
	var $order_id;
	var $customer_id;
	var $order_table;

	var $sessionData;
	public function __construct($data = array()) {
		$this->ci = &get_instance();
		$this->ci->load->database();
		$this->Pp_order_formater($data);
	}

	public function Pp_order_formater($data = array()) {
		$order_id = $data[0];

		$this->order_id = $order_id;
		if (isset($data[1])) {
			$this->customer_id = $data[1];
			$this->ci->db->where('order_mst.customer_id', $data[1]);
		}
		$this->ci->db->select('order_mst.*,transaction_cart_data.id as trn_c_id,transaction_cart_data.se_data as trn_c_data');
		$this->ci->db->from('order_mst');
		$this->ci->db->where('order_mst.id', $order_id);
		$this->ci->db->order_by('order_mst.id', 'DESC');
		$this->ci->db->join('transaction_cart_data', 'transaction_cart_data.id = order_mst.trn_cart_id');
		$this->order_table = $this->ci->db->get()->row();

		$this->sessionData = $this->unserializeTrnData();
	}

	public function orderData($key) {
		if (isset($this->order_table->$key)) {
			return $this->order_table->$key;
		} else {
			return "";
		}
	}

	public function orderFrom() {
		$order_id = $this->orderData('order_id');
		return (substr($order_id, 0, 2) == 'AI') ? "National" : "International";
	}

	public function unserializeTrnData() {
		return unserialize(base64_decode($this->orderData('trn_c_data')));
	}

	public function orderCountry() {
		$country = $this->sessionData['ip_country'];
		return $this->ci->db->where('sortname', $country)->get('countries')->row()->name;
	}

	public function orderCurrency() {
		return $this->sessionData['currency_choose'];
	}

	public function orderCustomerData($key = null) {
		$customer_id   = $this->sessionData['customer_data']['customer_id'];
		$customer_data = $this->ci->db->where('id', $customer_id)->get('customers')->row_array();
		return (!empty($key)) ? $customer_data[$key] : $customer_data;
	}

	public function isCoupenUse() {
		return (isset($this->sessionData['cart_coupen_data'])) ? true : false;
	}

	public function coupenData($key) {
		return (!empty($key) && isset($this->sessionData['cart_coupen_data']->{$key})) ? $this->sessionData['cart_coupen_data']->{$key} : '';
	}

	public function coupenDiscountPrice() {
		if ($this->coupenData('discount_type') == 0) {
			$discount_amount = $this->coupenData('dis_percet_rs');
			return $amount   = $discount_amount;
		} elseif ($this->coupenData('discount_type') == 1) {
			$discount_amount = $this->coupenData('dis_percet_rs');
			return $amount   = round(($this->cartTotal() + $this->serviceCharge()) * $discount_amount) / 100;
		}
	}

	public function bill_amount() {
		return $this->cartTotal() + $this->sumCharges() - $this->coupenDiscountPrice();
	}

	public function billingAddress($key) {
		$billingAddress = $this->sessionData['checkout']['billing_address'];
		return (!empty($key)) ? $billingAddress[$key] : $billingAddress['address1'] . ', ' . $billingAddress['address2'] . ', ' . $billingAddress['city'] . '-' . $billingAddress['post_code'] . ', ' . $billingAddress['state'] . ', ' . $billingAddress['country'];
	}
	public function shippingAddress($key) {
		$shippingAddress = $this->sessionData['checkout']['shipping_address'];
		return (!empty($key)) ? $shippingAddress[$key] : $shippingAddress['address1'] . ', ' . $shippingAddress['address2'] . ', ' . $shippingAddress['city'] . '-' . $shippingAddress['post_code'] . ', ' . $shippingAddress['state'] . ', ' . $shippingAddress['country'];
	}
	public function customizeOrder() {
		return ($this->sessionData['newcart']['total_service_charges'] > 0) ? true : false;
	}
	public function serviceCharge() {
		return ($this->customizeOrder()) ? $this->sessionData['newcart']['total_service_charges'] : 0;
	}
	public function shippingCharges() {
		return (isset($this->sessionData['newcart']['total_shipping_charges'])) ? $this->sessionData['newcart']['total_shipping_charges'] : 0;
	}
	public function sumCharges() {
		return $this->serviceCharge() + $this->shippingCharges();
	}
	public function cartTotal() {
		return $this->sessionData['cart_contents']['cart_total'];
	}

	public function totalProducts() {
		return $this->sessionData['cart_contents']['total_items'];
	}

	public function allProducts() {
		$all_products = $this->sessionData['cart_contents'];
		unset($all_products['cart_total']);
		unset($all_products['total_items']);
		return $all_products;
	}

	public function productPrice($rowid, $sum = array()) {
		$product = $this->allProducts()[$rowid];

		$productPrice   = $product['subtotal'];
		$serviceCharge  = 0;
		$shippingCharge = 0;
		if (isset($this->sessionData['newcart']['services_expenses'][$product['rowid']])) {
			$serviceCharge = $this->sessionData['newcart']['services_expenses'][$product['rowid']] * $product['qty'];
		}
		if (isset($this->sessionData['newcart']['shipping_charge'][$product['rowid']])) {
			$shippingCharge = $this->sessionData['newcart']['shipping_charge'][$product['rowid']] * $product['qty'];
		}
		$returnValue = $productPrice;
		foreach ($sum as $key => $value) {
			$returnValue = $returnValue+$$value;
		}

		return $returnValue;
	}

	public function productServiceCharge($rowid, $with_qty = false) {
		$serviceCharge = 0;
		if (isset($this->sessionData['newcart']['services_expenses'][$rowid])) {
			$serviceCharge = $this->sessionData['newcart']['services_expenses'][$rowid];
		}
		if ($with_qty) {
			$product       = $this->allProducts()[$rowid];
			$serviceCharge = $serviceCharge * $product['qty'];
		}
		return $serviceCharge;
	}
	public function productShippingCharge($rowid, $with_qty = false) {
		$shippingCharge = 0;
		if (isset($this->sessionData['newcart']['shipping_charge'][$rowid])) {
			$shippingCharge = $this->sessionData['newcart']['shipping_charge'][$rowid];
		}
		if ($with_qty) {
			$product        = $this->allProducts()[$rowid];
			$shippingCharge = $shippingCharge * $product['qty'];
		}
		return $shippingCharge;
	}
	public function taxPercent($rowid) {
		if ($this->productServiceCharge($rowid, true) > 0) {
			return 5;
		}
		return 0;
	}
	public function taxChargesRs($rowid) {
		$tax = 0;
		if ($this->productServiceCharge($rowid, true) > 0) {
			$product_price = $this->productPrice($rowid, ['serviceCharge', 'shippingCharge']);
			$tax           = round(($product_price * $this->taxPercent($rowid)) / 100);
		}
		return $tax;
	}
	public function serviceData($row_id, $inDetail = null) {
		$product = $this->allProducts()[$rowId];
		if (isset($product['options'])) {
			foreach ($product['options'] as $opt_key => $opt_value) {
				if ($opt_value[$opt_key . 'radio'] == 'standard') {
					echo "<div>Standard $opt_key</div>";
					$standard_sizes_keys = explode("#", $opt_value[$opt_key . '_standard_sizes_name']);
					array_pop($standard_sizes_keys);
					foreach ($standard_sizes_keys as $s_size_key => $s_size_value) {
						$size_value = $opt_value[$opt_key . str_replace(" ", "_", $s_size_value)];
						echo "<div class='g8fs12 p-padding_l_10 grey-text text-darken-2'>$s_size_value : $size_value</div>";
					}
				} else if ($opt_value[$opt_key . 'radio'] == 'customize') {
					$customize_id   = $this->sessionData['cart']['product_' . $row_id]['mesurement_select_data'][0];
					$customize_data = $this->ci->db->where('id', $customize_id)->get('customer_mesurement')->row();
					echo "<div>Customize $opt_key";
					if (isset($order_trn_data['cart']['product_' . $product['rowid']]['mesurement_select_data'])) {
						echo " : <span>" . $customize_data->name . " (" . $customize_data->no . ")</span>";
					}
					echo "</div>";
				} else {
					echo "<div class='opacity5'>Unstitched $opt_key </div>";
				}
			}
		} else {
			return 'Unstitched Product.';
		}
	}

	public function convertRsCurrency($rs) {
		$this->ci->load->library('Ccr');
		return $this->ci->ccr->cfa($this->sessionData['currency'], $rs, $this->orderCurrency(), false);
	}
}

/* End of file Pp_loader_helper.php */
/* Location: ./application/libraries/Pp_loader_helper.php */
