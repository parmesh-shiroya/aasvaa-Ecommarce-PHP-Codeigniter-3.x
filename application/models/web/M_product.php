<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_product extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	/**
	 * @param $product_id
	 */
	public function plus_view_to_product($product_id = 0) {
		$this->db->set('views', 'views+1', FALSE);
		$this->db->where('product_id', $product_id);
		$this->db->where('status', 'on');
		$this->db->where('stock !=', '0');
		$this->db->update('product_mst');
		$this->add_quick_product_view($product_id);
	}
	/**
	 * @param $prod_id
	 */
	public function add_quick_product_view($prod_id = 0) {
		$customer_id = NULL;
		if ($this->pp_login_varified->customer_varified()) {
			$customer_id = $this->session->userdata('customer_data')['customer_id'];
		}
		$data = array(
			'product_id'  => $prod_id,
			'customer_id' => $customer_id,
			'single_view' => '1',
			'date'        => date('d-m-Y'),
			'ip'          => $_SERVER['REMOTE_ADDR'],
			'time'        => date('h:i a'),
			'month'       => date('M-Y'),
		);
		if (isset($_SESSION['ip_country']) && isset($_SESSION['report']['ftq']) && isset($_SESSION['region'])) {
			$data = array_merge($data, array(
				'country' => $_SESSION['ip_country'],
				'region'  => $_SESSION['region'],
				'uni_key' => $_SESSION['report']['ftq']));
		}
		$check_data = '';
		if (isset($_SESSION['report']['ftq'])) {
			$check_data = $this->db->where('product_id', $prod_id)->where('uni_key', $_SESSION['report']['ftq'])->where('date', date('d-m-Y'))->get('rep_product_view')->row();
		}
		if (empty($check_data)) {
			$this->db->insert('rep_product_view', $data);
		} else {
			$new_single_view = $check_data->single_view + 1;
			$data            = array_merge($data, array('single_view' => $new_single_view));
			$this->db->where('product_id', $prod_id)->where('uni_key', $_SESSION['report']['ftq'])->where('date', date('d-m-Y'))->update('rep_product_view', $data);
		}
	}
	/**
	 * @param  $product_id
	 * @return mixed
	 */
	public function get_product($product_id = 0) {
		// $this->db->where('product_id', $product_id);
		// $this->db->where('status', 'on');
		// $this->db->limit(1);
		// $result = $this->db->get('product_mst');
		// return $result->row();

		$this->db->select('product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name as sub_cat_name');
		$this->db->from('product_mst');
		$this->db->where('product_id', $product_id);
		$this->db->where('status =', 'on');
		$this->db->where('stock !=', '0');
		$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = product_mst.main_cat_id');
		$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = product_mst.sub_cat_id');
		return $this->db->get()->row();
	}

	/**
	 * @param  $id
	 * @return mixed
	 */
	public function get_standard_size_chart($id) {
		$this->db->where('id', $id);
		$result = $this->db->get('adm_standard_size_charts');
		return $result->row();
	}
	/**
	 * @param $name
	 */
	public function get_product_by_home_bottom($name = "") {
		return unserialize(base64_decode($this->db->where('name', $name)->get('templete_mst')->row()->datas));
	}
	/**
	 * @param  $sub_cat_id
	 * @param  $catalogue_name
	 * @return mixed
	 */
	public function get_slider1_product($sub_cat_id = 0, $catalogue_name = "") {
		$slider_settings = $this->get_product_by_home_bottom('sin_pro_page_slider1');
		$this->db->select('product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name as sub_cat_name');
		$this->db->from('product_mst');
		$this->db->where('status =', 'on');
		$this->db->where('stock !=', '0');
		switch ($slider_settings['show_product_by']) {
		case 'random':
			$this->db->order_by('rand()');
			break;
		case 'new_product':
			$this->db->order_by("STR_TO_DATE(date, '%d-%m-%Y')");
			break;
		case 'old_product':
			$this->db->order_by("STR_TO_DATE(date, '%d-%m-%Y')", 'desc');
			break;
		case 'most_viewed':
			$this->db->order_by('views', 'desc');
			break;
		case 'most_sell':
			$this->db->order_by('product_sell', 'desc');
			break;
		case 'low_price':
			$this->db->order_by('sell_price', 'asc');
			break;
		case 'high_price':
			$this->db->order_by('sell_price', 'desc');
			break;
		case 'similar_product':
			$this->db->where('product_mst.sub_cat_id', $sub_cat_id);
			$this->db->order_by('rand()');
			break;
		case 'intrested_in':
			$this->db->where('catalogue_name', $catalogue_name);
			$this->db->order_by('rand()');
			break;
		case 'ready_to_ship':
			$this->db->where('ship_time', 'Ready To Ship');
			$this->db->order_by('rand()');
			break;
		case 'catalogue':
			$this->db->where('catalogue_name', $slider_settings['catalogue']);
			$this->db->order_by('rand()');
			break;

		default:
			$this->db->order_by('rand()');
			break;
		}

		$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = product_mst.main_cat_id');
		$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = product_mst.sub_cat_id');
		$this->db->limit($slider_settings['max']);
		return $this->db->get()->result();
	}

	/**
	 * @param  $sub_cat_id
	 * @param  $catalogue_name
	 * @return mixed
	 */
	public function get_slider2_product($sub_cat_id = 0, $catalogue_name = "") {
		$slider_settings = $this->get_product_by_home_bottom('sin_pro_page_slider2');
		$this->db->select('product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name as sub_cat_name');
		$this->db->from('product_mst');
		$this->db->where('status =', 'on');
		$this->db->where('stock !=', '0');
		switch ($slider_settings['show_product_by']) {
		case 'random':
			$this->db->order_by('rand()');
			break;
		case 'new_product':
			$this->db->order_by("STR_TO_DATE(date, '%d-%m-%Y')");
			break;
		case 'old_product':
			$this->db->order_by("STR_TO_DATE(date, '%d-%m-%Y')", 'desc');
			break;
		case 'most_viewed':
			$this->db->order_by('views', 'desc');
			break;
		case 'most_sell':
			$this->db->order_by('product_sell', 'desc');
			break;
		case 'low_price':
			$this->db->order_by('sell_price', 'asc');
			break;
		case 'high_price':
			$this->db->order_by('sell_price', 'desc');
			break;
		case 'intrested_in':
			$this->db->where('product_mst.sub_cat_id', $sub_cat_id);
			$this->db->order_by('rand()');
			break;
		case 'similar_product':
			$this->db->where('catalogue_name', $catalogue_name);
			$this->db->order_by('rand()');
			break;
		case 'ready_to_ship':
			$this->db->where('ship_time', 'Ready To Ship');
			$this->db->order_by('rand()');
			break;
		case 'catalogue':
			$this->db->where('catalogue_name', $slider_settings['catalogue']);
			$this->db->order_by('rand()');
			break;

		default:
			$this->db->order_by('rand()');
			break;
		}

		$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = product_mst.main_cat_id');
		$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = product_mst.sub_cat_id');
		$this->db->limit($slider_settings['max']);
		return $this->db->get()->result();
	}

	/**
	 * @param $product_id
	 */
	public function get_total_reviews($product_id) {
		return $this->db->select_sum('star')
		            ->where('prod_id', $product_id)
		            ->get('product_reviews');
	}
}

/* End of file m_product.php */
/* Location: ./application/models/web/m_product.php */
