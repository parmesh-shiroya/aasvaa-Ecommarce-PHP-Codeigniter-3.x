<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pp_loader_helper {

	public function __construct() {
		$this->ci = &get_instance();
		$this->ci->load->database();
	}

	/**
	 * @return mixed
	 */
	public function get_adm_prof_data() {
		$prof_data = array();
		$get_data  = array('shop_add', 'mobile_no', 'customer_support_email', 'contact_person_name', 'add_email', 'company_name', 'address1', 'address2', 'add_city', 'add_state', 'add_pincode', 'add_country', 'add_contactno');
		foreach ($get_data as $key => $value) {
			$this->ci->db->where('pro_key', $value);
			$prof_data[$value] = $this->ci->db->get('adm_profile')->row()->pro_value;
		}
		return $prof_data;
	}
	/**
	 * @return mixed
	 */
	public function get_shipping_charge() {
		return $this->ci->db->order_by('id', 'desc')->get('shipping_charge')->row();
	}

	public function get_mobile_nav_menu() {
		return unserialize(base64_decode($this->ci->db->where('name', 'mobile_nav_menu')->get('templete_mst')->row()->datas));
	}
	public function get_main_nav_menu() {
		return array("menu_data" => unserialize(base64_decode($this->ci->db->where('name', 'main_nav_menu')->get('templete_mst')->row()->datas)));
	}

	/**
	 * @return mixed
	 */
	public function get_top_message() {
		return unserialize(base64_decode($this->ci->db->where('name', 'top_message_1')->get('templete_mst')->row()->datas));
	}
	/**
	 * @param $status
	 */
	public function get_order_status($status = 0) {
		switch ($status) {
		case '0':
			return 'Placed';
			break;
		case '1':
			return 'Customize Work';
			break;
		case '2':
			return 'Ready To Shipped';
			break;
		case '3':
			return 'In Transit';
			break;
		case '4':
			return 'Delivered';
			break;
		case '5':
			return 'On Hold';
			break;
		case '6':
			return 'Confirm';
			break;
		case '7':
			return 'Canceled';
			break;
		case '8':
			return 'Out For Deliverey';
			break;
		case '9':
			return 'Exception';
			break;

		case '11':
			return 'Return Request';
			break;

		case '12':
			return 'Return Confirmed';
			break;

		case '13':
			return 'In Transit';
			break;

		case '14':
			return 'Return Recived';
			break;

		case '15':
			return 'Return';
			break;

		case '16':
			return 'Return Refused';
			break;
		}
	}
	/**
	 * @param $status
	 */
	public function set_order_status($status = 0) {
		switch ($status) {
		case '0':
			return '<span class="font13 p-padding_lr_1rem p-padding_5 border-round  light-blue white-text">Placed</span>';
			break;
		case '1':
			return '<span class="font13 p-padding_lr_1rem p-padding_5 border-round teal lighten-1 white-text">Customize Work</span>';
			break;
		case '2':
			return '<span class="font13 p-padding_lr_1rem p-padding_5 border-round  deep-purple  white-text">Ready To Shipped</span>';
			break;
		case '3':
			return '<span class="font13 p-padding_lr_1rem p-padding_5 border-round deep-orange lighten-1 white-text">In Transit</span>';
			break;
		case '4':
			return '<span class="font13 p-padding_lr_1rem p-padding_5 border-round green lighten-1 white-text">Delivered</span>';
			break;
		case '5':
			return '<span class="font13 p-padding_lr_1rem p-padding_5 border-round amber lighten-1 white-text">On Hold</span>';
			break;
		case '6':
			return '<span class="font13 p-padding_lr_1rem p-padding_5 border-round green lighten-1 white-text">Confirm</span>';
			break;
		case '7':
			return '<span class="font13 p-padding_lr_1rem p-padding_5 border-round red lighten-1 white-text">Canceled</span>';
			break;
		case '8':
			return '<span class="font13 p-padding_lr_1rem p-padding_5 border-round orange lighten-1 white-text">Out For Deliverey</span>';
			break;
		case '9':
			return '<span class="font13 p-padding_lr_1rem p-padding_5 border-round red lighten-1 white-text">Exception</span>';
			break;

		case '11':
			return '<span class="font13 p-padding_lr_1rem p-padding_5 border-round red lighten-1 white-text">Return Request</span>';
			break;

		case '12':
			return '<span class="font13 p-padding_lr_1rem p-padding_5 border-round amber lighten-1 white-text">Return Confirmed</span>';
			break;

		case '13':
			return '<span class="font13 p-padding_lr_1rem p-padding_5 border-round green lighten-1 white-text">In Transit</span>';
			break;

		case '14':
			return '<span class="font13 p-padding_lr_1rem p-padding_5 border-round blue lighten-1 white-text">Return Recived</span>';
			break;

		case '15':
			return '<span class="font13 p-padding_lr_1rem p-padding_5 border-round red lighten-1 white-text">Return Complete</span>';
			break;

		case '16':
			return '<span class="font13 p-padding_lr_1rem p-padding_5 border-round red lighten-1 white-text">Return Refused</span>';
			break;
		}
	}

	/**
	 * @return mixed
	 */
	public function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP')) {
			$ipaddress = getenv('HTTP_CLIENT_IP');
		} else if (getenv('HTTP_X_FORWARDED_FOR')) {
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		} else if (getenv('HTTP_X_FORWARDED')) {
			$ipaddress = getenv('HTTP_X_FORWARDED');
		} else if (getenv('HTTP_FORWARDED_FOR')) {
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		} else if (getenv('HTTP_FORWARDED')) {
			$ipaddress = getenv('HTTP_FORWARDED');
		} else if (getenv('REMOTE_ADDR')) {
			$ipaddress = getenv('REMOTE_ADDR');
		} else {
			$ipaddress = 'UNKNOWN';
		}

		return $ipaddress;
	}

	/**
	 * @param $key
	 */
	function product_slider_title_writer($key) {

		switch ($key) {
		case 'new_product':
			return 'New Products';
			break;
		case 'most_viewed':
			return 'Most Viewed';
			break;
		case 'most_sell':
			return 'Best Seller';
			break;
		case 'ready_to_ship':
			return 'Ready To Ship';
			break;
		case 'similar_product':
			return 'Similar Products';
			break;
		case 'intrested_in':
			return 'You may interested in';
			break;
		default:
			return '';
			break;
		}

	}

	/**
	 * @return mixed
	 */
	public function get_bulksms_balance() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, 'http://login.bulksmsgateway.in/userbalance.php?user=AASVAAFASHION&password=9723643270&type=3');
		$result = curl_exec($ch);
		curl_close($ch);
		return $obj = json_decode($result)->remainingcredits;
	}
}

/* End of file Pp_loader_helper.php */
/* Location: ./application/libraries/Pp_loader_helper.php */
