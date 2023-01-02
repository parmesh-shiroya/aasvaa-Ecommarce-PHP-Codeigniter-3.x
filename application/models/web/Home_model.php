<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}
	/**
	 * @return mixed
	 */
	public function get_product() {
		$this->db->select('product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name as sub_cat_name');
		$this->db->from('product_mst');
		$this->db->where('status =', 'on');
		$this->db->where('stock !=', '0');
		$this->db->order_by('product_mst.views', 'DESC');
		$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = product_mst.main_cat_id');
		$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = product_mst.sub_cat_id');
		$this->db->limit(0, 18);
		return $this->db->get();
	}
	public function get_product_by_home_bottom() {
		return unserialize(base64_decode($this->db->where('name', 'home_bottom_product')->get('templete_mst')->row()->datas));
	}
	/**
	 * @return mixed
	 */
	public function get_product_home_bottom() {
		$slider_settings = $this->get_product_by_home_bottom();
		$this->db->select('product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name as sub_cat_name');
		$this->db->from('product_mst');
		$this->db->where('stock !=', '0');
		$this->db->where('status =', 'on');
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
		return $this->db->get();
	}

	/**
	 * @return mixed
	 */
	public function get_mobile_nav_menu() {
		$this->db->where('name', 'mobile_nav_menu');
		return $this->db->get('templete_mst')->row();
	}

	/**
	 * @return mixed
	 */
	public function get_random_product() {
		$this->db->select('product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name as sub_cat_name');
		$this->db->from('product_mst');
		$this->db->where('status =', 'on');
		$this->db->where('stock !=', '0');
		$this->db->order_by('rand()');
		$this->db->join('main_cat_mst', 'main_cat_mst.main_cat_id = product_mst.main_cat_id');
		$this->db->join('sub_cat_mst', 'sub_cat_mst.sub_cat_id = product_mst.sub_cat_id');
		$this->db->limit(8);
		$obja = $this->db->get();
		return $obja->result();
	}
	public function get_slider_product_by_det() {
		return unserialize(base64_decode($this->db->where('name', 'home_product_slider')->get('templete_mst')->row()->datas));
	}
	/**
	 * @return mixed
	 */
	public function get_slider_product() {
		$slider_settings = $this->get_slider_product_by_det();
		$this->db->select('product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name as sub_cat_name');
		$this->db->from('product_mst');
		$this->db->where('stock !=', '0');
		$this->db->where('status =', 'on');
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
		$obja = $this->db->get();
		return $obja->result();

	}

	public function get_slider_product_by_det2() {
		return unserialize(base64_decode($this->db->where('name', 'home_product_slider2')->get('templete_mst')->row()->datas));
	}
	/**
	 * @return mixed
	 */
	public function get_slider_product2() {
		$slider_settings = $this->get_slider_product_by_det2();
		$this->db->select('product_mst.*,main_cat_mst.cat_name,sub_cat_mst.cat_name as sub_cat_name');
		$this->db->from('product_mst');
		$this->db->where('stock !=', '0');
		$this->db->where('status =', 'on');
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
		$obja = $this->db->get();
		return $obja->result();

	}

	/**
	 * @param  $name
	 * @return mixed
	 */
	public function get_theme_data($name = "") {
		$this->db->where('name', $name);
		return $this->db->get('templete_mst')->row();
	}

	/**
	 * @return mixed
	 */
	public function get_main_slide_images() {
		$this->db->or_where('b_keys', 'home_slider_0');
		$this->db->or_where('b_keys', 'home_slider_1');
		$this->db->or_where('b_keys', 'home_slider_2');
		$this->db->or_where('b_keys', 'home_slider_3');
		$this->db->or_where('b_keys', 'home_slider_4');
		return $this->db->get('banner_mst')->result();
	}

	/**
	 * @return mixed
	 */
	public function get_main_home_3_banner() {
		$this->db->or_where('b_keys', 'home_3_banner_0');
		$this->db->or_where('b_keys', 'home_3_banner_1');
		$this->db->or_where('b_keys', 'home_3_banner_2');

		return $this->db->get('banner_mst')->result();
	}

	/**
	 * @return mixed
	 */
	public function get_main_home_2_banner() {
		$this->db->or_where('b_keys', 'home_2_banner_0');
		$this->db->or_where('b_keys', 'home_2_banner_1');
		return $this->db->get('banner_mst')->result();
	}
	/**
	 * @return mixed
	 */
	public function get_banner_5_images() {
		for ($i = 0; $i < 5; $i++) {
			$this->db->or_where('b_keys', 'home_5banner' . $i);
		}
		$this->db->order_by('id');
		return $this->db->get('banner_mst')->result();
	}

	/**
	 * @return mixed
	 */
	public function get_main_home_2big_banner() {
		$this->db->or_where('b_keys', 'home_2big_banner_0');
		$this->db->or_where('b_keys', 'home_2big_banner_1');
		return $this->db->get('banner_mst')->result();
	}

}

/* End of file home_model.php */
/* Location: ./application/models/web/home_model.php */
