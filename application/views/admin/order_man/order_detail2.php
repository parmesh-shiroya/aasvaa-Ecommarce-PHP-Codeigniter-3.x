<!-- <pre class="grey-text text-darken-4"> -->

	<?php
$order_trn_data        = unserialize(base64_decode($order_mst->trn_c_data));
$order_trn_return_data = unserialize(base64_decode($order_mst->trn_return_data));
// print_r($order_trn_return_data);
// print_r($order_trn_data);
if (isset($ccavenue_data->datas)) {
	$ccavenue_data = unserialize(base64_decode($ccavenue_data->datas));
}
// if (isset($paypal_data->datas)) {
// 	$paypal_data = unserialize(base64_decode($paypal_data->datas));
// }
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
		<div class="c-row">
			<?php
$for_name_keys = explode("#", $value->for_name);
		array_pop($for_name_keys);
		foreach ($for_name_keys as $for_name_keys_key => $for_name_keys_value) {
			?>
			<div class="grid g112">
				<h6 class="g8fs16 teal-text g8fw500 font-capitalize g8mtb15 "><?php echo $for_name_keys_value; ?></h6>
				<table class="bordered size_table border-1px g8fs13 grey-text text-darken-1">
					<tbody>
						<?php foreach (unserialize(base64_decode($value->data)) as $custom_size_data_key => $custom_size_data_value) {
				// echo $for_name_keys_key;
				if (strpos($custom_size_data_key, $for_name_keys_value . "#") !== false) {?>
						<tr>
							<td class="g8fs14 grey-text text-darken-4"><?php echo str_replace($for_name_keys_value . "#", "", $custom_size_data_key); ?></td>
							<td><?php echo $custom_size_data_value; ?></td>
						</tr>
						<?php } else if (strpos($custom_size_data_key, $for_name_keys_value) !== false) {?>
						<tr>
							<td class="g8fs14 grey-text text-darken-4"><?php echo $custom_size_data_key; ?></td>
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
<?php }}
?>
<?php
if ($this->input->get('message')) {?>
	<div class="c-row gmf center"><div class="grid g9f g124"><h6 class="red-text g8lh20 font-scope_one g8fw600 g8ls10 center ">Something Wrong.<br><?php echo $this->input->get('message'); ?></h6></div></div>
<?php }?>
<div class="c-row gm0">
	<section class="grid g124 gp0">
		<div class="grid g118">
			<div class="grid g124 g8mtb15 white border3-1px g8p17">
				<div class="c-row c-equalspace g8m0">
					<div class="grid g17">
						<h6 class="grey-text g8mtb15 valign-wrapper g8ls30 g8fw500 g8fs13">
						<i class="material-icons g8fs19 left">reorder</i>ORDER ID</h6>
						<h6 class="grey-text text-darken-2 g8fw800 g8ls13 g8fs14 g8mtb10"><?php echo $order_mst->order_id; ?></h6>
					</div>
					<div class="grid g18">
						<h6 class="grey-text valign-wrapper g8mtb15 g8ls30 g8fw500 g8fs13">
						<i class="material-icons g8fs19 left">query_builder</i>ORDER DATE</h6>
						<h6 class="grey-text text-darken-2 g8fw800 g8ls13 g8fs14 g8mtb10"><?php echo $order_mst->date . " (" . $order_mst->time . ")"; ?></h6>
					</div>
					<div class="grid g17">
						<h6 class="grey-text valign-wrapper g8mtb15 g8ls30 g8fw500 g8fs13">
						<i class="material-icons g8fs19 left">local_atm</i>ORDER TYPE</h6>
						<h6 class="grey-text text-darken-2 g8fw800 g8ls13 g8fs14 g8mtb10"><?php echo ($order_mst->payment_from == 'cod') ? 'COD' : 'PREPAID'; ?></h6>
					</div>
				</div>
			</div>
			<div class="grid g124 g8mtb15 white  border3-1px g8p17">
				<div class="c-row c-equalspace g8m0">
					<div class="grid g18">
						<h6 class="grey-text text-darken-3 g8mtb15 valign-wrapper g8ls20 g8fw500 g8fs13">
						<i class="material-icons g8fs19 left">person</i>CUSTOMER DETAILS</h6>
						<div class="grid g124 grey-text-new g8m0">
							<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10"><?php echo $customer_data->first_name . " " . $customer_data->last_name; ?></h6>
							<h6 class=" g8ls13  g8fs13 g8mtb10"><?php echo $customer_data->email_id; ?></h6>
							<h6 class=" g8ls13 font-capitalize  g8fs13 g8mtb10"><?php echo $customer_data->mobileno; ?></h6>
							<h6 class=" g8ls13 font-capitalize  g8fs13 g8mtb10"><?php echo $customer_data->gender; ?></h6>
						</div>
						<div class="grid gpf g124"><h6 class="g8mtb15 g8ls20 g8fw500 g8fs13"><a target="_blank" class="valign-wrapper" href="<?php echo base_url('admin/order_man/order_detail/order_invoice/' . $order_mst->id); ?>">
						<i class="material-icons g8fs19 tam left">assignment</i><span class="vam">DOWNLOAD INVOICE</span></a></h6><div></div></div>
					</div>
					<?php if ($order_trn_data['checkout']['billing_address']['address_id'] == $order_trn_data['checkout']['shipping_address']['address_id']) {
	$address = $order_trn_data['checkout']['billing_address'];
	?>
					<div class="grid g18">
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
					<div class="grid  g18">
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
					<div class="grid  g18">
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
			<?php if ($order_mst->status == '15') {?>

			<div class="grid g124 g8mtb15 white  border3-1px g8p17">
				<div class="c-row c-equalspace g8m0">
					<div class="grid g18">
						<h6 class="grey-text text-darken-3 g8mtb15 valign-wrapper g8ls20 g8fw500 g8fs13">
						<i class="material-icons g8fs19 left">attach_money</i>Refund Successfully.</h6>
						<div class="grid g124 grey-text-new g8m0">
							<h6 class=" g8ls13  g8fs13  g8mtb10">Refund Amount :- <?php echo $this->ccr->cc('INR', 'INR', $order_mst->return_com_price); ?></h6>
							<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">Refund To :- <?php echo $order_mst->return_com_transfer_in; ?></h6>
							<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">Refund Date :- <?php echo $order_mst->return_complete_date; ?></h6>

<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">Note :- <?php echo $order_mst->return_com_note; ?></h6>
						</div>
					</div>
				</div>
				</div>
				<?php }?>
		</div>
		<div class="grid gp0 g16">
			<div class="grid g124  g8mt15 white border3-1px g8p17 ">
				<h6 class="grey-text text-darken-3 g8mtb15 valign-wrapper g8ls20 g8fw500 g8fs13">
				<i class="material-icons font19 left">attach_money</i>ORDER TOTAL</h6>
				<div class="grid grey-text-new g124 zeo_padding">
					<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">
					<span>Products Price</span>
					<span class="right price" price="<?php echo ($order_trn_data['cart_contents']['cart_total'] + $order_trn_data['newcart']['total_service_charges']); ?>"></span>
					</h6>
					<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">
					<span>Shipping Price</span>
					<span class="right price" price="<?php echo $order_trn_data['newcart']['total_shipping_charges']; ?>"></span>
					</h6>
					<div class="divider grey lighten-3"></div>
					<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">
					<span>Order Total</span>
					<span class="right price" price="<?php
$paid_by_amt = $order_trn_data['cart_contents']['cart_total'] + $order_trn_data['newcart']['total_other_charges'];
$remian_amt  = $paid_by_amt;
echo $paid_by_amt;?>"></span>
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
					<span class="right price" price="<?php echo $dis_total; ?>"></span>
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
					<span class="right price" price="<?php echo $paid_by_amt; ?>"></span>
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
					<span class="right price" price="<?php echo $remian_amt; ?>"></span>
					</h6>
					<?php if ($order_mst->status == 15) {?>

					<div class="divider grey lighten-3"></div>
					<div class="divider grey lighten-3"></div>
					<h6 class="grey-text text-darken-3 g8mtb15 valign-wrapper g8ls20 g8fw500 g8fs13">
		<i class="material-icons font19 left">local_shipping</i>RETURN ORDER TRANSACTION</h6>
		<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>Recived Amount</span>
			<span class="right price" price="<?php echo $paid_by_amt; ?>"></span>
			</h6>
			<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>- Refunded Amount</span>
			<span class="right price" price="<?php echo $order_mst->return_com_price; ?>"></span>
			</h6>
			<div class="divider grey lighten-3"></div>
			<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>Return Charges</span>
			<span class="right price" price="<?php echo $paid_by_amt - $order_mst->return_com_price; ?>"></span>
			</h6>
			<?php }?>
				</div>
			</div>
			<?php if ($order_mst->payment_from == 'paypal' || $order_mst->payment_from == 'ccavenue' || isset($order_trn_data['cart_coupen_data'])) {
	?>
			<div class="grid g124  g8mt15 white border3-1px g8p17 ">
				<div class="grid grey-text-new g124 zeo_padding">
					<?php
if ($order_mst->payment_from == 'paypal' || $order_mst->payment_from == 'ccavenue') {?>
					<h6 class=" g8ls13 font-capitalize g8fs13 g8mtb10">
					<span>Tran Id : </span>
					<span class="right"><?php echo $order_mst->trnscation_id; ?></span>
					</h6>
					<?php }
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
	if ($bank_detail->payment_to == 'paypal') {
		?>
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
	****************************************************************************
	-->
	<!-- Modal Structure -->

	<?php if ($order_mst->status == 1 || $order_mst->status == 6 || $order_mst->status == 5 || $order_mst->status == 11) {?>
	<div id="shipping_det_change" class="modal black-text">
		<div class="modal-content">
			<h6 class="center g8fw500 font-open_sans g8fs19 cp">Shipping Parcel Detail</h6>
			<div class="c-row gmf c-center g8p20 ">
				<form id="<?php echo ($order_mst->status == 11) ? 'change_return_shipping_details' : 'change_shipping_details'; ?>" class="pp-form  grid g818">
					<input  value="<?php echo $order_mst->id; ?>" name="name_order_id" required type="hidden" class="hidden">
					<input  value="<?php echo $order_mst->order_id; ?>" name="name_order_order_id" required type="hidden" class="hidden">
					<input  value="<?php echo $ship_par_data['to_pincode']; ?>" name="name_to_pincode" required type="hidden" class="hidden">
					<input  value="<?php echo $ship_par_data['payment_mode']; ?>" name="name_payment_mode" required type="hidden" class="hidden">
					<input  value="<?php echo $ship_par_data['total_items']; ?>" name="name_total_items" required type="hidden" class="hidden">
					<div class="grid g812 g8p10">
						<div class="grid pp-text-field g824">
							<label>Weight (Kg)</label>
							<input placeholder="1.5" name="name_weight" required value="<?php echo $ship_par_data['weight']; ?>" type="text" class="only-number">
						</div>
					</div>
					<div class="grid g812 g8p10">
						<div class="grid pp-text-field g824">
							<label>Height (Cm)</label>
							<input placeholder="11" name="name_height" value="<?php echo $ship_par_data['height']; ?>"  required type="text" class="only-number ">
						</div>
					</div>
					<div class="grid g812 g8p10">
						<div class="grid pp-text-field g824">
							<label>Lenght (Cm)</label>
							<input placeholder="35" name="name_length" value="<?php echo $ship_par_data['length']; ?>"  required type="text" class="only-number ">
						</div>
					</div>
					<div class="grid g812 g8p10">
						<div class="grid pp-text-field g824">
							<label>Width (Cm)</label>
							<input placeholder="30" name="name_width" value="<?php echo $ship_par_data['width']; ?>"  required type="text" class="only-number">
						</div>
					</div>
					<div class="grid g824 g8mt10 center"><button type="submit" class="c-btna g8plr20">Change</div>
				</form>
			</div>
		</div>
	</div>
	<?php }?>
	<section class="grid g124 gp0">
		<div class="grid gpr0 g18">
			<div class="grid gpf g124  g8mtb15 white border3-1px g8p7">
				<h6 class="grey-text text-darken-3 g8mtb15 center g8ls20 g8fw500  g8fs13"><i class="material-icons g8mr15 vam g8fs19">reorder</i><span class="vam">STATUS</span></h6>
				<!-- <div id="status_box" class="grid  grey-text bbg maxh160 text-darken-2 gpf border2-1px g124 g8ptb4 g8plr10">

				</div> -->
				<button data-target="track_model" class="open_model center c-bbtnp grid g124">Track</button>
				<?php if ($order_mst->status == 0 || $order_mst->status == 1 || $order_mst->status == 6 || $order_mst->status == 5 || $order_mst->status == 7) {?>
				<div class="grid grey-text text-darken-2 gpf g8mt10 g124 ">
					<form id="status_change" class="valign-wrapper">
						<select id="status_select" order-id="12" required="" class="browser-default maxh30 br0 grid g118 gpf grey-text text-darken-3 g8fs13">
							<option class="grey-text text-darken-1" value="" disabled="" selected="">Change Status to</option>

							<option  message='Order Is On Hold' value="5">On Hold</option>
							<option message='Order Confirmed' value="6">Confirmed</option>
							<?php if (isset($customize_data)) {?>

							<option message='Product Customized' value="1">Customization</option>
							<?php }?>
							<option message='Order Canceled By Admin' value="7">Cancel</option>
						<!-- 	<option value="2">Ready To Shipped</option>
							<option value="3">Shipped</option>
							<option value="4">Delivered</option>
							<option value="7">Cancel</option> -->
						</select>
						<button class="c-btna br0 grid h30 g16">Change</button>
					</form>
					</div>
					<?php }?>
				</div>
				<div class="grid hidden status_success_div g124"><h6 class="center font-karla red-text text-darken-0  g8mt17">Status Change Successfully.</h6></div>
			</div>
			<?php if ($order_mst->status == 1 || $order_mst->status == 6 || $order_mst->status == 5) {?>
			<div class="grid gpr0 g18">
				<div class="grid gpf g124  g8mtb15 white border3-1px g8p7">
					<h6 class="grey-text text-darken-3 g8mtb15 center g8ls20 g8fw500  g8fs13"><i class="material-icons g8mr15 vam g8fs19">assignment</i><span class="vam">SHIPPING DETAILS</span></h6>
					<div  class="grid  grey-text-new   text-darken-2 gpf g124 g8ptb4 g8plr5">
						<h6 class="g8fs12"><span class="g8ls15">Pincode</span><span class="right g8ls12"><?php echo $ship_par_data['to_pincode']; ?></span></h6>
						<h6 class="g8fs12"><span class="g8ls15">Weight</span><span class="right weight_txt  g8ls12"><?php echo $ship_par_data['weight']; ?>Kg</span></h6>
						<h6 class="g8fs12"><span class="g8ls15">Height</span><span class="g8ls12 height_txt right "><?php echo $ship_par_data['height']; ?>cm</span></h6>
						<h6 class="g8fs12"><span class="g8ls15">Length</span><span class="right lenght_txt g8ls12"><?php echo $ship_par_data['length']; ?>cm</span></h6>
						<h6 class="g8fs12"><span class="g8ls15">Width</span><span class="right width_txt g8ls12"><?php echo $ship_par_data['width']; ?>cm</span></h6>
						<h6 class="g8fs12"><span class="g8ls15">Payment Mode</span><span class="right g8ls12"><?php echo $ship_par_data['payment_mode']; ?></span></h6>
						<h6 class="g8fs12"><span class="g8ls15">Total Items</span><span class="right g8ls12"><?php echo $ship_par_data['total_items']; ?></span></h6>
					</div>
					<div class="center grid g124 gpf g8mt5 g8t10"><button data-target="shipping_det_change" class="c-btna grid g124 open_model h30">Change</button></div>
				</div>
			</div>


			<?php if ($order_mst->order_from == 'ai') {?>
			<div class="grid gpr0 g18">
				<div class="grid gpf g124  g8mtb15 white border3-1px g8p7">
					<h6 class="grey-text text-darken-3 g8mtb15 center g8ls20 g8fw500  g8fs13"><i class="material-icons g8mr15 vam g8fs19">local_shipping</i><span class="vam">SHIPPING BY</span></h6>
					<div class="spinner h20 g8mtb0 hidden redy_to_data_spinner ">
						<div class="rect1"></div>
						<div class="rect2"></div>
						<div class="rect3"></div>
					</div>
					<div class="spinner shipping_data_spinner">
						<div class="rect1"></div>
						<div class="rect2"></div>
						<div class="rect3"></div>
						<div class="rect4"></div>
						<div class="rect5"></div>
					</div>
					<div class="grid shipping_data_div font-karla grey-text-new text-darken-2 gpf g124 g8ptb4 g8plr5">
						<h6 class="g8fs13"><span class="g8ls15">Name</span><span class="right s_provider g8ls9">Bluedart</span></h6>
						<h6 class="g8fs13"><span class="g8ls15">Service type</span><span class="right s_service g8ls9">Standard</span></h6>
						<h6 class="g8fs13"><span class="g8ls15">Delivery Days</span><span class="g8ls9 s_del_date right ">5</span></h6>
						<h6 class="g8fs13"><span class="g8ls15">Charge</span><span class="right g8ls9 s_charge price" price="217"></span></h6>
						<div class="center grid g124 gpf g8mt5 g8t10"><button class="c-btnp ready_to_ship_button grid g124 h30">Ready To Ship</button></div>
					</div>
				</div>
			</div>
			<?php } else if ($order_mst->status != '11' && $order_mst->status != '0') {?>
			<div class="grid gpr0 g18">
				<div class="grid gpf g124 font-karla g8mtb15 white border3-1px g8p7">
					<h6 class="grey-text text-darken-3 g8mtb15 center g8ls20 g8fw500  g8fs13"><i class="material-icons g8mr15 vam g8fs19">local_shipping</i><span class="vam">SHIPPING CHARGES</span></h6>
					<div class="spinner h20 g8mtb0 hidden redy_to_data_spinner ">
						<div class="rect1"></div>
						<div class="rect2"></div>
						<div class="rect3"></div>
					</div>
					<div class="spinner shipping_data_spinner">
						<div class="rect1"></div>
						<div class="rect2"></div>
						<div class="rect3"></div>
						<div class="rect4"></div>
						<div class="rect5"></div>
					</div>
					<div class="grid shipping_data_div grey-text-new text-darken-2 gpf g124 g8ptb4 g8plr5">
						<h6 class="g8fs13"><span class="g8ls15">Shipping Charge</span><span class="right g8ls9 s_charge"></span></h6>
						<div class="center grid g124 gpf g8mt5 g8t10"><button class="c-btnp ready_to_ship_button grid g124 h30">Ready To Ship</button></div>
					</div>
				</div>
			</div>
			<?php }} else if ($order_mst->status != 7 && $order_mst->status != 0 && $order_mst->order_from != 'af') {?>
<div class="grid shipment_by_div gpr0 g18">
				<div class="grid gpf g124  g8mtb15 white border3-1px g8p7">
					<h6 class="grey-text text-darken-3 g8mtb15 center g8ls20 g8fw500  g8fs13"><i class="material-icons g8mr15 vam g8fs19">assignment</i><span class="vam">SHIPPING DETAILS</span></h6>
					<div id="status_box" class="grid  grey-text-new  font-karla text-darken-2 gpf g124 g8ptb4 g8plr5">
						<h6 class="g8fs13"><span class="g8ls15">Shipped By</span><span class="right g8ls12 shipped_by"></span></h6>
						<h6 class="g8fs13"><span class="g8ls15">Shipment Id</span><span class="right  g8ls12 ship_id"></span></h6>
						<h6 class="g8fs13"><span class="g8ls15">Shipping Amount</span><span class="g8ls12 right payment_mode"></span>
						<h6 class="g8fs13"><span class="g8ls15">Tracking No</span><span class="g8ls12 right traking_no"></span></h6>
						<h6 class="g8fs13"><span class="g8ls15">Forward Label</span><span class="g8ls12 right forward_label"><a  target="_blank" href="">Label</a></span></h6>
					</div>
				</div>
			</div>
			<?php }?>
		</section>

<!-- ****************************************************************************
		*                            Section Two For Return Product                             *		**************************************************************************** -->
		<?php
if ($order_mst->status == '11' || $order_mst->status == '12' || $order_mst->status == '13' || $order_mst->status == '14' || $order_mst->status == '15' || $order_mst->status == '16') {
	?>
<section class="grid g124 gp0">
<?php if ($order_mst->status != '15') {
		?>

		<div class="grid gpr0 g18">
			<div class="grid gpf g124  g8mtb15 white border3-1px g8p7">
				<h6 class="grey-text text-darken-3 g8mtb15 center g8ls20 g8fw500  g8fs13"><i class="material-icons g8mr15 vam g8fs19">reorder</i><span class="vam">STATUS</span></h6>
					<?php if ($order_mst->status == 11 || $order_mst->status == 12 || $order_mst->status == 13 || $order_mst->status == 14 || $order_mst->status == 15 || $order_mst->status == 16) {
			?>
				<div class="grid grey-text text-darken-2 gpf g8mt10 g124 ">
				<?php

			if ($order_mst->status == 11) {
				echo "<h6 class='center red-text g8fs13 g8fw500 g8ls7'>Request For Return Order.</h6>";
			}
			?>

					<form id="status_change" class="valign-wrapper">
						<select id="status_select" order-id="12" required="" class="browser-default maxh30 br0 grid g118 gpf grey-text text-darken-3 g8fs13">
							<option class="grey-text text-darken-1" value="" disabled="" selected="">Change Status to</option>
							<!-- <option message='Request For Return Order.' value="11">Return Request</option> -->
							<option message='Return Request Confirmed.' value="12">Return Confirmed</option>
							<option message='Return Request Canceled' value="16">Return Request Cancel</option							>
							<option message='Return In Transit.' value="13">In Transit</option>
							<option message='Product Recived Successfully.' value="14">Return Delivered</option							>
							<option message='Return Order Process Complete.' value="15">Return Complete</option>
							<option message='Parcel Delivered.' value="4">Delivered</option>
						</select>
						<button class="c-btna br0 grid h30 g16">Change</button>
					</form>
					</div>
					<?php }?>
				</div>
			</div>
			<?php }if ($order_mst->status == 11) {?>
			<div class="grid gpr0 g18">
				<div class="grid gpf g124  g8mtb15 white border3-1px g8p7">
					<h6 class="grey-text text-darken-3 g8mtb15 center g8ls20 g8fw500  g8fs13"><i class="material-icons g8mr15 vam g8fs19">assignment</i><span class="vam">RETURN SHIPPING DETAILS</span></h6>
					<div  class="grid  grey-text-new   text-darken-2 gpf g124 g8ptb4 g8plr5">
						<h6 class="g8fs12"><span class="g8ls15">Pincode</span><span class="right g8ls12"><?php echo $ship_par_data['to_pincode']; ?></span></h6>
						<h6 class="g8fs12"><span class="g8ls15">Weight</span><span class="right  r_weight_txt g8ls12"><?php echo $ship_par_data['weight']; ?>Kg</span></h6>
						<h6 class="g8fs12"><span class="g8ls15">Height</span><span class="g8ls12 r_height_txt right "><?php echo $ship_par_data['height']; ?>cm</span></h6>
						<h6 class="g8fs12"><span class="g8ls15">Length</span><span class="right r_lenght_txt g8ls12"><?php echo $ship_par_data['length']; ?>cm</span></h6>
						<h6 class="g8fs12"><span class="g8ls15">Width</span><span class="right r_width_txt g8ls12"><?php echo $ship_par_data['width']; ?>cm</span></h6>
						<h6 class="g8fs12"><span class="g8ls15">Payment Mode</span><span class="right g8ls12"><?php echo $ship_par_data['payment_mode']; ?></span></h6>
						<h6 class="g8fs12"><span class="g8ls15">Total Items</span><span class="right g8ls12"><?php echo $ship_par_data['total_items']; ?></span></h6>
					</div>
					<div class="center grid g124 gpf g8mt5 g8t10"><button data-target="shipping_det_change" class="c-btna grid g124 open_model h30">Change</button></div>
				</div>
			</div>


			<?php if ($order_mst->order_from == 'ai') {?>
			<div class="grid gpr0 g18">
				<div class="grid gpf g124  g8mtb15 white border3-1px g8p7">
					<h6 class="grey-text text-darken-3 g8mtb15 center g8ls20 g8fw500  g8fs13"><i class="material-icons g8mr15 vam g8fs19">local_shipping</i><span class="vam">RETURN SHIPPING BY</span></h6>
					<div class="spinner h20 g8mtb0 hidden redy_to_data_spinner ">
						<div class="rect1"></div>
						<div class="rect2"></div>
						<div class="rect3"></div>
					</div>
					<div class="spinner shipping_data_spinner">
						<div class="rect1"></div>
						<div class="rect2"></div>
						<div class="rect3"></div>
						<div class="rect4"></div>
						<div class="rect5"></div>
					</div>
					<div class="grid shipping_data_div font-karla grey-text-new text-darken-2 gpf g124 g8ptb4 g8plr5">
						<h6 class="g8fs13"><span class="g8ls15">Name</span><span class="right s_provider g8ls9">Bluedart</span></h6>
						<h6 class="g8fs13"><span class="g8ls15">Service type</span><span class="right s_service g8ls9">Standard</span></h6>
						<h6 class="g8fs13"><span class="g8ls15">Delivery Days</span><span class="g8ls9 s_del_date right ">5</span></h6>
						<h6 class="g8fs13"><span class="g8ls15">Charge</span><span class="right g8ls9 s_charge price" price="217"></span></h6>
						<div class="center grid g124 gpf g8mt5 g8t10"><button class="c-btnp ready_to_return_ship_button grid g124 h30">Return Confirmed</button></div>
					</div>
				</div>
			</div>
			<?php } else {?>
			<div class="grid gpr0 g18">
				<div class="grid gpf g124 font-karla g8mtb15 white border3-1px g8p7">
					<h6 class="grey-text text-darken-3 g8mtb15 center g8ls20 g8fw500  g8fs13"><i class="material-icons g8mr15 vam g8fs19">local_shipping</i><span class="vam">RETURN SHIPPING CHARGES</span></h6>
					<div class="spinner h20 g8mtb0 hidden redy_to_data_spinner ">
						<div class="rect1"></div>
						<div class="rect2"></div>
						<div class="rect3"></div>
					</div>
					<div class="spinner shipping_data_spinner">
						<div class="rect1"></div>
						<div class="rect2"></div>
						<div class="rect3"></div>
						<div class="rect4"></div>
						<div class="rect5"></div>
					</div>
					<div class="grid shipping_data_div grey-text-new text-darken-2 gpf g124 g8ptb4 g8plr5">
						<h6 class="g8fs13"><span class="g8ls15">Shipping Charge</span><span class="right g8ls9 s_charge"></span></h6>
						<div class="center grid g124 gpf g8mt5 g8t10"><button class="c-btnp ready_to_return_ship_button grid g124 h30">Ready To Ship</button></div>
					</div>
				</div>
			</div>
			<?php }} else if ($order_mst->status != 16 && $order_mst->order_from != 'af') {?>
<div class="grid return_shipment_by_div gpr0 g18">
				<div class="grid gpf g124  g8mtb15 white border3-1px g8p7">
					<h6 class="grey-text text-darken-3 g8mtb15 center g8ls20 g8fw500  g8fs13"><i class="material-icons g8mr15 vam g8fs19">assignment</i><span class="vam">RETURN SHIPPING DETAILS</span></h6>
					<div id="status_box" class="grid  grey-text-new  font-karla text-darken-2 gpf g124 g8ptb4 g8plr5">
						<h6 class="g8fs13"><span class="g8ls15">Shipped By</span><span class="right g8ls12 shipped_by"></span></h6>
						<h6 class="g8fs13"><span class="g8ls15">Shipment Id</span><span class="right  g8ls12 ship_id"></span></h6>
						<h6 class="g8fs13"><span class="g8ls15">Shipping Amount</span><span class="g8ls12 right payment_mode"></span>
						<h6 class="g8fs13"><span class="g8ls15">Tracking No</span><span class="g8ls12 right traking_no"></span></h6>
						<h6 class="g8fs13"><span class="g8ls15">Forward Label</span><span class="g8ls12 right forward_label"><a  target="_blank" href="">Label</a></span></h6>
					</div>
				</div>
			</div>
			<?php }?>
		</section>
<?php }?>
		<!-- ****************************************************************************
		*                             All Product Show                             *
		**************************************************************************** -->
		<section class="grid g124 g8mtb15">
			<div class="grid gp0 g124 white border3-1px">
				<div class="grid g124 gp0">
					<?php foreach ($order_trn_data['cart_contents'] as $key => $value) {
	if ($key != "cart_total" && $key != 'total_items') {
		?>
					<div class="grid valign-wrapper g124">
						<div class="grid g8mt7 gp0 g46 g54 g64 g72">
							<img class="responsive-img br4" src="<?php echo base_url('uploads/pro_image/94_130/' . $value['image']); ?>">
						</div>
						<div class="grid g8mt7 gpf g8pl15 g418 g514 g612 g712">
							<div class="grid g424">
								<h6 class="cp g8mtb4 name-title g8ls7 g8fs14 font-roboto"><a class="black-text" href="<?php echo base_url('product/quick/product/view/' . $value['id'] . '/' . $value['name']); ?>"><?php echo $value['name']; ?></a></h6>
							</div>
							<div class="grid g124">
								<h6 class="grey-text g8fs12 g8mtb4 text-darken-1"><span class="g8pr7"><?php echo (isset($value['sku'])) ? 'Sku :- ' . $value['sku'] : ''; ?></span>
								<?php echo 'Qty :- ' . $value['qty']; ?></h6>
							</div>
							<div class="grid  g4addn g124">
								<?php
$total_product_price = $value['price'];
		if (isset($order_trn_data['newcart']['services_expenses'])) {
			if (isset($order_trn_data['newcart']['services_expenses'][$value['rowid']])) {
				$total_product_price = $value['price'] + $order_trn_data['newcart']['services_expenses'][$value['rowid']];
			}
		}
		?>
								<h6 class="grey-text text-darken-3 g8fs13 g8mtb4 g8fw500"><?php echo $this->ccr->cc('INR', 'INR', $total_product_price); ?></h6>
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

	<!-- ////////// Track_model ////////////////////-->
<div id="show_complete_model" class="modal black-text small_model ">
    <div class="modal-content">
      <h6 class="center font-roboto_slab cp g8fs18">Return Complete Confirm</h6>
      <div class="divider g8mt10"></div>
      <div class="model-content">
<div class="spinner hidden g8mtb10 h20">
			<div class="rect1"></div>
			<div class="rect2"></div>
			<div class="rect3"></div>
			<div class="rect4"></div>
		</div>

		<div class="grid g124">
			<form class="pp-form" id="return_complete_form">
				<div class="grid g124 pp-text-field">
					<label>Paid Rs.</label>
					<input placeholder="2300" name="name_rs" required type="text" class="only-number">
					<input type="hidden" name="order_id" value="<?php echo $order_mst->id; ?>">
				</div>
				<div class="grid g124 pp-text-field">
					<label>Transfer In</label>
					<input placeholder="Bank Or Paypal" name="name_transfer_in" required type="text" class=" ">
				</div>
				<div class="grid g124 pp-text-field">
					<label>Note</label>
					<textarea placeholder="Write Note." name="name_note"  type="text" class=" "></textarea>
				</div>
				<center><button class="c-btna g8plr10 g8mt15">Submit</button></center>
			</form>
		</div>
    </div>
    </div>

  </div>
  <!-- /////////////// End Track_model ////////////////////-->

	<form id="payment_form" class="hidden" action="http://payment.vello.in/pg/14/payment" method="post">

<input type="hidden" class="hidden" name="pg" value="paytm">
<input type="hidden" class="hidden" name="orderCode" value="">
</form>

	<style>
	.maxh160{
		max-height: 160px;
		overflow-y: scroll;
	}
	.maxh30{
		max-height: 30px;
	}
	</style>
	<script>
	$(document).ready(function() {

	var u_order_id = <?php echo $order_mst->id; ?>;

	$("#message_for_cstm_form").on('submit', function(event) {
	event.preventDefault();
	var data = $(this).serialize();
	$.post(base_url+'admin/order_man/order_detail/message', data, function(data, textStatus, xhr) {
	if(data.result == true){
	Materialize.toast('Message Send Successfully.', 3000);
	}else{
	Materialize.toast('Error: Reload Page.', 3000);
	location.reload();
	}
	},'json');
	});
	$("#status_change").on('submit', function(event) {
	event.preventDefault();
	if ($('#status_change #status_select').val() == 2) {
	show_confire_box();
	}else if($('#status_change #status_select').val() == 12){
show_return_confire_box();
	}
	else if($('#status_change #status_select').val() == 16){
show_return_request_cancel_con_box();
	}
	else if($('#status_change #status_select').val() == 7){
show_cancel_con_box();
	}
	else if($('#status_change #status_select').val() == 15){
		return_complete_model();

	}
	 else if($('#status_change #status_select').val() == 6 || $('#status_change #status_select').val() == 5 || $('#status_change #status_select').val() == 1){
		send_confirm_message($('#status_change #status_select').val());
	}
	else{
	change_status();
	}
	});
/*=======================================================
	//  Send Email About Status Function //
	====================================================*/
	 function send_confirm_message(status_id){

	 	$.post(base_url+'admin/order_man/order_detail/send_status_mail', {u_order_id: u_order_id,status_id:status_id}, function(data, textStatus, xhr) {
	 		change_status();
	 	});
	 }
	/*=======================================================
	//  End Send Email About Status Function //
	====================================================*/
	$(".ready_to_ship_button").on("click",function(event){
event.preventDefault();
if ($(this).attr('result') == 'true') {
	show_confire_box();
}else{
	Materialize.toast("Data Not Fetch From Zepo. Reload The Page",3000);
}
	});
function show_cancel_con_box(){
		swal({
  title: "Are you sure?",
  text: 'Write a valid reason for Cancel Order.',
  type: "input",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes",
  closeOnConfirm: false,
    inputPlaceholder: "Write Reason."
},
function(inputValue){
	 if (inputValue === false) return false;

  if (inputValue === "") {
    swal.showInputError("You need to write something!");
    return false
  }
  	var f_data = $('#status_change #status_select').val();
  $('#status_change #status_select').find("option[value='"+f_data+"']").attr('message',inputValue);
change_status();
});

	}
function show_return_request_cancel_con_box(){
		swal({
  title: "Are you sure?",
  text: 'Write a reason for refuse Return request.',
  type: "input",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes",
  closeOnConfirm: false,
    inputPlaceholder: "Write Reason."
},
function(inputValue){
	 if (inputValue === false) return false;

  if (inputValue === "") {
    swal.showInputError("You need to write something!");
    return false
  }
  	var f_data = $('#status_change #status_select').val();
  $('#status_change #status_select').find("option[value='"+f_data+"']").attr('message',inputValue);
change_status();
});

	}

	function show_confire_box(){
		swal({
  title: "Are you sure?",
  text: '"Ready To Ship" Send Pickup Data To Shipping Provider.',
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes",
  closeOnConfirm: false
},
function(){
ready_to_ship();
});

	}

	function change_status(){
		swal.close();
	var f_data = $('#status_change #status_select').val();
	var order_id = u_order_id;
	var status = $('#status_change #status_select').find("option[value='"+f_data+"']").text();
	var message = $('#status_change #status_select').find("option[value='"+f_data+"']").attr('message');
	$.post(base_url+'admin/order_man/order_detail/change_status_to', {status: f_data,order_id:order_id,status_text:status,message:message}, function(data, textStatus, xhr) {

	if (data.result == true) {
	Materialize.toast('Status Update Successfully.', 3000);
	// get_status();
	$(".status_success_div").removeClass('hidden');
if (f_data == 7) {
	$.post(base_url+'admin/order_man/order_detail/send_status_mail', {u_order_id: u_order_id,status_id:'7'}, function(data, textStatus, xhr) {
	location.reload();
	 	});
}else if(f_data == 16){
$.post(base_url+'admin/order_man/order_detail/send_status_mail', {u_order_id: u_order_id,status_id:'16'}, function(data, textStatus, xhr) {
	location.reload();
	 	});
}else{
	location.reload();
}


	}
	},'json');
	}

	get_status();
	function get_status(){
	var order_id = u_order_id;
	$.post(base_url+'admin/order_man/order_detail/get_order_status', {order_id: order_id}, function(data, textStatus, xhr) {
	var html = "";
	var track_model_html = "";
	var status_id = '';
	$.each(data.result.reverse(), function(index, val) {
		if (status_id != val.status_id) {
track_model_html += '<p><i class="material-icons g8fs19 vam g8pr6">chevron_right</i><span class="vam font-capitalize g8ls7">'+val.status+'</span></p>';
	status_id = val.status_id;
}
track_model_html += '<h6 class="g8fs12 g8lh17 g8pl25 g8ls8 grey-text ">'+val.message+'<br><i class="g8fs11">'+val.time+', '+val.date+'</i></h6>';
	html += '<h6 class="g8fs12"><span>['+val.date+']['+val.time+']</span><span class="right font-capitalize">'+val.status+'</span></h6>';
	});
	$(".track-model-content").html(track_model_html);
	// $("#status_box").html(html);
	},'json');
	}
	$(".open_model").on('click', function(event) {
	event.preventDefault();
	var mo_id = $(this).attr('data-target');
	$('#'+mo_id).openModal();
	});
	$('ul.tabs.shipping_add_tabs').tabs();


get_shipping_data_f_db();
function get_shipping_data_f_db(){
	var order_id = u_order_id;
$.post(base_url+'admin/order_man/order_detail/get_shipping_data_f_db', {order_id: order_id}, function(data, textStatus, xhr) {
	$(".shipment_by_div .shipped_by").text(data.del_c);
	$(".shipment_by_div .ship_id").text(data.response.shipment_id);

	console.log(data);

},'json');
}


get_zepo_courier_order_info();
function get_zepo_courier_order_info(){
	var order_id = u_order_id;
$.post(base_url+'admin/order_man/order_detail/get_zepo_courier_order_info', {order_id: order_id}, function(data, textStatus, xhr) {

	console.log(data);
	if (data.result) {
		$(".shipment_by_div .payment_mode").html("&#8377;" +price_seprate(data.data.amount));
		$(".shipment_by_div .traking_no").text(data.data.tracking_no);
	$(".shipment_by_div .forward_label a").attr('href',data.data.data.shipments[0].shipmentPackages.forward_label);
	}

},'json');
}
<?php
if ($order_mst->status == '14') {?>
	function return_complete_model(){
		$("#show_complete_model").openModal();
	}
	$("#return_complete_form").on('submit', function(event) {
		event.preventDefault();
		$("#show_complete_model .spinner").removeClass('hidden');
		var data = $(this).serialize();
		$.post(base_url+'admin/order_man/order_detail/return_complete_status/', data, function(data, textStatus, xhr) {
			console.log(data);

			$.post(base_url+'admin/order_man/order_detail/send_status_mail', {u_order_id: u_order_id,status_id:'15'}, function(data, textStatus, xhr) {
				$("#show_complete_model .spinner").addClass('hidden');
	change_status();
	 	});
		},"json");
	});
<?php }
if ($order_mst->status == '6' || $order_mst->status == '1' || $order_mst->status == '5') {?>
	$("#change_shipping_details").on('submit',function(event){
	event.preventDefault();
	var data = $(this).serialize();
	$.post(base_url+'admin/order_man/order_detail/change_shipping_parcel', data, function(data, textStatus, xhr) {

	if (data.result == true) {
		$(".weight_txt").text($("#change_shipping_details [name='name_weight']").val()+'Kg');
		$(".height_txt").text($("#change_shipping_details [name='name_height']").val()+'cm');
		$(".lenght_txt").text($("#change_shipping_details [name='name_length']").val()+'cm');
		$(".width_txt").text($("#change_shipping_details [name='name_width']").val()+'cm');
			get_shipping_provider_data();

	$("#shipping_det_change").closeModal();
	}
	},"json");
	});
	get_shipping_provider_data();
<?php }
if ($order_mst->order_from == 'ai' && ($order_mst->status == '6' || $order_mst->status == '1' || $order_mst->status == '5')) {?>

	function get_shipping_provider_data(){
		$(".shipping_data_div").addClass("hidden");
		$(".shipping_data_spinner").removeClass("hidden");
	$.post(base_url+'zepo/zepo/adm_get_rates_by_pincode/'+u_order_id, {param1: 'value1'}, function(data, textStatus, xhr) {

		if (data[0].success == 'true') {
			$(".shipping_data_div .s_provider").html(data[0].name);
			$(".shipping_data_div .s_service").html(data[0].service_name);
			$(".shipping_data_div .s_del_date").html(data[0].expected_delivery_days);
			$(".shipping_data_div .s_charge").html("&#8377;" + price_seprate(data[0].total_charge));
			$(".shipping_data_div .ready_to_ship_button").attr('result',data[0].success);
		$(".shipping_data_spinner").addClass("hidden");
		$(".shipping_data_div").removeClass("hidden");
	}else{
		$(".shipping_data_spinner").addClass("hidden");
		$(".shipping_data_div .ready_to_ship_button").attr('result',data[0].success);
		Materialize.toast("Something Wrong",3000);
	}
	},'json');
	}
	function ready_to_ship(){
	$(".redy_to_data_spinner").removeClass('hidden');
	var order_id = u_order_id;
$.post(base_url+'zepo/zepo/adm_create_shipment/', {id: order_id}, function(data, textStatus, xhr) {
	console.log(data);
	if (data.success == true) {
		swal("Data Recived.", "Now You Can Pay For This Shipment.", "success");
		$("[name='orderCode']").val(data.order_code);
		$("#payment_form").submit();
		// location.reload();
	}else{
		$(".redy_to_data_spinner").addClass('hidden');
		swal("Error", "Something Wrong With Zepo Request.", "error");
	}
},'json');
}
<?php } else if ($order_mst->order_from == 'af' && ($order_mst->status == '6' || $order_mst->status == '1' || $order_mst->status == '5')) {?>
function get_shipping_provider_data(){
	var shipping_country = '<?php echo $order_trn_data['checkout']['shipping_address']['country']; ?>';
		$(".shipping_data_div").addClass("hidden");
		$(".shipping_data_spinner").removeClass("hidden");
	$.post(base_url+'admin/order_man/order_detail/get_international_ship_price/'+u_order_id, {shipping_country: shipping_country}, function(data, textStatus, xhr) {

		if (data.result == 'true') {
			$(".shipping_data_div .s_charge").html("&#8377;" + price_seprate(data.price));
			$(".shipping_data_div .ready_to_ship_button").attr('result',data.result);
		$(".shipping_data_spinner").addClass("hidden");
		$(".shipping_data_div").removeClass("hidden");
	}else{
		$(".shipping_data_spinner").addClass("hidden");
		$(".shipping_data_div .ready_to_ship_button").attr('result',data.result);
		Materialize.toast("Something Wrong",3000);
	}
	},'json');
	}
	function ready_to_ship(){
	$(".redy_to_data_spinner").removeClass('hidden');
	var order_id = u_order_id;
$.post(base_url+'admin/order_man/order_detail/shipped_international_courier', {id: order_id}, function(data, textStatus, xhr) {
	console.log(data);
	if (data.success == '1') {
		location.reload();
	}else{
		$(".redy_to_data_spinner").addClass('hidden');
		Materialize.toast("Something Wrong With Mail Request.",3000);
	}
},'json');
}
<?php }if ($order_mst->status == '12' || $order_mst->status == '13' || $order_mst->status == '14' || $order_mst->status == '15') {?>


get_zepo_return_courier_order_info();
function get_zepo_return_courier_order_info(){
	var order_id = u_order_id;
$.post(base_url+'admin/order_man/order_detail/get_zepo_return_courier_order_info', {order_id: order_id}, function(data, textStatus, xhr) {

	console.log(data);
	if (data.result) {
		$(".return_shipment_by_div .payment_mode").html("&#8377;" +price_seprate(data.data.amount));
		$(".return_shipment_by_div .traking_no").text(data.data.tracking_no);
	$(".return_shipment_by_div .forward_label a").attr('href',data.data.data.shipments[0].shipmentPackages.forward_label);
	}

},'json');
}

get_return_shipping_data_f_db();
function get_return_shipping_data_f_db(){
	var order_id = u_order_id;
$.post(base_url+'admin/order_man/order_detail/get_return_shipping_data_f_db', {order_id: order_id}, function(data, textStatus, xhr) {
	$(".return_shipment_by_div .shipped_by").text(data.del_c);
	$(".return_shipment_by_div .ship_id").text(data.response.shipment_id);

	console.log(data);

},'json');
}


<?php }
if ($order_mst->status == '11') {?>

$(".ready_to_return_ship_button").on('click', function(event) {
	event.preventDefault();
	show_return_confire_box();
});

	$("#change_return_shipping_details").on('submit',function(event){
	event.preventDefault();
	var data = $(this).serialize();
	$.post(base_url+'admin/order_man/order_detail/change_return_shipping_parcel', data, function(data, textStatus, xhr) {

	if (data.result == true) {
		get_return_shipping_provider_data();
		$(".r_weight_txt").text($("#change_return_shipping_details [name='name_weight']").val()+'Kg');
		$(".r_height_txt").text($("#change_return_shipping_details [name='name_height']").val()+'cm');
		$(".r_lenght_txt").text($("#change_return_shipping_details [name='name_length']").val()+'cm');
		$(".r_width_txt").text($("#change_return_shipping_details [name='name_width']").val()+'cm');

	$("#shipping_det_change").closeModal();
	}
	},"json");
	});
	get_return_shipping_provider_data();
function get_return_shipping_provider_data(){
	$(".shipping_data_div").addClass("hidden");
		$(".shipping_data_spinner").removeClass("hidden");
	$.post(base_url+'zepo/zepo/adm_get_return_rates_by_pincode/'+u_order_id, {param1: 'value1'}, function(data, textStatus, xhr) {

		if (data[0].success == 'true') {
			$(".shipping_data_div .s_provider").html(data[0].name);
			$(".shipping_data_div .s_service").html(data[0].service_name);
			$(".shipping_data_div .s_del_date").html(data[0].expected_delivery_days);
			$(".shipping_data_div .s_charge").html("&#8377;" + price_seprate(data[0].total_charge));
			$(".shipping_data_div .ready_to_ship_button").attr('result',data[0].success);
		$(".shipping_data_spinner").addClass("hidden");
		$(".shipping_data_div").removeClass("hidden");
	}else{
		$(".shipping_data_spinner").addClass("hidden");
		$(".shipping_data_div .ready_to_ship_button").attr('result',data[0].success);
		Materialize.toast("Something Wrong",3000);
	}
	},'json');
	}

function show_return_confire_box(){
		swal({
  title: "Are you sure?",
  text: '"Return Confirmed" Send Pickup Data To Shipping Provider.',
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes",
  closeOnConfirm: false
},
function(){
ready_return_confirm_ship();
});
	}
		function ready_return_confirm_ship(){
				$(".redy_to_data_spinner").removeClass('hidden');
	var order_id = u_order_id;
$.post(base_url+'zepo/zepo/adm_create_return_shipment/', {id: order_id}, function(data, textStatus, xhr) {
	console.log(data);
	if (data.success == true) {
		$("[name='orderCode']").val(data.order_code);
	$.post(base_url+'admin/order_man/order_detail/send_status_mail', {u_order_id: u_order_id,status_id:'12'}, function(data, textStatus, xhr) {
		swal("Data Recived.", "Now You Can Pay For This Shipment.", "success");
		$("#payment_form").submit();
	 	});




		// location.reload();
	}else{
		$(".redy_to_data_spinner").addClass('hidden');
		swal("Error", "Something Wrong With Zepo Request.", "error");
	}
},'json');
		}
<?php }?>

	});


	</script>
	<?php
