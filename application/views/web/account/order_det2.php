<!-- <pre class="grey-text text-darken-4"> -->
<?php
$order_trn_data        = unserialize(base64_decode($order_mst->trn_c_data));
$order_trn_return_data = unserialize(base64_decode($order_mst->trn_return_data));
if (isset($ccavenue_data->datas)) {
	$ccavenue_data = unserialize(base64_decode($ccavenue_data->datas));
}
// print_r(unserialize(base64_decode($paypal_data->datas)));
// print_r($order_trn_data);
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
		<h6 class="font18 font-capitalize cp"><?php echo $value->name . ' (' . $value->no . ')'; ?></h6>
		<div class="pp-row">
			<?php
$for_name_keys = explode("#", $value->for_name);
		array_pop($for_name_keys);
		foreach ($for_name_keys as $for_name_keys_key => $for_name_keys_value) {
			?>
			<div class="pp-col ps6">
				<h6 class="font16 teal-text font-500 font-capitalize pp-margin-tb-15"><?php echo $for_name_keys_value; ?></h6>
				<table class="bordered size_table border-1px font13 grey-text text-darken-1">
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
<div class="c-row gm0">
	<?php
switch ($order_mst->status) {
case '7':
	echo '<div class="grid g8mb15 border3-1px red g8ptb7 br10 opacity8 g124"><h6 class="center order_cancel_label g8ls7 g8fw600 font-raleway">Order Cancel By Customer.</h6></div>';
	break;
case '12':
	echo '<div class="grid g8mb15 border3-1px amber g8ptb7 br10 opacity8 g124"><h6 class="center g8ls7 g8fw600 font-raleway">Return Request Accept.</h6></div>';
	break;
case '16':
	echo '<div class="grid g8mb15 border3-1px red g8ptb7 br10 lighten-1 opacity8 g124"><h6 class="center g8ls7 g8fw600 request_can_reason_text font-raleway">Return Request Refuse.</h6></div>';
	break;
default:
	break;
}
?>
	<section class="grid g124 gp0">
		<div class="grid g624 g718">
			<div class="grid g8mtb15 g124">
				<ul class="progressbar g4fs8 g5fs10 g8fs11 grid g124 gpf">
					<li class=" <?php echo ($order_mst->status == 0) ? 'active' : ''; ?>">Placed</li>
					<?php
if ($order_mst->status != 7) {?>
					<li class=" <?php echo ($order_mst->status == 5) ? 'active' : ''; ?>">On Hold</li>
					<li class=" <?php echo ($order_mst->status == 6) ? 'active' : ''; ?>">Confirm</li>
					<?php if (isset($customize_data)) {?><li class=" <?php echo ($order_mst->status == 1) ? 'active' : ''; ?>">Customize</li><?php }?>
					<li class=" <?php echo ($order_mst->status == 2) ? 'active' : ''; ?>">Ready To Ship</li>
					<li class=" <?php echo ($order_mst->status == 3) ? 'active' : ''; ?>">In Transit</li>
					<li class=" <?php echo ($order_mst->status == 8) ? 'active' : ''; ?>">Out For Delivery</li>
					<li class=" <?php echo ($order_mst->status == 4) ? 'active' : ''; ?>">Delivered</li>
					<?php } else {
	echo '<li class="active">Canceled</li>';
}?>
				</ul>
				<div class="grid center g8mt20 g124"><button data-target="track_model" class="c-bbtna open_model g8plr20">Track</button></div>
			</div>
			<?php if ($order_mst->status == 11 || $order_mst->status == 12 || $order_mst->status == 13 || $order_mst->status == 14 || $order_mst->status == 15 || $order_mst->status == 16) {
	?>
			<div class="grid g8mtb15 g124">
				<ul class="progressbar pro_return g4fs8 g5fs10 g8fs11 grid g124 gpf">
					<li class=" <?php echo ($order_mst->status == 11) ? 'active' : ''; ?>">Return Request</li>
					<?php
if ($order_mst->status == 16) {
		echo '<li class="active">Return Request Canceled.</li>';
	} else {
		?>
					<li class=" <?php echo ($order_mst->status == 12) ? 'active' : ''; ?>">Confirmed</li>
					<li class=" <?php echo ($order_mst->status == 13) ? 'active' : ''; ?>">In Transit</li>
					<li class=" <?php echo ($order_mst->status == 14) ? 'active' : ''; ?>">Delivered</li>
					<li class=" <?php echo ($order_mst->status == 15) ? 'active' : ''; ?>">Complete</li>
					<?php }?>
				</ul>
			</div>
			<?php }?>
			<div class="grid g124 g8mt15 white border3-1px g8p17">
				<div class="c-row c-equalspace g8m0"> li
					<div class="grid border-1px bt0 bl0 bb0 g424 g57">
						<h6 class="grey-text g8mtb15 valign-wrapper g8ls30 g8fw500 g8fs13">
						<i class="material-icons g8fs19 left">reorder</i>ORDER ID</h6>
						<h6 class="grey-text text-darken-2 g8fw800 g8ls13 g8fs14 g8mtb10"><?php echo $order_mst->order_id; ?></h6>
					</div>
					<div class="grid border-1px bt0 bl0 bb0 g424 g57">
						<h6 class="grey-text valign-wrapper g8mtb15 g8ls30 g8fw500 g8fs13">
						<i class="material-icons g8fs19 left">query_builder</i>ORDER DATE</h6>
						<h6 class="grey-text text-darken-2 g8fw800 g8ls13 g8fs14 g8mtb10"><?php echo $order_mst->date . " (" . $order_mst->time . ")"; ?></h6>
					</div>
					<div class="grid  g424 g57">
						<h6 class="grey-text valign-wrapper g8mtb15 g8ls30 g8fw500 g8fs13">
						<i class="material-icons g8fs19 left">local_atm</i>ORDER TYPE</h6>
						<h6 class="grey-text text-darken-2 g8fw800 g8ls13 g8fs14 g8mtb10"><?php echo ($order_mst->payment_from == 'cod') ? 'COD' : 'PREPAID'; ?></h6>
					</div>
				</div>
			</div>
			<div class="grid g124 g8mtb15 white  border3-1px g8p17">
				<div class="c-row c-equalspace g8m0">
					<?php if ($order_trn_data['checkout']['billing_address']['address_id'] == $order_trn_data['checkout']['shipping_address']['address_id']) {
	$address = $order_trn_data['checkout']['billing_address'];
	?>
					<div class="grid g424 g524">
						<h6 class="grey-text text-darken-3 g8mtb15 valign-wrapper g8ls20 g8fw500  g8fs13">
						<i class="material-icons font19 left">place</i>ADDRESS</h6>
						<div class="grid g124 grey-text-new zeo_padding">
							<h6 class=" g8ls13 font-capitalize  g8fs13 g8mtb10"><?php echo $address['name']; ?></h6>
							<h6 class="g8lh20  g8ls13 font-capitalize  g8fs13 g8mtb10"><?php echo $address['address1'] . ' ' . $address['address2']; ?></h6>
							<h6 class=" g8ls13 font-capitalize  g8fs13 g8mtb10"><?php echo $address['city'] . ' - ' . $address['post_code']; ?></h6>
							<h6 class=" g8ls13 font-capitalize  g8fs13 g8mtb10"><?php echo $address['state'] . ' - ' . $address['country']; ?></h6>
							<h6 class=" g8ls13 font-capitalize  g8fs13 g8mtb10"><?php echo $address['mobile_no']; ?></h6>
						</div>
					</div>
					<?php } else {
	$address = $order_trn_data['checkout']['billing_address'];
	?>
					<div class="grid  g424 g512">
						<h6 class="grey-text text-darken-3 g8mtb15 valign-wrapper g8ls20 g8fw500 g8fs13">
						<i class="material-icons font19 left">place</i>BILLING ADDRESS</h6>
						<div class="grid grey-text-new g124 zeo_padding">
							<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10"><?php echo $address['name']; ?></h6>
							<h6 class=" g8lh20 g8ls13 font-capitalize g8fs13 g8mtb10"><?php echo $address['address1'] . ' ' . $address['address2']; ?></h6>
							<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10"><?php echo $address['city'] . ' - ' . $address['post_code']; ?></h6>
							<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10"><?php echo $address['state'] . ' - ' . $address['country']; ?></h6>
							<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10"><?php echo $address['mobile_no']; ?></h6>
						</div>
					</div>
					<?php $address = $order_trn_data['checkout']['shipping_address'];?>
					<div class="grid  g424 g512">
						<h6 class="grey-text text-darken-3 g8mtb15 valign-wrapper g8ls20 g8fw500 g8fs13">
						<i class="material-icons font19 left">place</i>SHIPPING ADDRESS</h6>
						<div class="grid grey-text-new g124 zeo_padding">
							<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10"><?php echo $address['name']; ?></h6>
							<h6 class=" g8lh20  g8ls13 font-capitalize g8fs13 g8mtb10"><?php echo $address['address1'] . ' ' . $address['address2']; ?></h6>
							<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10"><?php echo $address['city'] . ' - ' . $address['post_code']; ?></h6>
							<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10"><?php echo $address['state'] . ' - ' . $address['country']; ?></h6>
							<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10"><?php echo $address['mobile_no']; ?></h6>
						</div>
					</div>
					<?php }
?>
				</div>
			</div>
		</div>
		<div class="grid gp0 g624 g76">
			<div class="grid g124  g8mt15 white border3-1px g8p17 ">
				<h6 class="grey-text text-darken-3 g8mtb15 valign-wrapper g8ls20 g8fw500 g8fs13">
				<i class="fa fa-money left font19" aria-hidden="true"></i>ORDER TOTAL</h6>
				<div class="grid grey-text-new g124 zeo_padding">
					<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">
					<span>Products Price</span>
					<span class="right"><?php echo $this->ccr->cfa($order_trn_data['currency'], ($order_trn_data['cart_contents']['cart_total'] + $order_trn_data['newcart']['total_service_charges'])); ?></span>
					</h6>
					<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">
					<span>Shipping Price</span>
					<span class="right "><?php echo $this->ccr->cfa($order_trn_data['currency'], $order_trn_data['newcart']['total_shipping_charges']); ?></span>
					</h6>
					<div class="divider grey lighten-3"></div>
					<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">
					<span>Order Total</span>
					<span class="right " price="<?php
$paid_by_amt = $order_trn_data['cart_contents']['cart_total'] + $order_trn_data['newcart']['total_other_charges'];
$remian_amt  = $paid_by_amt;
?>"><?php echo $this->ccr->cfa($order_trn_data['currency'], $paid_by_amt); ?></span>
					</h6>
					<?php
if (isset($order_trn_data['cart_coupen_data'])) {
	if ($order_trn_data['cart_coupen_data']->discount_type == 0) {
		$title     = "Discount";
		$dis_total = $order_trn_data['cart_coupen_data']->dis_percet_rs;
	} elseif ($order_trn_data['cart_coupen_data']->discount_type == 1) {
		$title     = "Discount " . $order_trn_data['cart_coupen_data']->dis_percet_rs . "%";
		$dis_total = round(($order_trn_data['cart_contents']['cart_total'] + $order_trn_data['newcart']['total_service_charges']) * $order_trn_data['cart_coupen_data']->dis_percet_rs / 100);
	}
	$remian_amt = $paid_by_amt - $dis_total;
	?>
					<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">
					<span><?php echo $title; ?></span>
					<span class="right"><?php echo $this->ccr->cfa($order_trn_data['currency'], $dis_total); ?></span>
					</h6>
					<?php }
if ($order_mst->payment_from == 'paypal') {
	$title       = "Paid to Paypal";
	$paid_by_amt = round((1 / $order_trn_data['currency']['USD']) * $order_trn_return_data['get']['amt']);
	$remian_amt  = $remian_amt - $paid_by_amt;
} else if ($order_mst->payment_from == 'ccavenue') {
	$title       = "Paid to CCavenue";
	$paid_by_amt = $ccavenue_data['amount'];
	$remian_amt  = $remian_amt - $paid_by_amt;
}
if ($order_mst->payment_from == 'paypal' || $order_mst->payment_from == 'ccavenue') {
	?>
					<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">
					<span><?php echo $title; ?></span>
					<span class="right"><?php echo $this->ccr->cfa($order_trn_data['currency'], $paid_by_amt); ?></span>
					</h6>
					<?php }
if ($order_mst->payment_from == 'cod' && !empty($order_mst->delivered_date)) {
	$paid_by_amt = $remian_amt;
	$remian_amt  = $remian_amt - $paid_by_amt;
	?>
<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">
					<span>Paid Amount</span>
					<span class="right price" price="<?php echo $paid_by_amt; ?>"></span>
					</h6>
<?php }
?>
					<div class="divider grey lighten-3"></div>
					<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">
					<span>Remain amt</span>
					<span class="right"><?php echo $this->ccr->cfa($order_trn_data['currency'], $remian_amt); ?></span>
					</h6>
					<?php if ($order_mst->status == 15) {?>

					<div class="divider grey lighten-3"></div>
					<div class="divider grey lighten-3"></div>
					<h6 class="grey-text text-darken-3 g8mtb15 valign-wrapper g8ls20 g8fw500 g8fs13">
		<i class="material-icons font19 left">local_shipping</i>RETURN ORDER TRANSACTION</h6>
		<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>Paid Amount</span>
			<span class="right price" price="<?php echo $paid_by_amt; ?>"></span>
			</h6>
			<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>- Return Charges</span>
			<span class="right price" price="<?php echo $paid_by_amt - $order_mst->return_com_price; ?>"></span>
			</h6>
			<div class="divider grey lighten-3"></div>

			<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>Refunded Amount</span>
			<span class="right price" price="<?php echo $order_mst->return_com_price; ?>"></span>
			</h6>
			<?php }?>
				</div>
			</div>

			<?php if (isset($order_trn_data['cart_coupen_data'])) {
	?>
			<div class="grid g124  g8mt15 white border3-1px g8p8 ">
				<div class="grid grey-text-new g124 zeo_padding">
					<?php
if (isset($order_trn_data['cart_coupen_data'])) {?>
					<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">
					<span>Coupen Use : </span>
					<span class="right"><?php echo $order_trn_data['cart_coupen_data']->code; ?></span>
					</h6>
					<?php }
	?>
				</div>
			</div>
			<?php }?>
			<?php
if (($order_mst->status == 11 || $order_mst->status == 12 || $order_mst->status == 13 || $order_mst->status == 14 || $order_mst->status == 15) && isset($bank_detail)) {
	if ($bank_detail->payment_to == 'paypal') {?>
			<div class="grid g124  g8mt15 white border3-1px g8p17 ">
				<h6 class="grey-text text-darken-3 g8mtb15 valign-wrapper g8ls20 g8fw500 g8fs13">
				<i class="material-icons font19 left">account_balance</i>PAYPAL ACCOUNT DETAIL</h6>
				<div class="grid grey-text-new g124 zeo_padding">
					<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">
					<span>Username</span>
					<span class="right"><?php echo $bank_detail->paypal_username; ?></span>
					</h6>
					<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">
					<span>Email Id</span>
					<span class="right "><?php echo $bank_detail->paypal_email; ?></span>
					</h6>
					<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">
					<span>Mobile no</span>
					<span class="right " price=""><?php echo $bank_detail->paypal_mobile_no; ?></span>
					</h6>
				</div>
			</div>
			<?php } else {?>
<div class="grid g124  g8mt15 white border3-1px g8p17 ">
				<h6 class="grey-text text-darken-3 g8mtb15 valign-wrapper g8ls20 g8fw500 g8fs13">
				<i class="material-icons font19 left">account_balance</i>CUSTOMER BANK DETAIL</h6>
				<div class="grid grey-text-new g124 zeo_padding">
					<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">
					<span>Name</span>
					<span class="right"><?php echo $bank_detail->account_holder_name; ?></span>
					</h6>
					<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">
					<span>Account no</span>
					<span class="right "><?php echo $bank_detail->account_no; ?></span>
					</h6>
					<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">
					<span>IFSC Code</span>
					<span class="right " price=""><?php echo $bank_detail->ifsc_code; ?></span>
					</h6>
				</div>
			</div>
				<?php }}?>
		</div>
	</section>
	<!-- ****************************************************************************
	*                       Second Section 1) Status Boc 2) shipping parcel details                      *
	*****************************************************************************-->
	<!-- Modal Structure -->
	<section class="grid g124 gp0">
		<div class="grid g624 g716">
			<div class="grid g124 g8mt15 white border3-1px g8p17">
				<div class="c-row c-equalspace g8m0">
					<div class="grid  g424 g57">
						<h6 class="grey-text g8mtb15 valign-wrapper g8ls30 g8fw500 g8fs13">
						<i class="material-icons g8fs19 left">reorder</i>ORDER ID</h6>
						<h6 class="grey-text text-darken-2 g8fw800 g8ls13 g8fs14 g8mtb10"><?php echo $order_mst->order_id; ?></h6>
					</div>
					<div class="grid  g424 g57">
						<h6 class="grey-text valign-wrapper g8mtb15 g8ls30 g8fw500 g8fs13">
						<i class="material-icons g8fs19 left">query_builder</i>ORDER DATE</h6>
						<h6 class="grey-text text-darken-2 g8fw800 g8ls13 g8fs14 g8mtb10"><?php echo $order_mst->date . " (" . $order_mst->time . ")"; ?></h6>
					</div>
					<div class="grid  g424 g57">
						<h6 class="grey-text valign-wrapper g8mtb15 g8ls30 g8fw500 g8fs13">
						<i class="material-icons g8fs19 left">local_atm</i>ORDER TYPE</h6>
						<h6 class="grey-text text-darken-2 g8fw800 g8ls13 g8fs14 g8mtb10"><?php echo ($order_mst->payment_from == 'cod') ? 'COD' : 'PREPAID'; ?></h6>
					</div>
				</div>
			</div>
		</div>
		<div class="grid gp0 g624 g78">
			<div class="grid g124 gpf g8mt15 white border3-1px g8p17 ">
				<?php
switch ($order_mst->status) {
case '0':
case '5':
	?>
				<div class="pp-col pp-margin-tb-15 zero_padding ps6">
					<!-- <h6 class="font15 grey-text text-darken-4">Name</h6> -->
					<button href="" order-data="<?php echo $this->pp_hash->encrypt_data($order_id); ?>" class="c-bbtnp g8plr15 cancel_order_btn">Cancel Order</button>
					<br>
				</div>
				<?php
break;
case '1': ?>
				<div class="pp-col pp-margin-tb-15 zero_padding ps12">
					<div class="grey-text g8fs13 g8ls7 text-darken-1">
						You Can Not Cancel Custom Size Product Order.
					</div>
				</div>
				<?php break;
case '9': ?>
				<div class="pp-col pp-margin-tb-15 zero_padding ps12">
					<div class="red-text g8fs13 g8ls7 text-lighten-1">
						Delivery Exception. Customer not Accept a Product.
					</div>
				</div>
				<?php break;
// case '2':
// 	echo '<span class="font15 p-padding_lr_1rem p-padding_5 border-round  deep-purple  white-text">Ready To Shipped</span><br>';
// 	break;
case '16':
case '4':
	if (isset($custom_product_isset) && $custom_product_isset == true && $order_mst->order_from != 'af') {?>
				<div class="pp-col pp-margin-tb-15 zero_padding ps12">
					<div class="grey-text g8fs13 g8ls7 text-darken-1">
						You Can Not Return Custom Size Product Order.
					</div>
				</div>
				<?php } else if ($order_mst->order_from != 'af') {
		if ($order_mst->status == 16) {
		}
		?>
				<!-- <h6 class="font15 grey-text text-darken-4">Name</h6> -->
				<?php
$today           = date('d-m-Y');
		$today           = DateTime::createFromFormat('d-m-Y', date('d-m-Y', strtotime($today)));
		$delivery_date   = DateTime::createFromFormat('d-m-Y', date('d-m-Y', strtotime($order_mst->delivered_date)));
		$contractDateEnd = DateTime::createFromFormat('d-m-Y', date('d-m-Y', strtotime("+7 day", strtotime($order_mst->delivered_date))));
		if (($delivery_date <= $today) && ($today <= $contractDateEnd)) {
			$return_request_btn = true;
			?>
				<div class="pp-col pp-margin-tb-15 zero_padding ps12">
				<center class="return_order_progressbar hidden"><div class="spinner h30 g8mt0 g8mlr0 g8mb10">
				<div class="rect1"></div>
				<div class="rect2"></div>
				<div class="rect3"></div>
				<div class="rect4"></div>
				<div class="rect5"></div>
			</div>
  </center>
					<button href="" order-data="<?php echo $this->pp_hash->encrypt_data($order_id); ?>" class="return_request_btn c-bbtnp g8plr15">Return Order</button>
					<br>
				</div>
				<h6 class="grey-text g8fs13 g8ls7 text-darken-1">In Return Order We Debit Return Shipping Charge from Payment.</h6>
				<?php }?>
				<div class="pp-col g8mb15 zero_padding ps12">
					<div class="grey-text g8fs13 g8ls7 text-darken-1">
						You Can Request For Return Order In 7 Days After Delivered Date.
						<br>
					</div>
				</div>
				<?php }
	break;
case '7': ?>
				<div class="pp-col pp-margin-tb-15 zero_padding ps12">
					<div class="red-text g8fs13 g8ls7 text-lighten-1">
						Order Cancel By You.
					</div>
				</div>
				<?php	break;
case '11':
	$cancel_return_request_order = true;
	?>
				<div class="pp-col pp-margin-tb-15 zero_padding ps12">
					<button order-data="<?php echo $this->pp_hash->encrypt_data($order_id); ?>" class="c-bbtnp cancel_return_request_btn g8plr15 ">Cancel Return Request</button>
					<br>
					<h6 class="grey-text g8fs13 g8ls7 text-darken-1">In Return Order We Debit Return Shipping Charge from Payment.</h6>
				</div>
				<?php
break;
case '12':
	?>
				<div class="pp-col pp-margin-tb-15 zero_padding ps12">
					<!-- <button href="" order-data="<?php echo $this->pp_hash->encrypt_data($order_id); ?>" class="c-bbtnp g8plr15 cancel_order_btn">Cancel Return Request</button> -->
					<a target="_blank" class="blue-text font-karla lable_link"><i class="material-icons vam g8pr10 g8fs18">file_download</i>Label</a>
					<h6 class="grey-text g8fs13 g8ls7 text-darken-1">Return Request Accept. Print Return Label and Ready your parcel.</h6>
				</div>
				<?php
break;
default:
	if (isset($custom_product_isset) && $custom_product_isset == true) {?>
				<div class="pp-col pp-margin-tb-15 zero_padding ps12">
					<div class="red-text text-lighten-1 font15">
						You Can Not Return Custom Size Product Order.
					</div>
				</div>
				<?php } else if ($order_mst->order_from != 'af') {
		?>
				<div class="pp-col pp-margin-tb-15 zero_padding ps12">
					<div class="grey-text g8fs13 g8ls7 text-darken-1">
						You Can Request For Return Order In 7 Days After Delivered Date.
						<br>
						In Return Order We Debit Return Shipping Charge from Payment.
					</div>
				</div>
				<?php }
	break;
}
?>
			</div>
		</div>
	</section>
	<!-- ****************************************************************************
	*                             All Product Show                             *
	**************************************************************************** -->
	<section class="grid g124  g8mtb15">
		<div class="grid gp0 g124 white border3-1px">
			<div class="grid g124 gp0">
				<?php foreach ($order_trn_data['cart_contents'] as $key => $value) {
	if ($key != "cart_total" && $key != 'total_items') {
		?>
				<div class="grid valign-wrapper g124">
					<div class="grid g8mt7 gp0 g46 g54 g64 g72">
						<img class="responsive-img br4" src="<?php echo base_url('uploads/pro_image/94_130/' . $value['image']); ?>">
					</div>
					<div class="grid g8mt7 gpf g8pl15 g418 g514 g612 g714">
						<div class="grid g424">
							<h6 class="cp g8mtb4 name-title g8ls7 g8fs14 font-roboto"><a class="black-text" href="<?php echo base_url('product/quick/product/' . $value['sku'] . '/' . $value['id'] . '/' . $value['name']); ?>"><?php echo $value['name']; ?></a></h6>
						</div>

						<div class="grid g124">
							<h6 class="grey-text g8fs12 g8mtb4 text-darken-1"><span class="g8pr7"><?php echo (isset($value['sku'])) ? 'Sku :- ' . $value['sku'] : ''; ?></span>
							<?php echo 'Qty :- ' . $value['qty']; ?></h6>
						</div>
						<div class="grid g124">
							<?php
$total_product_price = $value['price'];
		if (isset($order_trn_data['newcart']['services_expenses'])) {
			if (isset($order_trn_data['newcart']['services_expenses'][$value['rowid']])) {
				$total_product_price = $value['price'] + $order_trn_data['newcart']['services_expenses'][$value['rowid']];
			}
		}
		?>
							<h6 class="grey-text text-darken-3 g8fs13 g8mtb4 g8fw500"><?php echo $this->ccr->cfa($order_trn_data['currency'], $total_product_price); ?></h6>
						</div>
					</div>
					<div class="grid gpf grey-text text-darken-4 g8fs13 g8mt7 g8pl15 g4addn g56 g68 g78">
						<?php if (isset($value['options'])) {
			foreach ($value['options'] as $opt_key => $opt_value) {
				if ($opt_value[$opt_key . 'radio'] == 'standard') {
					echo "<div>Standard $opt_key</div>";
					$standard_sizes_keys = explode("#", $opt_value[$opt_key . '_standard_sizes_name']);
					array_pop($standard_sizes_keys);
					foreach ($standard_sizes_keys as $s_size_key => $s_size_value) {
						$size_value = $opt_value[$opt_key . str_replace(" ", "_", $s_size_value)];
						echo "<div class='g8fs12 p-padding_l_10 grey-text text-darken-2'>$s_size_value : $size_value</div>";
					}
				} else if ($opt_value[$opt_key . 'radio'] == 'customize') {
					echo "<div>Customize $opt_key";
					if (isset($order_trn_data['cart']['product_' . $value['rowid']]['mesurement_select_data'])) {
						echo " : <span class='pointer open_model hover-text-primary' data-target='custom_size_model_" . $customize_data['id_' . $value['id']]->id . "' >" . $customize_data['id_' . $value['id']]->name . " (" . $customize_data['id_' . $value['id']]->no . ")</span>";
					}
					echo "</div>";
				} else {
					echo "<div class='opacity5'>Unstitched $opt_key </div>";
				}
			}
		} else {
			echo "<div  class='opacity5'>Unstitched Full Product</div>";
		}
		?>
					</div>
				</div>
				<div class="divider"></div>
				<?php }}?>
			</div>
		</div>
	</section>
</div>
<!-- ////////// Track_model ////////////////////-->
<div id="track_model" class="modal black-text small_model modal-fixed-footer">
	<div class="modal-content">
		<h6 class="center font-roboto_slab cp g8fs18">Track Product</h6>
		<div class="divider g8mt10"></div>
		<div class="track-model-content">
			<div class="spinner">
				<div class="rect1"></div>
				<div class="rect2"></div>
				<div class="rect3"></div>
				<div class="rect4"></div>
				<div class="rect5"></div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class=" modal-action right g8plr13 modal-close waves-effect c-btnf">Close</button>
	</div>
</div>
<!-- /////////////// End Track_model ////////////////////-->

<!-- ////////// Return Payment Data Form ////////////////////-->
<?php if (isset($return_request_btn)) {if ($order_mst->payment_from == 'paypal') {?>
<div id="bank_payment_data_model" class="modal black-text small_model">
	<div class="modal-content">
		<h6 class="center font-roboto_slab cp g8fs18">Paypal Account Detail</h6>
		<div class="divider g8mt10"></div>
		<div class="bank-detail-model-content">
			<div class="spinner bank-detail-from-loader hidden">
				<div class="rect1"></div>
				<div class="rect2"></div>
				<div class="rect3"></div>
				<div class="rect4"></div>
				<div class="rect5"></div>
			</div>
			<h6 class="center g8lh19 font-karla g8fs13 g8pt10 g8fw600">When we recived return product. We send return payment to this account.</h6>
			<div class="pp-form">
				<form class="" id="payapl_detail_form" accept-charset="utf-8">
					<div class="grid g8mtb30 input-field g812">
						<i class="material-icons prefix">account_box</i>
						<label for="account_username" class="active">Paypal Username</label>
						<input id="account_username" value="" name="paypal_username" required="" class="" type="text">
					</div>
					<div class="grid g8mtb30 input-field g812">
						<i class="material-icons prefix">mail</i>
						<label for="account_paypal_email" class="active">Paypal Email id</label>
						<input id="account_paypal_email" value="" name="account_paypal_email" required="" class="" type="text">
					</div>
					<div class="grid g8mtb30 input-field g812">
						<i class="material-icons prefix">phone</i>
						<label for="paypal_mobile_no" class="active">Paypal Mobile no</label>
						<input id="paypal_mobile_no" value="" name="paypal_mobile_no" required="" class="only-number" type="text">
						<input type="hidden" name="order_data" value="<?php echo $this->pp_hash->encrypt_data($order_id); ?>">
						<input type="hidden" name="order_order_data" value="<?php echo $this->pp_hash->encrypt_data($order_mst->order_id); ?>">
					</div>
					<center><button type="submit" class="c-btnp g8plr10">Submit</button></center>
				</form>
			</div>
		</div>
	</div>
	<!-- <div class="modal-footer">
		<button class=" modal-action right g8plr13 modal-close waves-effect c-btnf">Close</button>
	</div> -->
</div>
<?php } else {?>
<!-- /////////////// End Return Payment data ////////////////////-->
<!-- ////////// Return Paypal Data Form ////////////////////-->

<div id="bank_payment_data_model" class="modal black-text small_model">
	<div class="modal-content">
		<h6 class="center font-roboto_slab cp g8fs18">Bank Account Detail</h6>
		<div class="divider g8mt10"></div>
		<div class="bank-detail-model-content">
			<div class="spinner bank-detail-from-loader hidden">
				<div class="rect1"></div>
				<div class="rect2"></div>
				<div class="rect3"></div>
				<div class="rect4"></div>
				<div class="rect5"></div>
			</div>
			<h6 class="center g8lh19 font-karla g8fs13 g8pt10 g8fw600">When we recived return product. We send return payment to this account.</h6>
			<div class="pp-form">
				<form class="" id="bank_detail_form" accept-charset="utf-8">
					<div class="grid g8mtb30 input-field g812">
						<i class="material-icons prefix">account_box</i>
						<label for="account_holde_name" class="active">Account Holder Name</label>
						<input id="account_holde_name" value="" name="account_holde_name" required="" class="" type="text">
					</div>
					<div class="grid g8mtb30 input-field g812">
						<i class="material-icons prefix">account_balance_wallet</i>
						<label for="account_no" class="active">Account No</label>
						<input id="account_no" value="" name="account_no" required="" class="only-number" type="text">
					</div>
					<div class="grid g8mtb30 input-field g812">
						<i class="material-icons prefix">account_balance_wallet</i>
						<label for="confirm_account_no" class="active">Confirm Account No</label>
						<input id="confirm_account_no" value="" name="confirm_account_no" required="" class="only-number" type="text">
						<input type="hidden" name="order_data" value="<?php echo $this->pp_hash->encrypt_data($order_id); ?>">
						<input type="hidden" name="order_order_data" value="<?php echo $this->pp_hash->encrypt_data($order_mst->order_id); ?>">
					</div>
					<div class="grid g8mtb30 input-field g812">
						<i class="material-icons prefix">account_balance</i>
						<label for="ifsc_code" class="active">IFSC Code</label>
						<input id="ifsc_code" value="" name="ifsc_code" required="" class="" type="text">
					</div>
					<center><button type="submit" class="c-btnp g8plr10">Submit</button></center>
				</form>
			</div>
		</div>
	</div>
	<!-- <div class="modal-footer">
		<button class=" modal-action right g8plr13 modal-close waves-effect c-btnf">Close</button>
	</div> -->
</div>
<?php }}?>
<!-- /////////////// End Pyapal Payment data ////////////////////-->
<script>
$(document).ready(function() {
var u_order_id = <?php echo $order_mst->id; ?>;
$(".open_model").on('click', function(event) {
event.preventDefault();
var mo_id = $(this).attr('data-target');
$('#'+mo_id).openModal();
});
get_status();
function get_status(){
var order_id = u_order_id;
$.post(base_url+'account/order_det/get_order_status', {order_id: order_id}, function(data, textStatus, xhr) {
var html = "";
var track_model_html = "";
var status_id = '';
console.log(data);
$.each(data.result.reverse(), function(index, val) {
if (status_id != val.status_id) {
track_model_html += '<p><i class="material-icons g8fs19 vam g8pr6">chevron_right</i><span class="vam font-capitalize g8ls7">'+val.status+'</span></p>';
status_id = val.status_id;
}
if(val.status_id == '16'){
$(".request_can_reason_text").html("Return Request Refuse, "+val.message);
}
if(val.status_id == '7'){
$(".order_cancel_label").html("Order Cancel "+val.status_text);
}
track_model_html += '<h6 class="g8fs12 g8lh17 g8pl25 g8ls8 grey-text ">'+val.message+'<br><i class="g8fs11">'+val.time+', '+val.date+'</i></h6>';
html += '<h6 class="g8fs13"><span>['+val.date+']['+val.time+']</span><span class="right font-capitalize">'+val.status+'</span></h6>';
});
$(".track-model-content").html(track_model_html);
$("#status_box").html(html);
},'json');
}

function show_confire_box(object){
swal({
title: "Are you sure?",
text: 'You want to cancel this Order?',
type: "input",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Yes",
closeOnConfirm: false,
inputPlaceholder: "Cancel Reason."
},
function(inputValue){
if (inputValue === false) return false;
if (inputValue === "") {
swal.showInputError("You need to write reason!");
return false
}
cancel_order(object,inputValue);
});
}
function cancel_order(objects,inputValue){
swal.close();
$(objects).text('Processing..');
$(objects).removeClass('cancel_order_btn');
var order_data = $(objects).attr('order-data');
$.post(base_url+'account/order_det/cancel_order', {order_data: order_data,reason:inputValue}, function(data, textStatus, xhr) {
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
<?php
if (isset($cancel_return_request_order)) {?>
function show_return_cancel_confire_box(object){
swal({
title: "Are you sure?",
text: 'You want to Cancel Return request?',
type: "warning",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Yes",
closeOnConfirm: false,
},
function(){
cancel_return_order_request(object);
});
}
function cancel_return_order_request(object){
var order_data = $(object).attr('order-data');
$.post(base_url+'account/order_det/return_order', {order_data: order_data}, function(data, textStatus, xhr) {
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
$(".return_request_btn").on('click', function(event) {
event.preventDefault();
var objects = $(this);
show_return_cancel_confire_box(objects);
});
<?php }?>
<?php
if ($order_mst->status == '12') {?>
get_return_label();
function get_return_label(){
var order_id = u_order_id;
$.post(base_url+'account/order_det/get_return_label', {order_id: order_id}, function(data, textStatus, xhr) {
console.log(data);
if (data.result) {
$("a.lable_link").attr('href',data.data.data);
}
},'json');
}
<?php }
if (isset($return_request_btn)) {?>

//  Form bank Detail Submit
<?php if ($order_mst->payment_from == 'paypal') {?>
function open_bank_model(object,textmessage){
	$("#bank_payment_data_model").openModal();
$("#payapl_detail_form").on('submit', function(event) {
event.preventDefault();
$(".return_order_progressbar").removeClass('hidden');
$(".bank-detail-from-loader").removeClass('hidden');
$(".return_request_btn").addClass('hidden');
var datas= $(this).serialize();
$.post(base_url+'account/order_det/add_paypal_detail',  datas  , function(data, textStatus, xhr) {
	$(".bank-detail-from-loader").addClass('hidden');
if(data.result == true){
	Lobibox.notify('success', {

    msg: 'Bank Data Save Successfully.',

});
	    $("#bank_payment_data_model").closeModal();
	    $(".return_order_progressbar").addClass('hidden');
return_order_request(object,textmessage);
	$('#payapl_detail_form').find("input[type]").removeClass('invalid');
$('#payapl_detail_form').find('.pp-error-text').remove();
$('#payapl_detail_form').find('.input-field').removeClass('pp-error');
// location.href = base_url+'account/dashboard';
    // $('#bank_detail_form').find("input[type]").val("");
}else{
   Lobibox.notify('error', {

    msg: 'Form Data Not Valid.'
});
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#payapl_detail_form [name='"+index+"']").addClass('invalid');
$("#payapl_detail_form [name='"+index+"']").parent('.input-field').addClass('pp-error');
$("#payapl_detail_form [name='"+index+"']").parent('.input-field').children('span.pp-error-text').remove();
$("#payapl_detail_form [name='"+index+"']").parent('.input-field').append('<span class="pp-error-text red-text g8fs13 g8pl3rem font-karla font-capitalize">'+el+'</span>');
});
}
},'json');
});
}

<?php } else {?>
function open_bank_model(object,textmessage){
	$("#bank_payment_data_model").openModal();
$("#bank_detail_form").on('submit', function(event) {
event.preventDefault();
$(".return_order_progressbar").removeClass('hidden');
$(".bank-detail-from-loader").removeClass('hidden');
$(".return_request_btn").addClass('hidden');
var datas= $(this).serialize();
$.post(base_url+'account/order_det/add_bank_detail',  datas  , function(data, textStatus, xhr) {
	$(".bank-detail-from-loader").addClass('hidden');
if(data.result == true){
	Lobibox.notify('success', {

    msg: 'Bank Data Save Successfully.',

});
	    $("#bank_payment_data_model").closeModal();
	    $(".return_order_progressbar").addClass('hidden');
return_order_request(object,textmessage);
	$('#bank_detail_form').find("input[type]").removeClass('invalid');
$('#bank_detail_form').find('.pp-error-text').remove();
$('#bank_detail_form').find('.input-field').removeClass('pp-error');
// location.href = base_url+'account/dashboard';
    // $('#bank_detail_form').find("input[type]").val("");
}else{
   Lobibox.notify('error', {

    msg: 'Form Data Not Valid.'
});
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#bank_detail_form [name='"+index+"']").addClass('invalid');
$("#bank_detail_form [name='"+index+"']").parent('.input-field').addClass('pp-error');
$("#bank_detail_form [name='"+index+"']").parent('.input-field').children('span.pp-error-text').remove();
$("#bank_detail_form [name='"+index+"']").parent('.input-field').append('<span class="pp-error-text red-text g8fs13 g8pl3rem font-karla font-capitalize">'+el+'</span>');
});
}
},'json');
});
}

<?php }?>
//  End Form submit


function show_return_confire_box(object){
swal({
title: "Are you sure?",
text: 'You want to Return this Order?',
type: "input",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Yes",
closeOnConfirm: false,
inputPlaceholder: "Reason Of Return."
},
function(inputValue){
if (inputValue === false) return false;
if (inputValue === "") {
swal.showInputError("You need to write something!");
return false
}

open_bank_model(object,inputValue);
swal.close(object,inputValue);
// $("#bank_payment_data_model").openModal();
// return_order_request(object,inputValue);
});
}
function return_order_request(object,inputValue){
	$(".return_request_btn").addClass('hidden');
	$(".return_order_progressbar").removeClass('hidden');
var order_data = $(object).attr('order-data');
$.post(base_url+'account/order_det/return_order', {order_data: order_data,reason:inputValue}, function(data, textStatus, xhr) {
console.log(data);
swal.close();
if(data.result == true){
	$(".return_order_progressbar").addClass('hidden');
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
$(".return_request_btn").on('click', function(event) {
event.preventDefault();
var objects = $(this);
show_return_confire_box(objects);
});
<?php }?>
});
</script>
<style>
.progressbar {
margin: 0;
padding: 0;
counter-reset: step;
}
.progressbar li {
list-style-type: none;
<?php if ($order_mst->status == 7) {echo 'width: 50%;';} else {echo (isset($customize_data)) ? 'width: 12.05%;' : 'width: 14.28%;';}?>
letter-spacing: 1.2px;
font-weight: 500;
float: left;
position: relative;
text-align: center;
text-transform: uppercase;
color: #61C26E;
}
.progressbar li:before {
width: 30px;
height: 30px;
content: counter(step);
counter-increment: step;
font-weight: 600;
line-height: 27px;
border: 2px solid #61C26E;
display: block;
text-align: center;
margin: 0 auto 10px auto;
border-radius: 50%;
background-color: white;
}
.progressbar li:after {
width: 100%;
height: 2px;
content: '';
position: absolute;
background-color: #61C26E;
top: 15px;
left: -50%;
z-index: -1;
}
.progressbar li:first-child:after {
content: none;
}
.progressbar li.active {
color: #61C26E;
}
.progressbar li.active:before {
line-height: 28px;
font-size: 15px;
content: "";
font-family: "FontAwesome";
border-color: #61C26E;
color: #61C26E;
}
.progressbar li.active ~ li:before{
border-color: #7d7d7d;
}
.progressbar li.active ~ li{
color: #7d7d7d;
}
.progressbar li.active ~ li:after {
background-color: #7d7d7d;
}
.pro_return {
margin: 0;
padding: 0;
counter-reset: step;
}
.pro_return li {
<?php echo ($order_mst->status == 16) ? 'width: 50%;' : 'width: 20%;'; ?>
color: #EA4335;
}
.pro_return li:before {
border: 2px solid #EA4335;
}
.pro_return li:after {
background-color: #EA4335;
}
.pro_return li.active {
color: #EA4335;
}
.pro_return li.active:before {
border-color: #EA4335;
color: #EA4335;
}
.maxh160{
max-height: 160px;
overflow-y: scroll;
}
.maxh30{
max-height: 30px;
}
</style>