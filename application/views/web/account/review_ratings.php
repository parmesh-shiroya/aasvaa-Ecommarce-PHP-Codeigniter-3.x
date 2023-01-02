
<div class="pp-col card ps12">
	<div class="pp-col p-padding_10 ps12">
		<h6 class="title  font18">My Review & Ratings</h6>
	</div>
	<div class="pp-col font-karla zero_padding  ps12">
		<?php
if (!empty($my_reviews)) {

	foreach ($my_reviews as $key => $value) {
		$product_url = base_url('product/review/quick/' . $value->product_sku . '/' . $value->product_id . '/' . str_replace(" ", "-", $value->product_name));
		?>
		<div class="pp-col zero_padding wish_list_box valign-wrapper ps12">
			<div class="pp-col pp-margin-t-7 zero_padding ps3 pm2 pl2 pxl1">
				<img class="responsive-img br4" src="<?php echo base_url('uploads/pro_image/94_130/' . $value->pro_img); ?>">
			</div>
			<div class="pp-col pp-margin-t-7 pp-padding-l-15 ps9 pm10 pl10 pxl11">
				<div class="pp-col ps12">
					<a href="<?php echo $product_url; ?>"><h6 class="primary-text pp-margin-tb-4 name-title font-roboto_slab"><?php echo $value->product_name; ?></h6></a>
				</div>
				<div class="pp-col ps12">
					<h6 class="grey-text font13 pp-margin-tb-4 text-darken-1">Sku :-					                                                                 <?php echo $value->product_sku; ?></h6>
				</div>
				<div class="pp-col valign-wrapper ps12">

							<?php
for ($i = 1; $i <= 5; $i++) {
			if ($i <= $value->star) {
				echo '<span class="material-icons g8fs13 primary-text text-darken-3">star</span>';
			} else {
				// echo '<span class="material-icons g8fs13">star_border</span>';
			}
		}
		?>

				</div>
				<div class="pp-col ps12">
					<h6 class="grey-text text-darken-4 pp-margin-tb-4 font-500">Review :- <?php echo $value->review; ?></h6>
				</div>
				<div class="pp-col ps12">
				<h6 class="grey-text">
				<span class="pp-padding_l_7_in_small hover-text-primary font13 pointer btn_delete_review" review-id="<?php echo $value->id; ?>"><u>Delete Review</u></span>
				</h6>

				</div>
			</div>
		</div>
		<div class="divider"></div>
		<?php }}?>
	</div>
</div>

<script>
	$(document).ready(function() {
		$(".btn_delete_review").on('click', function(event) {
			event.preventDefault();
var review_id = $(this).attr('review-id');
$.post(base_url+'account/my_account_ajax/delete_review_ratings', {review_id: review_id}, function(data, textStatus, xhr) {
	location.reload();
});
		});
	});
</script>
<style>
.name-title{
	font-size: 14px;
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