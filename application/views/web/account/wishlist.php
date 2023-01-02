<div class="pp-col card ps12">
	<div class="pp-col p-padding_10 ps12">
		<h6 class="title  font18">My Wishlist</h6>
	</div>
	<div class="pp-col zero_padding  ps12">
		<?php
if (isset($_SESSION['product_likes'])) {

	foreach ($_SESSION['product_likes'] as $key => $value) {
		if (isset(${'product_' . $value['product_id']})) {
			$product = ${'product_' . $value['product_id']};

			$product_url = base_url('product/' . $product->cat_name . '/' . str_replace(" ", "-", $product->sub_cat_name) . '/' . $product->product_sku . '/' . $product->product_id . '/' . str_replace(" ", "-", $product->product_name));
			?>
		<div class="pp-col zero_padding wish_list_box valign-wrapper ps12">
			<div class="pp-col pp-margin-t-7 zero_padding ps3 pm2 pl2 pxl1">
				<img class="responsive-img br4" src="<?php echo base_url('uploads/pro_image/94_130/' . $product->pro_img); ?>">
			</div>
			<div class="pp-col pp-margin-t-7 pp-padding-l-15 ps9 pm10 pl10 pxl11">
				<div class="pp-col ps12">
					<a href="<?php echo $product_url; ?>"><h6 class="primary-text pp-margin-tb-4 name-title font-roboto_slab"><?php echo $product->product_name; ?></h6></a>
				</div>
				<div class="pp-col ps12">
					<h6 class="grey-text font13 pp-margin-tb-4 text-darken-1">Sku :-					                                                                 <?php echo $product->product_sku; ?></h6>
				</div>
				<div class="pp-col ps12">
					<h6 class="grey-text text-darken-4 pp-margin-tb-4 font-500"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $product->sell_price); ?></h6>
				</div>
				<div class="pp-col ps12">
				<h6 class="grey-text text-darken-3">
				<span class="pp-padding-r-15 pp-zero_padding_in_small hover-text-primary"><button product-id="<?php echo $product->product_id; ?>" class="c-bbtnp h28 waves-effect  pointer btn_add_to_cart font-karla ">Add To Cart</button></span>
				<span class="pp-padding-l-15 pp-padding_l_7_in_small hover-text-primary font13 pointer btn_remove_from_list" wish-id="<?php echo $product->product_id; ?>"><u>Delete From List</u></span>
				</h6>

				</div>
			</div>
		</div>
		<div class="divider"></div>
		<?php }}}?>
	</div>
</div>

<script>
	$(document).ready(function() {
		$(".btn_remove_from_list").on('click', function(event) {
			event.preventDefault();
var wish_id = $(this).attr('wish-id');
$.post(base_url+'wishlist/remove_from_wish_list', {wish_id: wish_id}, function(data, textStatus, xhr) {
	console.log(data);
	if (data.result == true) {
		$('.btn_remove_from_list[wish-id="'+wish_id+'"]').parents(".wish_list_box").remove();
	}
},'json');
		});
	});
</script>
<style>
.name-title{
	font-size: 16px;
}
	 @media only screen and (max-width : 970px) {
	 	.name-title{
font-size: 1.2rem;
}
	 }
	  @media only screen and (max-width : 610px) {
	  	.name-title{
font-size: 1rem;
}
	 }
</style>