<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Pp_common {

	function __construct() {
		$this->CI = &get_instance();
		$this->CI->load->library('image_lib');
		$this->CI->load->database();
	}

	/**
	 * @param  $file_inputs
	 * @param  $upload_path
	 * @return mixed
	 */
	public function upload_product_image($file_inputs, $upload_path = "uploads/") {
		if (!empty($file_inputs) || $file_inputs != null) {
			$uploadData = array();
			for ($i = 0; $i < count($file_inputs['name']); $i++) {
				$_FILES['image_file']['name']     = trim(md5($file_inputs['name'][$i] . time()) . $file_inputs['name'][$i]);
				$_FILES['image_file']['type']     = $file_inputs['type'][$i];
				$_FILES['image_file']['tmp_name'] = $file_inputs['tmp_name'][$i];
				$_FILES['image_file']['error']    = $file_inputs['error'][$i];
				$_FILES['image_file']['size']     = $file_inputs['size'][$i];

				// $upload_path = 'uploads/pro_image/orignal/';
				$config['upload_path']   = $upload_path;
				$config['allowed_types'] = 'jpg|png|jpeg';
				//$config['max_size']	= '100';
				//$config['max_width'] = '1024';
				//$config['max_height'] = '768';
				$this->CI->load->library('upload');
				$this->CI->upload->initialize($config);
				if ($this->CI->upload->do_upload('image_file')) {
					$fileData       = $this->CI->upload->data();
					$uploadData[$i] = $fileData;

				}

			}
			return $uploadData;
		}
	}
// ////////////////// Generate Thumbnails ////////////////////////
	/**
	 * @param $image_paths
	 * @param $new_name
	 * @param $new_paths_and_size
	 */
	public function resize_image($image_paths, $new_name, $new_paths_and_size, $main_tain_ratio = TRUE) {
		for ($i = 0; $i < count($image_paths); $i++) {
			$file = $image_paths[$i];

			// $new_paths_and_size = array('uploads/pro_image/94_130/' => array(94, 130), 'uploads/pro_image/200_275/' => array(200, 275), 'uploads/pro_image/230_400/' => array(270, 400), 'uploads/pro_image/900_1200/' => array(900, 1200));
			$configs['image_library']  = 'gd2';
			$configs['create_thumb']   = FALSE;
			$configs['maintain_ratio'] = $main_tain_ratio;

			/////////////////////////////////////////
			foreach ($new_paths_and_size as $key => $value) {
				if (copy($file, $key . $new_name[$i])) {
					$configs['source_image'] = $key . $new_name[$i];
					if ($value[1] !== 0) {
						$configs['height'] = $value[1];
					}
					$configs['width'] = $value[0];

					$this->CI->image_lib->clear();
					$this->CI->image_lib->initialize($configs);
					$this->CI->image_lib->resize();
					$this->CI->image_lib->clear();

				}
			}
		}
	}
	// ////////////////// End Generate Thumbnails ////////////////////////
	// ////////////////// Send Email ////////////////////////

	/**
	 * @param  $from
	 * @param  $to
	 * @param  $subject
	 * @param  $message
	 * @param  $name
	 * @return int
	 */
	function sendEmail($from, $to, $subject, $message, $name = NULL) {
		$config = Array(
//            'protocol' => 'smtp',
			//            'smtp_host' => 'ssl://smtp.googlemail.com',
			//            'smtp_port' => 465,
			//            'smtp_user' => 'vishaltesting7@gmail.com', // change it to yours
			//            'smtp_pass' => 'vishal789', // change it to yours
			'mailtype' => 'html',
			'charset'  => 'iso-8859-1',
			'wordwrap' => TRUE,
		);

		$this->CI->load->library('email', $config);
		$this->CI->email->set_newline("\r\n");
		$this->CI->email->from($from, $name);
		$this->CI->email->to($to);
		$this->CI->email->subject($subject);
		$this->CI->email->message($message);
		if ($this->CI->email->send()) {
			return 1;
		} else {
			$this->CI->email->send(FALSE);
			$this->CI->email->print_debugger(array('headers'));
			return 0;
		}
	}
	// ////////////////// End Send Email ////////////////////////
	// ////////////////// Send SMS ////////////////////////
	/**
	 * @param $mob_no
	 * @param $message
	 */
	public function send_sms($mob_no, $message) {
		$username = "AASVAAFASHION";

		$password = "9723643270";

		$message = $message;

		$sender = "AASVAA"; //ex:INVITE

		$mobile_number = $mob_no;

		$url = "login.bulksmsgateway.in/sendmessage.php?user=" . urlencode($username) . "&password=" . urlencode($password) . "&mobile=" . urlencode($mobile_number) . "&message=" . urlencode($message) . "&sender=" . urlencode($sender) . "&type=" . urlencode('3');

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$curl_scraped_page = curl_exec($ch);

		curl_close($ch);
		return json_decode($curl_scraped_page);

	}
	// ////////////////// End Send SMS ////////////////////////
	//
	/**
	 * @param $order_id
	 */
	public function send_order_status_message($order_id, $order_status) {
		$order_mst = $this->CI->db->select('order_mst.*,transaction_cart_data.id as trn_c_id,transaction_cart_data.se_data as trn_c_data')
		                  ->from('order_mst')
		                  ->where('order_mst.id', $order_id)
		                  ->order_by('order_mst.id', 'DESC')
		                  ->join('transaction_cart_data', 'transaction_cart_data.id = order_mst.trn_cart_id')
		                  ->get()->row();
		$trn_data      = unserialize(base64_decode($order_mst->trn_c_data));
		$customer_data = $this->CI->db->where('id', $order_mst->customer_id)
		                      ->get('customers')->row();
		$product_name = $order_mst->order_id;
		if ($trn_data['cart_contents']['total_items'] == 1) {
			foreach ($trn_data['cart_contents']['total_items'] == 1 as $key => $value) {
				if ($key != 'total_items' && $key != 'cart_total') {
					$product_name = $value['name'];
				}
			}
		}
		$message = '';
		switch ($order_status) {
		case '0':
			$message = "Your order for Aasvaa.com " . $product_name . " has been successfully placed. it will be delivered by Estimated Date. Thank you for shopping at Aasvaa.";
			break;
		case '1':
			$message = "Your order for Aasvaa.com " . $product_name . " has been Customized. The Order is been ready in few days.";
			break;
		case '3':
			$courier_info   = $this->CI->db->where('order_id', $order_id)->get('zepo_courier_order_info')->row();
			$courier_info_2 = $this->CI->db->where('order_id', $order_id)->get('zepo_courier_order_info')->row();
			$message        = "Your package with Aasvaa.com " . $product_name . " has been shipped via " . $courier_info_2->delivery_by . " Tracking no :- " . $courier_info->tracking_no . '.';
			break;
		case '4':
			$message = "Hi " . $customer_data->first_name . "\n Your order for  " . $product_name . " has been successfully delivered. Thank you for choosing us. \n Invoice Successfully sent to your reg. Email id.";
			break;
		case '5':
			$message = "Your order for Aasvaa.com " . $product_name . " has been On hold for some reason. We inform you in short time about your order status.";
			break;
		case '6':
			$message = "Hi " . $customer_data->first_name . "\n Your order for  " . $product_name . " is confirmed. It will be shipped soon. We will deliver it in few days.";
			break;
		case '7':
			$message = "Your Aasvaa.com " . $product_name . " has been cancelled. Please check your email for more details.";
			if ($order_mst->payment_from != 'cod') {
				$message = "Your Aasvaa.com " . $product_name . " has been cancelled. The order Amount will be refunded. We will notify you via E-mail/SMS when the refund is processed. Please check your email for more details.";
			}
			break;
		case '8':
			$message = "Your order for  " . $product_name . " will be delivered today. Pay Order Value in Cash.";
			break;
		case '11':
			$message = "You Request for return Aasvaa.com Order " . $product_name . ". We start processing your request and inform you shortly.";
			break;
		case '12':
			$message = "Your Request for return Aasvaa.com Order " . $product_name . " is Approved. we will picked up your order within 2-3 days. for Smooth return, please pack your item with original packing and Attach return slip.";
			break;
		case '13':
			$message = "Hi " . $customer_data->first_name . "\n We have Picked up your product " . $product_name . " we will keep sharing updates on your return product via Email/SMS.";
			break;
		case '14':
			$message = "Hi " . $customer_data->first_name . "\n We Recived your return product " . $product_name . ". We complete refund process shortly. Thank you for choosing us.";
			break;
		case '15':
			$message = "Hi " . $customer_data->first_name . "\n Refund Process: Rs." . $order_mst->return_com_price . ". For $product_name  has been refunded to your " . $order_mst->return_com_transfer_in . " Account. It take upto 4 business days to credit the account.";
			break;
		case '16':
			$order_status = $this->CI->db->where('order_id', $order_id)
			                     ->where('status_id', '16')
			                     ->order_by('id', 'DESC')
			                     ->get('order_status_mst')
			                     ->row();
			if ($order_status->status_text == 'By Admin') {
				$message = "Hi " . $customer_data->first_name . "\n Your Request for return Aasvaa.com Order " . $product_name . " is Cancelled. Because '" . $order_status->message . "'.";
			} else {
				$message = "Hi " . $customer_data->first_name . "\n You cancelled return request of " . $product_name . " of Aasvaa.com.";
			}

			break;
		default:
			# code...
			break;
		}
		$data = '';
		if (!empty($message)) {
			$data = $this->send_sms($customer_data->mobileno, $message);
		}
		return $data;
	}

	/**
	 * @param  $table
	 * @param  array    $data
	 * @return mixed
	 */
	public function insert_report_data($data = array()) {
		if (!empty($data)) {
			ob_start();
			system('ipconfig /all');
			$mycomsys = ob_get_contents();
			ob_clean();
			$find_mac   = "Physical"; //find the "Physical" & Find the
			$pmac       = strpos($mycomsys, $find_mac);
			$macaddress = substr($mycomsys, ($pmac + 36), 17);

			$data1 = array(
				'date'    => date('d-m-Y'),
				'time'    => date('h:i a'),
				'ip'      => $_SERVER['REMOTE_ADDR'],
				'mac'     => $macaddress,
				'country' => $_SESSION['ip_country'],
				'region'  => $_SESSION['region'],
				'month'   => date('M-Y'),
			);
			$data = array_merge($data, $data1);
			return $this->CI->db->insert('page_report', $data);
		}
		return false;
	}

	/**
	 * @param $page
	 * @param $uni_key
	 */
	public function delete_report_data($page, $uni_key) {
		ob_start();
		system('ipconfig /all');
		$mycomsys = ob_get_contents();
		ob_clean();
		$find_mac   = "Physical"; //find the "Physical" & Find the
		$pmac       = strpos($mycomsys, $find_mac);
		$macaddress = substr($mycomsys, ($pmac + 36), 17);
		return $this->CI->db->where('page', $page)->where('mac', $macaddress)->where('uni_key', $uni_key)->delete('page_report');
	}
}