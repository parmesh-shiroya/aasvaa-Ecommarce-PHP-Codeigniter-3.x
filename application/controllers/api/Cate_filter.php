<?php

/**
 *
 */
class Cate_filter extends My_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('api/m_cate_filter_api', 'model');
	}
	public function index() {
		if (isset($_POST['method'])) {
			$this->$_POST['method']();
		}
	}

	private function add_filter_data() {
		if (isset($_POST['method'])) {
			if (isset($_SESSION['filter'][$_POST['keys']])) {
				array_push($_SESSION['filter'][$_POST['keys']], $_POST['value']);
				$_SESSION['filter'][$_POST['keys']] = array_values(array_unique($_SESSION['filter'][$_POST['keys']]));
			} else {
				$_SESSION['filter'][$_POST['keys']] = array($_POST['value']);
			}
			$_SESSION['filter'] = array_filter($_SESSION['filter']);
			print_r($_SESSION['filter']);
		}
	}
	private function add_filter_price() {
		if (isset($_POST['method'])) {
			$_SESSION['price_filters'][$_POST['keys']] = $this->ccr->cc2($_SESSION['currency_choose'], 'INR', $_POST['value'], 1, 1);
		}
	}
	private function remove_filter_data() {
		if (isset($_POST['method'])) {
			if (isset($_SESSION['filter'][$_POST['keys']])) {
				$_SESSION['filter'][$_POST['keys']] = array_values(array_diff($_SESSION['filter'][$_POST['keys']], [$_POST['value']]));
			} else {
				$_SESSION['filter'][$_POST['keys']] = array($_POST['value']);
			}
			$_SESSION['filter'] = array_filter($_SESSION['filter']);
			print_r($_SESSION['filter']);
		}
	}

	private function add_ship_time_filter() {
		if (isset($_POST['method'])) {
			if (isset($_SESSION['single_filter'][$_POST['keys']])) {
				array_push($_SESSION['single_filter'][$_POST['keys']], $_POST['value']);
				$_SESSION['single_filter'][$_POST['keys']] = array_values(array_unique($_SESSION['single_filter'][$_POST['keys']]));
			} else {
				$_SESSION['single_filter'][$_POST['keys']] = array($_POST['value']);
			}
			$_SESSION['single_filter'] = array_filter($_SESSION['single_filter']);
			print_r($_SESSION['single_filter']);
		}
	}

	private function remove_ship_time_filter() {
		if (isset($_POST['method'])) {
			if (isset($_SESSION['single_filter'][$_POST['keys']])) {
				$_SESSION['single_filter'][$_POST['keys']] = array_values(array_diff($_SESSION['single_filter'][$_POST['keys']], [$_POST['value']]));
			} else {
				$_SESSION['single_filter'][$_POST['keys']] = array($_POST['value']);
			}
			$_SESSION['single_filter'] = array_filter($_SESSION['single_filter']);
			print_r($_SESSION['single_filter']);
		}
	}
	private function get_product_by_filter() {
		if (isset($_SESSION['filter']) && !empty($_SESSION['filter'])) {
			$filter_product = $this->model->get_product_by_filter();
			$this->generate_product_box_from_filter($filter_product);
			// $this->output->set_content_type('application/json')->set_output(json_encode($filter_product));
		}
	}

	/**
	 * @param $product
	 */
	private function generate_product_box_from_filter($product) {

		foreach ($product as $key => $value) {
			$product_url = base_url('product/' . $value->cat_name . '/' . str_replace(" ", "-", $value->sub_cat_name) . '/' . $value->product_sku . '/' . $value->product_id . '/' . str_replace(" ", "-", $value->product_name));
			?>
      <div class="pp-col ps6 pl4 pxl3 ">
         <div class="card product-card hoverable" card-id="<?php echo $value->product_id; ?>">
            <div class="card-image waves-effect waves-block waves-light href" href="<?php echo $product_url; ?>">
                <img src="<?php echo base_url('uploads/pro_image/400_470/' . $value->pro_img); ?>" class="responsive-img ">
                <div class="quick_view_button hide-on-small-only valign-wrapper ">
                    <div class="valign quick_button center-align">
                        <a class="btn-floating animated quick_button_btn quick_button_btn_<?php echo $value->product_id; ?> waves-effect waves-light green tooltipped fadeOut" prod-id="<?php echo $value->product_id; ?>" data-position="top" data-delay="50" data-tooltip="Quick View" data-tooltip-id="7acb1d26-604a-db4d-1fcf-d60ac4c5e279"><i class="material-icons">visibility</i></a>
                    </div>
                </div>
            </div>
            <div class="card-content p-padding_10 esml_padding_10">
                <div class="pp-row zero_margin content-row">
                    <div class="pp-col zero_padding ps12">
                        <a href="<?php echo $product_url; ?>"><h6 style="max-height:2em; overflow-y:hidden;" class="font13 grey-text text-darken-4"><b><?php echo $value->product_name; ?></b></h6></a>
                    </div>

                </div>
            </div>
            <div class="card-action p-padding_10 esml_padding_10">
                <div class="pp-row valign-wrapper zero_margin">
                    <div class="pp-col p-padding_2 ps12 pm6 pl6"><span class="orange-text price text-lighten-2 old-price" price="<?php echo $value->mrp; ?>"></span>  <span class="orange-text price  new-price" price="<?php echo $value->sell_price; ?>"></span></div>
                    <div class="pp-col p-padding_2 ps4 pm2 pl2 btn_like tooltipped" data-position="bottom" product-id="<?php echo $value->product_id; ?>" data-delay="50" data-tooltip="Like"><i class="material-icons">thumb_up</i></div>
                    <div product-id="<?php echo $value->product_id; ?>" class="pp-col btn_add_to_cart p-padding_2 tooltipped ps4 pm2 pl2" data-position="bottom" data-delay="50" data-tooltip="Add To Cart"><i class="material-icons">shopping_cart</i></div>
                    <div class="pp-col p-padding_2 ps4 pm2 pl2 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Add To Compare"><i class="material-icons">swap_horiz</i></div>
                </div>
            </div>

        </div>
      </div>
      <?php }
	}

}
