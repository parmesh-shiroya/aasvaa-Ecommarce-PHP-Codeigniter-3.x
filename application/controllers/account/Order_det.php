<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_det extends My_Controller {
	public function __construct() {
		parent::__construct();
		//Do your magic here
		if (!$this->pp_login_varified->customer_varified()) {
			header('location:' . site_url('account/login'));
		}

		$this->load->model('web/account/m_order_det', 'model');
	}
	/**
	 * @param $order_id
	 */
	public function index($order_id = 0) {
		$data['order_id'] = $order_id;

		$customer_id       = $this->session->userdata('customer_data')['customer_id'];
		$data['order_mst'] = $this->model->get_order_with_id($order_id, $customer_id);
		// foreach ($data['order_mst'] as $order_data) {
		// print_r($data['order_mst']);
		if ($data['order_mst']->payment_from == 'paypal') {
			$data['paypal_data'] = $this->model->get_paypal_payment_data($data['order_mst']->payment_from_data_id);
		}
		if ($data['order_mst']->payment_from == 'ccavenue') {
			$data['ccavenue_data'] = $this->model->get_ccavenue_payment_data($data['order_mst']->payment_from_data_id);
		}
		if ($data['order_mst']->status == 11 || $data['order_mst']->status == 15 || $data['order_mst']->status == 12 || $data['order_mst']->status == 16 || $data['order_mst']->status == 13 || $data['order_mst']->status == 14) {
			$data['bank_detail'] = $this->model->get_bank_details($data['order_mst']->id);
		}
		$data['customer_data'] = $this->model->get_customer_data($data['order_mst']->customer_id);

		foreach (unserialize(base64_decode($data['order_mst']->trn_c_data))['cart_contents'] as $key => $value) {
			if ($key != "cart_total" && $key != 'total_items') {
				$data['single_product_data']['id_' . $value['id']] = $this->model->get_product_data_by_id($value['id']);
				if (isset($value['options'])) {
					foreach ($value['options'] as $opt_key => $opt_value) {
						if ($opt_value[$opt_key . 'radio'] == 'customize' || $opt_value[$opt_key . 'radio'] == 'standard') {
							$data['custom_product_isset'] = true;
						}
						if ($opt_value[$opt_key . 'radio'] == 'customize') {
							if (isset(unserialize(base64_decode($data['order_mst']->trn_c_data))['cart']['product_' . $value['rowid']]['mesurement_select_data'])) {
								// print_r(unserialize(base64_decode($data['order_mst']->trn_c_data))['cart']['product_' . $value['rowid']]['mesurement_select_data']);
								$data['customize_data']['id_' . $value['id']] = $this->model->get_product_custome_mesurement(array_values(unserialize(base64_decode($data['order_mst']->trn_c_data))['cart']['product_' . $value['rowid']]['mesurement_select_data'])[0]);
							}
						}
					}
				}
			}

		}
		// }

		$headers['mobile_nav_menu'] = $this->pp_loader_helper->get_mobile_nav_menu();
		$this->load->view('web/inc/header_view', $headers);
		$this->load->view('web/contents/nav_menu', $this->pp_loader_helper->get_main_nav_menu());
		// $this->load->view('web/contents/nav_menu');
		$this->load->view('web/account/inc/header2');
		$this->load->view('web/account/order_det2', $data);
		$this->load->view('web/account/inc/footer2');
		$this->load->view('web/inc/footer_view', $this->pp_loader_helper->get_adm_prof_data());

	}

	public function cancel_order() {
		if (isset($_POST['order_data'])) {
			$order_id    = $this->pp_hash->decrypt_data($_POST['order_data']);
			$customer_id = $this->session->userdata('customer_data')['customer_id'];
			$result      = $this->model->cancel_order($order_id, $customer_id);
			$this->send_status_mail($order_id, '7');
			$this->output->set_content_type('application_json')
			     ->set_output(json_encode(['result' => $result]));
		} else {
			header("Location: " . site_url('account/'));
		}
	}
	public function return_order() {
		if (isset($_POST['order_data'])) {
			$order_id    = $this->pp_hash->decrypt_data($_POST['order_data']);
			$customer_id = $this->session->userdata('customer_data')['customer_id'];
			$result      = $this->model->return_order($order_id, $customer_id);
			$this->send_status_mail($order_id, '11');
			$this->output->set_content_type('application_json')
			     ->set_output(json_encode(['result' => $result]));
		} else {
			header("Location: " . site_url('account/'));
		}
	}
	public function messag() {
		if (isset($_POST['order_data']) && isset($_POST['message_txt_area'])) {
			$order_id    = $this->pp_hash->decrypt_data($_POST['order_data']);
			$customer_id = $this->session->userdata('customer_data')['customer_id'];
			$result      = $this->model->message_frm_cst($order_id, $customer_id, $this->input->post('message_txt_area'));
			$this->output->set_content_type('application_json')
			     ->set_output(json_encode(['result' => $result]));
		} else {
			header("Location: " . site_url('account/order_det/message'));
		}
	}

	public function get_order_status() {
		if ($this->input->post('order_id')) {
			$result = $this->model->get_order_stauts($this->input->post('order_id'));
			if (empty($result)) {
				$result = $this->model->change_status_to($this->input->post('order_id'), '0', 'Placed', 'Order Placed');
				$result = $this->model->get_order_stauts($this->input->post('order_id'));
			}
			$this->output->set_content_type('application_json')
			     ->set_output(json_encode(['result' => $result]));
		}
	}

	public function get_return_label() {

		if (isset($_POST['order_id'])) {

			$parcel_det = $this->model->get_row('order_id', $this->input->post('order_id'), 'zepo_return_courier_order_info');
			if (!empty($parcel_det)) {
				$result = true;

				$data = array(
					'id'             => $parcel_det->id,
					'order_id'       => $parcel_det->order_id,
					'order_order_id' => $parcel_det->order_order_id,
					'res_order_id'   => $parcel_det->res_order_id,
					'amount'         => $parcel_det->amount,
					'payment_mode'   => $parcel_det->payment_mode,
					'shipment_id'    => $parcel_det->shipment_id,
					'tracking_no'    => $parcel_det->tracking_no,
					'data'           => unserialize(base64_decode($parcel_det->data))->shipments[0]->shipmentPackages->forward_label,
					'date'           => $parcel_det->date,
					'time'           => $parcel_det->time,

				);
			} else {
				$result = false;
				$data   = array();
			}

			$this->output->set_content_type('application_json')
			     ->set_output(json_encode(['result' => $result, 'data' => $data]));
		}

	}

	function add_bank_detail() {
		if ($this->input->post('account_holde_name') && $this->input->post('order_data')) {
			$this->output->set_content_type('application_json');
			$form_rules = array(
				array(
					'field'  => 'account_holde_name',
					'label'  => 'Account Holder Name',
					'rules'  => 'trim|required|min_length[2]',
					'errors' => array(
						'required' => 'You must provide a %s.',
					),
				),
				array(
					'field'  => 'account_no',
					'label'  => 'Account No',
					'rules'  => 'trim|required|numeric|min_length[5]',
					'errors' => array(
						'required' => 'You must provide a %s.',
					),
				),
				array(
					'field'  => 'confirm_account_no',
					'label'  => 'Confirm Account Number',
					'rules'  => 'trim|required|min_length[2]|numeric|matches[account_no]',
					'errors' => array(
						'required' => 'You must provide a %s.',
						'matches'  => 'Account No Not match.',
					),
				),
				array(
					'field'  => 'ifsc_code',
					'label'  => 'IFSC Code',
					'rules'  => 'trim|required|min_length[4]',
					'errors' => array(
						'required'   => 'You must provide a %s.',
						'min_length' => 'Please Write full %s',
					),
				),
			);
			$keys   = array();
			$values = array();

			$this->form_validation->set_rules($form_rules);
			if ($this->form_validation->run() == FALSE) {
				$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
			} else {
				$order_id       = $this->pp_hash->decrypt_data($_POST['order_data']);
				$customer_id    = $this->session->userdata('customer_data')['customer_id'];
				$order_order_id = $this->pp_hash->decrypt_data($_POST['order_order_data']);
				$array          = array(
					"customer_id"         => $customer_id,
					"order_id"            => $order_id,
					"order_order_id"      => $order_order_id,
					"payment_to"          => 'bank',
					"account_holder_name" => $this->input->post('account_holde_name'),
					"account_no"          => $this->input->post('account_no'),
					"ifsc_code"           => $this->input->post('ifsc_code'),
				);
				$check_isset = $this->model->check_bankaccount_exist($order_id, $customer_id);
				$result      = false;
				if (!empty($check_isset)) {
					$result = $this->model->update_bank_account_detail($order_id, $customer_id, $array);
				} else {
					$result = $this->model->insert_bank_details($array);
				}
				$this->output->set_output(json_encode(['result' => $result]));
			}
		}
	}


	function add_paypal_detail() {
		if ($this->input->post('paypal_username') && $this->input->post('account_paypal_email')) {
			$this->output->set_content_type('application_json');
			$form_rules = array(
				array(
					'field'  => 'paypal_username',
					'label'  => 'Paypal Username',
					'rules'  => 'trim|required|min_length[2]',
					'errors' => array(
						'required' => 'You must provide a %s.',
					),
				),
				array(
					'field'  => 'account_paypal_email',
					'label'  => 'Paypal Email id',
					'rules'  => 'trim|required|valid_email',
					'errors' => array(
						'required' => 'You must provide a %s.',
					),
				),
				array(
					'field'  => 'paypal_mobile_no',
					'label'  => 'Paypal Mobile no',
					'rules'  => 'trim|required|min_length[10]|numeric',
					'errors' => array(
						'required' => 'You must provide a %s.',
					),
				),
			);
			$keys   = array();
			$values = array();

			$this->form_validation->set_rules($form_rules);
			if ($this->form_validation->run() == FALSE) {
				$this->output->set_output(json_encode(['result' => 0, 'errorsdata' => $this->form_validation->error_array()]));
			} else {
				$order_id       = $this->pp_hash->decrypt_data($_POST['order_data']);
				$customer_id    = $this->session->userdata('customer_data')['customer_id'];
				$order_order_id = $this->pp_hash->decrypt_data($_POST['order_order_data']);
				$array          = array(
					"customer_id"         => $customer_id,
					"order_id"            => $order_id,
					"order_order_id"      => $order_order_id,
					"payment_to"          => 'paypal',
					"paypal_username" => $this->input->post('paypal_username'),
					"paypal_email"          => $this->input->post('account_paypal_email'),
					"paypal_mobile_no"           => $this->input->post('paypal_mobile_no'),
				);
				$check_isset = $this->model->check_bankaccount_exist($order_id, $customer_id);
				$result      = false;
				if (!empty($check_isset)) {
					$result = $this->model->update_bank_account_detail($order_id, $customer_id, $array);
				} else {
					$result = $this->model->insert_bank_details($array);
				}
				$this->output->set_output(json_encode(['result' => $result]));
			}
		}
	}
/*==================================================
========= Send Mail Functions ================
 */
	/**
	 * @param $order_id
	 * @param $status
	 */
	private function send_status_mail($order_id, $status) {
		$order_id      = $order_id;
		$customer_id   = $this->session->userdata('customer_data')['customer_id'];
		$order_mst     = $this->model->get_order_with_id($order_id, $customer_id);
		$customer_data = $this->model->get_customer_data($order_mst->customer_id);
		$result        = "";
		$title         = "";
		switch ($status) {
		case '7':
			$title = 'Your Aasvaa Order No : ' . $order_mst->order_id . ' has been Cancelled';
			$ch    = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, base_url('private/g_email_data/generate_order_cancel_mail/' . $order_id));
			$result = curl_exec($ch);
			curl_close($ch);
			$this->pp_common->send_order_status_message($order_id, $status);
			break;

		case '11':
			$title = 'You Request For Return Order No : ' . $order_mst->order_id . ' Aasvaa.';
			$ch    = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, base_url('private/g_email_data/generate_order_return_request_mail/' . $order_id));
			$result = curl_exec($ch);
			curl_close($ch);
			$this->pp_common->send_order_status_message($order_id, $status);
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

	/*==================================================
		========= End Send Mail Functions ================
	*/
	public function order_invoice() {

		$content = '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!-- TemplateBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>
<div style="width: 780px;">
<table width="780px" border="0">
  <tbody>
    <tr>
      <td style="padding: 0px 12px;">
      <div style="margin: 10px 0px 7px 0px;"><h2 style="">Retail Invoices/Bill</h2></div>

         <div style="float: right; padding:7px 10px; border:dashed #000 2px;">
          <span><strong>Invoice No :</strong> # CHN_PUZHAL_0120160200008633</span>
        </div>

        <div style="margin:10px 0px; float:left; width: 100%;">
          <p>Warehouse Address: SND WAREHOUSE, SHED NO: C1, DOOR NO 4/195, REDHILLS-AMBATTUR ROAD, PUZHAL VILLAGE, CHENNAI, TAMIL NADU, India - 600062</p>
          </div>
          <div style="border-bottom: 3px solid #000000;"></div>
        </td>
    </tr>
    <tr>
      <td style="padding: 0px 10px;"><table width="100%" border="0">
        <tbody class="">
          <tr>
            <td valign="top">
            <div style="width: 233px">
             <p style="margin-top:0px"><strong>Order ID : AD201602000020</strong></p>
              <p><strong>Order Date :</strong> 01-02-2016</p>
              <p><strong>Invoice ID :</strong> AD201602000020</p>
              </div>
		  	</td>
		  <td class="address-table">
         <div style="width: 233px">
          <p><strong>Billing Address</strong></p>
          <p>Parmesh Shiroya</p>
			 <p>67, bhidbhanjan soc, near nakshtra residency, nana varachha, surat - 6,</p>
          <p>Surat 395006 Gujarat</p>
          <p>Phone: 9924756555</p>
			  </div>
           </td>
            <td class="address-table">
           	 <div style="width: 233px">
            	 <p><strong>Shipping Address</strong></p>
          <p>Parmesh Shiroya</p>
          <p>67, bhidbhanjan soc, near nakshtra residency, nana varachha, surat - 6,</p>
          <p>Surat 395006 Gujarat</p>
          <p>Phone: 9924756555</p>
				</div>
            </td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td>
      <div style="border: 1px solid #000; margin: 0px 10px;"></div>
       <table style="margin: 0 10px;" class="product-table" width="100%" border="0">
        <tbody>
          <tr class="top-title">
            <td width="11%"><strong>Product</strong></td>
            <td width="45%"><strong>Title</strong></td>
            <td width="5%"><strong>Qty</strong></td>
            <td width="11%"><strong>Price(Rs)</strong></td>
            <td width="7%"><strong>Tax(%)</strong></td>
            <td width="10%"><strong>Tax(Rs)</strong></td>
			  <td width="11%"><strong>Total(Rs)</strong></td>
          </tr>
          <tr>
            <td>AASVAA0012</td>
            <td>Aasvaa Worthy Women\'s Embroidered Net Lehenga <br> Choli With Un-Stitched Blouse</td>
            <td>1</td>
            <td>2200.00</td>
            <td>10%</td>
            <td>220.00</td>
            <td>2440.00</td>
          </tr>
          <tr>
            <td></td>
            <td><strong style="float: right">Total</strong></td>
			  <td>1</td>
            <td>2200.00</td>
            <td></td>
            <td>220.00</td>
            <td>2440.00</td>
          </tr>
        </tbody>
      </table>
      <div style="border-top: 2px solid #000; width: 100%; margin-left: auto; border-bottom: 2px solid #000;"><div style="margin-left: auto;   margin-top: 10px; float:right ;  font-size: 20px">Grand Total :- Rs.2440.00</div></div>
      </td>
    </tr>
  </tbody>
</table></div>
</body>
<style>
	.product-table td{
		padding: 5px 7px;
	}
	.product-table .top-title td{
		border-bottom: 1px solid #000;
	}

	.address-table p{

		margin: 0px;
	}
</style>
</html>


';

		require_once 'includes/pdf/vendor/autoload.php';
		$html2pdf = new HTML2PDF('P', 'A4', 'en');
		$html2pdf->WriteHTML($content);
		$html2pdf->Output('exemple.pdf');
	}

}

/* End of file Order_det.php */
/* Location: ./application/controllers/account/Order_det.php */