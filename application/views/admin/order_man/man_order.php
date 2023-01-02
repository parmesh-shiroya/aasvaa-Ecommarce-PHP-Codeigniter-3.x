<!-- <pre class="black-text">
	<?php
foreach ($order_mst as $key) {
	// print_r(unserialize(base64_decode($key->trn_c_data)));
	// print_r(unserialize(base64_decode($paypal_data['or_' . $key->id]->datas)));
}
?>
</pre> -->
<div class="pp-row">
	<div class="pp-col ps12">
		<ul class="tabs z-depth-1">
		<li class="tab pp-col ps2"><a class="active" href="#upcoming_order_div">Upcoming</a></li>
			<li class="tab pp-col ps2"><a  href="#pending_order_div">New</a></li>
			<li class="tab pp-col ps2"><a  href="#on_hold_order_div">On Hold</a></li>
			<!-- <li class="tab pp-col ps2"><a  href="#customize_work_order_div">Customize Work</a></li> -->
			<li class="tab pp-col ps2"><a href="#ready_to_ship_order_div">Ready To Ship</a></li>
			<li class="tab pp-col ps2"><a href="#shipped_order_div">Shipped</a></li>
			<li class="tab pp-col ps2"><a href="#delivered_order_div">Delivered</a></li>
		</ul>
	</div>
	<div id="upcoming_order_div" class="pp-col ps12">
		<div class="pp-col card pp-padres black-text ps12">
			<table class="bordered grey-text text-darken-3">
				<thead >
					<tr>
						<th colspan="2" data-field="id">Order Summery</th>
						<!-- <th data-field="name">Order Status</th> -->
						<th data-field="name">Qty and Price</th>
						<th data-field="price">Customer Details</th>
						<th data-field="price">Date</th>
						<!-- <th data-field="price">View</th> -->
					</tr>
				</thead>
				<tbody class=" font14">
					<?php
foreach ($cart_mst as $rows) {
	$customer_data = ${'customer_' . $rows->customer_id};
	foreach (unserialize(base64_decode($rows->cart)) as $cart_key => $cart_value) {
		if (isset($cart_value['adm_status']) && $cart_value['adm_status'] == 'on') {
			?>
					<tr>
						<td><img src="<?php echo base_url('uploads/pro_image/94_130/' . $cart_value['image']); ?>" class="img-responsive"></td>
						<td>
						<div class="font-roboto_slab pp-margin-tb-2 primary-text font15"><?php echo $cart_value['name']; ?></div>
							<div class="grey-text font13 pp-margin-tb-2 text-darken-1"><?php echo 'Product Id : ' . $cart_value['id']; ?></div>
							<div class="grey-text font13 pp-margin-tb-2 text-darken-1"><?php echo 'Sku : ' . $cart_value['sku']; ?></div>
							<div class="grey-text font-500 pp-margin-tb-2 text-darken-4"><?php echo '&#8377;' . $cart_value['price']; ?></div>
						</td>
						<!-- <td></td> -->
						<td>
							<div><?php echo 'Qty : ' . $cart_value['qty']; ?></div>
							<!-- <div><?php echo 'Product Price : &#8377;' . $cart_value['price']; ?></div> -->
							<?php
if (isset($cart_value['options'])) {
				$product_size = array();
				foreach ($cart_value['options'] as $key1 => $value1) {
					// if ($value1[$key1 . 'radio'] == 'standard' || $value1[$key1 . 'radio'] == 'customize') {
					// $product_size = array_merge($product_size, array($key1 => $value1[$key1 . 'radio']));?>
							<div class="teal-text font-500"><?php echo $key1 . ' ' . $value1[$key1 . 'radio']; ?></div>
							<?php	// }
				}
			} else {?>
							<div>Unstitched Full Product</div>
							<?php }
			?>


						</td>
						<td>
							<div class="font-capitalize">Name : <?php echo $customer_data->first_name . ' ' . $customer_data->last_name; ?></div>
							<div>Email : <?php echo $customer_data->email_id; ?></div>
						</td>
						<td>
<div><?php echo $cart_value['date']; ?></div>
						</td>
						<td>
							<!-- <a href="<?php echo site_url('admin/order_man/order_detail/index/' . $order_data->id); ?>" class="btn"><i class="material-icons left">search</i>View</a> -->
						</td>
					</tr>
					<?php }
	}
}

?>
				</tbody>
			</table>
		</div>
	</div>


	<div id="pending_order_div" class="pp-col ps12">
		<div class="pp-col card pp-padres black-text ps12">
			<table class="bordered">
				<thead>
					<tr>
						<th colspan="2" data-field="id">Order Summery</th>
						<!-- <th data-field="name">Order Status</th> -->
						<th data-field="name">Qty and Price</th>
						<th data-field="price">Buyer Details</th>
						<th data-field="price">Status</th>
						<th data-field="price">View</th>
					</tr>
				</thead>
				<tbody>
					<?php
foreach ($order_mst as $order_data) {
	if ($order_data->status == 0) {
		foreach (unserialize(base64_decode($order_data->trn_c_data))['cart_contents'] as $key => $value) {
			if ($key != "cart_total" && $key != 'total_items') {
				?>
					<tr>
						<td><img src="<?php echo base_url('uploads/pro_image/94_130/' . $value['image']); ?>" class="img-responsive"></td>
						<td>
							<div><?php echo 'Product Id : ' . $value['id']; ?></div>
							<div><?php echo 'Order Date : ' . $order_data->date; ?></div>
							<div><?php echo 'Order Id : ' . $order_data->id; ?></div>
						</td>
						<!-- <td></td> -->
						<td>
							<div><?php echo 'Qty : ' . $value['qty']; ?></div>
							<div><?php echo 'Product Price : &#8377;' . $value['price']; ?></div>
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
							<div><?php echo 'Payment By : ' . $order_data->payment_from; ?></div>
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
							<div>Payment : <?php echo ($paypal_data_unser['currency_code'] == 'USD') ? '$' : '';
						echo $paypal_data_unser['amount_' . $no] * $paypal_data_unser['quantity_' . $no] . " (&#8377;" . round(($paypal_data_unser['amount_' . $no] * $paypal_data_unser['quantity_' . $no]) * (1 / unserialize(base64_decode($order_data->trn_c_data))['usd_price'])) . ")"; ?></div>
							<?php }
					// unserialize(base64_decode($paypal_data['or_' . $order_data->id]->datas))[''];
				}
				?>
						</td>
						<td>
							<div>Id : <?php echo unserialize(base64_decode($order_data->trn_c_data))['customer_data']['customer_id']; ?></div>
							<div class="font-capitalize">Name : <?php echo unserialize(base64_decode($order_data->trn_c_data))['customer_data']['firstname'] . ' ' . unserialize(base64_decode($order_data->trn_c_data))['customer_data']['lastname']; ?></div>
							<div>Email : <?php echo unserialize(base64_decode($order_data->trn_c_data))['customer_data']['email']; ?></div>
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
					echo '<span class="font15 p-padding_lr_1rem p-padding_5 border-round green  white-text">Delivered</span><br>';
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
							<a href="<?php echo site_url('admin/order_man/order_detail/index/' . $order_data->id); ?>" class="btn"><i class="material-icons left">search</i>View</a>
						</td>
					</tr>
					<?php }
		}
	}
}
?>
				</tbody>
			</table>
		</div>
	</div>

<div id="on_hold_order_div" class="pp-col ps12">
		<div class="pp-col card pp-padres black-text ps12">
			<table class="bordered">
				<thead>
					<tr>
						<th colspan="2" data-field="id">Order Summery</th>
						<!-- <th data-field="name">Order Status</th> -->
						<th data-field="name">Qty and Price</th>
						<th data-field="price">Buyer Details</th>
						<th data-field="price">Status</th>
						<th data-field="price">View</th>
					</tr>
				</thead>
				<tbody>
					<?php
foreach ($order_mst as $order_data) {
	if ($order_data->status == 5 || $order_data->status == 1) {
		foreach (unserialize(base64_decode($order_data->trn_c_data))['cart_contents'] as $key => $value) {
			if ($key != "cart_total" && $key != 'total_items') {
				?>
					<tr>
						<td><img src="<?php echo base_url('uploads/pro_image/94_130/' . $value['image']); ?>" class="img-responsive"></td>
						<td>
							<div><?php echo 'Product Id : ' . $value['id']; ?></div>
							<div><?php echo 'Order Date : ' . $order_data->date; ?></div>
							<div><?php echo 'Order Id : ' . $order_data->id; ?></div>
						</td>
						<!-- <td></td> -->
						<td>
							<div><?php echo 'Qty : ' . $value['qty']; ?></div>
							<div><?php echo 'Product Price : &#8377;' . $value['price']; ?></div>
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
							<div><?php echo 'Payment By : ' . $order_data->payment_from; ?></div>
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
							<div>Payment : <?php echo ($paypal_data_unser['currency_code'] == 'USD') ? '$' : '';
						echo $paypal_data_unser['amount_' . $no] * $paypal_data_unser['quantity_' . $no] . " (&#8377;" . round(($paypal_data_unser['amount_' . $no] * $paypal_data_unser['quantity_' . $no]) * (1 / unserialize(base64_decode($order_data->trn_c_data))['usd_price'])) . ")"; ?></div>
							<?php }
					// unserialize(base64_decode($paypal_data['or_' . $order_data->id]->datas))[''];
				}
				?>
						</td>
						<td>
							<div>Id : <?php echo unserialize(base64_decode($order_data->trn_c_data))['customer_data']['customer_id']; ?></div>
							<div class="font-capitalize">Name : <?php echo unserialize(base64_decode($order_data->trn_c_data))['customer_data']['firstname'] . ' ' . unserialize(base64_decode($order_data->trn_c_data))['customer_data']['lastname']; ?></div>
							<div>Email : <?php echo unserialize(base64_decode($order_data->trn_c_data))['customer_data']['email']; ?></div>
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
					echo '<span class="font15 p-padding_lr_1rem p-padding_5 border-round green  white-text">Delivered</span><br>';
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
							<a href="<?php echo site_url('admin/order_man/order_detail/index/' . $order_data->id); ?>" class="btn"><i class="material-icons left">search</i>View</a>
						</td>
					</tr>
					<?php }
		}
	}
}
?>
				</tbody>
			</table>
		</div>

	</div>

	<?php
/* <div id="customize_work_order_div" class="pp-col ps12">
<div class="pp-col card pp-padres black-text ps12">
<table class="bordered">
<thead>
<tr>
<th colspan="2" data-field="id">Order Summery</th>
<!-- <th data-field="name">Order Status</th> -->
<th data-field="name">Qty and Price</th>
<th data-field="price">Buyer Details</th>
<th data-field="price">Status</th>
<th data-field="price">View</th>
</tr>
</thead>
<tbody>
<?php
foreach ($order_mst as $order_data) {
if ($order_data->status == 1) {
foreach (unserialize(base64_decode($order_data->trn_c_data))['cart_contents'] as $key => $value) {
if ($key != "cart_total" && $key != 'total_items') {
?>
<tr>
<td><img src="<?php echo base_url('uploads/pro_image/94_130/' . $value['image']); ?>" class="img-responsive"></td>
<td>
<div><?php echo 'Product Id : ' . $value['id']; ?></div>
<div><?php echo 'Order Date : ' . $order_data->date; ?></div>
<div><?php echo 'Order Id : ' . $order_data->id; ?></div>
</td>
<!-- <td></td> -->
<td>
<div><?php echo 'Qty : ' . $value['qty']; ?></div>
<div><?php echo 'Product Price : &#8377;' . $value['price']; ?></div>
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
<div><?php echo 'Payment By : ' . $order_data->payment_from; ?></div>
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
<div>Payment : <?php echo ($paypal_data_unser['currency_code'] == 'USD') ? '$' : '';
echo $paypal_data_unser['amount_' . $no] * $paypal_data_unser['quantity_' . $no] . " (&#8377;" . round(($paypal_data_unser['amount_' . $no] * $paypal_data_unser['quantity_' . $no]) * (1 / unserialize(base64_decode($order_data->trn_c_data))['usd_price'])) . ")"; ?></div>
<?php }
// unserialize(base64_decode($paypal_data['or_' . $order_data->id]->datas))[''];
}
?>
</td>
<td>
<div>Id : <?php echo unserialize(base64_decode($order_data->trn_c_data))['customer_data']['customer_id']; ?></div>
<div class="font-capitalize">Name : <?php echo unserialize(base64_decode($order_data->trn_c_data))['customer_data']['firstname'] . ' ' . unserialize(base64_decode($order_data->trn_c_data))['customer_data']['lastname']; ?></div>
<div>Email : <?php echo unserialize(base64_decode($order_data->trn_c_data))['customer_data']['email']; ?></div>
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
echo '<span class="font15 p-padding_lr_1rem p-padding_5 border-round green  white-text">Delivered</span><br>';
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
<a href="<?php echo site_url('admin/order_man/order_detail/index/' . $order_data->id); ?>" class="btn"><i class="material-icons left">search</i>View</a>
</td>
</tr>
<?php }
}
}
}
?>
</tbody>
</table>
</div>

</div> */?>
	<div id="ready_to_ship_order_div" class="pp-col ps12">
<div class="pp-col card pp-padres black-text ps12">
			<table class="bordered">
				<thead>
					<tr>
						<th colspan="2" data-field="id">Order Summery</th>
						<!-- <th data-field="name">Order Status</th> -->
						<th data-field="name">Qty and Price</th>
						<th data-field="price">Buyer Details</th>
						<th data-field="price">Status</th>
						<th data-field="price">View</th>
					</tr>
				</thead>
				<tbody>
					<?php
foreach ($order_mst as $order_data) {
	if ($order_data->status == 2) {
		foreach (unserialize(base64_decode($order_data->trn_c_data))['cart_contents'] as $key => $value) {
			if ($key != "cart_total" && $key != 'total_items') {
				?>
					<tr>
						<td><img src="<?php echo base_url('uploads/pro_image/94_130/' . $value['image']); ?>" class="img-responsive"></td>
						<td>
							<div><?php echo 'Product Id : ' . $value['id']; ?></div>
							<div><?php echo 'Order Date : ' . $order_data->date; ?></div>
							<div><?php echo 'Order Id : ' . $order_data->id; ?></div>
						</td>
						<!-- <td></td> -->
						<td>
							<div><?php echo 'Qty : ' . $value['qty']; ?></div>
							<div><?php echo 'Product Price : &#8377;' . $value['price']; ?></div>
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
							<div><?php echo 'Payment By : ' . $order_data->payment_from; ?></div>
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
							<div>Payment : <?php echo ($paypal_data_unser['currency_code'] == 'USD') ? '$' : '';
						echo $paypal_data_unser['amount_' . $no] * $paypal_data_unser['quantity_' . $no] . " (&#8377;" . round(($paypal_data_unser['amount_' . $no] * $paypal_data_unser['quantity_' . $no]) * (1 / unserialize(base64_decode($order_data->trn_c_data))['usd_price'])) . ")"; ?></div>
							<?php }
					// unserialize(base64_decode($paypal_data['or_' . $order_data->id]->datas))[''];
				}
				?>
						</td>
						<td>
							<div>Id : <?php echo unserialize(base64_decode($order_data->trn_c_data))['customer_data']['customer_id']; ?></div>
							<div class="font-capitalize">Name : <?php echo unserialize(base64_decode($order_data->trn_c_data))['customer_data']['firstname'] . ' ' . unserialize(base64_decode($order_data->trn_c_data))['customer_data']['lastname']; ?></div>
							<div>Email : <?php echo unserialize(base64_decode($order_data->trn_c_data))['customer_data']['email']; ?></div>
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
					echo '<span class="font15 p-padding_lr_1rem p-padding_5 border-round green  white-text">Delivered</span><br>';
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
							<a href="<?php echo site_url('admin/order_man/order_detail/index/' . $order_data->id); ?>" class="btn"><i class="material-icons left">search</i>View</a>
						</td>
					</tr>
					<?php }
		}
	}
}
?>
				</tbody>
			</table>
		</div>
	</div>
	<div id="shipped_order_div" class="pp-col ps12">
<div class="pp-col card pp-padres black-text ps12">
			<table class="bordered">
				<thead>
					<tr>
						<th colspan="2" data-field="id">Order Summery</th>
						<!-- <th data-field="name">Order Status</th> -->
						<th data-field="name">Qty and Price</th>
						<th data-field="price">Buyer Details</th>
						<th data-field="price">Status</th>
						<th data-field="price">View</th>
					</tr>
				</thead>
				<tbody>
					<?php
foreach ($order_mst as $order_data) {
	if ($order_data->status == 3) {
		foreach (unserialize(base64_decode($order_data->trn_c_data))['cart_contents'] as $key => $value) {
			if ($key != "cart_total" && $key != 'total_items') {
				?>
					<tr>
						<td><img src="<?php echo base_url('uploads/pro_image/94_130/' . $value['image']); ?>" class="img-responsive"></td>
						<td>
							<div><?php echo 'Product Id : ' . $value['id']; ?></div>
							<div><?php echo 'Order Date : ' . $order_data->date; ?></div>
							<div><?php echo 'Order Id : ' . $order_data->id; ?></div>
						</td>
						<!-- <td></td> -->
						<td>
							<div><?php echo 'Qty : ' . $value['qty']; ?></div>
							<div><?php echo 'Product Price : &#8377;' . $value['price']; ?></div>
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
							<div><?php echo 'Payment By : ' . $order_data->payment_from; ?></div>
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
							<div>Payment : <?php echo ($paypal_data_unser['currency_code'] == 'USD') ? '$' : '';
						echo $paypal_data_unser['amount_' . $no] * $paypal_data_unser['quantity_' . $no] . " (&#8377;" . round(($paypal_data_unser['amount_' . $no] * $paypal_data_unser['quantity_' . $no]) * (1 / unserialize(base64_decode($order_data->trn_c_data))['usd_price'])) . ")"; ?></div>
							<?php }
					// unserialize(base64_decode($paypal_data['or_' . $order_data->id]->datas))[''];
				}
				?>
						</td>
						<td>
							<div>Id : <?php echo unserialize(base64_decode($order_data->trn_c_data))['customer_data']['customer_id']; ?></div>
							<div class="font-capitalize">Name : <?php echo unserialize(base64_decode($order_data->trn_c_data))['customer_data']['firstname'] . ' ' . unserialize(base64_decode($order_data->trn_c_data))['customer_data']['lastname']; ?></div>
							<div>Email : <?php echo unserialize(base64_decode($order_data->trn_c_data))['customer_data']['email']; ?></div>
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
					echo '<span class="font15 p-padding_lr_1rem p-padding_5 border-round green  white-text">Delivered</span><br>';
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
							<a href="<?php echo site_url('admin/order_man/order_detail/index/' . $order_data->id); ?>" class="btn"><i class="material-icons left">search</i>View</a>
						</td>
					</tr>
					<?php }
		}
	}
}
?>
				</tbody>
			</table>
		</div>
	</div>
	<div id="delivered_order_div" class="pp-col ps12">
<div class="pp-col card pp-padres black-text ps12">
			<table class="bordered">
				<thead>
					<tr>
						<th colspan="2" data-field="id">Order Summery</th>
						<!-- <th data-field="name">Order Status</th> -->
						<th data-field="name">Qty and Price</th>
						<th data-field="price">Buyer Details</th>
						<th data-field="price">Status</th>
						<th data-field="price">View</th>
					</tr>
				</thead>
				<tbody>
					<?php
foreach ($order_mst as $order_data) {
	if ($order_data->status == 4) {
		foreach (unserialize(base64_decode($order_data->trn_c_data))['cart_contents'] as $key => $value) {
			if ($key != "cart_total" && $key != 'total_items') {
				?>
					<tr>
						<td><img src="<?php echo base_url('uploads/pro_image/94_130/' . $value['image']); ?>" class="img-responsive"></td>
						<td>
							<div><?php echo 'Product Id : ' . $value['id']; ?></div>
							<div><?php echo 'Order Date : ' . $order_data->date; ?></div>
							<div><?php echo 'Order Id : ' . $order_data->id; ?></div>
						</td>
						<!-- <td></td> -->
						<td>
							<div><?php echo 'Qty : ' . $value['qty']; ?></div>
							<div><?php echo 'Product Price : &#8377;' . $value['price']; ?></div>
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
							<div><?php echo 'Payment By : ' . $order_data->payment_from; ?></div>
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
							<div>Payment : <?php echo ($paypal_data_unser['currency_code'] == 'USD') ? '$' : '';
						echo $paypal_data_unser['amount_' . $no] * $paypal_data_unser['quantity_' . $no] . " (&#8377;" . round(($paypal_data_unser['amount_' . $no] * $paypal_data_unser['quantity_' . $no]) * (1 / unserialize(base64_decode($order_data->trn_c_data))['usd_price'])) . ")"; ?></div>
							<?php }
					// unserialize(base64_decode($paypal_data['or_' . $order_data->id]->datas))[''];
				}
				?>
						</td>
						<td>
							<div>Id : <?php echo unserialize(base64_decode($order_data->trn_c_data))['customer_data']['customer_id']; ?></div>
							<div class="font-capitalize">Name : <?php echo unserialize(base64_decode($order_data->trn_c_data))['customer_data']['firstname'] . ' ' . unserialize(base64_decode($order_data->trn_c_data))['customer_data']['lastname']; ?></div>
							<div>Email : <?php echo unserialize(base64_decode($order_data->trn_c_data))['customer_data']['email']; ?></div>
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
					echo '<span class="font15 p-padding_lr_1rem p-padding_5 border-round green  white-text">Delivered</span><br>';
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
							<a href="<?php echo site_url('admin/order_man/order_detail/index/' . $order_data->id); ?>" class="btn"><i class="material-icons left">search</i>View</a>
						</td>
					</tr>
					<?php }
		}
	}
}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<style type="text/css" media="screen">
.indicator{
	/* display: none; */
}
table thead th{
	font-weight: 500;
}
</style>