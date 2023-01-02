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
				<tbody class=" g8fs12">
					<?php
foreach ($cart_mst as $rows) {
	$customer_data = ${'customer_' . $rows->customer_id};
	foreach (unserialize(base64_decode($rows->cart)) as $cart_key => $cart_value) {
		if (isset($cart_value['adm_status']) && $cart_value['adm_status'] == 'on') {
			$product_url = base_url('product/' . ${'product_' . $cart_value['id']}->cat_name . '/' . str_replace(" ", "-", ${'product_' . $cart_value['id']}->sub_cat_name) . '/' . ${'product_' . $cart_value['id']}->product_sku . '/' . ${'product_' . $cart_value['id']}->product_id . '/' . str_replace(" ", "-", ${'product_' . $cart_value['id']}->product_name));
			?>
					<tr>
						<td><img src="<?php echo base_url('uploads/pro_image/94_130/' . $cart_value['image']); ?>" class="br4 img-responsive"></td>
						<td>
							<div class="font-roboto_slab g8mtb2 font13"><a target="_blank"  class="cp" href="<?php echo $product_url; ?>"><?php echo substr($cart_value['name'], 0, 42) . '...'; ?></a></div>
							<div class="grey-text g8fs11 g8mtb2 text-darken-1"><?php echo 'Product Id : ' . $cart_value['id']; ?></div>
							<div class="grey-text g8fs11 g8mtb2 text-darken-1"><?php echo 'Sku : ' . $cart_value['sku']; ?></div>
							<div class="grey-text font-500 g8mtb2 text-darken-4"><?php echo '&#8377;' . $cart_value['price']; ?></div>
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
					// $product_size = array_merge($product_size, array($key1 => $value1[$key1 . 'radio']));
					if (isset($value1[$key1 . 'radio'])) {

						?>

							<div class="teal-text font-500"><?php echo $key1 . ' ' . $value1[$key1 . 'radio']; ?></div>
							<?php } else {
						echo '<div>Unstitched Full Product</div>';
					}
				}} else {?>
							<div>Unstitched Full Product</div>
							<?php }?>
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