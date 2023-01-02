<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends My_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('m_report', 'model');
	}
	/**
	 * @param $arr
	 */
	public function index($arr = "") {
		if (!empty($arr)) {
			switch ($arr) {
			case 'ftq':
				$this->first_time_query();
				break;
			case 'ust':
				$this->update_stay_time();
				break;

			default:
				# code...
				break;
			}
		}
	}

	private function first_time_query() {

		if (!isset($_SESSION['report']) || !isset($_SESSION['report']['ftq'])) {

			$time = time() . mt_rand(1000, 999999);
			$this->add_browser_data($time);

		}
	}

	private function update_stay_time() {
		if (!isset($_SESSION['report']['stay_time']['timer']) || time() - $_SESSION['report']['stay_time']['timer'] > 60) {
			$stay_time_calc = 1;
			if (isset($_SESSION['report']['stay_time']['timer'])) {
				$stay_time_calc = round(((time() - $_SESSION['report']['stay_time']['timer']) / 60));
			}
			if ($stay_time_calc > 5) {
				$stay_time_calc = 5;
			}
			$_SESSION['report']['stay_time']['time'] = $_SESSION['report']['stay_time']['time'] + $stay_time_calc;
			$customer_id                             = null;
			if ($this->pp_login_varified->customer_varified()) {
				$customer_id = $this->session->userdata('customer_data')['customer_id'];
			}
			$this->model->update_stay_time_data($_SESSION['report']['ftq'], $_SESSION['report']['stay_time']['time'], $customer_id);
			$_SESSION['report']['stay_time']['timer'] = time();
		}
	}

	/**
	 * @param $time
	 */
	private function add_browser_data($time) {
		if (!isset($_SESSION['report']) || !isset($_SESSION['report']['ftq'])) {
			ob_start();
			system('ipconfig /all');
			$mycomsys = ob_get_contents();
			ob_clean();
			$find_mac   = "Physical"; //find the "Physical" & Find the
			$pmac       = strpos($mycomsys, $find_mac);
			$macaddress = substr($mycomsys, ($pmac + 36), 17);
			require_once 'includes/browser.php';
			$browser  = new Browser();
			$version  = $browser->getVersion();
			$platform = $browser->getPlatform();
			switch ($platform) {
			case Browser::PLATFORM_WINDOWS:
			case Browser::PLATFORM_WINDOWS:
				$platform = "Windows";
				break;
			case Browser::PLATFORM_APPLE:
			case Browser::PLATFORM_WINDOWS:
				$platform = "Mac";
				break;
			case Browser::PLATFORM_ANDROID:
				$platform = "Android";
				break;
			case Browser::PLATFORM_IPHONE:
			case Browser::PLATFORM_IPAD:
				$platform = "iPhone";
				break;
			default:
				$platform = 'Other';
				break;
			}
			$browser = $browser->getBrowser();
			switch ($browser) {
			case Browser::BROWSER_OPERA:
			case Browser::BROWSER_IE:
			case Browser::BROWSER_FIREFOX:
			case Browser::BROWSER_MOZILLA:
			case Browser::BROWSER_SAFARI:
			case Browser::BROWSER_CHROME:
				$browser = $browser;
				break;

			default:
				$browser = 'Other';
				break;
			}

			$data = array(
				'browser'   => $browser,
				'version'   => $version,
				'platform'  => $platform,
				'date'      => date('d-m-Y'),
				'time'      => date('h:i a'),
				'ip'        => $_SERVER['REMOTE_ADDR'],
				'mac'       => $macaddress,
				'country'   => $_SESSION['ip_country'],
				'region'    => $_SESSION['region'],
				'month'     => date('M-Y'),
				'stay_time' => '1',
				'uni_key'   => $time,
			);
			$_SESSION['report']['stay_time']['time'] = 0;
			$check_result                            = $this->model->check_exist_data($_SERVER['REMOTE_ADDR'], $macaddress, $platform);
			if (empty($check_result)) {
				$this->model->insert_data('rep_browser', $data);
				$_SESSION['report']['ftq'] = $time;
			} else {
				$_SESSION['report']['stay_time']['time'] = $check_result->stay_time;
				$_SESSION['report']['ftq']               = $check_result->uni_key;
			}

		}
	}

}