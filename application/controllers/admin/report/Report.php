<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	public function __construct() {
		parent::__construct();
		//Do your magic here
		if (!$this->pp_login_varified->admin_varified()) {
			header('location:' . site_url('admin/login'));
		}
		$this->load->model('admin/m_report', 'model');
	}
	public function index() {
		if ($this->input->get('data')) {
			$function = $this->input->get('data');
			$this->$function();
		}
	}
//===========================================================//
	//====================== Sales Report =======================//
	//===========================================================//
	private function sales_by_month() {
		if ($this->input->get('from') && $this->input->get('to')) {
			$x_axis_data = array();
			$dates       = $this->get_date_between_date($this->input->get('from'), $this->input->get('to'));

			$return['chart_label'] = 'Total Sales';
			$sales_by_month        = $this->model->get_sales_by_month($this->input->get('from'), $this->input->get('to'));
			// echo json_encode($sales_by_month);
			$y_axis_data            = array();
			$return['table_header'] = array("Month", "Orders", "Gross Sales", "Discount", "Refunds", "Net Sales", "Shipping", "Total sales", "Ordered quantity", "Net quantity");
			$table_data             = array();
			foreach ($dates as $dates_key => $dates_value) {
				array_push($x_axis_data, $dates_value);
				$y_axis_string   = 0;
				$month           = "";
				$orders          =
				$gross_sales     =
				$discount        =
				$refunds         =
				$net_sales       =
				$shipping        =
				$total_sales     =
				$order_qty       =
				$return_products =
				$net_qty         = 0;
				foreach ($sales_by_month as $key => $value) {
					$month = $sales_month = date("M-Y", strtotime($value->date));

					if ($sales_month == $dates_value) {
						$orders += $value->total_orders;
						$gross_sales += $value->product_price + $value->service_charge;
						$discount += $value->discount;
						if ($value->status == 15) {
							$refunds += $value->product_price + $value->service_charge;
							$return_products = $value->total_products;
							$shipping -= $value->shipping_charge;
						}
						$net_sales = (($gross_sales - $discount) - $refunds);
						$shipping += $value->shipping_charge;
						$y_axis_string = $total_sales = $net_sales + $shipping;
						$order_qty += $value->total_products;
						$net_qty = $order_qty - $return_products;
					}
				}
				array_push($y_axis_data, $y_axis_string);
				$push_data = array($dates_value, $orders, $this->ccr->cc("INR", "INR", $gross_sales), $this->ccr->cc("INR", "INR", $discount), $this->ccr->cc("INR", "INR", $refunds), $this->ccr->cc("INR", "INR", $net_sales), $this->ccr->cc("INR", "INR", $shipping), $this->ccr->cc("INR", "INR", $total_sales), $order_qty, $net_qty);
				array_push($table_data, $push_data);
			}
			$return['x_axis_data'] = $x_axis_data;
			$return['y_axis_data'] = $y_axis_data;
			$return['table_data']  = $table_data;
			echo json_encode($return);
		}
	}

	private function sales_by_product() {
		if ($this->input->get('from') && $this->input->get('to')) {

			$sales_by_product = $this->model->get_sales_by_product($this->input->get('from'), $this->input->get('to'));
			// echo json_encode($sales_by_product);
			$x_axis_data            = array();
			$y_axis_data            = array();
			$return['table_header'] = array("Product Type", "Variant SKU", "Net quantity", "Gross sales", "Discounts", "Refunds", "Net Sales", "Tax", "Total Sales", "Ordered quantity");
			$table_data             = array();
			$x_axis_string          = "";
			$y_axis_string          = 0;
			$product_type           =
			$varient_sku            = "";
			$net_qty                =
			$gross_sales            =
			$discount               =
			$refunds                =
			$net_sales              =
			$tax                    =
			$total_sales            =
			$order_qty              = 0;

			foreach ($sales_by_product as $key => $value) {
				$x_axis_string = $value->main_cat . " " . $value->pro_sku;
				$product_type  = $value->main_cat;
				$varient_sku   = $value->pro_sku;
				$net_qty       = $value->order_qty - $value->return_qty;
				$gross_sales   = $value->sell_price + $value->customize_price;
				$discount      = $value->discount_price;
				$refunds       = $value->return_price;
				$net_sales     = $gross_sales - $discount - $refunds;
				$tax           = 0;
				$y_axis_string = $total_sales = $net_sales;
				$order_qty     = $value->order_qty;
				array_push($x_axis_data, $x_axis_string);
				array_push($y_axis_data, $y_axis_string);
				$push_data = array(
					$product_type,
					$varient_sku,
					$net_qty,
					$this->ccr->cc("INR", "INR", $gross_sales),
					$this->ccr->cc("INR", "INR", $discount),
					$this->ccr->cc("INR", "INR", $refunds),
					$this->ccr->cc("INR", "INR", $net_sales),
					$this->ccr->cc("INR", "INR", $tax),
					$this->ccr->cc("INR", "INR", $y_axis_string),
					$order_qty,
				);
				array_push($table_data, $push_data);
			}
			$return['chart_label'] = 'Total Sales';
			$return['x_axis_data'] = $x_axis_data;
			$return['y_axis_data'] = $y_axis_data;
			$return['table_data']  = $table_data;
			echo json_encode($return);
		}
	}

	//===========================================================//
	//====================== End Sales Report =======================//
	//===========================================================//
	//===========================================================//
	//====================== Visitors Reports =======================//
	//===========================================================//
	private function visitor_over_time() {
		if ($this->input->get('from') && $this->input->get('to')) {
			$visitor_data     = $this->model->visitor_over_time($this->input->get('from'), $this->input->get('to'));
			$visitor_wrc_data = $this->model->visitor_w_reach_checkout_rep($this->input->get('from'), $this->input->get('to'));
			// echo json_encode($visitor_data);
			$x_axis_data = array();
			$dates       = $this->get_date_between_date($this->input->get('from'), $this->input->get('to'));

			$y_axis_data            = array();
			$return['table_header'] = array("Month", "Visitors", "Checkouts");
			$table_data             = array();
			foreach ($dates as $datekey => $datevalue) {
				array_push($x_axis_data, $datevalue);
				$y_axis_string = 0;
				$month         = $datevalue;
				$visitors      =
				$checkouts     = 0;
				foreach ($visitor_data as $vdkey => $vdvalue) {
					if ($vdvalue->month == $datevalue) {
						$visitors = $y_axis_string = $vdvalue->total_visits;
						break;
					}
				}
				foreach ($visitor_wrc_data as $vwrckey => $vwrcvalue) {
					if ($vwrcvalue->month == $datevalue) {
						$checkouts = $vwrcvalue->checkout_reach;
						break;
					}
				}
				array_push($y_axis_data, $y_axis_string);
				$push_data = array($month, $visitors, $checkouts);
				array_push($table_data, $push_data);
			}

			$return['chart_label'] = 'Visitors';
			$return['x_axis_data'] = $x_axis_data;
			$return['y_axis_data'] = $y_axis_data;
			$return['table_data']  = $table_data;
			echo json_encode($return);
		}

	}

	private function visitors_by_location() {
		if ($this->input->get('from') && $this->input->get('to')) {
			$visitors_by_location   = $this->model->visitors_by_location($this->input->get('from'), $this->input->get('to'));
			$visitors_check_reach   = $this->model->visitor_w_reach_checkout_rep($this->input->get('from'), $this->input->get('to'));
			$x_axis_data            = array();
			$y_axis_data            = array();
			$return['table_header'] = array("Country", "Visitors", "Checkouts");
			$table_data             = array();
			$country                = "";
			$visitors               =
			$checkouts              = 0;

			foreach ($visitors_by_location as $key => $value) {
				array_push($x_axis_data, $value->country_name);
				array_push($y_axis_data, $value->total);
				$country  = $value->country_name;
				$visitors = $value->total;
				foreach ($visitors_check_reach as $key1 => $value1) {
					if ($value1->country == $value->country) {
						$checkouts = $value1->checkout_reach;
					}
				}
				$push_data = array($country, $visitors, $checkouts);
				array_push($table_data, $push_data);

			}
			$return['chart_label'] = 'Visitors';
			$return['x_axis_data'] = $x_axis_data;
			$return['y_axis_data'] = $y_axis_data;
			$return['table_data']  = $table_data;
			echo json_encode($return);

		}
	}
	//===========================================================//
	//====================== End Visitor Reports =======================//
	//===========================================================//
	//===========================================================//
	//====================== Start Behaviour Report =======================//
	//===========================================================//
	private function get_top_search() {
		if ($this->input->get('from') && $this->input->get('to')) {
			$top_searches = $this->model->get_top_search_fr($this->input->get('from'), $this->input->get('to'));

			$x_axis_data            = array();
			$y_axis_data            = array();
			$return['table_header'] = array("Keyword", "Total Search", "Products");
			$table_data             = array();
			foreach ($top_searches as $key => $value) {
				array_push($x_axis_data, ucfirst($value->search));
				array_push($y_axis_data, $value->total);
				$array_data = array(ucfirst($value->search), $value->total, $value->product_show);
				array_push($table_data, $array_data);
			}
			$return['chart_label'] = 'Total Search';
			$return['x_axis_data'] = $x_axis_data;
			$return['y_axis_data'] = $y_axis_data;
			$return['table_data']  = $table_data;
			echo json_encode($return);
		}
	}

	private function get_top_search_with_zero_result() {
		if ($this->input->get('from') && $this->input->get('to')) {
			$top_searches = $this->model->get_top_search_with_few_result_fr($this->input->get('from'), $this->input->get('to'));

			$x_axis_data            = array();
			$y_axis_data            = array();
			$return['table_header'] = array("Keyword", "Total Search", "Products");
			$table_data             = array();
			foreach ($top_searches as $key => $value) {
				array_push($x_axis_data, ucfirst($value->search));
				array_push($y_axis_data, $value->total);
				$array_data = array(ucfirst($value->search), $value->total, $value->product_show);
				array_push($table_data, $array_data);
			}
			$return['chart_label'] = 'Total Search';
			$return['x_axis_data'] = $x_axis_data;
			$return['y_axis_data'] = $y_axis_data;
			$return['table_data']  = $table_data;
			echo json_encode($return);
		}
	}
	//===========================================================//
	//====================== End Behaviour Report =======================//
	//===========================================================//
	//===========================================================//
	//====================== Start Customer Report =======================//
	//===========================================================//

	/**
	 * @param $from
	 * @param $to
	 */
	private function get_customer_by_countries() {
		if ($this->input->get('from') && $this->input->get('to')) {
			$customer_by_countries = $this->model->get_customer_by_countries_rep($this->input->get('from'), $this->input->get('to'));
			$get_total_sales       = $this->model->get_total_sales($this->input->get('from'), $this->input->get('to'));
			// echo json_encode($get_total_sales);
			$x_axis_data            = array();
			$y_axis_data            = array();
			$return['table_header'] = array("Country", "Customers", "Orders", "Orders Value");
			$table_data             = array();
			foreach ($customer_by_countries as $key => $value) {
				array_push($x_axis_data, $value->country_name);
				$total_order_amount = 0;
				$total_orders       = 0;
				foreach ($get_total_sales as $key1 => $value1) {
					if ($value->country == $value1->country) {
						$total_order_amount += $value1->bill_amount;
						$total_orders++;
					}
				}
				// $total_orders = $value1->total_orders;
				array_push($y_axis_data, $total_order_amount);
				$array_data = array($value->country_name, $value->total_customers, $total_orders, $this->ccr->cc("INR", "INR", $total_order_amount));
				array_push($table_data, $array_data);
			}
			$return['chart_label'] = 'Sales';
			$return['x_axis_data'] = $x_axis_data;
			$return['y_axis_data'] = $y_axis_data;
			$return['table_data']  = $table_data;
			echo json_encode($return);
		}
	}

	private function get_customers_overtime() {
		if ($this->input->get('from') && $this->input->get('to')) {
			$visitor_over_time_rep = $this->model->visitor_over_time_rep($this->input->get('from'), $this->input->get('to'));
			$get_total_orderes     = $this->model->get_orders_data_for_cst_over_time($this->input->get('from'), $this->input->get('to'));
			// echo json_encode($visitor_over_time_rep);
			// echo json_encode($get_total_orderes);
			$x_axis_data            = array();
			$dates                  = $this->get_date_between_date($this->input->get('from'), $this->input->get('to'));
			$y_axis_data            = array();
			$return['table_header'] = array("Month", "Customers", "Total Orders", "Return Orders", "Total Sales");
			$table_data             = array();
			foreach ($dates as $datekey => $datevalue) {
				array_push($x_axis_data, $datevalue);
				$y_axis_string = 0;
				$month         = $datevalue;
				$customers     =
				$total_orders  = 0;
				$return_orders = 0;
				$total_sales   = 0;
				foreach ($visitor_over_time_rep as $vdkey => $vdvalue) {
					if ($vdvalue->month == $datevalue) {
						$customers++;
						$y_axis_string += $vdvalue->total_visit_time;
					}
				}
				$y_axis_string = $customers;
				foreach ($get_total_orderes as $key => $value) {
					if ($value->month == $datevalue) {
						$total_orders++;
						$return_orders += $value->return_orders;
						if ($value->status == 4 || $value->status == 11 || $value->status == 16) {
							$total_sales += $value->bill_amount;
						}
					}
				}
				array_push($y_axis_data, $y_axis_string);
				$push_data = array($month, $customers, $total_orders, $return_orders, $this->ccr->cc("INR", "INR", $total_sales));
				array_push($table_data, $push_data);
			}
			$return['chart_label'] = 'Customers';
			$return['x_axis_data'] = $x_axis_data;
			$return['y_axis_data'] = $y_axis_data;
			$return['table_data']  = $table_data;
			echo json_encode($return);
		}

	}

	private function get_valuable_customers() {
		if ($this->input->get('from') && $this->input->get('to')) {
			$valuablecustomers = $this->model->get_valuable_customers_rep($this->input->get('from'), $this->input->get('to'));
			echo json_encode($valuablecustomers);
			$x_axis_data            = array();
			$y_axis_data            = array();
			$return['table_header'] = array("Month", "Customer Type", "Orders", "Gross Sales", "Refunds", "Net Sales", "Total Sales");

			// foreach ($valuablecustomers as $key => $value) {

			// }

		}
	}
	//===========================================================//
	//====================== End Customer Report =======================//
	//===========================================================//

	//===========================================================//
	//====================== Finace Report =======================//
	//===========================================================//

	private function get_finace_report() {
		if ($this->input->get('from') && $this->input->get('to')) {
			$get_order_codAndPrepaid_profit = $this->model->get_order_codAndPrepaid_profit_rep($this->input->get('from'), $this->input->get('to'));
			$prepaid_total                  =
			$cod_total                      =
			$gross_sales                    =
			$discount                       =
			$returns                        =
			$net_sales                      =
			$shipping                       =
			$taxes                          =
			$total_sales                    = 0;

			foreach ($get_order_codAndPrepaid_profit as $key => $value) {
				$gross_sales += $value->product_price + $value->service_charge;
				$discount += $value->discount;
				if ($value->status == 15) {
					$returns += $value->product_price + $value->service_charge;
					$shipping -= $value->shipping_charge;
				}
				$net_sales = (($gross_sales - $discount) - $returns);
				$shipping += $value->shipping_charge;
				$total_sales = $net_sales + $shipping;
				if ($value->payment_from == "paypal" || $value->payment_from == "ccavenue") {
					$sales_pre    = (($value->product_price + $value->service_charge) - $value->discount);
					$shipping_pre =
					$return_pre   = 0;
					if ($value->status == 15) {
						$return_pre = $value->product_price + $value->service_charge;
						$shipping_pre -= $value->shipping_charge;
					}

					$shipping_pre += $value->shipping_charge;
					$prepaid_total += ($sales_pre - $return_pre + $shipping_pre);
				} else if ($value->payment_from == "cod") {
					$sales_cod    = (($value->product_price + $value->service_charge) - $value->discount);
					$shipping_cod = $return_cod = 0;
					if ($value->status == 15) {
						$return_cod = $value->product_price + $value->service_charge;
						$shipping_cod -= $value->shipping_charge;
					}
					$shipping_cod += $value->shipping_charge;
					$cod_total += ($sales_cod - $return_cod + $shipping_cod);
				}
			}

			$return = array(
				"prepaid_sales" => $this->ccr->cc("INR", "INR", $prepaid_total),
				"cod_sales"     => $this->ccr->cc("INR", "INR", $cod_total),
				"gross_sales"   => $this->ccr->cc("INR", "INR", $gross_sales),
				"discount"      => $this->ccr->cc("INR", "INR", $discount),
				"return"        => $this->ccr->cc("INR", "INR", $returns),
				"net_sales"     => $this->ccr->cc("INR", "INR", $net_sales),
				"shipping"      => $this->ccr->cc("INR", "INR", $shipping),
				"taxes"         => $this->ccr->cc("INR", "INR", $taxes),
				"total_sales"   => $this->ccr->cc("INR", "INR", $total_sales),
			);
			echo json_encode($return);
		}
	}

	public function get_transaction_report() {
		if ($this->input->get('from') && $this->input->get('to')) {
			$delivered_orders = $this->model->get_total_orderes_that_delivered($this->input->get('from'), $this->input->get('to'));

			$x_axis_data            = array();
			$y_axis_data            = array();
			$return['table_header'] = array("Order Id", "Pay To", "Status", "Amount", "Date");
			$table_data             = array();
			$order_ids              = $payment_from              = $status              = $date              = $total_amount              = '';
			foreach ($delivered_orders as $key => $value) {
				array_push($x_axis_data, $value->order_order_id);
				array_push($y_axis_data, $value->bill_amount);
				$order_order_id = $value->order_order_id;

				$payment_from = $value->payment_from;
				$status       = 'Recived';
				$date         = $value->date;
				$total_amount = $value->bill_amount;
				$push_data    = array($order_order_id, $payment_from, $status, $this->ccr->cc("INR", "INR", $total_amount), $date);
				array_push($table_data, $push_data);
				if ($value->status == '15') {
					array_push($x_axis_data, $value->order_order_id);
					array_push($y_axis_data, ($value->return_com_price - $value->return_com_price - $value->return_com_price));
					$order_order_id = $value->order_order_id;
					$payment_from   = $value->return_com_transfer_in;
					$status         = 'Paid';
					$date           = $value->return_complete_date;
					$total_amount   = ($value->return_com_price - $value->return_com_price - $value->return_com_price);
					$push_data      = array($order_order_id, $payment_from, $status, $this->ccr->cc("INR", "INR", $total_amount), $date);
					array_push($table_data, $push_data);
				}
			}
			$return['chart_label'] = 'Amount';
			$return['x_axis_data'] = $x_axis_data;
			$return['y_axis_data'] = $y_axis_data;
			$return['table_data']  = $table_data;
			// echo "<pre>";
			// print_r($return);
			echo json_encode($return);

		}
	}
	//===========================================================//
	//====================== End Finace Report =======================//
	//===========================================================//
	//

	private function get_report_page_data() {
		if ($this->input->get('from') && $this->input->get('to')) {
			$return['sales_product']     = sizeof($this->model->get_sales_by_product($this->input->get('from'), $this->input->get('to')));
			$visitor_over_time           = $this->model->visitor_over_time($this->input->get('from'), $this->input->get('to'));
			$return['visitor_over_time'] = 0;
			foreach ($visitor_over_time as $key => $value) {
				$return['visitor_over_time'] += $value->total_visits;
			}
			$visitor_by_location           = $this->model->visitors_by_location($this->input->get('from'), $this->input->get('to'));
			$return['visitor_by_location'] = 0;
			foreach ($visitor_by_location as $key => $value) {
				$return['visitor_by_location']++;
			}

			$return['top_searches']               = sizeof($this->model->get_top_search_fr($this->input->get('from'), $this->input->get('to')));
			$return['top_searches_with_zero_res'] = sizeof($this->model->get_top_search_with_few_result_fr($this->input->get('from'), $this->input->get('to')));
			$customer_by_countries                = $this->model->get_customer_by_countries_rep($this->input->get('from'), $this->input->get('to'));

			$return['customers_by_countries'] = 0;
			foreach ($customer_by_countries as $key => $value) {
				$return['customers_by_countries']++;
			}
			$return['sales_product'] .= " Products";
			$return['visitor_over_time'] .= " Visitors";
			$return['visitor_by_location'] .= " Countries";
			$return['top_searches'] .= " Keywords";
			$return['top_searches_with_zero_res'] .= " Keywords";
			$return['customers_by_countries'] .= " Countries";
			echo json_encode($return);

		}
	}

	//===========================================================//
	//====================== Other Helper =======================//
	//===========================================================//
	/**
	 * @param  $from
	 * @param  $to
	 * @return mixed
	 */
	private function get_date_between_date($from, $to) {
		$start       = (new DateTime(DateTime::createFromFormat('d-m-Y', $from)->format('Y-m-d')))->modify('first day of this month');
		$end_date    = DateTime::createFromFormat('d-m-Y', $to)->format('Y-m-d');
		$end         = (new DateTime($end_date))->modify('first day of next month');
		$interval    = DateInterval::createFromDateString('1 month');
		$period      = new DatePeriod($start, $interval, $end);
		$x_axis_data = array();
		foreach ($period as $dt) {
			array_push($x_axis_data, $dt->format("M-Y"));
		}
		return $x_axis_data;
	}

}
