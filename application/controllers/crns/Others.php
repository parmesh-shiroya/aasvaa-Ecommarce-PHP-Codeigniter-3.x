<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Others extends My_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('crons/m_crons', 'model');
	}
	public function track_order_shipment() {
		$order_data = $this->model->get_trackable_orders();
		foreach ($order_data as $key => $value) {
			$data             = $this->track_shipment_data($value->tracking_no, $value->id, $value->delivery_by);
			$del_date         = "";
			$status_date      = "";
			$last_status_date = "";
			if (sizeof($data->trackingStatus[0]->tracking_history) != $value->last_status_length) {
				$tracking_history = array_reverse($data->trackingStatus[0]->tracking_history);
				$result           = false;
				foreach ($tracking_history as $trackingkey => $trackingvalue) {
					$status_id = 2;
					$status    = "Ready to Ship";
					switch ($trackingvalue->status) {
					case 'Pickup Scheduled':
						$status_id = 2;
						$status    = "Ready to Ship";
						break;
					case 'In Transit':
						$status_id = 3;
						$status    = "In Transit";
						break;
					case 'Out For Delivery':
						$status_id = 8;
						$status    = "Out For Delivery";
						break;
					case 'Delivery Exception':
						$status_id = 9;
						$status    = "Delivery Exception";
						break;
					case 'Delivered':
						$status_id = 4;
						$status    = "Delivered";
						$del_date  = date('d-m-Y', $trackingvalue->status_date_time / 1000);
						break;
					default:
						$status_id = 2;
						$status    = "Ready to Ship";
						break;
					}
					$status_date      = date('d-m-Y', $trackingvalue->status_date_time / 1000);
					$last_status_date = $status_date;
					$indata           = array(
						'order_id'    => $value->id,
						'status_text' => 'By Zepo',
						'date'        => date('d-m-Y', ($trackingvalue->status_date_time / 1000)),
						'time'        => date('h:i a', ($trackingvalue->status_date_time / 1000)),
						'status_id'   => $status_id,
						'status'      => $status,
						'location'    => $trackingvalue->location,
						'timestamp'   => $trackingvalue->status_date_time,
						'message'     => $trackingvalue->message_detail,
					);

					$res = $this->model->get_tracking_data($value->id, $status_id, $trackingvalue->status_date_time);

					if (empty($res)) {
						echo $result = $this->model->insert_data('order_status_mst', $indata);
					}
				}
				echo $result;
				if ($result) {
					$this->model->update_data('id', $value->id, 'order_mst', array('status' => $status_id, 'last_status_date' => $last_status_date, 'delivered_date' => $del_date));
					$this->model->update_data('order_id', $value->id, 'zepo_courier_order_info', array('last_status_length' => sizeof($data->trackingStatus[0]->tracking_history)));
				}

				if (isset($status_id)) {
					$this->pp_common->send_order_status_message($value->id, $status_id);
					switch ($status_id) {
					case '3':
						$this->send_status_mail($value->id, '3');
						break;
					case '4':
						$this->send_status_mail($value->id, '4');
						break;
					default:
						# code...
						break;
					}
				}

			}
		}
	}

	/**
	 * @param  $traking_no
	 * @param  $order_id
	 * @param  $ship_prov
	 * @return mixed
	 */
	public function track_shipment_data($traking_no = "", $order_id = "", $ship_prov = "") {
		$traking_array = array(
			'Fedex'     => 1,
			'Aramex'    => 2,
			'Delhivery' => 4,
			'Dotzot'    => 6,
			'Bluedart'  => 8,
		);
		echo $ship_prov;
		echo 'http://api.couriers.zepo.in/couriers/' . $traking_array[$ship_prov] . '/track/' . $traking_no;
		if (!empty($traking_no) && !empty($order_id) && !empty($ship_prov)) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, 'http://api.couriers.zepo.in/couriers/' . $traking_array[$ship_prov] . '/track/' . $traking_no);
			$result = curl_exec($ch);
			curl_close($ch);
			return $obj = json_decode($result);
		}
	}

	//  Return Shipment traking Data //
	public function track_return_order_shipment() {
		echo "<pre>";
		$order_data = $this->model->get_return_trackable_orders();
		foreach ($order_data as $key => $value) {
			$data             = $this->track_shipment_data($value->tracking_no, $value->id, $value->delivery_by);
			$del_date         = "";
			$status_date      = "";
			$last_status_date = "";
			if (sizeof($data->trackingStatus[0]->tracking_history) != $value->last_status_length) {
				$tracking_history = array_reverse($data->trackingStatus[0]->tracking_history);
				$result           = false;
				foreach ($tracking_history as $trackingkey => $trackingvalue) {
					$status_id = 12;
					$status    = "Return Confirm";
					switch ($trackingvalue->status) {
					case 'Pickup Scheduled':
						$status_id = 12;
						$status    = "Return Confirm";
						break;
					case 'In Transit':
						$status_id = 13;
						$status    = "Return In Transit";
						break;
					case 'Out For Delivery':
						$status_id = 13;
						$status    = "Return Out For Delivery";
						break;
					case 'Delivery Exception':
						$status_id = 18;
						$status    = "Return Delivery Exception";
						break;
					case 'Delivered':
						$status_id = 14;
						$status    = "Delivered";
						break;
					default:
						$status_id = 12;
						$status    = "Return Confirm";
						break;
					}
					$status_date      = date('d-m-Y', $trackingvalue->status_date_time / 1000);
					$last_status_date = $status_date;
					$indata           = array(
						'order_id'    => $value->id,
						'status_text' => 'By Zepo',

						'date'      => date('d-m-Y', ($trackingvalue->status_date_time / 1000)),
						'time'      => date('h:i a', ($trackingvalue->status_date_time / 1000)),
						'status_id' => $status_id,
						'status'    => $status,
						'location'  => $trackingvalue->location,
						'timestamp' => $trackingvalue->status_date_time,
						'message'   => $trackingvalue->message_detail,
					);
					print_r($indata);
					$res = $this->model->get_tracking_data($value->id, $status_id, $trackingvalue->status_date_time);

					if (empty($res)) {
						echo $result = $this->model->insert_data('order_status_mst', $indata);
					}
				}
				echo $result;
				if ($result) {
					$this->model->update_data('id', $value->id, 'order_mst', array('status' => $status_id, 'last_status_date' => $last_status_date));
					$this->model->update_data('order_id', $value->id, 'zepo_return_courier_order_info', array('last_status_length' => sizeof($data->trackingStatus[0]->tracking_history)));
				}

			}
		}
	}

	/**
	 * @param $order_id
	 * @param $status_id
	 */
	private function send_status_mail($order_id, $status_id) {

		$order_id      = $order_id;
		$order_mst     = $this->model->get_order_with_id($order_id);
		$customer_data = $this->model->get_customer_data($order_mst->customer_id);
		$result        = "";
		$title         = "";
		switch ($status_id) {
		case '3':
			$title = 'Your Aasvaa Order No : ' . $order_mst->order_id . ' has been Shipped';
			$ch    = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, base_url('private/g_email_data/generate_order_shipped_mail/' . $order_id));
			$result = curl_exec($ch);
			curl_close($ch);
			break;
		case '4':
			$title = 'Your Aasvaa Order No : ' . $order_mst->order_id . ' has been Successfully Delivered';
			$ch    = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, base_url('private/g_email_data/generate_order_delivered_mail/' . $order_id));
			$result = curl_exec($ch);
			curl_close($ch);

			break;
		default:
			$result = '';
			$title  = '';
			break;
		}
		$array1      = array('&#8377', '&#8364', '&#8360');
		$array2      = array('&#8377;', '&#8364;', '&#8360;');
		$result      = str_replace($array1, $array2, $result);
		$mail_return = $this->pp_common->sendEmail('forcustomer@aasvaa.com', $customer_data->email_id, $title, $result);
		$this->output->set_content_type('application_json')
		     ->set_output(json_encode(['result' => $mail_return]));

	}
}