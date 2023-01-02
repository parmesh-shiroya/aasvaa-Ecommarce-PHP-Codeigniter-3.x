<!-- <pre class="grey-text">
<?php
if (!empty($order_mst)) {
	$trn_c_data = unserialize(base64_decode($order_mst[0]->trn_c_data));
	print_r($trn_c_data);
}
?>
</pre> -->
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
<div class="pp-col cad pp-padres black-text ps12">
	<div class="pp-col p-padding_10 ps12">
		<h6 class="title  g8fs16">My Orders</h6>
	</div>
	<div class="pp-col zero_padding ps12">
		<?php
if (empty($order_mst)) {
	echo "<h6 class='center g8fs20 g8ls5 font-karla g8fw00 g8ptb15'>No Order Found.</h6>";
} else {
	foreach ($order_mst as $order_data) {
		$trn_c_data = unserialize(base64_decode($order_data->trn_c_data));?>
		<div class="pp-col card z-depth-05 zero_padding  ps12">
			<div class="pp-col p-padding_tb_9 border-1px p-padding_lr_1rem valign-wrapper ps12">
				<div class="pp-col ps12 pm4 left zero_padding"><a href="<?php echo site_url('account/order_det/index/' . $order_data->id); ?>"><button class="order_button waves-effect c-btnp g8plr15"><?php echo $order_data->order_id; ?></button></a></div>
				<div class="pp-col ps4 pp-hide-small-min center zero_padding">
					<?php
echo $this->pp_loader_helper->set_order_status($order_data->status);
		?>
				</div>
				<div class="pp-col ps4 pp-hide-small-min right zero_padding"><button class="waves-effect track_btn waves-light right text-tran_none  g8plr10 font-capitalize c-bbtna" or-data = "<?php echo $order_data->id; ?>"><i class="material-icons  pp-hide-small-min left" >place</i>Track </button></div>
			</div>
			<div class="pp-col bt0 bb0 ps12 border-1px zero_padding pp-padres">
				<?php foreach ($trn_c_data['cart_contents'] as $key => $value) {
			if ($key != "cart_total" && $key != 'total_items') {
				?>
				<div class="pp-col valign-wrapper ps12">
					<div class="pp-col g8mt7 zero_padding ps3 pm2 pl2 pxl1">
						<img class="responsive-img br4 " src="<?php echo base_url('uploads/pro_image/94_130/' . $value['image']); ?>">
					</div>
					<div class="pp-col g8mt7 g8pl15 ps9 pm7 pl6 pxl6">
						<div class="pp-col ps12">
							<h6 class="primary-text g8mtb4  g8ls5 name-title "><?php echo $value['name']; ?></h6>
						</div>
						<div class="pp-col ps12">
							<h6 class="grey-text g8fs11 g8ls5 g8mtb4 text-darken-1"><span class="g8pr7"><?php echo (isset($value['sku'])) ? 'Sku :- ' . $value['sku'] : ''; ?></span>
							<?php echo 'Qty :- ' . $value['qty']; ?></h6>
						</div>
						<div class="pp-col  ps12">
							<?php
if ($order_data->payment_from == 'paypal') {
					$paypal_data_unser = unserialize(base64_decode($paypal_data['or_' . $order_data->id]->datas));
					foreach ($paypal_data_unser as $paypal_key => $paypal_value) {
						if (strpos($paypal_key, 'item_number_') !== false) {
							if ($paypal_value == $value['id']) {
								$no = str_replace('item_number_', '', $paypal_key);
							}
						}
					}
					if (isset($no)) {
						?>
							<h6 class="grey-text text-darken-4 g5fs11 g8fs12 g8mtb4 g8fw500"><?php echo ($paypal_data_unser['currency_code'] == 'USD') ? 'US$' : '';
						echo $paypal_data_unser['amount_' . $no] * $paypal_data_unser['quantity_' . $no];
						if ($_SESSION['currency_choose'] != "USD") {
							echo " - (" . $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']) . ' ' . number_format((float) unserialize(base64_decode($order_data->trn_c_data))['currency'][$_SESSION['currency_choose']] * round(($paypal_data_unser['amount_' . $no] * $paypal_data_unser['quantity_' . $no]) * (1 / unserialize(base64_decode($order_data->trn_c_data))['usd_price'])), 2, '.', '') . ")";} ?></h6>
							<?php }
					// unserialize(base64_decode($paypal_data['or_' . $order_data->id]->datas))[''];
				} else if ($order_data->payment_from == 'ccavenue') {

					$service_charge  = (isset($trn_c_data['newcart']['services_expenses'][$value['rowid']])) ? $trn_c_data['newcart']['services_expenses'][$value['rowid']] : 0;
					$shipping_charge = (isset($trn_c_data['newcart']['shipping_charge'][$value['rowid']])) ? $trn_c_data['newcart']['shipping_charge'][$value['rowid']] : 0;
					$total_price     = ($value['price'] + $service_charge + $shipping_charge) * $value['qty'];?>
<h6 class="grey-text text-darken-4 g8fs12 g8ls7 g8mtb4 g8fw500"><?php echo "<span class='' price='" . round($total_price) . "'>" . $this->ccr->cc('INR', 'INR', round($total_price), 1, 1); ?>
<?php echo ($_SESSION['currency_choose'] != "INR") ? " -  (" . $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']) . ' ' . number_format((float) unserialize(base64_decode($order_data->trn_c_data))['currency'][$_SESSION['currency_choose']] * round($total_price), 2, '.', '') . ")" : ''; ?>

	</span>
</h6>
<?php }
				?>
							<!-- <h6 class="grey-text text-darken-4 g8fs12 g8mtb4 g8fw500"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $value['price']); ?></h6> -->
						</div>
					</div>
					<div class="pp-col g8mt7 g8pl15 pp-hide-small-min pm3 pl4 pxl4">
						<?php
if (isset($value['options'])) {
					$product_size = array();
					foreach ($value['options'] as $key1 => $value1) {
						// if ($value1[$key1 . 'radio'] == 'standard' || $value1[$key1 . 'radio'] == 'customize') {
						// $product_size = array_merge($product_size, array($key1 => $value1[$key1 . 'radio']));?>
						<h6 class="grey-text g8ls5 g8fs11 g8mtb4 text-darken-1"><?php echo $key1 . ' ' . $value1[$key1 . 'radio']; ?></h6>
						<?php	// }
					}
				} else {?>
						<h6 class="grey-text g8ls5 g8fs11 g8mtb4 text-darken-1">Unstitched Full Product</h6>
						<?php }
				?>
					</div>
				</div>
				<div class="divider"></div>
				<?php }}?>
			</div>
			<div class="pp-col bt0 g8ls5 p-padding_tb_9 border-1px p-padding_lr_1rem valign-wrapper ps12">
			<div class="pp-col hide-on-medium-max ps12 center zero_padding">

					<?php
echo $this->pp_loader_helper->set_order_status($order_data->status);
		?>

			</div>
				<div class="pp-col ps12 pm3 pp-hide-small-min left zero_padding">
					<h6 class="grey-text g8fs12 g8mtb4 text-darken-1">Order Date :					                                                                					                                                                 <?php echo $order_data->date; ?></h6>
				</div>
				<div class="pp-col ps12 pp-hide-small-min pm9 right zero_padding">
					<h6 class="grey-text g8fs12 g8mtb4 text-darken-1">
					<?php
if (isset($paypal_data['or_' . $order_data->id])) {
			$paypal_data_this = $paypal_data['or_' . $order_data->id];
			if (isset(unserialize(base64_decode($paypal_data_this->datas))['discount_amount_cart']) || isset(unserialize(base64_decode($paypal_data_this->datas))['discount_rate_cart'])) {
				?>
					<span class="green-text">Discount :<?php
if (isset(unserialize(base64_decode($paypal_data_this->datas))['discount_amount_cart'])) {
					echo "US$ " . unserialize(base64_decode($paypal_data_this->datas))['discount_amount_cart'];
					if ($_SESSION['currency_choose'] != "USD") {
						echo " -  (" . $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']) . ' ' . number_format((float) $trn_c_data['currency'][$_SESSION['currency_choose']] * round(unserialize(base64_decode($paypal_data_this->datas))['discount_amount_cart'] * (1 / $trn_c_data['usd_price'])), 2, '.', '') . ")";
					}
					// echo "<span class='price' price='" . unserialize(base64_decode($paypal_data->datas))['discount_amount_cart'] . "'></span>";
				} else if (isset(unserialize(base64_decode($paypal_data_this->datas))['discount_rate_cart'])) {
					echo "<span>" . unserialize(base64_decode($paypal_data_this->datas))['discount_amount_cart'] . "%</span>";
				}
				?></span>
					<?php
}
		}
		if (isset($ccavenue_data['or_' . $order_data->id])) {
			$ccavenue_data_this = $ccavenue_data['or_' . $order_data->id];
			$mercent_4          = unserialize(base64_decode(unserialize(base64_decode($ccavenue_data_this->datas))['merchant_param4']));
			if (!empty($mercent_4) && (isset($mercent_4['discount_amount_cart']) || isset($mercent_4['discount_rate_cart']))) {
				?>
					<span class="green-text">Discount :<?php
if (isset($mercent_4['discount_amount_cart'])) {

					echo $this->ccr->cc('INR', 'INR', $mercent_4['discount_amount_cart'], 1, 1);
					if ($_SESSION['currency_choose'] != "INR") {
						echo " -  (" . $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']) . ' ' . number_format((float) $trn_c_data['currency'][$_SESSION['currency_choose']] * round($mercent_4['discount_amount_cart']), 2, '.', '') . ")";
					}

					// echo "<span class='price' price='" . $mercent_4['discount_amount_cart'] . "'></span>";
				} else if (isset($mercent_4['discount_rate_cart'])) {
					echo "<span>" . $mercent_4['discount_rate_cart'] . "%</span>";
				}
				?></span>
					<?php
}
		}
		if (isset($paypal_data['or_' . $order_data->id])) {
			// echo unserialize(base64_decode($paypal_data_this->datas))['discount_amount_cart'];
			echo "<span class='grey-text right g8fw500 g8fs13  text-darken-1'>Total :- US$ " . unserialize(base64_decode($order_data->trn_return_data))['get']['amt'];
			if ($_SESSION['currency_choose'] != "USD") {
				echo " - (" . $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']) . ' ' . number_format((float) $trn_c_data['currency'][$_SESSION['currency_choose']] * round(unserialize(base64_decode($order_data->trn_return_data))['get']['amt'] * (1 / $trn_c_data['usd_price'])), 2, '.', '') . ")";
			}
			echo "</span>";
		} else if (isset($ccavenue_data['or_' . $order_data->id])) {
			$order_trn_return_data = unserialize(base64_decode($order_data->trn_return_data));
			echo "<span class='grey-text right g8fw500 g8fs13  text-darken-1'>Total :- " . $this->ccr->cc("INR", "INR", round($order_trn_return_data['post']['encResp_dcr']['amount']));
			if ($_SESSION['currency_choose'] != "INR") {
				echo " - (" . $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']) . ' ' . number_format((float) $trn_c_data['currency'][$_SESSION['currency_choose']] * round($order_trn_return_data['post']['encResp_dcr']['amount']), 2, '.', '') . ")";
			}
			echo "</span>";
		}
		?>
					</h6>
				</div>
			</div>
		</div>
		<?php }}?>
	</div>
</div>
<style type="text/css" media="screen">
									.size_table	tr td{
padding: 10px 7px;
}
</style>
<style>
.name-title{
	font-size: 13.3px;
}
@media only screen and (max-width : 970px) {
		.name-title{
font-size: 1rem;
}
	@media only screen and (max-width : 610px) {
		.order_button{
				font-size: 13px;
	 	line-height: unset;
		 height:  30px;
		 width: 100%;
		  	color: #666;
	 	border:2px solid #d81b60 ;
	 	background:rgba(0,0,0,0);
		}
		.order_button:hover{
			color: #fff;
		}
		.name-title{
font-size: 0.85rem;
font-family: "Fira Sans",sans-serif;
}
	}

</style>

<script>
	$(document).ready(function() {

		$(".track_btn").on('click', function(event) {
			event.preventDefault();
			var order_id = $(this).attr('or-data');
			get_status(order_id);
		});
	function get_status(order_id){
		var loading_html = '<div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
		$(".track-model-content").html(loading_html);
		$("#track_model").openModal();
$.post(base_url+'account/order_det/get_order_status', {order_id: order_id}, function(data, textStatus, xhr) {
var html = "";
var track_model_html = "";
var status_id = '';
console.log(data);
$.each(data.result.reverse(), function(index, val) {
if (status_id != val.status_id) {
track_model_html += '<p><i class="material-icons g8fs19 vam g8pr6">chevron_right</i><span class="vam font-capitalize g8ls7">'+val.status+'</span></p>';
}
track_model_html += '<h6 class="g8fs12 g8lh17 g8pl25 g8ls8 grey-text ">'+val.message+'<br><i class="g8fs11">'+val.time+', '+val.date+'</i></h6>';
html += '<h6 class="g8fs13"><span>['+val.date+']['+val.time+']</span><span class="right font-capitalize">'+val.status+'</span></h6>';
});
$(".track-model-content").html(track_model_html);
$("#status_box").html(html);
},'json');
}
	});
</script>