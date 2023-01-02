<?php
foreach ($order_mst as $order_data) {
	if (in_array($order_data->status, $status_array)) {
		$trn_c_data = unserialize(base64_decode($order_data->trn_c_data));?>
		<div class="pp-col card bb0 border3-1px z-depth-0 zero_padding  ps12">
			<div class="pp-col p-padding_tb_9 border2-1px p-padding_lr_1rem valign-wrapper ps12">
				<div class="pp-col ps12 pm4 left zero_padding"><a href="<?php echo site_url('admin/order_man/order_detail/index/' . $order_data->id . '/' . $order_data->order_id); ?>"><button class="order_button waves-effect c-btna g8plr20 "><?php echo $order_data->order_id; ?></button></a></div>
				<div class="pp-col ps4 pp-hide-small-min center zero_padding">
					<?php
echo $this->pp_loader_helper->set_order_status($order_data->status);
		?>
				</div>
			</div>
			<div class="pp-col p-padding_tb_9 border2-1px p-padding_lr_1rem grey-text text-darken-4 valign-wrapper ps12">
				<div class="pp-col hide-on-medium-max ps12 center zero_padding">
					<?php
echo $this->pp_loader_helper->set_order_status($order_data->status);
		?>
				</div>
				<div class="pp-col pm4 left zero_padding">
					<h6 class=" g8fs12 pp-margin-tb-4"><div class='pwidth_120px grey-text-new left'>Order Time : </div><span><?php echo $order_data->date . " (" . $order_data->time . ")"; ?></span></h6>
					<h6 class=" g8fs12 pp-margin-tb-4 "><div class='pwidth_120px grey-text-new left'>Total Product :</div><span><?php echo $trn_c_data['cart_contents']['total_items']; ?></span></h6>
				</div>
				<div class="pp-col pm4 right zero_padding">
				<h6 class="g8fs12 pp-margin-tb-4 "><div class="pwidth_120px grey-text-new left">Total : </div><span ><?php echo $this->ccr->cc("INR", "INR", $trn_c_data['cart_contents']['cart_total'] + $trn_c_data['newcart']['total_service_charges']); ?></span></h6>
<?php
if (isset($trn_c_data['cart_coupen_data'])) {?>
				<h6 class=" g8fs12 pp-margin-tb-4 "><div class='pwidth_120px grey-text-new left'> Discount : </div><span>
<?php echo ($trn_c_data['cart_coupen_data']->discount_type == 0) ? $this->ccr->cc("INR", "INR", $trn_c_data['cart_coupen_data']->dis_percet_rs) : '' . $trn_c_data['cart_coupen_data']->dis_percet_rs . '%'; ?>
				</span></h6>
<?php }?>
<h6 class="g8fs12 pp-margin-tb-4"><div class="pwidth_120px grey-text-new left">Shipping Charge : </div><span><?php echo $this->ccr->cc("INR", "INR", $trn_c_data['newcart']['total_shipping_charges']); ?></span></h6>
<?php
$total_paid = $trn_c_data['cart_contents']['cart_total'] + $trn_c_data['newcart']['total_other_charges'];
		if (isset($trn_c_data['cart_coupen_data'])) {
			if ($trn_c_data['cart_coupen_data']->discount_type == 0) {
				$total_paid = $total_paid - $trn_c_data['cart_coupen_data']->dis_percet_rs;
			} else if ($trn_c_data['cart_coupen_data']->discount_type == 1) {
				$total_paid = $total_paid - ((($$trn_c_data['cart_contents']['cart_total'] + $trn_c_data['newcart']['total_service_charges']) * $trn_c_data['cart_coupen_data']->dis_percet_rs) / 100);
			}
		}
		?>
<h6 class="g8fs12 pp-margin-tb-4"><div class="pwidth_120px grey-text-new left"><?php echo ($order_data->payment_from == 'cod') ? 'Total Payable' : 'Total Paid' ?> : </div><span><?php echo $this->ccr->cc("INR", "INR", $total_paid); ?></span></h6>
			</div>
				<div class="pp-col pm4 right zero_padding">
	<h6 class="g8fs12 pp-margin-tb-4 "><div class="pwidth_120px grey-text-new left">Customer : </div><span class="font-capitalize" ><?php echo ${'customer_' . $order_data->customer_id}->first_name . " " . ${'customer_' . $order_data->customer_id}->last_name; ?></span></h6>
	<h6 class="g8fs12 pp-margin-tb-4 "><div class="pwidth_120px grey-text-new left">Email id : </div><span ><?php echo ${'customer_' . $order_data->customer_id}->email_id; ?></span></h6>
				</div>
			</div>
			<div class="pp-col ps12  zero_padding pp-padres">
				<?php foreach ($trn_c_data['cart_contents'] as $key => $value) {
			if ($key != "cart_total" && $key != 'total_items') {
				?>
				<div class="pp-col valign-wrapper ps12">
					<div class="pp-col pp-margin-t-7 zero_padding ps3 pm2 pl2 pxl1">
						<img class="responsive-img br4" src="<?php echo base_url('uploads/pro_image/94_130/' . $value['image']); ?>">
					</div>
					<div class="pp-col pp-margin-t-7 pp-padding-l-15 ps9 pm7 pl6 pxl6">
						<div class="pp-col ps12">
							<h6 class="pp-margin-tb-4 name-title g8fs13 g8ls7"><a target="_blank" href="<?php echo base_url('product/order/product/' . $value['sku'] . '/' . $value['id'] . '/' . $value['name']); ?>" class="primary-text "><?php echo $value['name']; ?></a></h6>
						</div>
						<div class="pp-col ps12">
							<h6 class="grey-text font12 pp-margin-tb-4 text-darken-1"><span class="pp-padding-r-7"><?php echo (isset($value['sku'])) ? 'Sku :- ' . $value['sku'] : ''; ?></span>
							<?php echo 'Qty :- ' . $value['qty']; ?></h6>
						</div>
						<div class="pp-col  ps12">
							<?php
$total_product_price = $value['price'];
				if (isset($trn_c_data['newcart']['services_expenses'])) {
					if (isset($trn_c_data['newcart']['services_expenses'][$value['rowid']])) {
						$total_product_price = $value['price'] + $trn_c_data['newcart']['services_expenses'][$value['rowid']];
					}
				}

				?>
							<h6 class="grey-text text-darken-4 g8fs12 pp-margin-tb-4 font-500"><?php echo $this->ccr->cc('INR', 'INR', $total_product_price); ?></h6>
						</div>
					</div>
					<div class="pp-col pp-margin-t-7 pp-padding-l-15 pp-hide-small-min pm3 pl4 pxl4">
						<?php
if (isset($value['options'])) {
					$product_size = array();
					foreach ($value['options'] as $key1 => $value1) {
						if ($value1[$key1 . 'radio'] == 'standard' || $value1[$key1 . 'radio'] == 'customize') {
							echo '<h6 class="primary-text font-500 g8fs12 pp-margin-tb-4">';
						} else {
							echo '<h6 class="grey-text font12 pp-margin-tb-4 text-darken-1">';
						}
						// $product_size = array_merge($product_size, array($key1 => $value1[$key1 . 'radio']));?>
<?php echo $key1 . ' ' . $value1[$key1 . 'radio']; ?></h6>
						<?php	// }
					}
				} else {?>
						<h6 class="grey-text font12 pp-margin-tb-4 text-darken-1">Unstitched Full Product</h6>
						<?php }
				?>
					</div>
				</div>
				<div class="divider"></div>
				<?php }}?>
			</div>

		</div>
		<?php }
}?>