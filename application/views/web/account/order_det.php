<!-- <pre class="grey-text text-darken-4"> -->
<?php
$order_trn_data        = unserialize(base64_decode($order_mst->trn_c_data));
$order_trn_return_data = unserialize(base64_decode($order_mst->trn_return_data));
// print_r($customize_data2);
?>
<!-- </pre> -->
<?php
if (isset($customize_data)) {

	$customize_data2 = array_map('json_decode', array_unique(array_map('json_encode', $customize_data)));
	foreach ($customize_data2 as $key => $value) {
		// echo $value->id;
		?>
<div id="custom_size_model_<?php echo $value->id; ?>" class="modal grey-text text-darken-4">
	<div class="modal-content">
		<h6 class="font18 font-capitalize teal-text"><?php echo $value->name . ' (' . $value->no . ')'; ?></h6>
		<div class="pp-row">
			<?php
$for_name_keys = explode("#", $value->for_name);
		array_pop($for_name_keys);
		foreach ($for_name_keys as $for_name_keys_key => $for_name_keys_value) {
			?>
			<div class="pp-col ps6">
				<h6 class="font16 teal-text font-500 font-capitalize pp-margin-tb-15"><?php echo $for_name_keys_value; ?></h6>
				<table class="bordered size_table border-1px font14 grey-text text-darken-1">
					<tbody>
						<?php foreach (unserialize(base64_decode($value->data)) as $custom_size_data_key => $custom_size_data_value) {
				// echo $for_name_keys_key;
				if (strpos($custom_size_data_key, $for_name_keys_value . "#") !== false) {?>
						<tr>
							<td class="font14 grey-text text-darken-4"><?php echo str_replace($for_name_keys_value . "#", "", $custom_size_data_key); ?></td>
							<td><?php echo $custom_size_data_value; ?></td>
						</tr>
						<?php } else if (strpos($custom_size_data_key, $for_name_keys_value) !== false) {?>
<tr>
							<td class="font14 grey-text text-darken-4"><?php echo $custom_size_data_key; ?></td>
							<td><?php echo $custom_size_data_value; ?></td>
						</tr>
<?php	}

			}
			?>
					</tbody>
				</table>
			</div>
			<?php }
		?>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
	</div>
</div>
<?php }
}
?>
<div class="pp-row zero_margin">
	<div class="pp-col transparent z-depth-0 pp-padres grey-text text-darken-4 card ps12">
		<div class="pp-col  ps9">
			<h6 class="font14 font-500 pp-margin-tb-15">ORDER INFORMATION</h6>
			<div class="pp-row grey pp-padres zero_margin card lighten-4 z-depth-1">
				<div class="pp-col ps8">
					<div class="pp-col pp-margin-tb-7 zero_padding ps6">
						<div class="pp-margin-tb-7 pp-col ps12"><h6 class="font14 grey-text text-darken-1">Order Id</h6></div>
						<div class="pp-margin-tb-7 pp-col ps12"><h6 class="font16 font-capitalize"><?php echo $order_mst->id; ?></h6></div>
					</div>
					<div class="pp-col pp-margin-tb-7 zero_padding ps6">
						<div class="pp-margin-tb-7 pp-col ps12"><h6 class="font14 grey-text text-darken-1">Order Date</h6></div>
						<div class="pp-margin-tb-7 pp-col ps12"><h6 class="font16 font-capitalize"><?php echo $order_mst->date; ?></h6></div>
					</div>
					<div class="pp-col pp-margin-tb-7 zero_padding ps6">
						<div class="pp-margin-tb-7 pp-col ps12"><h6 class="font14 grey-text text-darken-1">Number Of Package</h6></div>
						<div class="pp-margin-tb-7 pp-col ps12"><h6 class="font16"><?php echo $order_trn_data['cart_contents']['total_items']; ?></h6></div>
					</div>
					<div class="pp-col pp-margin-tb-7 zero_padding ps6">
						<div class="pp-margin-tb-7 pp-col ps12"><h6 class="font14 grey-text text-darken-1">Payment By</h6></div>
						<div class="pp-margin-tb-7 pp-col ps12"><h6 class="font16 font-capitalize"><?php echo $order_mst->payment_from; ?></h6></div>
					</div>
					<?php
if (isset($paypal_data)) {
	if (isset(unserialize(base64_decode($paypal_data->datas))['discount_amount_cart']) || isset(unserialize(base64_decode($paypal_data->datas))['discount_rate_cart'])) {
		?>
					<div class="pp-col pp-margin-tb-7 zero_padding ps6">
						<div class="pp-margin-tb-7 pp-col ps12">
						<h6 class="font14 grey-text text-darken-1">Coupen Discount</h6></div>
						<div class="pp-margin-tb-7 pp-col ps12"><h6 class="font16 font-capitalize"><?php
if (isset(unserialize(base64_decode($paypal_data->datas))['discount_amount_cart'])) {
			echo "US$ " . unserialize(base64_decode($paypal_data->datas))['discount_amount_cart'];
			if ($_SESSION['currency_choose'] != "USD") {
				echo " (" . $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']) . ' ' . number_format((float) $order_trn_data['currency'][$_SESSION['currency_choose']] * round(unserialize(base64_decode($paypal_data->datas))['discount_amount_cart'] * (1 / $order_trn_data['usd_price'])), 2, '.', '') . ")";
			}
			// echo "<span class='price' price='" . unserialize(base64_decode($paypal_data->datas))['discount_amount_cart'] . "'></span>";
		} else if (isset(unserialize(base64_decode($paypal_data->datas))['discount_rate_cart'])) {
			echo "<span>" . unserialize(base64_decode($paypal_data->datas))['discount_amount_cart'] . "%</span>";
		}
		?></h6></div>
					</div>
					<?php
}
}
if (isset($ccavenue_data)) {
	$mercent_4 = unserialize(base64_decode(unserialize(base64_decode($ccavenue_data->datas))['merchant_param4']));
	if (!empty($mercent_4) && (isset($mercent_4['discount_amount_cart']) || isset($mercent_4['discount_rate_cart']))) {
		?>
					<div class="pp-col pp-margin-tb-7 zero_padding ps6">
						<div class="pp-margin-tb-7 pp-col ps12"><h6 class="font14 grey-text text-darken-1">Coupen Discount</h6></div>
						<div class="pp-margin-tb-7 pp-col ps12"><h6 class="font16 font-capitalize"><?php
if (isset($mercent_4['discount_amount_cart'])) {
			echo $this->ccr->cc('INR', 'INR', $mercent_4['discount_amount_cart'], 1, 1);
			if ($_SESSION['currency_choose'] != "INR") {
				echo " -  (" . $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']) . ' ' . number_format((float) $order_trn_data['currency'][$_SESSION['currency_choose']] * round($mercent_4['discount_amount_cart']), 2, '.', '') . ")";
			}
			// echo "<span class='price' price='" . $mercent_4['discount_amount_cart'] . "'></span>";
		} else if (isset($mercent_4['discount_rate_cart'])) {
			echo "<span>" . $mercent_4['discount_rate_cart'] . "%</span>";
		}
		?></h6></div>
					</div>
					<?php
}
}
?>
				</div>
				<div class="pp-col ps4">
					<div class="pp-col zero_padding ps12">
						<div class="pp-margin-tb-7 pp-col ps12"><h6 class="font14 grey-text text-darken-1">Comment</h6></div>
						<div class="pp-margin-tb-7 pp-col ps12"><h6 class="font16"><?php echo $order_trn_data['checkout']['payment_method']['additional_comments']; ?></h6></div>
					</div>
				</div>
			</div>
		</div>
		<div class="pp-col  ps3">
			<div class="pp-col ps12 zero_padding">
				<h6 class="font14 font-500 pp-margin-tb-15">ORDER TOTAL</h6>
				<div class="pp-row center blue pp-padres zero_margin card z-depth-1">
					<div class="pp-col ps12">
						<?php if ($order_mst->payment_from == 'paypal') {
	?>
						<h5 class="white-text"><?php
// echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $mercent_4['discount_amount_cart'], 1, 1);
	echo 'US$ ' . $order_trn_return_data['get']['amt']; ?></h5>
	<?php if ($_SESSION['currency_choose'] != "USD") {?>
<h5 class="white-text " price=''><?php echo $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']) . ' ' . number_format((float) $order_trn_data['currency'][$_SESSION['currency_choose']] * round($order_trn_return_data['get']['amt'] * (1 / $order_trn_data['usd_price'])), 2, '.', ''); ?></h5>
	<?php }?>


						<?php } else if ($order_mst->payment_from == 'ccavenue') {?>
						<h5 class="white-text price" price="<?php echo round($order_trn_return_data['post']['encResp_dcr']['amount']); ?>"></h5>
						<?php if ($_SESSION['currency_choose'] != "INR") {?>
						<h5 class="white-text"><?php echo "(" . $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']) . ' ' . number_format((float) $order_trn_data['currency'][$_SESSION['currency_choose']] * round($order_trn_return_data['post']['encResp_dcr']['amount']), 2, '.', '') . ")"; ?></h5>
						<?php }}?>
					</div>
				</div>
			</div>
			<div class="pp-col ps12 zero_padding">
				<h6 class="font14 font-500 pp-margin-tb-15">ORDER STATUS</h6>
				<div class="pp-row center pp-padres zero_margin card z-depth-1">
					<div class="pp-col ps12">
						<?php
echo $this->pp_loader_helper->set_order_status($order_mst->status);

?>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="pp-col transparent z-depth-0 zero_padding grey-text text-darken-4 card ps12">
		<div class="pp-col  ps6">
			<h6 class="font14 font-500 pp-margin-tb-15">ADDRESS DETAILS</h6>
			<div class="pp-row  zero_padding zero_margin card  z-depth-1">
				<div class="pp-col zero_padding ps12">
					<ul class="tabs shipping_add_tabs tabs-fixed-width">
						<li class="tab pp-col ps6"><a class="active" href="#ship_add_div">Shipping Address</a></li>
						<li class="tab pp-col ps6"><a  href="#bill_add_div">Billing Address</a></li>
					</ul>
				</div>
				<div id="ship_add_div" class="pp-col pp-padres ps12">
					<div class="font14 border-inshadow  grey lighten-5 pp-padres font-capitalize">
						<?php
echo $order_trn_data['checkout']['shipping_address']['name'] . '<br>' .
	$order_trn_data['checkout']['shipping_address']['address1'] . '<br>' .
	$order_trn_data['checkout']['shipping_address']['address2'] . '<br>' .
	$order_trn_data['checkout']['shipping_address']['city'] . ' - ' .
	$order_trn_data['checkout']['shipping_address']['post_code'] . '<br>' .
	$order_trn_data['checkout']['shipping_address']['state'] . '<br>' .
	$order_trn_data['checkout']['shipping_address']['country'] . '<br>'
	. 'Mobile No : ' . $order_trn_data['checkout']['shipping_address']['mobile_no'];
?>
					</div>
				</div>
				<div id="bill_add_div" class="pp-col pp-padres ps12">
					<div class="font14 border-inshadow  grey lighten-5 pp-padres font-capitalize">
						<?php
echo $order_trn_data['checkout']['billing_address']['name'] . '<br>' .
	$order_trn_data['checkout']['billing_address']['address1'] . '<br>' .
	$order_trn_data['checkout']['billing_address']['address2'] . '<br>' .
	$order_trn_data['checkout']['billing_address']['city'] . ' - ' .
	$order_trn_data['checkout']['billing_address']['post_code'] . '<br>' .
	$order_trn_data['checkout']['billing_address']['state'] . '<br>' .
	$order_trn_data['checkout']['billing_address']['country'] . '<br>'
	. 'Mobile No : ' . $order_trn_data['checkout']['billing_address']['mobile_no'];
?>
					</div>
				</div>
			</div>
		</div>
<div class="pp-col ps6">
			<h6 class="font14 font-500 pp-margin-tb-15">Order Action</h6>
			<div class="pp-row pp-padres zero_margin card z-depth-1">
				<div class="pp-col ps12">
				<?php
switch ($order_mst->status) {
case '0':
case '5':
	?>
	<div class="pp-col pp-margin-tb-15 zero_padding ps6">
						<!-- <h6 class="font15 grey-text text-darken-4">Name</h6> -->
						<a href="" order-data="<?php echo $this->pp_hash->encrypt_data($order_id); ?>" class="btn cancel_order_btn red lighten-1">Cancel Order</a>
						<br>
					</div>
					<div class="pp-col pp-margin-tb-15 zero_padding ps12">
<div class="red-text text-lighten-1 font13">
							You Can Cancel Order When Order Status Is Pending.
						</div>
					</div>
	<?php
break;
// case '1':
// 	echo '<span class="font15 p-padding_lr_1rem p-padding_5 border-round teal lighten-1 white-text">Customize Work</span><br>';
// 	break;
// case '2':
// 	echo '<span class="font15 p-padding_lr_1rem p-padding_5 border-round  deep-purple  white-text">Ready To Shipped</span><br>';
// 	break;
// case '3':
// 	echo '<span class="font15 p-padding_lr_1rem p-padding_5 border-round deep-orange lighten-1 white-text">Shipped</span><br>';
// 	break;
case '4':
	if (isset($custom_product_isset) && $custom_product_isset == true) {?>
<div class="pp-col pp-margin-tb-15 zero_padding ps12">
<div class="red-text text-lighten-1 font15">
							You Can Not Return Custom Size Product Order.
						</div>
					</div>
	<?php } else {

		?>
	<div class="pp-col pp-margin-tb-15 zero_padding ps6">
						<!-- <h6 class="font15 grey-text text-darken-4">Name</h6> -->
						<a href="" class="btn red lighten-1">Return Order</a>
						<br>
					</div>
					<div class="pp-col pp-margin-tb-15 zero_padding ps12">
<div class="red-text text-lighten-1 font13">
							You Can Request For Return Order In 7 Days After Delivered Date.
							<br>
							In Return Order We Cut Return Shipping Charge from Payment.
						</div>
					</div>
	<?php }
	break;
case '7': ?>
	<div class="pp-col pp-margin-tb-15 zero_padding ps12">
<div class="red-text text-lighten-1 font14">
							This Order Cancel By You.
						</div>
					</div>
<?php	break;
default:
	if (isset($custom_product_isset) && $custom_product_isset == true) {?>
<div class="pp-col pp-margin-tb-15 zero_padding ps12">
<div class="red-text text-lighten-1 font15">
							You Can Not Return Custom Size Product Order.
						</div>
					</div>
	<?php } else {

		?>

<div class="pp-col pp-margin-tb-15 zero_padding ps12">
<div class="red-text text-lighten-1 font13">
							You Can Request For Return Order In 7 Days After Delivered Date.
							<br>
							In Return Order We Cut Return Shipping Charge from Payment.
						</div>
					</div>
	<?php }
	break;
}

?>


				</div>
			</div>

			<h6 class="font14 font-500 pp-margin-tb-15">MESSAGE</h6>

<div class="pp-col zero_padding ps12">
					<ul class="tabs shipping_add_tabs z-depth-1 tabs-fixed-width">
					<?php if (!empty($order_mst->order_message_by_adm)) {?>	<li class="tab pp-col ps6"><a class="active" href="#customer_message_div">Seller Message</a></li><?php }?>
						<li class="tab pp-col ps6"><a  href="#message_for_customer_div">Message For Seller</a></li>
					</ul>
				</div>


		<?php if (!empty($order_mst->order_message_by_adm)) {?>		<div id="customer_message_div" class="pp-row pp-padres zero_margin card z-depth-1">
				<div class="pp-col ps12">
					<div class="pp-col pp-margin-tb-2 zero_padding ps12">
						<div class="grey-text text-darken-1 font13">
							<?php echo $order_mst->order_message_by_adm; ?>
						</div>
					</div>
				</div>
			</div>
			<?php }?>

<div id="message_for_customer_div" class="pp-row pp-padres zero_margin card z-depth-1">
				<div class="pp-col ps12">
<div class="pp-col  zero_padding ps12">
<div class="grey-text text-darken-1 font13">
<form id="message_for_adm_form" class="pp-form">
<div class="pp-col pp-text-field ps12 zero_padding">
<input type="hidden" class="hidden" name="order_data" value="<?php echo $this->pp_hash->encrypt_data($order_id); ?>">
<textarea placeholder="Write Message For Seller" name="message_txt_area"><?php echo $order_mst->order_message_by_cstm; ?></textarea>
<center><button type="Submit" class="pp-margin-t-7 btn">Submit</button></center>
</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="pp-col  grey-text text-darken-4 card ps12">
		<table class="bordered font14">
			<thead>
				<tr>
					<th colspan="2" data-field="id">Product Details</th>
					<th data-field="name">Price</th>
					<th data-field="price">Size Data</th>
				</tr>
			</thead>
			<tbody>
				<?php
foreach ($order_trn_data['cart_contents'] as $key => $value) {
	if ($key != "cart_total" && $key != 'total_items') {
		?>
				<tr>
					<td><img src="<?php echo base_url('uploads/pro_image/94_130/' . $value['image']); ?>" class="img-responsive"></td>
					<td>
						<!-- <div class="teal-text font15"><?php echo $single_product_data['id_' . $value['id']]->product_name; ?></div> -->
						<div><?php echo 'Product Id : ' . $value['id']; ?></div>
						<div><?php echo 'Sku : ' . $single_product_data['id_' . $value['id']]->product_sku; ?></div>
					</td>
					<td>
						<div><?php echo 'Qty : ' . $value['qty']; ?></div>
						<div><?php echo 'Price : <span class="" price="">' . $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']) . ' ' . number_format((float) $order_trn_data['currency'][$_SESSION['currency_choose']] * $value['price'], 2, '.', '') . '</span>'; ?></div>
						<div><?php echo 'Shipping Charge : <span class="" price="">' . $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']) . ' ' . number_format((float) $order_trn_data['currency'][$_SESSION['currency_choose']] * $order_trn_data['newcart']['shipping_charge'][$value['rowid']], 2, '.', '') . '
						</span>'; ?></div>
						<?php if (isset($value['options'])) {
			if (isset($order_trn_data['newcart']['services_expenses']) && isset($order_trn_data['newcart']['services_expenses'][$value['rowid']])) {
				echo "<div>Customize Charge : <span class='' price=''>
" . $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']) . " " . number_format((float) $order_trn_data['currency'][$_SESSION['currency_choose']] * $order_trn_data['newcart']['services_expenses'][$value['rowid']], 2, '.', '') . "
				</span></div>";
			}
		}?>
<?php if ($order_mst->payment_from == 'paypal') {
			$paypal_data_unser = unserialize(base64_decode($paypal_data->datas));
			foreach ($paypal_data_unser as $paypal_key => $paypal_value) {
				$no = "";
				if (strpos($paypal_key, 'item_number_') !== false) {
					if ($paypal_value == $value['id']) {
						$no = str_replace('item_number_', '', $paypal_key);
					}
				}
				if (!empty($no)) {
					?>
						<div>Total Paid  :<?php echo ($paypal_data_unser['currency_code'] == 'USD') ? 'US$' : '';
					echo ($paypal_data_unser['amount_' . $no] * $paypal_data_unser['quantity_' . $no]);
					if ($_SESSION['currency_choose'] != "USD") {
						echo " (" . $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']) . ' ' . number_format((float) $order_trn_data['currency'][$_SESSION['currency_choose']] * round(($paypal_data_unser['amount_' . $no] * $paypal_data_unser['quantity_' . $no]) * (1 / $order_trn_data['usd_price'])), 2, '.', '') . ")";
					} ?>
					</div>
							<?php }
			}
			?>
<?php } else if ($order_mst->payment_from == 'ccavenue') {

			$service_charge  = (isset($order_trn_data['newcart']['services_expenses'][$value['rowid']])) ? $order_trn_data['newcart']['services_expenses'][$value['rowid']] : 0;
			$shipping_charge = (isset($order_trn_data['newcart']['shipping_charge'][$value['rowid']])) ? $order_trn_data['newcart']['shipping_charge'][$value['rowid']] : 0;
			$total_price     = ($value['price'] + $service_charge + $shipping_charge) * $value['qty'];?>
<div>Total Paid  :<?php echo "<span class='' price='" . round($total_price) . "'>" . $this->ccr->cc('INR', 'INR', round($total_price), 1, 1); ?>
<?php echo ($_SESSION['currency_choose'] != "INR") ? " -  (" . $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']) . ' ' . number_format((float) $order_trn_data['currency'][$_SESSION['currency_choose']] * round($total_price), 2, '.', '') . ")" : ''; ?>

	</span>
</div>
		<?php }?>
						</td>
						<td>
							<?php if (isset($value['options'])) {
			foreach ($value['options'] as $opt_key => $opt_value) {
				if ($opt_value[$opt_key . 'radio'] == 'standard') {
					echo "<div>Standard $opt_key</div>";
					$standard_sizes_keys = explode("#", $opt_value[$opt_key . '_standard_sizes_name']);
					array_pop($standard_sizes_keys);
					foreach ($standard_sizes_keys as $s_size_key => $s_size_value) {
						$size_value = $opt_value[$opt_key . str_replace(" ", "_", $s_size_value)];
						echo "<div class='font13 p-padding_l_10 grey-text text-darken-2'>$s_size_value : $size_value</div>";
					}
				} else if ($opt_value[$opt_key . 'radio'] == 'customize') {
					echo "<div>Customize $opt_key";
					if (isset($order_trn_data['cart']['product_' . $value['rowid']]['mesurement_select_data'])) {
						echo " : <span class='pointer open_model hover-text-primary' data-target='custom_size_model_" . $customize_data['id_' . $value['id']]->id . "' >" . $customize_data['id_' . $value['id']]->name . " (" . $customize_data['id_' . $value['id']]->no . ")</span>";
					}
					echo "</div>";
				}
			}
		}?>
						</td>
					</tr>
					<?php
}}
?>
				</tbody>
			</table>
		</div>
	</div>
	<script>
	function show_confire_box(object){

		swal({
  title: "Are you sure?",
  text: 'You want to cancel this Order?',
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes",
  closeOnConfirm: false
},
function(){
cancel_order(object);
});

}
function cancel_order(objects){
		var order_data = $(objects).attr('order-data');

		$.post(base_url+'account/order_det/cancel_order', {order_data: order_data}, function(data, textStatus, xhr) {
			console.log(data);
			swal.close();
			if(data.result == true){
					 Lobibox.notify('default', {
    msg: 'Order Cancel Successfully.'
});

				location.reload();
			}else{
					 Lobibox.notify('default', {
    msg: 'Error: Reload Page.'
});

				location.reload();
			}
		},"json");
	}
	$(".cancel_order_btn").on('click', function(event) {
		event.preventDefault();
		var objects = $(this);
		show_confire_box(objects);

	});

		$(document).ready(function() {
		$(".open_model").on('click', function(event) {
			event.preventDefault();
			var mo_id = $(this).attr('data-target');
	$('#'+mo_id).openModal();
		});
	$('ul.tabs.shipping_add_tabs').tabs();

	$("#message_for_adm_form").on('submit', function(event) {
		event.preventDefault();
var data = $(this).serialize();
$.post(base_url+'account/order_det/messag', data, function(data, textStatus, xhr) {
	if(data.result == true){
				Materialize.toast('Message Send Successfully.', 3000);
			}else{
				Materialize.toast('Error: Reload Page.', 3000);
				location.reload();
			}
	console.log(data);
},'json');
	});
		});
	</script>
	<style type="text/css" media="screen">
			.size_table	tr td{
		padding: 10px 7px;
	}
	</style>