<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_report extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * @return mixed
	 */
	public function get_all_orders_count() {
		return $this->db->select('status, count(status) as total')
		            ->group_by('status')
		            ->order_by('id', 'desc')
		            ->where("STR_TO_DATE(order_mst.date, '%d-%m-%Y')   BETWEEN STR_TO_DATE('" . $_SESSION['adm']['report_data']['start_date'] . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $_SESSION['adm']['report_data']['end_date'] . "', '%d-%m-%Y')")
		            ->get('order_mst')->result();
	}

	/**
	 * @param $order_status
	 */
	public function get_total_sales_price_by_status($group_by = 'order_mst.date', $select = '') {
		$this->db->select('order_mst.date,count(order_mst.id) as total_orders ,SUM(bill_amount) as total_sale');
		$this->db->select($select);
		$this->db->select('SUM(CASE WHEN order_mst.status = "4" OR  order_mst.status = "11" OR order_mst.status = "16" THEN bill_amount ELSE 0 END) ta_delivered');
		$this->db->select('SUM(CASE WHEN order_mst.status = "12" OR  order_mst.status = "13" OR order_mst.status = "14" OR order_mst.status = "15" THEN bill_amount ELSE 0 END) ta_return');
		$this->db->select('SUM(CASE WHEN order_mst.status = "0" OR  order_mst.status = "1" OR order_mst.status = "2" OR order_mst.status = "3" OR order_mst.status = "5" OR order_mst.status = "6" OR order_mst.status = "8"  THEN bill_amount ELSE 0 END) ta_other');
		$this->db->select('SUM(CASE WHEN order_mst.status = "7"  THEN bill_amount ELSE 0 END) ta_cancel');
		$this->db->select('SUM(CASE WHEN order_mst.status = "4" OR  order_mst.status = "11" OR order_mst.status = "16" THEN 1 ELSE 0 END) s_delivered');
		$this->db->select('SUM(CASE WHEN order_mst.status = "12" OR  order_mst.status = "13" OR order_mst.status = "14" OR order_mst.status = "15" THEN 1 ELSE 0 END) s_return');
		$this->db->select('SUM(CASE WHEN order_mst.status = "0" OR  order_mst.status = "1" OR order_mst.status = "2" OR order_mst.status = "3" OR order_mst.status = "5" OR order_mst.status = "6" OR order_mst.status = "8" THEN 1 ELSE 0 END) s_other');
		$this->db->select('SUM(CASE WHEN order_mst.status = "7"  THEN 1 ELSE 0 END) s_cancel');
		$this->db->from('order_mst');
		$this->db->where("STR_TO_DATE(order_mst.date, '%d-%m-%Y')   BETWEEN STR_TO_DATE('" . $_SESSION['adm']['report_data']['start_date'] . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $_SESSION['adm']['report_data']['end_date'] . "', '%d-%m-%Y')");
		$this->db->where('order_finance_seprate', 1);
		$this->db->order_by('order_mst.id', 'Asc');
		$this->db->group_by($group_by);
		$this->db->join('rep_order_finance', 'rep_order_finance.order_id = order_mst.id');
		return $this->db->get()->result_array();
	}
	/**
	 * @return mixed
	 */
	public function get_order_codAndPrepaid_profit() {
		$this->db->select('order_mst.date,count(order_mst.id) as total_orders,order_mst.payment_from,order_mst.status, SUM(bill_amount) as total_sale');
		$this->db->from('order_mst');
		$this->db->where("STR_TO_DATE(order_mst.date, '%d-%m-%Y')   BETWEEN STR_TO_DATE('" . $_SESSION['adm']['report_data']['start_date'] . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $_SESSION['adm']['report_data']['end_date'] . "', '%d-%m-%Y')");
		$this->db->where('order_finance_seprate', 1);
		$this->db->where('(status = 4 OR status = 16 OR status = 11)');
		$this->db->order_by('order_mst.id', 'Asc');
		$this->db->group_by('order_mst.payment_from');
		$this->db->join('rep_order_finance', 'rep_order_finance.order_id = order_mst.id');

		return $this->db->get()->result();
	}

	/**
	 * @return mixed
	 */
	public function get_varient_skus() {
		$this->db->select('pro_sku,product_id,sum(qty) as total_qty,count(id) as total_orders,order_month');
		$this->db->from('order_product_data');
		$this->db->where("STR_TO_DATE(order_date, '%d-%m-%Y')   BETWEEN STR_TO_DATE('" . $_SESSION['adm']['report_data']['start_date'] . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $_SESSION['adm']['report_data']['end_date'] . "', '%d-%m-%Y')");
		$this->db->order_by('sum(qty)', 'DESC');
		$this->db->group_by('pro_sku');
		$this->db->limit(10);
		return $this->db->get()->result();
	}

// Get customer who buy something  In Selected time
	/**
	 * @param $limit
	 */
	public function get_customer_WBS($limit = 0) {
		if ($limit != 0) {
			$this->db->limit($limit);
		}
		return $this->db->select('rep_order_finance.order_date,count(rep_order_finance.id) as total_orders,sum(rep_order_finance.total_products) as total_products,sum(rep_order_finance.bill_amount) as total_bill_amount,customers.id as customer_id,customers.first_name,customers.last_name,customers.email_id')
		            ->from('rep_order_finance')

		            ->select('SUM(CASE WHEN order_mst.status = "4" OR  order_mst.status = "11" OR order_mst.status = "16" THEN bill_amount ELSE 0 END) ta_delivered')
		            ->select('SUM(CASE WHEN order_mst.status = "12" OR  order_mst.status = "13" OR order_mst.status = "14" OR order_mst.status = "15" THEN bill_amount ELSE 0 END) ta_return')
		            ->select('SUM(CASE WHEN order_mst.status = "0" OR  order_mst.status = "1" OR order_mst.status = "2" OR order_mst.status = "3" OR order_mst.status = "5" OR order_mst.status = "6" OR order_mst.status = "8"  THEN bill_amount ELSE 0 END) ta_other')
		            ->select('SUM(CASE WHEN order_mst.status = "7"  THEN bill_amount ELSE 0 END) ta_cancel')
		            ->select('SUM(CASE WHEN order_mst.status = "4" OR  order_mst.status = "11" OR order_mst.status = "16" THEN 1 ELSE 0 END) s_delivered')
		            ->select('SUM(CASE WHEN order_mst.status = "12" OR  order_mst.status = "13" OR order_mst.status = "14" OR order_mst.status = "15" THEN 1 ELSE 0 END) s_return')
		            ->select('SUM(CASE WHEN order_mst.status = "0" OR  order_mst.status = "1" OR order_mst.status = "2" OR order_mst.status = "3" OR order_mst.status = "5" OR order_mst.status = "6" OR order_mst.status = "8"  THEN 1 ELSE 0 END) s_other')
		            ->select('SUM(CASE WHEN order_mst.status = "7"  THEN 1 ELSE 0 END) s_cancel')

		            ->group_by('rep_order_finance.customer_id')
		            ->order_by('sum(rep_order_finance.bill_amount)', 'DESC')
		            ->where("STR_TO_DATE(rep_order_finance.order_date, '%d-%m-%Y')   BETWEEN STR_TO_DATE('" . $_SESSION['adm']['report_data']['start_date'] . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $_SESSION['adm']['report_data']['end_date'] . "', '%d-%m-%Y')")
		            ->join('order_mst', 'order_mst.id = rep_order_finance.order_id')
		            ->join('customers', 'customers.id = rep_order_finance.customer_id')
		            ->get()->result();
	}

	/**
	 * @param  $customer_id
	 * @return mixed
	 */
	public function get_customer_orders($customer_id = 0) {
		if ($customer_id != 0) {
			$this->db->where('order_mst.customer_id', $customer_id);
		}
		return $this->db->select('rep_order_finance.order_date,rep_order_finance.order_order_id,rep_order_finance.total_products,order_mst.payment_from,rep_order_finance.bill_amount,customers.id,customers.first_name,customers.last_name,customers.email_id')
		            ->from('rep_order_finance')
		            ->select('(CASE WHEN order_mst.status = "4" OR  order_mst.status = "11" OR order_mst.status = "16" THEN "Delivered" WHEN order_mst.status = "12" OR  order_mst.status = "13" OR order_mst.status = "14" OR order_mst.status = "15" THEN "Return" WHEN order_mst.status = "0" OR  order_mst.status = "1" OR order_mst.status = "2" OR order_mst.status = "3" OR order_mst.status = "5" OR order_mst.status = "6" OR order_mst.status = "8"  THEN "Other" WHEN order_mst.status = "4" OR  order_mst.status = "11" OR order_mst.status = "7" THEN "Cancel" END) as order_status')
		            ->order_by('rep_order_finance.order_id', 'DESC')
		            ->where("STR_TO_DATE(rep_order_finance.order_date, '%d-%m-%Y')   BETWEEN STR_TO_DATE('" . $_SESSION['adm']['report_data']['start_date'] . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $_SESSION['adm']['report_data']['end_date'] . "', '%d-%m-%Y')")
		            ->join('order_mst', 'order_mst.id = rep_order_finance.order_id')
		            ->join('customers', 'customers.id = rep_order_finance.customer_id')
		            ->get()->result();
	}
	//====================================================
	//============== Behaviour Report ====================
	//====================================================
	/**
	 * @return mixed
	 */
	public function get_top_search($limit = 0) {
		if ($limit != 0) {
			$this->db->limit($limit);
		}
		return $this->db->select('search,product_show,count(search) as total')
		            ->group_by('search')
		            ->order_by('count(search)', 'desc')
		            ->where("STR_TO_DATE(date, '%d-%m-%Y')   BETWEEN STR_TO_DATE('" . $_SESSION['adm']['report_data']['start_date'] . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $_SESSION['adm']['report_data']['end_date'] . "', '%d-%m-%Y')")
		            ->get('rep_search')->result();
	}

	/**
	 * @return mixed
	 */
	public function get_top_search_with_few_result($limit = 0) {
		if ($limit != 0) {
			$this->db->limit($limit);
		}
		return $this->db->select('search,product_show,count(search) as total')
		            ->group_by('search')
		            ->order_by('count(search)', 'desc')
		            ->order_by("STR_TO_DATE(date, '%d-%m-%Y')")
		            ->where("STR_TO_DATE(date, '%d-%m-%Y')   BETWEEN STR_TO_DATE('" . $_SESSION['adm']['report_data']['start_date'] . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $_SESSION['adm']['report_data']['end_date'] . "', '%d-%m-%Y')")
		            ->where("product_show = '0'")

		            ->get('rep_search')->result();
	}

	/**
	 * @return mixed
	 */
	public function get_customer_with_fill_cart($limit = 0) {
		if ($limit != 0) {
			$this->db->limit($limit);
		}
		return $this->db->select('new_cart.customer_id,new_cart.total_product,new_cart.insert_date,customers.id,customers.first_name,customers.last_name,customers.email_id')
		            ->from('new_cart')
		            ->order_by('new_cart.total_product', 'desc')
		            ->where("STR_TO_DATE(new_cart.insert_date, '%d-%m-%Y')   BETWEEN STR_TO_DATE('" . $_SESSION['adm']['report_data']['start_date'] . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $_SESSION['adm']['report_data']['end_date'] . "', '%d-%m-%Y')")
		            ->where("new_cart.total_product != '0'")
		            ->join('customers', 'customers.id = new_cart.customer_id')

		            ->get()->result();
	}

	/**
	 * @return mixed
	 */
	public function get_page_report() {
		return $this->db->select('page_report.page,count(page_report.page) as total_reach')
		            ->from('page_report')
		            ->order_by('count(page_report.page)', 'desc')
		            ->group_by('page_report.page')
		            ->where("STR_TO_DATE(page_report.date, '%d-%m-%Y')   BETWEEN STR_TO_DATE('" . $_SESSION['adm']['report_data']['start_date'] . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $_SESSION['adm']['report_data']['end_date'] . "', '%d-%m-%Y')")

		            ->get()->result();
	}

	/**
	 * @return mixed
	 */
	public function get_page_report_by_page($page) {
		return $this->db->select('page_report.page,page_report.date,page_report.other_data,customers.id,customers.first_name,customers.last_name,customers.email_id')
		            ->from('page_report')
		            ->where('page_report.page', $page)
		            ->order_by('id', 'desc')
		            ->where("STR_TO_DATE(page_report.date, '%d-%m-%Y') BETWEEN STR_TO_DATE('" . $_SESSION['adm']['report_data']['start_date'] . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $_SESSION['adm']['report_data']['end_date'] . "', '%d-%m-%Y')")
		            ->join('customers', 'customers.id = page_report.customer_id')
		            ->get()->result();
	}

//====================================================
	//============== Visitor Report ====================
	//====================================================
	//
	/**
	 * @return mixed
	 */
	public function get_dateWisevisitors() {
		return $this->db->select('count(id) as total_visitor, sum(stay_time) as total_time_spend ,date')
		            ->select('SUM(CASE WHEN country = "IN" THEN 1 ELSE 0 END) indian_visitors')
		            ->select('SUM(CASE WHEN country != "IN" THEN 1 ELSE 0 END) ocountry_visitors')

		            ->select('SUM(CASE WHEN browser = "Firefox" OR browser = "Mozilla" THEN 1 ELSE 0 END) firefox_visitors')
		            ->select('SUM(CASE WHEN browser = "Chrome" THEN 1 ELSE 0 END) chrome_visitors')
		            ->select('SUM(CASE WHEN browser = "Opera" THEN 1 ELSE 0 END) opera_visitors')
		            ->select('SUM(CASE WHEN browser = "Internet Explorer" THEN 1 ELSE 0 END) ie_visitors')
		            ->select('SUM(CASE WHEN browser = "Safari" THEN 1 ELSE 0 END) safari_visitors')
		            ->select('SUM(CASE WHEN browser = "Other" THEN 1 ELSE 0 END) other_browser_visitors')

		            ->select('SUM(CASE WHEN platform = "Windows" THEN 1 ELSE 0 END) windows_visitors')
		            ->select('SUM(CASE WHEN platform = "Mac" THEN 1 ELSE 0 END) mac_visitors')
		            ->select('SUM(CASE WHEN platform = "Android" THEN 1 ELSE 0 END) android_visitors')
		            ->select('SUM(CASE WHEN platform = "iPhone" THEN 1 ELSE 0 END) iphone_visitors')
		            ->select('SUM(CASE WHEN platform = "Other" THEN 1 ELSE 0 END) other_platform_visitors')
		            ->where("STR_TO_DATE(date, '%d-%m-%Y') BETWEEN STR_TO_DATE('" . $_SESSION['adm']['report_data']['start_date'] . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $_SESSION['adm']['report_data']['end_date'] . "', '%d-%m-%Y')")
		            ->group_by('date')
		            ->order_by("id", 'desc')
		            ->get('rep_browser')->result();
	}

	/**
	 * @param $limit
	 */
	public function get_mostTimeSpendCustomer($limit = 0) {
		if ($limit != 0) {
			$this->db->limit($limit);
		}

		return $this->db->select('sum(stay_time) as stay_time,count(rep_browser.id) as visited_days,customers.id,customers.first_name,customers.last_name,customers.email_id')
		            ->where('customer_id != "NULL"')
		            ->order_by('sum(stay_time)', 'desc')
		            ->from('rep_browser')
		            ->group_by('customer_id')
		            ->where("STR_TO_DATE(rep_browser.date, '%d-%m-%Y') BETWEEN STR_TO_DATE('" . $_SESSION['adm']['report_data']['start_date'] . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $_SESSION['adm']['report_data']['end_date'] . "', '%d-%m-%Y')")
		            ->join('customers', 'customers.id = rep_browser.customer_id')
		            ->get()->result();
	}
	/**
	 * @return mixed
	 */
	public function get_browser_data() {
		return $this->db->select('browser, count(browser) as total')
		            ->group_by('browser')
		            ->order_by('count(platform)', 'desc')
		            ->where("STR_TO_DATE(date, '%d-%m-%Y') BETWEEN STR_TO_DATE('" . $_SESSION['adm']['report_data']['start_date'] . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $_SESSION['adm']['report_data']['end_date'] . "', '%d-%m-%Y')")
		            ->get('rep_browser')->result();
	}

	/**
	 * @return mixed
	 */
	public function get_platform_data() {
		return $this->db->select('platform, count(platform) as total')
		            ->group_by('platform')
		            ->order_by('count(platform)', 'desc')
		            ->where("STR_TO_DATE(date, '%d-%m-%Y') BETWEEN STR_TO_DATE('" . $_SESSION['adm']['report_data']['start_date'] . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $_SESSION['adm']['report_data']['end_date'] . "', '%d-%m-%Y')")
		            ->get('rep_browser')->result();
	}

	/**
	 * @return mixed
	 */
	public function get_country_data() {
		return $this->db->select('rep_browser.country, count(rep_browser.country) as total,countries.name as country_name')
		            ->group_by('rep_browser.country')
		            ->order_by('count(rep_browser.country)', 'desc')
		            ->limit(15)
		            ->where("STR_TO_DATE(rep_browser.date, '%d-%m-%Y') BETWEEN STR_TO_DATE('" . $_SESSION['adm']['report_data']['start_date'] . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $_SESSION['adm']['report_data']['end_date'] . "', '%d-%m-%Y')")
		            ->join('countries', 'countries.sortname = rep_browser.country')
		            ->get('rep_browser')->result();
	}

	/**
	 * @param $limit
	 */
	public function most_visited_ips($limit = 0) {
		if ($limit != 0) {
			$this->db->limit($limit);
		}
		return $data = $this->db->select('rep_browser.ip,count(rep_browser.id) as total_time_visit,countries.name as country,rep_browser.region,sum(rep_browser.stay_time) as total_spend_time')
		                    ->where('rep_browser.customer_id IS NULL')
		                    ->where("STR_TO_DATE(rep_browser.date, '%d-%m-%Y') BETWEEN STR_TO_DATE('" . $_SESSION['adm']['report_data']['start_date'] . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $_SESSION['adm']['report_data']['end_date'] . "', '%d-%m-%Y')")
		                    ->group_by('rep_browser.ip')
		                    ->from('rep_browser')
		                    ->join('countries', 'countries.sortname = rep_browser.country')
		                    ->order_by('count(rep_browser.id)', 'DESC')
		                    ->get()->result();

	}

	//====================================================
	//============== Customer Report ====================
	//====================================================
	/**
	 * @param $limit
	 */
	public function get_customerbyCountries($limit = 0) {
		if ($limit != 0) {
			$this->db->limit(10);
		}
		return $this->db->select('count(customers.id) as total_customers,countries.name as country_name')
		            ->select('SUM(CASE WHEN customers.gender = "male" THEN 1 ELSE 0 END) c_male')
		            ->select('SUM(CASE WHEN customers.gender = "female" THEN 1 ELSE 0 END) c_female')
		            ->select('SUM(CASE WHEN customers.gender IS NULL THEN 1 ELSE 0 END) c_gender')

		            ->select('SUM(CASE WHEN customers.login_with = "web" THEN 1 ELSE 0 END) web_login')
		            ->select('SUM(CASE WHEN customers.login_with = "facebook" THEN 1 ELSE 0 END) fb_login')
		            ->select('SUM(CASE WHEN customers.login_with = "google" THEN 1 ELSE 0 END) google_login')
		            ->select('SUM(CASE WHEN customers.login_with = "guest_login" THEN 1 ELSE 0 END) guest_login')

		            ->from('customers')
		            ->where("STR_TO_DATE(customers.date, '%d-%m-%Y') BETWEEN STR_TO_DATE('" . $_SESSION['adm']['report_data']['start_date'] . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $_SESSION['adm']['report_data']['end_date'] . "', '%d-%m-%Y')")
		            ->group_by('customers.country')
		            ->order_by('count(customers.id)', 'desc')
		            ->join('countries', 'countries.sortname = customers.country')
		            ->get()->result();
	}

	////////////////// Report Ajax //////////////////////
	/**
	 * @param $from
	 * @param $to
	 */

	public function get_sales_by_month($from, $to) {
		return $this->db->select("count(rep_order_finance.id) as total_orders , sum(total_products) as total_products,sum(product_price) as product_price, sum(service_charge) as service_charge,sum(shipping_charge) as shipping_charge,sum(discount) as discount,sum(bill_amount) as bill_amount, sum(recived) as recived,sum(remain_amount) as remain_amount,order_mst.date,rep_order_finance.order_month,status")
		            ->select('SUM(CASE WHEN discount != "0" THEN 1 ELSE 0 END) coupen_use')
		            ->select('SUM(CASE WHEN order_order_id LIKE "AF%" THEN 1 ELSE 0 END) international_order')
		            ->select('SUM(CASE WHEN order_order_id LIKE "AI%" THEN 1 ELSE 0 END) national_order')
		            ->where("STR_TO_DATE(order_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('" . $from . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $to . "', '%d-%m-%Y')")
		            ->from('order_mst')
		            ->join('rep_order_finance', 'rep_order_finance.order_id = order_mst.id')
		            ->where("(order_mst.status = 4 OR order_mst.status = 11 OR order_mst.status = 16 OR order_mst.status = 15)")
		            ->where("order_mst.order_finance_seprate", 1)
		            ->group_by('order_mst.id')
		            ->order_by('order_mst.id', 'desc')
		            ->get()->result();
	}

	/**
	 * @param  $from
	 * @param  $to
	 * @return mixed
	 */
	public function get_sales_by_product($from, $to) {
		return $this->db->select("main_cat,pro_sku,sum(sell_price) as sell_price,sum(discount_price) as discount_price,sum(customize_price) as customize_price,sum(order_product_data.qty) as order_qty,sum(shipping_charge) as shipping_charge")
		            ->select('SUM(CASE WHEN discount_price != "0" THEN 1 ELSE 0 END) coupen_use')
		            ->select('SUM(CASE WHEN order_order_id LIKE "AF%" THEN 1 ELSE 0 END) international_order')
		            ->select('SUM(CASE WHEN order_order_id LIKE "AI%" THEN 1 ELSE 0 END)
		            	national_order')
		            ->select('SUM(CASE WHEN order_mst.status = 15 THEN order_product_data.qty ELSE 0 END) return_qty')
		            ->select('SUM(CASE WHEN order_mst.status = 15 THEN (sell_price-discount_price+customize_price) ELSE 0 END) return_price')
		            ->where("STR_TO_DATE(order_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('" . $from . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $to . "', '%d-%m-%Y')")
		            ->from('order_product_data')
		            ->join('order_mst', 'order_mst.id = order_product_data.order_id')
		            ->where("(order_mst.status = 4 OR order_mst.status = 11 OR order_mst.status = 16 OR order_mst.status = 15)")
		            ->where("order_mst.order_finance_seprate", 1)
		            ->group_by('order_product_data.product_id')
		            ->order_by('count(order_product_data.id)', 'desc')
		            ->get()->result();
	}

	/**
	 * @param $from
	 * @param $to
	 */
	public function visitor_over_time($from, $to) {
		return $this->db->select('count(rep_browser.id) as total_visits,month')
		            ->where("STR_TO_DATE(date, '%d-%m-%Y') BETWEEN STR_TO_DATE('" . $from . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $to . "', '%d-%m-%Y')")
		            ->group_by('month')
		            ->order_by('rep_browser.id', 'Asc')
		            ->get('rep_browser,new_cart')->result();
	}

	/**
	 * @param $from
	 * @param $to
	 */
	public function visitors_by_location($from, $to) {
		return $this->db->select('rep_browser.country, count(rep_browser.country) as total,countries.name as country_name')
		            ->group_by('rep_browser.country')
		            ->order_by('count(rep_browser.country)', 'desc')
		            ->where("STR_TO_DATE(rep_browser.date, '%d-%m-%Y') BETWEEN STR_TO_DATE('" . $from . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $to . "', '%d-%m-%Y')")
		            ->join('countries', 'countries.sortname = rep_browser.country')
		            ->get('rep_browser')->result();
	}
	/**
	 * @param  $from
	 * @param  $to
	 * @return mixed
	 */
	public function visitor_w_reach_checkout_rep($from, $to) {
		return $this->db->select('country,month,count(id) as checkout_reach')

		            ->where("page", "Checkout")
		            ->where("STR_TO_DATE(date, '%d-%m-%Y') BETWEEN STR_TO_DATE('" . $from . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $to . "', '%d-%m-%Y')")
		            ->group_by('month')
		            ->order_by('id', 'Asc')
		            ->get('page_report')->result();
	}

	/**
	 * @param  $from
	 * @param  $to
	 * @return mixed
	 */
	public function get_top_search_fr($from, $to) {
		return $this->db->select('search,product_show,count(search) as total')
		            ->group_by('search')
		            ->order_by('count(search)', 'desc')
		            ->where("STR_TO_DATE(date, '%d-%m-%Y')   BETWEEN STR_TO_DATE('" . $from . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $to . "', '%d-%m-%Y')")
		            ->get('rep_search')->result();
	}

	/**
	 * @param  $from
	 * @param  $to
	 * @return mixed
	 */
	public function get_top_search_with_few_result_fr($from, $to) {
		return $this->db->select('search,product_show,count(search) as total')
		            ->group_by('search')
		            ->order_by('count(search)', 'desc')
		            ->order_by("STR_TO_DATE(date, '%d-%m-%Y')")
		            ->where("STR_TO_DATE(date, '%d-%m-%Y')   BETWEEN STR_TO_DATE('" . $from . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $to . "', '%d-%m-%Y')")
		            ->where("product_show = '0'")
		            ->get('rep_search')->result();
	}

	/**
	 * @param  $from
	 * @param  $to
	 * @return mixed
	 */
	function get_customer_by_countries_rep($from, $to) {
		return $this->db->select('count(customers.id) as total_customers,customers.country,countries.name as country_name')
		            ->select('SUM(CASE WHEN customers.gender = "male" THEN 1 ELSE 0 END) c_male')
		            ->select('SUM(CASE WHEN customers.gender = "female" THEN 1 ELSE 0 END) c_female')
		            ->select('SUM(CASE WHEN customers.gender IS NULL THEN 1 ELSE 0 END) c_gender')

		            ->select('SUM(CASE WHEN customers.login_with = "web" THEN 1 ELSE 0 END) web_login')
		            ->select('SUM(CASE WHEN customers.login_with = "facebook" THEN 1 ELSE 0 END) fb_login')
		            ->select('SUM(CASE WHEN customers.login_with = "google" THEN 1 ELSE 0 END) google_login')
		            ->select('SUM(CASE WHEN customers.login_with = "guest_login" THEN 1 ELSE 0 END) guest_login')

		            ->from('customers')
		            ->where("STR_TO_DATE(customers.date, '%d-%m-%Y') BETWEEN STR_TO_DATE('" . $from . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $to . "', '%d-%m-%Y')")
		            ->group_by('customers.country')
		            ->order_by('count(customers.id)', 'desc')
		            ->join('countries', 'countries.sortname = customers.country')
		            // ->join('order_mst', 'order_mst.customer_id = customers.id')
		            // ->join('rep_order_finance', 'rep_order_finance.order_id = order_mst.id')
		            ->get()->result();
	}

	/**
	 * @param  $from
	 * @param  $to
	 * @return mixed
	 */
	function get_total_sales($from, $to) {
		return $this->db->select('order_mst.customer_id,customers.country,bill_amount,customers.month')
		            ->where('(status = 4 OR status = 11 OR status = 16)')
		            ->where("STR_TO_DATE(customers.date, '%d-%m-%Y') BETWEEN STR_TO_DATE('" . $from . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $to . "', '%d-%m-%Y')")
		            ->from('order_mst')
		            ->join('customers', 'order_mst.customer_id = customers.id')
		            ->join('rep_order_finance', 'rep_order_finance.order_id = order_mst.id')
		            ->get()->result();
	}
	/**
	 * @return mixed
	 */
	function visitor_over_time_rep($from, $to) {
		return $this->db->select('rep_browser.month,count(rep_browser.id) as total_visit_time')

		            ->group_by('rep_browser.month,rep_browser.customer_id')
		            ->order_by('count(rep_browser.id)', 'desc')
		            ->where("STR_TO_DATE(rep_browser.date, '%d-%m-%Y') BETWEEN STR_TO_DATE('" . $from . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $to . "', '%d-%m-%Y')")
		            ->where('rep_browser.customer_id IS NOT null')
		            ->get('rep_browser')->result();
	}
	/**
	 * @param  $from
	 * @param  $to
	 * @return mixed
	 */
	function get_orders_data_for_cst_over_time($from, $to) {
		return $this->db->select('order_mst.customer_id,customers.country,bill_amount,customers.month,order_mst.status')
		            ->select('(CASE WHEN order_mst.status = 4 OR status = 11 OR status = 16 THEN 1 ELSE 0 END) delivered ')
		            ->select('(CASE WHEN order_mst.status = 15  THEN 1 ELSE 0 END) return_orders ')
		            ->where('(status = 4 OR status = 11 OR status = 16 OR status = 15)')
		            ->where("STR_TO_DATE(customers.date, '%d-%m-%Y') BETWEEN STR_TO_DATE('" . $from . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $to . "', '%d-%m-%Y')")
		            ->from('order_mst')
		            ->join('customers', 'order_mst.customer_id = customers.id')
		            ->join('rep_order_finance', 'rep_order_finance.order_id = order_mst.id')
		            ->get()->result();
	}

	/**
	 * @param $limit
	 */
	public function get_valuable_customers_rep($from, $to) {

		return $this->db->select('rep_order_finance.order_date,,rep_order_finance.order_month as month,count(rep_order_finance.id) as total_orders,sum(rep_order_finance.total_products) as total_products,sum(rep_order_finance.bill_amount) as total_bill_amount,customers.id as customer_id,customers.first_name,customers.last_name,customers.email_id')
		            ->from('rep_order_finance')

		            ->select('SUM(CASE WHEN order_mst.status = "4" OR  order_mst.status = "11" OR order_mst.status = "16" THEN bill_amount ELSE 0 END) ta_delivered')
		            ->select('SUM(CASE WHEN order_mst.status = "12" OR  order_mst.status = "13" OR order_mst.status = "14" OR order_mst.status = "15" THEN bill_amount ELSE 0 END) ta_return')
		            ->select('SUM(CASE WHEN order_mst.status = "0" OR  order_mst.status = "1" OR order_mst.status = "2" OR order_mst.status = "3" OR order_mst.status = "5" OR order_mst.status = "6" OR order_mst.status = "8"  THEN bill_amount ELSE 0 END) ta_other')
		            ->select('SUM(CASE WHEN order_mst.status = "7"  THEN bill_amount ELSE 0 END) ta_cancel')
		            ->select('SUM(CASE WHEN order_mst.status = "4" OR  order_mst.status = "11" OR order_mst.status = "16" THEN 1 ELSE 0 END) s_delivered')
		            ->select('SUM(CASE WHEN order_mst.status = "12" OR  order_mst.status = "13" OR order_mst.status = "14" OR order_mst.status = "15" THEN 1 ELSE 0 END) s_return')
		            ->select('SUM(CASE WHEN order_mst.status = "0" OR  order_mst.status = "1" OR order_mst.status = "2" OR order_mst.status = "3" OR order_mst.status = "5" OR order_mst.status = "6" OR order_mst.status = "8"  THEN 1 ELSE 0 END) s_other')
		            ->select('SUM(CASE WHEN order_mst.status = "7"  THEN 1 ELSE 0 END) s_cancel')

		            ->group_by('rep_order_finance.customer_id,rep_order_finance.order_month')
		            ->order_by('rep_order_finance.id', 'DESC')
		            ->where("STR_TO_DATE(rep_order_finance.order_date, '%d-%m-%Y')   BETWEEN STR_TO_DATE('" . $from . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $to . "', '%d-%m-%Y')")
		            ->join('order_mst', 'order_mst.id = rep_order_finance.order_id')
		            ->join('customers', 'customers.id = rep_order_finance.customer_id')
		            ->get()->result();
	}

	/**
	 * @return mixed
	 */
	public function get_order_codAndPrepaid_profit_rep($from, $to) {
		return $this->db->select('rep_order_finance.*,order_mst.status')
		            ->from('rep_order_finance')
		            ->order_by('rep_order_finance.id', 'DESC')
		            ->where('(status = 4 OR status = 11 OR status = 15 OR status = 16 )')
		            ->where("STR_TO_DATE(rep_order_finance.order_date, '%d-%m-%Y')   BETWEEN STR_TO_DATE('" . $from . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $to . "', '%d-%m-%Y')")
		            ->join('order_mst', 'order_mst.id = rep_order_finance.order_id')
		            ->get()->result();
	}

	public function get_total_orderes_that_delivered($from, $to) {
		return $this->db->select('rep_order_finance.*,order_mst.*')
		            ->from('rep_order_finance')
		            ->order_by('rep_order_finance.id', 'DESC')
		            ->where('(status = 4 OR status = 11 OR status = 12 OR status = 13  OR status = 14  OR status = 15 OR status = 16 )')
		            ->where("STR_TO_DATE(rep_order_finance.order_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('" . $from . "', '%d-%m-%Y')  AND STR_TO_DATE('" . $to . "', '%d-%m-%Y')")
		            ->join('order_mst', 'order_mst.id = rep_order_finance.order_id')
		            ->get()->result();
	}

	public function get_single_order_trn_data($order_id) {
		return $this->db->select('rep_order_finance.*,order_mst.*,order_mst.id as order_id,customers.*')
		            ->from('rep_order_finance')
		            // ->where('(status = 4 OR status = 11 OR status = 12 OR status = 13  OR status = 14  OR status = 15 OR status = 16 )')
		            ->where("order_order_id", $order_id)
		            ->where("order_mst.order_finance_seprate", 1)
		            ->join('order_mst', 'order_mst.id = rep_order_finance.order_id')
		            ->join('customers', 'customers.id = rep_order_finance.customer_id')
		            ->get()->row();
	}

}