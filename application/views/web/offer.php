<div class="pp-container">
<div class="pp-row ">
<div class="pp-col pp-margin-tb-15 ps12">
<h6 class="center font24 text-darken-3 font-shadow-2 font-courgette"><?php echo $offer_title; ?></h6>
</div>
<div class="pp-col ps12">
<?php
	foreach ($offer_images as $key => $value) {
		if (!empty($value->b_values)) {
			if (!empty($value->link)) {
				echo '<a href="';
				echo (filter_var($value->link, FILTER_VALIDATE_URL)) ? $value->link : site_url($value->link);
				echo '">';
			}
		?>
	<div class="pp-col zero_padding ps12">
		<img class="responsive-img" src="<?php echo base_url('uploads/banner/offer_image/1600_520/' . $value->b_values); ?>">
	</div>
<?php
	echo (!empty($value->b_values)) ? "</a>" : "";
	}} ?>
</div>
</div>
</div>

<style type="text/css" media="screen">
.main{
	background: #fff;
}
</style>