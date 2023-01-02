
<div class="pp-col card pp-padres black-text ps12">
<div class="pp-col p-padding_10 ps12">
		<h6 class="title  font18">My Orders</h6>
	</div>
			<table class="bordered border-1px font13 size_table">
				<thead>
					<tr>
						<th colspan="2" data-field="id">Order Summery</th>
						<!-- <th data-field="name">Order Status</th> -->
						<th class="hide_on_medium" data-field="name">Qty and Price</th>
						<th data-field="price">Status</th>
						<th data-field="price">View</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($order_mst as $order_data) {

							foreach (unserialize(base64_decode($order_data->trn_c_data))['cart_contents'] as $key => $value) {
								if ($key != "cart_total" && $key != 'total_items') {
								?>
					<tr>
						<td><img src="<?php echo base_url('uploads/pro_image/94_130/' . $value['image']); ?>" class="img-responsive"></td>
						<td>
						<div class="hide_on_medium teal-text font14"><?php echo $value['name']; ?></div>
							<div><?php echo 'Product Id : ' . $value['id']; ?></div>
							<div><?php echo 'Order Date : ' . $order_data->date; ?></div>
							<div><?php echo 'Order Id : ' . $order_data->id; ?></div>
							<div class="font-capitalize"><?php echo 'Payment By : ' . $order_data->payment_from; ?></div>
						</td>
						<!-- <td></td> -->
						<td class="hide_on_medium">
							<div><?php echo 'Qty : ' . $value['qty']; ?></div>
							<div><?php echo 'Product Price : ' . $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']) . ' ' . number_format((float) unserialize(base64_decode($order_data->trn_c_data))['currency'][$_SESSION['currency_choose']] * $value['price'], 2, '.', ''); ?></div>
							<?php
								if (isset($value['options'])) {
												$product_size = array();
												foreach ($value['options'] as $key1 => $value1) {
													// if ($value1[$key1 . 'radio'] == 'standard' || $value1[$key1 . 'radio'] == 'customize') {
												// $product_size = array_merge($product_size, array($key1 => $value1[$key1 . 'radio']));?>
							<div><?php echo $key1 . ' ' . $value1[$key1 . 'radio']; ?></div>
							<?php	// }
												}
										} else {?>
							<div>Unstitched Full Product</div>
							<?php }
										?>

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
							<div>Payment :<?php echo ($paypal_data_unser['currency_code'] == 'USD') ? 'US$' : '';
						echo $paypal_data_unser['amount_' . $no] * $paypal_data_unser['quantity_' . $no];
						if ($_SESSION['currency_choose'] != "USD") {

						echo " (" . $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']) . ' ' . number_format((float) unserialize(base64_decode($order_data->trn_c_data))['currency'][$_SESSION['currency_choose']] * round(($paypal_data_unser['amount_' . $no] * $paypal_data_unser['quantity_' . $no]) * (1 / unserialize(base64_decode($order_data->trn_c_data))['usd_price'])), 2, '.', '') . ")";} ?></div>
							<?php }

												// unserialize(base64_decode($paypal_data['or_' . $order_data->id]->datas))[''];
											}
										?>
						</td>
						<td>
							<?php
								switch ($order_data->status) {
											case '0':
												echo '<span class="font15 p-padding_lr_1rem p-padding_5 border-round  light-blue white-text">Pending</span><br>';
												break;
											case '1':
												echo '<span class="font15 p-padding_lr_1rem p-padding_5 border-round teal lighten-1 white-text">Customize Work</span><br>';
												break;
											case '2':
												echo '<span class="font15 p-padding_lr_1rem p-padding_5 border-round  deep-purple  white-text">Ready To Shipped</span><br>';
												break;
											case '3':
												echo '<span class="font15 p-padding_lr_1rem p-padding_5 border-round deep-orange lighten-1 white-text">Shipped</span><br>';
												break;
											case '4':
												echo '<span class="font15 p-padding_lr_1rem p-padding_5 border-round green lighten-1 white-text">Delivered</span><br>';
												break;

											case '5':
												echo '<span class="font15 p-padding_lr_1rem p-padding_5 border-round amber lighten-1 white-text">On Hold</span><br>';
												break;

											case '7':
												echo '<span class="font15 p-padding_lr_1rem p-padding_5 border-round red lighten-1 white-text">Canceled</span><br>';
												break;
											}
										?>
						</td>
						<td>
							<a href="<?php echo site_url('account/order_det/index/' . $order_data->id); ?>" class="btn"><i class="material-icons hide_on_large left">search</i>View</a>
						</td>
					</tr>
					<?php }
							}

						}
					?>
				</tbody>
			</table>
		</div>
		<style type="text/css" media="screen">
			.size_table	tr td{
		padding: 10px 7px;
	}
	</style>
