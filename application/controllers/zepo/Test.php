<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends My_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('zepo/m_zepo', 'model');
	}
	public function index() {
		// $data = array();
		// $string = http_build_query($data);
		// $ch = curl_init("http://api.couriers.vello.in/initiateShipmentRequest");
		// curl_setopt($ch, CURLOPT_POST, true);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, true);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// $response = curl_exec($ch);
		// print_r($response);
		// curl_close($ch);
		// echo urlencode(utf8_encode('POST\n/initiateShipmentRequest'));
		// echo hash_hmac("sha1", "POST%0A%2Fusers%2F163%2Fpincodeservice%2Frate", 'f4d8a6d08703106f27c2cf30222ff771');
		// echo $Signature = base64_encode(hash_hmac("sha1", utf8_encode(urlencode('POST\n/initiateShipmentRequest')), 'f4d8a6d08703106f27c2cf30222ff771'));
		// // $Signature = "NTQ3ODA1ZWVhNGY1OTRhMjJlY2RiOWMzMDU2ZjMzYzU1NzRjZGM4Yw==";
		// $payloadName = array("Authorization" => "SHIPIT 44175ae22aa7f4954bf4f43977e37d64:$Signature");
		// $process = curl_init("http://api.couriers.vello.in/initiateShipmentRequest");
		// curl_setopt($process, CURLOPT_HTTPHEADER, array('Authorization: SHIPIT 44175ae22aa7f4954bf4f43977e37d64:' . $Signature, 'Content-Type: application/json'));
		// curl_setopt($process, CURLOPT_HEADER, 1);
		// // curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
		// curl_setopt($process, CURLOPT_TIMEOUT, 30);
		// curl_setopt($process, CURLOPT_POST, 1);
		// // curl_setopt($process, CURLOPT_POSTFIELDS, $payloadName);
		// curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
		// $return = curl_exec($process);
		// print_r($return);
		// echo curl_error($process);
		// curl_close($process);

		$api_key    = "44175ae22aa7f4954bf4f43977e37d64"; // ADD YOUR API KEY HERE
		$secret_key = "f4d8a6d08703106f27c2cf30222ff771"; // ADD YOUR SECRET KEY HERE
		$post_url   = "http://api.couriers.vello.in/users/3546/pincodeservice/rate"; // TESTING ENVIRONMENT
		//$post_url	=	"http://api.couriers.zepo.in/initiateShipmentRequest";	// PRODUCTION ENVIRONMENT
		$strtoSign = "POST\n/users/3546/pincodeservice/rate";
		$strtoSign = urlencode($strtoSign);
		$my_sign   = hash_hmac("sha1", $strtoSign, $secret_key);
		$my_sign   = base64_encode($my_sign);
		$header    = "Authorization:SHIPIT" . ' ' . $api_key . ':' . $my_sign;
// $this->getRequestObject()
		$request_data = array(
			"pickup_pincode"    => "395006",
			"delivery_pincode"  => "400003",
			"invoice_value"     => 1,
			"payment_mode"      => "online",
			"insurance"         => "false",
			"number_of_package" => 1,
			"package_details"   => array(array(
				"package_content"   => "Description",
				"no_of_items"       => 1,
				"invoice_value"     => 1,
				"package_dimension" => array(
					"weight" => 1,
					"height" => 6,
					"length" => 35,
					"width"  => 30,
				),
			)),
			"product_type"      => "Parcel",
		);
		$data = json_encode($request_data);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $post_url);
		//curl_setopt($ch, CURLOPT_POST, 1);
//		curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //Post Fields
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$headers = [
			'Accept-Encoding: gzip, deflate',
			'Accept-Language: en-US,en;q=0.5',
			'Cache-Control: no-cache',
			'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
			'X-MicrosoftAjax: Delta=true',
			$header,
			'Content-Type:application/json',
		];

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$server_output = curl_exec($ch);
		curl_close($ch);
		print_r($server_output);
	}

	/**
	 * @param $pincode
	 * @param $type
	 * @param $weight
	 */
	private function request_to_zepo($url_data, $request_data) {
		$api_key    = "90bf0b34ae100cff1e66cd4ce3c88a07"; // ADD YOUR API KEY HERE
		$secret_key = "1f98ee3866e684d6a92097721e69140b"; // ADD YOUR SECRET KEY HERE
		$post_url   = "http://api.couriers.zepo.in/" . $url_data; // TESTING ENVIRONMENT
		// $post_url  = "http://api.couriers.zepo.in/initiateShipmentRequest"; // PRODUCTION ENVIRONMENT
		$strtoSign = "GET\n/" . $url_data;
		$strtoSign = urlencode($strtoSign);
		$my_sign   = hash_hmac("sha1", $strtoSign, $secret_key);
		$my_sign   = base64_encode($my_sign);
		$header    = "Authorization:SHIPIT" . ' ' . $api_key . ':' . $my_sign;
		$data      = json_encode($request_data);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $post_url);
		//curl_setopt($ch, CURLOPT_POST, 1);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //Post Fields
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$headers = [
			'Accept-Encoding: gzip, deflate',
			'Accept-Language: en-US,en;q=0.5',
			'Cache-Control: no-cache',
			'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
			'X-MicrosoftAjax: Delta=true',
			$header,
			'Content-Type:application/json',
		];

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$server_output = curl_exec($ch);
		curl_close($ch);

		return $server_output;
	}
	public function getCourierOrderInfo($order_code, $order_id = 10001, $order_order_id = "AI20001", $return = false) {

		// $url = "http://api.couriers.vello.in/orders/" . $order_code . "?details=true";
		// $ch  = curl_init();
		// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($ch, CURLOPT_URL, $url);
		// $result = curl_exec($ch);
		// curl_close($ch);

		echo $server_output = $this->request_to_zepo("orders/" . $order_code . "?details=true", array());
		$obj                = json_decode($server_output);
		if ($obj->success) {
			$data = array(
				'order_id'       => $order_id,
				'order_order_id' => $order_order_id,
				'res_order_id'   => $order_code,
				'amount'         => $obj->amount,
				'payment_mode'   => $obj->paymentMode,
				'shipment_id'    => $obj->shipments[0]->shipment_id,
				'tracking_no'    => $obj->shipments[0]->shipmentPackages->tracking_number,
				'data'           => base64_encode(serialize($obj)),
				'date'           => date('d-m-Y'),
				'time'           => date('h:i a'),
			);
			if ($return) {
				// $this->model->delete_row('order_id', $order_id, 'zepo_return_courier_order_info');
				// $this->model->insert_data('zepo_return_courier_order_info', $data);
			} else {
				// $this->model->delete_row('order_id', $order_id, 'zepo_courier_order_info');
				// $this->model->insert_data('zepo_courier_order_info', $data);
			}
		}
	}
}