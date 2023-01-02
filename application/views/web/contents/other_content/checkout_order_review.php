
			<div class="pp-col pm12 pl3">
				<table class="address_table">
					<thead>
						<tr>
							<th>Billing Address<span class="right font13"><a class="hover-text-primary grey-text edit_billing_add_button text-darken-1">Edit Address</a></span></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="text-transform:capitalize;">
								<span class="bold"><?php echo $_SESSION['checkout']['billing_address']['name']; ?></span><br><?php echo $_SESSION['checkout']['billing_address']['address1'] . ", " . $_SESSION['checkout']['billing_address']['address2'] . ", " . $_SESSION['checkout']['billing_address']['city'] . "-" . $_SESSION['checkout']['billing_address']['post_code'] . ", " . $_SESSION['checkout']['billing_address']['state'] . ", " . $_SESSION['checkout']['billing_address']['country'] . "<br>Mobile : " . $_SESSION['checkout']['billing_address']['mobile_no']; ?></td>
							</tr>
						</tbody>
					</table>
					<table class="address_table">
						<thead>
							<tr>
								<th>Shipping Address<span class="right font13"><a class="hover-text-primary edit_shipping_add_button grey-text text-darken-1">Edit Address</a></span></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="text-transform:capitalize;">
									<span class="bold"><?php echo $_SESSION['checkout']['shipping_address']['name']; ?></span><br><?php echo $_SESSION['checkout']['shipping_address']['address1'] . ", " . $_SESSION['checkout']['shipping_address']['address2'] . ", " . $_SESSION['checkout']['shipping_address']['city'] . "-" . $_SESSION['checkout']['shipping_address']['post_code'] . ", " . $_SESSION['checkout']['shipping_address']['state'] . ", " . $_SESSION['checkout']['shipping_address']['country'] . "<br>Mobile : " . $_SESSION['checkout']['shipping_address']['mobile_no']; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="pp-col pm12 pl9">
						<table class="bordered g8fs13 highlight striped product_table">
							<?php
?>
							<thead>
								<tr>
									<th class="center" data-field="id">Product</th>
									<th data-field="name">Description</th>
									<th class="center" data-field="price">Item Code</th>
									<th class="center" data-field="price">Unit</th>
									<th class="center" data-field="price">Unit Price</th>
									<th class="center" data-field="price">Total</th>
								</tr>
							</thead>
							<tbody>
								<?php
foreach ($this->cart->contents() as $items) {
	$product_url = base_url('product/' . ${"product_data_" . $items['id']}->cat_name . '/' . str_replace(" ", "-", ${"product_data_" . $items['id']}->sub_cat_name) . '/' . ${"product_data_" . $items['id']}->product_sku . '/' . ${"product_data_" . $items['id']}->product_id . '/' . str_replace(" ", "-", ${"product_data_" . $items['id']}->product_name));
	?>
								<tr>
									<td><img width="75px" class="responsive-img" src="<?php echo base_url('uploads/pro_image/94_130/' . $items['image']); ?>" /></td>
									<td>
										<div>
											<a href="<?php echo $product_url; ?>"><span class="hover-text-primary font-karla  g8fw600 grey-text text-darken-2"><?php echo $items['name']; ?></span></a></div>
											<?php
$add_standard_price_array  = array();
	$add_customize_price_array = array();
	if ($this->cart->has_options($items['rowid'])) {
		foreach ($this->cart->product_options($items['rowid']) as $keysingle => $valuesingle) {
			echo "<div><span class='font-capitalize font13 grey-text text-darken-3 font-500'>" . $valuesingle[$keysingle . 'radio'] . " " . $keysingle . "</span></div>";
			if ($valuesingle[$keysingle . 'radio'] == 'standard') {
				$standard_size_for = explode("#", $valuesingle[$keysingle . '_standard_sizes_name']);
				array_pop($standard_size_for);
				array_push($add_standard_price_array, $keysingle);
				foreach ($standard_size_for as $standard_size_for_key => $standard_size_for_value) {
					// print_r($standard_size_for_value);
					//   print_r($keysingle.str_replace(" ","_",$valuesingle));
					echo "<div><span class='font13 grey-text text-darken-2 font-capitalize'>" . $standard_size_for_value . " : " . $valuesingle[$keysingle . str_replace(" ", "_", $standard_size_for_value)] . "</span></div>";
				}
			} else if ($valuesingle[$keysingle . 'radio'] == 'customize') {
				array_push($add_customize_price_array, $keysingle);
			}
		}
	}
	?>
										</td>
										<td class="center">
											<span type="text" value="" product-id="<?php echo $items['id']; ?>" class="stock_counter-textbox" ><?php echo ${"product_data_" . $items['id']}->product_sku; ?></span>
										</td>
										<td class="center">
											<span type="text" value="" text="<?php echo $items['qty']; ?>" product-id="<?php echo $items['id']; ?>" class="require_stock" ><?php echo $items['qty']; ?></span>
										</td>
										<td class="center"><span class=" unit_price" product-id="<?php echo $items['id']; ?>" price="<?php echo $items['price']; ?>"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $items['price']); ?></span><?php ?></td>
										<td width="160"> <div>
										<span product-id="<?php echo $items['id']; ?>" shipping-price="<?php echo $items['ship_charge']; ?>" inter-shipping-charge="<?php echo $items['inter_ship_charge']; ?>" class="total_price " price="<?php echo $items['subtotal']; ?>"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $items['subtotal']); ?></span></div>
										<?php
if (isset($add_standard_price_array) && !empty($add_standard_price_array)) {
		if (isset(${"standard_data_" . $items['id']})) {
			foreach ($add_standard_price_array as $standard_price_key => $standard_price_value) {
				foreach (${"standard_data_" . $items['id']} as $standard_data_key => $standard_data_value) {
					if ($standard_data_value['name'] == $standard_price_value) {
						echo "<div><span class='grey-text text-darken-2 font13'>" . $standard_price_value . " : </span><span class=' other_service_price' product-id='" . $items['id'] . "' price='" . $standard_data_value['standard_price'] . "'>" . $this->ccr->cc('INR', $_SESSION['currency_choose'], $standard_data_value['standard_price']) . "</span></div>";
					}
				}
			}
		}
	}
	if (isset($add_customize_price_array) && !empty($add_customize_price_array)) {
		if (isset(${"customize_data_" . $items['id']})) {
			foreach ($add_customize_price_array as $standard_price_key => $standard_price_value) {
				foreach (${"customize_data_" . $items['id']} as $customize_data_key => $customize_data_value) {
					if ($customize_data_value['name'] == $standard_price_value) {
						echo "<div><span class='grey-text  text-darken-2 font13'>" . $standard_price_value . " : </span><span class=' other_service_price' product-id='" . $items['id'] . "' price='" . $customize_data_value['customize_price'] . "'>" . $this->ccr->cc('INR', $_SESSION['currency_choose'], $customize_data_value['customize_price']) . "</span></div>";
					}
				}
			}
		}
	}
	?>
									</td>
								</tr>
								<?php }
?>
							</tbody>
							<tfoot class="g8fs13 font-karla">
							<tr>
								<td colspan="3"></td>
								<td colspan="2"><span ship-country="<?php echo $_SESSION['checkout']['shipping_address']["country"]; ?>" class="shipping-country">Sub-Total :- </span></td>
								<td  class="price right  sub_total_price" price="2500"></td>
							</tr>
							<?php if (isset($_SESSION['cart_coupen_data'])) {
	if ($_SESSION['cart_coupen_data']->discount_type == 0) {
		$sub_total = $_SESSION['cart_coupen_data']->dis_percet_rs;
	} else if ($_SESSION['cart_coupen_data']->discount_type == 1) {
		$sub_total = ($_SESSION['cart_coupen_data']->dis_percet_rs * $this->cart->total()) / 100;
	}

	?>
<tr>
<td colspan="3"></td>
								<td colspan="2"><span class="">Coupen Discount								                                                          								                                                           <?php echo ($_SESSION['cart_coupen_data']->discount_type == 1) ? $_SESSION['cart_coupen_data']->dis_percet_rs . '%' : ''; ?>:</span></td>
								<td class=" right discount_price" dis-percet-rs="<?php echo $_SESSION['cart_coupen_data']->dis_percet_rs; ?>" type="<?php echo $_SESSION['cart_coupen_data']->discount_type; ?>" price="2500"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $sub_total); ?></td>
							</tr>
	<?php }?>

							<tr>
								<td colspan="3"></td>
								<td width="140" colspan="2"><span class="">Shipping Charge :- </span></td>
								<td class="price right shipping-charge-total" price="2500"></td>
							</tr>
							<tr>
								<td colspan="3"></td>
								<td colspan="2"><span class="">Payable Amount :- </span></td>
								<td con-format="<?php echo $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']); ?>" con-cor="<?php echo $this->ccr->cc2('INR', $_SESSION['currency_choose'], '1', 1, 1, 0); ?>"  class="price right total-price-text" price="2500"></td>
							</tr>
							</tfoot>
						</table>
						<?php
if (isset($_SESSION['cart_coupen_data'])) {

	if ($_SESSION['cart_coupen_data']->discount_type == 0) {

		$discount_amount      = $_SESSION['cart_coupen_data']->dis_percet_rs;
		$total_amount_payment = ($this->cart->total() + $_SESSION['newcart']['total_other_charges']) - $discount_amount;

	} elseif ($_SESSION['cart_coupen_data']->discount_type == 1) {
		$discount_amount      = $_SESSION['cart_coupen_data']->dis_percet_rs;
		$total_amount_payment = round(($this->cart->total() + $_SESSION['newcart']['total_service_charges']) - (($this->cart->total() + $_SESSION['newcart']['total_service_charges']) * $discount_amount) / 100);

	}
} else {
	$total_amount_payment = ($this->cart->total() + $_SESSION['newcart']['total_other_charges']);
}
if (isset($_SESSION['checkout']['payment_method'])) {

	if ($_SESSION['checkout']['payment_method']['payment_option'] == 'cc_avenue_payment') {?>
	<span class="font14">Payment will be processed in equivalent INR only. Total Amount in INR :<?php echo $this->ccr->cc("INR", "INR", $total_amount_payment); ?></span>

						<form action="<?php echo site_url('checkout/payby_ccavenue'); ?>" method="post" accept-charset="utf-8">
						<input type="hidden" class="hidden" name="" value="ccavenue">
						<button type="submit" class="btn pp-margin-tb-10  right">Proceed to Payment</button>
						</form>
	<?php } else if ($_SESSION['checkout']['payment_method']['payment_option'] == 'visa_paypal') {?>
<span class="font14">Payment will be processed in equivalent USD only. Total Amount in USD :<?php echo $this->ccr->cc("INR", "USD", $total_amount_payment); ?></span>
						<form action="<?php echo site_url('checkout/paypal_payment'); ?>" method="post" accept-charset="utf-8">
						<input type="hidden" class="hidden" name="" value="paypal">
						<button type="submit" class="btn primary-light pp-margin-tb-10  right">Proceed to Payment</button>
						</form>
	<?php } else if ($_SESSION['checkout']['payment_method']['payment_option'] == 'cod_payment') {?>
<!-- <span class="font14">Payment will be processed in equivalent USD only. Total Amount in USD :<?php echo $this->ccr->cc("INR", "USD", $total_amount_payment); ?></span> -->
						<form action="<?php echo site_url('checkout/codverified'); ?>" method="post" accept-charset="utf-8">
						<input type="hidden" class="hidden" name="" value="paypal">
						<button type="submit" class="btn primary-light pp-margin-tb-10  right">Proceed to Payment</button>
						</form>
	<?php }
}
?>


					</div>

		<style type="text/css" media="screen">
		.address_table thead{
			background: rgb(247,247,247);
		}
		table{
			border: solid 1px #ddd;
		}
		.address_table{
			border:solid 1px #ccc;
		}
		.address_table th{
			padding: 10px 5px;
		}
		.address_table td{
			font-size: 13px;
			color: rgb(102,102,114);
		}
		.product_table tbody td{
		padding: 7px 5px;
		}
		.product_table tfoot td{
		padding: 3px 5px;
		font-size: 14px;
		}
		</style>
		<script>
			$(document).ready(function() {
		refresh_price();
		});
		function refresh_price(){
		$(".unit_price").each(function(index, el) {
		var pro_id  = $(this).attr('product-id');
		var price = parseInt($(this).attr('price'));
		var con_cor = $('.total-price-text').attr('con-cor');
var con_format = $('.total-price-text').attr('con-format');
// con_format = con_format.slice(0,-4);
		var unit = parseInt($(".require_stock[product-id='"+pro_id+"']").attr('text'));
		$(".other_service_price[product-id='"+pro_id+"']").each(function(index, el) {
		var other_price = $(this).attr('price');
		$(this).attr('final-price', unit*other_price);
		$(this).html(con_format+(((unit*other_price)*con_cor).toFixed(2)));

		});
		var aa1 = parseInt($(".total_price[product-id='"+pro_id+"']").attr('shipping-price'));
		var aa2 = parseInt($(".total_price[product-id='"+pro_id+"']").attr('inter-shipping-charge'));
		$(".total_price[product-id='"+pro_id+"']").attr('new-shipping-price',aa1*unit);
		$(".total_price[product-id='"+pro_id+"']").attr('new-inter-shipping-charge',aa2*unit);
		$(".total_price[product-id='"+pro_id+"']").attr("final-price",unit*price);
		// $(".total_price[product-id='"+pro_id+"']").html("&#8377;"+price_seprate(unit*price));
		});
		refresh_total_price();
		}
		function refresh_total_price(){
		var final_price = 0;
		$("[final-price]").each(function(index, el) {
		final_price += parseInt($(this).attr('final-price'));
		});
		var con_cor = $('.total-price-text').attr('con-cor');
var con_format = $('.total-price-text').attr('con-format');
// con_format = con_format.slice(0,-4);
		$(".sub_total_price").html(con_format+((final_price*con_cor).toFixed(2)));
		if ($(".discount_price").attr('dis-percet-rs') != undefined) {
var discount_per_rs= $(".discount_price").attr('dis-percet-rs');
var discount_type = $(".discount_price").attr('type');
if (discount_type == 0) {
var sub_total = discount_per_rs;
}
else if(discount_type == 1){

  var sub_total = (discount_per_rs * final_price) / 100;
  alert(sub_total);
}
var con_cor = $('.total-price-text').attr('con-cor');
var con_format = $('.total-price-text').attr('con-format');
// con_format = con_format.slice(0,-4);
$(".discount_price").html(con_format+((sub_total*con_cor).toFixed(2)));
$(".discount_price").attr('discount-prices',sub_total);
}
		$(".sub_total_price").attr('total-pricess',final_price);
		refresh_shipping_price();
		}
		function refresh_shipping_price(){
		var ship_country = $(".shipping-country").attr('ship-country');
		var charge =  0;
		if(ship_country != "india"){
		$("[new-inter-shipping-charge]").each(function(index, el) {
		charge += parseInt($(this).attr('new-inter-shipping-charge'));
		});
		}else if(ship_country == "india"){
		$("[new-shipping-price]").each(function(index, el) {
		charge += parseInt($(this).attr('new-shipping-price'));
		});
		}
		$(".shipping-charge-total").attr("total-pricess",charge);
		var con_cor = $('.total-price-text').attr('con-cor');
var con_format = $('.total-price-text').attr('con-format');
// con_format = con_format.slice(0,-4);
		$(".shipping-charge-total").html(con_format+((charge*con_cor).toFixed(2)));
		refresh_totalss_price();
		}
		function refresh_totalss_price(){
		var price = 0;
		var price2 =parseInt($(".sub_total_price").attr('total-pricess'));
		var price1 = parseInt($(".shipping-charge-total").attr("total-pricess"));
		if ($(".discount_price").attr('dis-percet-rs') != undefined) {
  var discount_price =$(".discount_price").attr('discount-prices');
price = (price1-discount_price)+price2;
  }else{
price = price1+price2;
  }
  var con_cor = $('.total-price-text').attr('con-cor');
var con_format = $('.total-price-text').attr('con-format');
// con_format = con_format.slice(0,-4);
		$(".total-price-text").html(con_format+((price*con_cor).toFixed(2)));
		}


		</script>